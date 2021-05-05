<?php

namespace App\Base\Models;

class MenuItemDTO implements \JsonSerializable
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $routerLink;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $to;

    /**
     * @var \MenuItemDTO[]
     */
    private $item = array();
    
    public function __construct()
    {
        $this->item = array();
        $this->Clean();
    }

    public function create(string $label, string $url) {
        $this->label = $label;
        $this->url = $url;
        $this->routerLink = $url;
        $this->to = $url;
    }     

    public function createWithItem(string $label, string $url, $item) {
        $this->label = $label;
        $this->url = $url;
        $this->routerLink = $url;
        $this->to = $url;
        $this->item = $item;
    }

    public function clean(): void {
        $this->label = "";
        $this->url = "";
        $this->routerLink = "";
        $this->to = "";
        $this->item = array();
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getRouterLink(): string
    {
        return $this->routerLink;
    }

    public function setRouterLink(string $routerLink): self
    {
        $this->routerLink = $routerLink;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function setTo(string $to): self
    {
        $this->to = $to;

        return $this;
    }

    public function &getItem()
    {
        return $this->item;
    }

    public function setItem($item): self
    {
        $this->item = $item;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'label' => $this->getLabel(),
            'url' => $this->getUrl(),
            'routerLink' => $this->getRouterLink(),
            'to' => $this->getTo(),
            'item' => $this->getItem()    
        ];
    }
}