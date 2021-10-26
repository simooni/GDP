<?php

namespace App\Entity;

use App\Repository\Nv3Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Nv3Repository::class)
 */
class Nv3
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
     * @ORM\ManyToOne(targetEntity=Nv2::class, inversedBy="nv3")
     */
    private $nv2;

    /**
     * @ORM\OneToMany(targetEntity=UserAffectation::class, mappedBy="nv3")
     */
    private $userAffectations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Nv4::class, mappedBy="nv3")
     */
    private $nv4s;

    public function __construct()
    {
        $this->userAffectations = new ArrayCollection();
        $this->nv4s = new ArrayCollection();
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

    public function getNv2(): ?Nv2
    {
        return $this->nv2;
    }

    public function setNv2(?Nv2 $nv2): self
    {
        $this->nv2 = $nv2;

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
            $userAffectation->setNv3($this);
        }

        return $this;
    }

    public function removeUserAffectation(UserAffectation $userAffectation): self
    {
        if ($this->userAffectations->removeElement($userAffectation)) {
            // set the owning side to null (unless already changed)
            if ($userAffectation->getNv3() === $this) {
                $userAffectation->setNv3(null);
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

    /**
     * @return Collection|Nv4[]
     */
    public function getNv4s(): Collection
    {
        return $this->nv4s;
    }

    public function addNv4(Nv4 $nv4): self
    {
        if (!$this->nv4s->contains($nv4)) {
            $this->nv4s[] = $nv4;
            $nv4->setNv3($this);
        }

        return $this;
    }

    public function removeNv4(Nv4 $nv4): self
    {
        if ($this->nv4s->removeElement($nv4)) {
            // set the owning side to null (unless already changed)
            if ($nv4->getNv3() === $this) {
                $nv4->setNv3(null);
            }
        }

        return $this;
    }

}
