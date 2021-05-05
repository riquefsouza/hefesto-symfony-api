<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\SequenceGenerator(sequenceName="adm_page_profile_pgl_seq_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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