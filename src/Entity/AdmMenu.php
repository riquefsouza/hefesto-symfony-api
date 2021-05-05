<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdmMenu
 *
 * @ORM\Table(name="adm_menu", uniqueConstraints={@ORM\UniqueConstraint(name="adm_menu_uk", columns={"mnu_description"})}, indexes={@ORM\Index(name="IDX_54F2B6ABF75889DC", columns={"mnu_pag_seq"}), @ORM\Index(name="IDX_54F2B6AB771551D", columns={"mnu_parent_seq"})})
 * @ORM\Entity
 */
class AdmMenu implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="mnu_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_menu_mnu_seq_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mnu_description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mnu_order", type="integer", nullable=true)
     */
    private $order;

    /**
     * @var \AdmPage
     *
     * @ORM\ManyToOne(targetEntity="AdmPage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mnu_pag_seq", referencedColumnName="pag_seq")
     * })
     */
    private $admPage;

    /**
     * @var \AdmMenu
     *
     * @ORM\ManyToOne(targetEntity="AdmMenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mnu_parent_seq", referencedColumnName="mnu_seq")
     * })
     */
    private $admMenuParent;

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

    public function getAdmPage(): ?AdmPage
    {
        return $this->admPage;
    }

    public function setAdmPage(?AdmPage $admPage): self
    {
        $this->admPage = $admPage;

        return $this;
    }

    public function getAdmMenuParent(): ?self
    {
        return $this->admMenuParent;
    }

    public function setAdmMenuParent(?self $admMenuParent): self
    {
        $this->admMenuParent = $admMenuParent;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'description' => $this->getDescription(),
            'idMenuParent' => $this->getAdmMenuParent()!=null ? $this->getAdmMenuParent()->getId() : '',
            'idPage' => $this->getAdmPage()!=null ? $this->getAdmPage()->getId() : '',
            'order' => $this->getOrder(),
            'admPage' => $this->getAdmPage(),
            'admMenuParent' => $this->getAdmMenuParent(),
        ];
    }

}
