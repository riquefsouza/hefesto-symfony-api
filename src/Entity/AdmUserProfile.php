<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdmUserProfile
 *
 * @ORM\Table(name="adm_user_profile", uniqueConstraints={@ORM\UniqueConstraint(name="adm_user_profile_uk", columns={"usp_prf_seq", "usp_use_seq"})}, indexes={@ORM\Index(name="IDX_482189FC388BAC0", columns={"usp_prf_seq"}), @ORM\Index(name="IDX_482189F1D4C3C12", columns={"usp_use_seq"})})
 * @ORM\Entity
 */
class AdmUserProfile
{
    /**
     * @var int
     *
     * @ORM\Column(name="usp_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_user_profile_usp_seq_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="usp_use_seq", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="usp_prf_seq", type="integer", nullable=false)
     */
    private $idProfile;

    /**
     * @var \AdmProfile
     *
     * @ORM\ManyToOne(targetEntity="AdmProfile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usp_prf_seq", referencedColumnName="prf_seq")
     * })
     */
    private $admProfile;

    /**
     * @var \AdmUser
     *
     * @ORM\ManyToOne(targetEntity="AdmUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usp_use_seq", referencedColumnName="usu_seq")
     * })
     */
    private $admUser;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdProfile(): int
    {
        return $this->idProfile;
    }

    public function setIdProfile(int $idProfile): self
    {
        $this->idProfile = $idProfile;

        return $this;
    }

    public function getAdmProfile(): ?AdmProfile
    {
        return $this->admProfile;
    }

    public function setAdmProfile(?AdmProfile $admProfile): self
    {
        $this->admProfile = $admProfile;

        return $this;
    }

    public function getAdmUser(): ?AdmUser
    {
        return $this->admUser;
    }

    public function setAdmUser(?AdmUser $admUser): self
    {
        $this->admUser = $admUser;

        return $this;
    }


}
