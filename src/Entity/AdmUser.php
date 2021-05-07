<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AdmUser
 *
 * @ORM\Table(name="adm_user", uniqueConstraints={@ORM\UniqueConstraint(name="adm_user_login_uk", columns={"usu_login"}), @ORM\UniqueConstraint(name="adm_user_password_uk", columns={"usu_password"}), @ORM\UniqueConstraint(name="adm_user_email_uk", columns={"usu_email"}), @ORM\UniqueConstraint(name="adm_user_name_uk", columns={"usu_name"})})
 * @ORM\Entity
 */
class AdmUser implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="usu_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_user_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usu_active", type="string", length=1, nullable=true, options={"default"="N","fixed"=true})
     */
    private $active = 'N';

    /**
     * @var string|null
     *
     * @ORM\Column(name="usu_email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="usu_login", type="string", length=64, nullable=false)
     */
    private $login;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usu_name", type="string", length=64, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="usu_password", type="string", length=128, nullable=false)
     */
    private $password;

    /**
     * @var Collection
	 * @ORM\ManyToMany(targetEntity="AdmProfile", inversedBy="admUsers")
	 * @ORM\JoinTable(name = "adm_user_profile", 
     *    joinColumns = { @ORM\JoinColumn(name = "usp_use_seq", referencedColumnName="usu_seq") }, 
     *    inverseJoinColumns = { @ORM\JoinColumn(name = "usp_prf_seq", referencedColumnName="prf_seq") })
    */
	private $admProfiles;

    /**
     * @var int[]|null
     */
    private $admIdProfiles = array();

    /**
     * @var string|null
     */
    private $userProfiles;

    /**
     * @var string|null
     */
    private $currentPassword;

    /**
     * @var string|null
     */
    private $newPassword;

        /**
     * @var string|null
     */
    private $confirmNewPassword;

    public function __construct() {
        $this->admProfiles = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function setActive(?string $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return int[]|null
     */
    public function &getAdmIdProfiles()
    {
        return $this->admIdProfiles;
    }

    public function setAdmIdProfiles(array $admIdProfiles): self
    {
        $this->admIdProfiles = $admIdProfiles;

        return $this;
    }

    public function getUserProfiles(): ?string
    {
        return $this->userProfiles;
    }

    public function setUserProfiles(?string $userProfiles): self
    {
        $this->userProfiles = $userProfiles;

        return $this;
    }

    public function getCurrentPassword(): ?string
    {
        return $this->currentPassword;
    }

    public function setCurrentPassword(?string $currentPassword): self
    {
        $this->currentPassword = $currentPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(?string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmNewPassword(): ?string
    {
        return $this->confirmNewPassword;
    }

    public function setConfirmNewPassword(?string $confirmNewPassword): self
    {
        $this->confirmNewPassword = $confirmNewPassword;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'active' => $this->getActive(),
            'email' => $this->getEmail(),
            'login' => $this->getLogin(),
            'name' => $this->getName(),
            'password' => $this->getPassword(),
            'admIdProfiles' => $this->getAdmIdProfiles(),
            'userProfiles' => $this->getUserProfiles(),
            'currentPassword' => $this->getCurrentPassword(),
            'newPassword' => $this->getNewPassword(),
            'confirmNewPassword' => $this->getConfirmNewPassword(),       
        ];
    }

}
