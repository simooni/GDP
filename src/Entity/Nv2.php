<?php

namespace App\Entity;

use App\Repository\Nv2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Nv2Repository::class)
 */
class Nv2
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
     * @ORM\ManyToOne(targetEntity=Nv1::class, inversedBy="nv2")
     */
    private $nv1;

    /**
     * @ORM\OneToMany(targetEntity=Nv3::class, mappedBy="nv2")
     */
    private $nv3; 

    /**
     * @ORM\OneToMany(targetEntity=UserAffectation::class, mappedBy="nv2")
     */
    private $userAffectations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    public function __construct()
    {
        $this->nv3 = new ArrayCollection();
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

    public function getNv1(): ?Nv1
    {
        return $this->nv1;
    }

    public function setNv1(?Nv1 $nv1): self
    {
        $this->nv1 = $nv1;

        return $this;
    }

    /**
     * @return Collection|Nv3[]
     */
    public function getNv3(): Collection
    {
        return $this->nv3;
    }

    public function addNv3(Nv3 $nv3): self
    {
        if (!$this->nv3->contains($nv3)) {
            $this->nv3[] = $nv3;
            $nv3->setNv2($this);
        }

        return $this;
    }

    public function removeNv3(Nv3 $nv3): self
    {
        if ($this->nv3->removeElement($nv3)) {
            // set the owning side to null (unless already changed)
            if ($nv3->getNv2() === $this) {
                $nv3->setNv2(null);
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
            $userAffectation->setNv2($this);
        }

        return $this;
    }

    public function removeUserAffectation(UserAffectation $userAffectation): self
    {
        if ($this->userAffectations->removeElement($userAffectation)) {
            // set the owning side to null (unless already changed)
            if ($userAffectation->getNv2() === $this) {
                $userAffectation->setNv2(null);
            }
        }

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
}
