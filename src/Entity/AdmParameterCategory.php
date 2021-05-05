<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdmParameterCategory
 *
 * @ORM\Table(name="adm_parameter_category", uniqueConstraints={@ORM\UniqueConstraint(name="adm_pmc_uk", columns={"pmc_description"})})
 * @ORM\Entity
 */
class AdmParameterCategory implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="pmc_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_parameter_category_pmc_seq_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pmc_description", type="string", length=64, nullable=false)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="pmc_order", type="bigint", nullable=true)
     */
    private $order;

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

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'description' => $this->getDescription(),
            'order' => $this->getOrder()
        ];
    }

}
