<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdmParameter
 *
 * @ORM\Table(name="adm_parameter", uniqueConstraints={@ORM\UniqueConstraint(name="adm_parameter_uk", columns={"par_description"})}, indexes={@ORM\Index(name="IDX_E884916A851250EF", columns={"par_pmc_seq"})})
 * @ORM\Entity
 */
class AdmParameter implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="par_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_parameter_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="par_code", type="string", length=64, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="par_description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="par_value", type="string", length=4000, nullable=true)
     */
    private $value;

    /**
     * @var \AdmParameterCategory
     *
     * @ORM\ManyToOne(targetEntity="AdmParameterCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="par_pmc_seq", referencedColumnName="pmc_seq")
     * })
     */
    private $admParameterCategory;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getAdmParameterCategory(): ?AdmParameterCategory
    {
        return $this->admParameterCategory;
    }

    public function setAdmParameterCategory(?AdmParameterCategory $admParameterCategory): self
    {
        $this->admParameterCategory = $admParameterCategory;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'code' => $this->getCode(),
            'description' => $this->getDescription(),
            'value' => $this->getValue(),
            'admParameterCategory' => $this->getAdmParameterCategory()
        ];
    }

}
