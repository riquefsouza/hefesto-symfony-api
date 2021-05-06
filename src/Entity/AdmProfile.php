<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\AdmPage;
use App\Entity\AdmUser;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AdmProfile
 *
 * @ORM\Table(name="adm_profile", uniqueConstraints={@ORM\UniqueConstraint(name="adm_profile_uk", columns={"prf_description"})})
 * @ORM\Entity
 * @ORM\NamedQueries({
 * 	@ORM\NamedQuery(name = "AdmProfile.findAdminMenuParentByIdProfiles", 
 *   query="SELECT DISTINCT t FROM App\Entity\AdmMenu t WHERE t.id IN (SELECT m.idMenuParent FROM App\Entity\AdmProfile p INNER JOIN p.admPages f INNER JOIN f.admMenus m WHERE p.id IN (?1) AND m.id <= 9) ORDER BY t.id, t.order"),
 *  @ORM\NamedQuery(name = "AdmProfile.findMenuParentByIdProfiles", 
 *   query="SELECT DISTINCT t FROM App\Entity\AdmMenu t WHERE t.id IN (SELECT m.idMenuParent FROM App\Entity\AdmProfile p INNER JOIN p.admPages f INNER JOIN f.admMenus m WHERE p.id IN (?1) AND m.id > 9) ORDER BY t.order, t.id"),
 *	@ORM\NamedQuery(name = "AdmProfile.findAdminMenuByIdProfiles", 
 *   query="SELECT DISTINCT m FROM App\Entity\AdmProfile p INNER JOIN p.admPages f INNER JOIN f.admMenus m WHERE p.id IN (?1) AND m.id <= 9 AND m.idMenuParent = ?2 ORDER BY m.id, m.order"),
 *	@ORM\NamedQuery(name = "AdmProfile.findMenuByIdProfiles", 
 *   query="SELECT DISTINCT m FROM App\Entity\AdmProfile p INNER JOIN p.admPages f INNER JOIN f.admMenus m WHERE p.id IN (?1) AND m.id > 9 AND m.idMenuParent = ?2 ORDER BY m.id, m.order"),
 * }) 
 */
class AdmProfile implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="prf_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_profile_prf_seq_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prf_administrator", type="string", length=1, nullable=true, options={"default"="N","fixed"=true})
     */
    private $administrator = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="prf_description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prf_general", type="string", length=1, nullable=true, options={"default"="N","fixed"=true})
     */
    private $general = 'N';

    /**
     * @var Collection
     * 	@ORM\ManyToMany(targetEntity="AdmPage", inversedBy="admProfiles")
     *  @ORM\JoinTable(name = "ADM_PAGE_PROFILE", 
     *     joinColumns = { @ORM\JoinColumn(name = "PGL_PRF_SEQ") }, 
     *     inverseJoinColumns = { @ORM\JoinColumn(name = "PGL_PAG_SEQ") })
     */
    private $admPages;

    /**
     * @var Collection
     * 	@ORM\ManyToMany(targetEntity="AdmUser", inversedBy="admProfiles")
	 *  @ORM\JoinTable(name = "ADM_USER_PROFILE", 
     *     joinColumns = { @ORM\JoinColumn(name = "USP_PRF_SEQ") }, 
     *     inverseJoinColumns = { @ORM\JoinColumn(name = "USP_USE_SEQ") })
     */
    private $admUsers;

    /**
     * @var string|null
     */
    private $profilePages;

    /**
     * @var string|null
     */
    private $profileUsers;

    public function __construct() {
        $this->admPages = new ArrayCollection();
        $this->admUsers = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAdministrator(): ?string
    {
        return $this->administrator;
    }

    public function setAdministrator(?string $administrator): self
    {
        $this->administrator = $administrator;

        return $this;
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

    public function getGeneral(): ?string
    {
        return $this->general;
    }

    public function setGeneral(?string $general): self
    {
        $this->general = $general;

        return $this;
    }

    /**
     * @return AdmPage[]|null
     */
    public function &getAdmPages()
    {
        return $this->admPages;
    }

    public function setAdmPages(array $admPages): self
    {
        $this->admPages = $admPages;

        return $this;
    }

    /**
     * @return AdmUser[]|null
     */
    public function &getAdmUsers()
    {
        return $this->admUsers;
    }

    public function setAdmUsers(array $admUsers): self
    {
        $this->admUsers = $admUsers;

        return $this;
    }

    public function getProfilePages(): ?string
    {
        return $this->profilePages;
    }

    public function setProfilePages(?string $profilePages): self
    {
        $this->profilePages = $profilePages;

        return $this;
    }

    public function getProfileUsers(): ?string
    {
        return $this->profileUsers;
    }

    public function setProfileUsers(?string $profileUsers): self
    {
        $this->profileUsers = $profileUsers;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'administrator' => $this->getAdministrator(),
            'description' => $this->getDescription(),
            'general' => $this->getGeneral(),
            'admPages' => $this->getAdmPages(),
            'admUsers' => $this->getAdmUsers(),
            'profilePages' => $this->getProfilePages(),
            'profileUsers' => $this->getProfileUsers(), 
        ];
    }

}
