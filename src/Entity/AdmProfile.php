<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdmProfile
 *
 * @ORM\Table(name="adm_profile", uniqueConstraints={@ORM\UniqueConstraint(name="adm_profile_uk", columns={"prf_description"})})
 * @ORM\Entity
 */
class AdmProfile
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


}
