<?php

namespace App\Service;

use App\Entity\AdmPage;
use App\Service\AdmPageProfileService;

class AdmPageService
{
    /**
     * @var AdmPageProfileService
     */
    private $service;

    public function __construct(AdmPageProfileService $service) {
        $this->service = $service;
    }

    public function setTransientList(array $list): void
    {
        foreach ($list as $item)
        {
            $this->setTransient($item);
        }
    }

    public function setTransient(AdmPage $item): void
    {
        $obj = $this->service->getProfilesByPage($item->getId());
        foreach ($obj as $profile) {
            array_push($item->getAdmIdProfiles(), $profile->getId());
        }

        $listPageProfiles = array();
        foreach ($obj as $profile) {
            array_push($listPageProfiles, $profile->getDescription());
        }
        $item->setPageProfiles(implode(",", $listPageProfiles));
    }

}