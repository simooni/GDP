<?php

namespace App\Entity;

use App\Repository\Nv4Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Nv4Repository::class)
 */
class Nv4
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
     * @ORM\ManyToOne(targetEntity=Nv3::class, inversedBy="nv4s")
     */
    private $nv3;

    /**
     * @ORM\OneToMany(targetEntity=Nv5::class, mappedBy="Nv4")
     */
    private $nv5s;

    /**
     * @ORM\OneToMany(targetEntity=UserAffectation::class, mappedBy="nv4")
     */
    private $userAffectations;

    public function __construct()
    {
        $this->nv5s = new ArrayCollection();
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

    public function getNv3(): ?Nv3
    {
        return $this->nv3;
    }

    public function setNv3(?Nv3 $nv3): self
    {
        $this->nv3 = $nv3;

        return $this;
    }

    /**
     * @return Collection|Nv5[]
     */
    public function getNv5s(): Collection
    {
        return $this->nv5s;
    }

    public function addNv5(Nv5 $nv5): self
    {
        if (!$this->nv5s->contains($nv5)) {
            $this->nv5s[] = $nv5;
            $nv5->setNv4($this);
        }

        return $this;
    }

    public function removeNv5(Nv5 $nv5): self
    {
        if ($this->nv5s->removeElement($nv5)) {
            // set the owning side to null (unless already changed)
            if ($nv5->getNv4() === $this) {
                $nv5->setNv4(null);
            }
        }

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
            $userAffectation->setNv4($this);
        }

        return $this;
    }

    public function removeUserAffectation(UserAffectation $userAffectation): self
    {
        if ($this->userAffectations->removeElement($userAffectation)) {
            // set the owning side to null (unless already changed)
            if ($userAffectation->getNv4() === $this) {
                $userAffectation->setNv4(null);
            }
        }

        return $this;
    }
}
