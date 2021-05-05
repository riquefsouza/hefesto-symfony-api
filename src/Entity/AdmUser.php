<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdmUser
 *
 * @ORM\Table(name="adm_user", uniqueConstraints={@ORM\UniqueConstraint(name="adm_user_login_uk", columns={"usu_login"}), @ORM\UniqueConstraint(name="adm_user_password_uk", columns={"usu_password"}), @ORM\UniqueConstraint(name="adm_user_email_uk", columns={"usu_email"}), @ORM\UniqueConstraint(name="adm_user_name_uk", columns={"usu_name"})})
 * @ORM\Entity
 */
class AdmUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="usu_seq", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adm_user_usu_seq_seq", allocationSize=1, initialValue=1)
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


}
