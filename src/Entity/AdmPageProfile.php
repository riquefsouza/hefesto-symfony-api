<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\AdmPage;
use App\Entity\AdmProfile;

/**
 * AdmPageProfile
 *
 * @ORM\Table(name="adm_page_profile", uniqueConstraints={@ORM\UniqueConstraint(name="adm_page_profile_uk", columns={"pgl_pag_seq", "pgl_prf_seq"})}, indexes={@ORM\Index(name="IDX_A6EFED006E4CDFF0", columns={"pgl_pag_seq"}), @ORM\Index(name="IDX_A6EFED00D66E8675", columns={"pgl_prf_seq"})})
 * @ORM\Entity
 */
class AdmPageProfile
{
    /**
     * @var int
     *
     * @ORM\Column(name="pgl_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_page_profile_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="pgl_pag_seq", type="integer", nullable=false)
     */
    private $idPage;

    /**
     * @var int
     *
     * @ORM\Column(name="pgl_prf_seq", type="integer", nullable=false)
     */
    private $idProfile;

    /**
     * @var \AdmPage
     *
     * @ORM\ManyToOne(targetEntity="AdmPage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pgl_pag_seq", referencedColumnName="pag_seq")
     * })
     */
    private $admPage;

    /**
     * @var \AdmProfile
     *
     * @ORM\ManyToOne(targetEntity="AdmProfile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pgl_prf_seq", referencedColumnName="prf_seq")
     * })
     */
    private $admProfile;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIdPage(): int
    {
        return $this->idPage;
    }

    public function setIdPage(int $idPage): self
    {
        $this->idPage = $idPage;

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

    public function getAdmPage(): ?AdmPage
    {
        return $this->admPage;
    }

    public function setAdmPage(?AdmPage $admPage): self
    {
        $this->admPage = $admPage;

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


}
