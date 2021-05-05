<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdmPage
 *
 * @ORM\Table(name="adm_page", uniqueConstraints={@ORM\UniqueConstraint(name="adm_page_description_uk", columns={"pag_description"}), @ORM\UniqueConstraint(name="adm_page_url_uk", columns={"pag_url"})})
 * @ORM\Entity
 */
class AdmPage
{
    /**
     * @var int
     *
     * @ORM\Column(name="pag_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_page_pag_seq_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pag_description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pag_url", type="string", length=255, nullable=false)
     */
    private $url;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }


}
