<?php

namespace App\Entity;

use App\Repository\Nv5Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Nv5Repository::class)
 */
class Nv5
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity=nv4::class, inversedBy="nv5s")
     */
    private $Nv4;

    /**
     * @ORM\OneToMany(targetEntity=UserAffectation::class, mappedBy="nv5")
     */
    private $userAffectations;

    public function __construct()
    {
        $this->userAffectations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNv4(): ?nv4
    {
        return $this->Nv4;
    }

    public function setNv4(?nv4 $Nv4): self
    {
        $this->Nv4 = $Nv4;

        return $this;
    }

    /**
     * @return Collection|UserAffectation[]
     */
    public function getUserAffectations(): Collection
    {
        return $this->userAffectations;
    }

    public function addUserAffectation(UserAffectation $userAffectation): self
    {
        if (!$this->userAffectations->contains($userAffectation)) {
            $this->userAffectations[] = $userAffectation;
            $userAffectation->setNv5($this);
        }

        return $this;
    }

    public function removeUserAffectation(UserAffectation $userAffectation): self
    {
        if ($this->userAffectations->removeElement($userAffectation)) {
            // set the owning side to null (unless already changed)
            if ($userAffectation->getNv5() === $this) {
                $userAffectation->setNv5(null);
            }
        }

        return $this;
    }
}
