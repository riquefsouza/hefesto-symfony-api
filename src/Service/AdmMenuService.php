<?php

namespace App\Service;

use App\Entity\AdmMenu;
use App\Base\Models\MenuItemDTO;
use App\Repository\AdmMenuRepository;
use App\Repository\AdmPageRepository;

class AdmMenuService
{
    /**
     * @var AdmMenuRepository
     */
    private $menuRepository;
    
    /**
     * @var AdmPageRepository
     */
    private $pageRepository;

    public function __construct(AdmMenuRepository $menuRepository,
        AdmPageRepository $pageRepository) {
        $this->menuRepository = $menuRepository;
        $this->pageRepository = $pageRepository;
    }

    public function setTransientWithoutSubMenus(array $list): void
    {
        foreach ($list as $item) {
            $this->setTransientSubMenus($item, null);
        }
    }

    public function setTransientList(array $list): void
    {
        foreach ($list as $item) {
            $this->setTransient($item);
        }
    }

    public function setTransientSubMenus(AdmMenu $item, array|null $subMenus): void
    {
        if ($item->getIdPage()!=null){
            $item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
        }
        if ($item->getIdMenuParent()!=null){
            $item->AdmMenuParent = $this->menuRepository->find($item->getIdMenuParent()); 
        }
        if ($subMenus!=null) {
            $item->setAdmSubMenus($subMenus);
        }
    }

    public function setTransient(AdmMenu $item)
    {
        $this->setTransientSubMenus($item, $this->menuRepository->findByIdMenuParent($item->getId()));
    }

    /**
     * @return AdmMenu[]
     */
    public function findMenuParentByIdProfiles(array $listaIdProfile){
        $lista = $this->menuRepository->findMenuParentByIdProfiles($listaIdProfile);

        foreach ($lista as $admMenu) {
            $plist = $this->menuRepository->findMenuByIdProfiles($listaIdProfile, $admMenu->getId());
            $this->setTransientWithoutSubMenus($plist);
            $this->setTransientSubMenus($admMenu, $plist);
        }
        return $lista;
    }
    /**
     * @return AdmMenu[]
     */
    public function findAdminMenuParentByIdProfiles(array $listaIdProfile){
        $lista = $this->menuRepository->findAdminMenuParentByIdProfiles($listaIdProfile);

        foreach ($lista as $admMenu) {
            $plist = $this->menuRepository->findAdminMenuByIdProfiles($listaIdProfile, $admMenu->getId());
            $this->setTransientWithoutSubMenus($plist);
            $this->setTransientSubMenus($admMenu, $plist);
        }
        return $lista;
    }

    /**
     * @return MenuItemDTO[]
     */
    public function mountMenuItem(array $listaIdProfile)
    {
        $lista = array();
        $listMenus = $this->findMenuParentByIdProfiles($listaIdProfile);
        
        foreach ($listMenus as $menu) {
            $item = array();
            $admSubMenus = $menu->getAdmSubMenus();

            foreach ($admSubMenus as $submenu) {
                $submenuVO = new MenuItemDTO($submenu->getDescription(), $submenu->getUrl());
                array_push($item, $submenuVO);
            };
            
            $vo = new MenuItemDTO($menu->getDescription(), $menu->getUrl(), $item);
            array_push($lista, $vo);
        };
        
        $listAdminMenus = $this->findAdminMenuParentByIdProfiles($listaIdProfile);
        foreach ($listAdminMenus as $menu) {
            $item = array();
            $admSubMenus = $menu->getAdmSubMenus();

            foreach ($admSubMenus as $submenu) {
                $submenuVO = new MenuItemDTO($submenu->getDescription(), $submenu->getUrl());
                array_push($item, $submenuVO);
            };
            
            $vo = new MenuItemDTO($menu->getDescription(), $menu->getUrl(), $item);
            array_push($lista, $vo);
        };
    
        return $lista;
    }

}