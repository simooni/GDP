<?php

namespace App\Entity;

use App\Repository\TaccesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaccesRepository::class)
 */
class Tacces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=UserAffectation::class, inversedBy="tacces")
     */
    private $userAffectation;

    /**
     * @ORM\ManyToOne(targetEntity=Taction::class, inversedBy="tacces")
     */
    private $action;

    /**
     * @ORM\ManyToOne(targetEntity=Tdocument::class, inversedBy="tacces")
     */
    private $document;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserAffectation(): ?UserAffectation
    {
        return $this->userAffectation;
    }

    public function setUserAffectation(?UserAffectation $userAffectation): self
    {
        $this->userAffectation = $userAffectation;

        return $this;
    }

    public function getAction(): ?Taction
    {
        return $this->action;
    }

    public function setAction(?Taction $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getDocument(): ?Tdocument
    {
        return $this->document;
    }

    public function setDocument(?Tdocument $document): self
    {
        $this->document = $document;

        return $this;
    }
}
