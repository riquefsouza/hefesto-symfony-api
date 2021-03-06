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
 */
class AdmProfile implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="prf_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_profile_seq", allocationSize=1, initialValue=1)
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
     *  @ORM\JoinTable(name = "adm_page_profile", 
     *     joinColumns = { @ORM\JoinColumn(name = "pgl_prf_seq", referencedColumnName="prf_seq") }, 
     *     inverseJoinColumns = { @ORM\JoinColumn(name = "pgl_pag_seq", referencedColumnName="pag_seq") })
     */
    private $admPages;

    /**
     * @var Collection
     * 	@ORM\ManyToMany(targetEntity="AdmUser", inversedBy="admProfiles")
	 *  @ORM\JoinTable(name = "adm_user_profile", 
     *     joinColumns = { @ORM\JoinColumn(name = "usp_prf_seq", referencedColumnName="prf_seq") }, 
     *     inverseJoinColumns = { @ORM\JoinColumn(name = "usp_use_seq", referencedColumnName="usu_seq") })
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
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
