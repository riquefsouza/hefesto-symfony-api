<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\AdmPage;

/**
 * AdmMenu
 *
 * @ORM\Table(name="adm_menu", uniqueConstraints={@ORM\UniqueConstraint(name="adm_menu_uk", columns={"mnu_description"})}, indexes={@ORM\Index(name="IDX_54F2B6ABF75889DC", columns={"mnu_pag_seq"}), @ORM\Index(name="IDX_54F2B6AB771551D", columns={"mnu_parent_seq"})})
 * @ORM\Entity
 * @ORM\NamedQueries({
 * 	@ORM\NamedQuery(name = "AdmProfile.findAdminMenuParentByIdProfiles", 
 *   query="SELECT t FROM App\Entity\AdmMenu t WHERE t.id IN (SELECT m.idMenuParent FROM App\Entity\AdmProfile p INNER JOIN p.admPages f INNER JOIN f.admMenus m WHERE p.id IN (?1) AND m.id <= 9) ORDER BY t.id, t.order"),
 *  @ORM\NamedQuery(name = "AdmProfile.findMenuParentByIdProfiles", 
 *   query="SELECT t FROM App\Entity\AdmMenu t WHERE t.id IN (SELECT m.idMenuParent FROM App\Entity\AdmProfile p INNER JOIN p.admPages f INNER JOIN f.admMenus m WHERE p.id IN (?1) AND m.id > 9) ORDER BY t.order, t.id"),
 *	@ORM\NamedQuery(name = "AdmProfile.findAdminMenuByIdProfiles", 
 *   query="SELECT t FROM App\Entity\AdmMenu t WHERE t.id IN (SELECT m.id FROM App\Entity\AdmProfile p INNER JOIN p.admPages f INNER JOIN f.admMenus m WHERE p.id IN (?1) AND m.id <= 9 AND m.idMenuParent = ?2) ORDER BY t.id, t.order"),
 *	@ORM\NamedQuery(name = "AdmProfile.findMenuByIdProfiles", 
 *   query="SELECT t FROM App\Entity\AdmMenu t WHERE t.id IN (SELECT m.id FROM App\Entity\AdmProfile p INNER JOIN p.admPages f INNER JOIN f.admMenus m WHERE p.id IN (?1) AND m.id > 9 AND m.idMenuParent = ?2) ORDER BY t.id, t.order"),
 * })  
 */
class AdmMenu implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="mnu_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_menu_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mnu_description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mnu_order", type="integer", nullable=true)
     */
    private $order;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mnu_pag_seq", type="integer", nullable=true)
     */
    private $idPage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mnu_parent_seq", type="integer", nullable=true)
     */
    private $idMenuParent;

    /**
     * @var \AdmPage
     *
     * @ORM\ManyToOne(targetEntity="AdmPage", inversedBy="admMenus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mnu_pag_seq", referencedColumnName="pag_seq")
     * })
     */
    private $admPage;

    /**
     * @var \AdmMenu
     *
     * @ORM\ManyToOne(targetEntity="AdmMenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mnu_parent_seq", referencedColumnName="mnu_seq")
     * })
     */
    private $admMenuParent;

    /** 
     * @var \AdmMenu[]|null
    */
    private $admSubMenus = array();

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getIdPage(): ?int
    {
        return $this->idPage;
    }

    public function setIdPage(?int $idPage): self
    {
        $this->idPage = $idPage;

        return $this;
    }

    public function getIdMenuParent(): ?int
    {
        return $this->idMenuParent;
    }

    public function setIdMenuParent(?int $idMenuParent): self
    {
        $this->idMenuParent = $idMenuParent;

        return $this;
    }

    public function getAdmPage(): ?AdmPage
    {
        return $this->admPage;
    }

    public function setAdmPage(?AdmPage $admPage): self
    {
        $this->admPage = $admPage;

        return $this;
    }

    public function getAdmMenuParent(): ?self
    {
        return $this->admMenuParent;
    }

    public function setAdmMenuParent(?self $admMenuParent): self
    {
        $this->admMenuParent = $admMenuParent;

        return $this;
    }

    public function getUrl(): string|null
    {
		return $this->admPage != null ? $this->admPage->getUrl() : null;
	}

    /**
     * @return \AdmMenu[]|null
     */
    public function &getAdmSubMenus()
    {
        return $this->admSubMenus;
    }

    public function setAdmSubMenus(array $admSubMenus): self
    {
        $this->admSubMenus = $admSubMenus;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'description' => $this->getDescription(),
            'idMenuParent' => $this->getAdmMenuParent()!=null ? $this->getAdmMenuParent()->getId() : '',
            'idPage' => $this->getAdmPage()!=null ? $this->getAdmPage()->getId() : '',
            'order' => $this->getOrder(),
            'admPage' => $this->getAdmPage(),
            'admMenuParent' => $this->getAdmMenuParent(),
        ];
    }

}
