<?php

namespace App\Entity;

use App\Repository\Nv1Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Nv1Repository::class)
 */
class Nv1
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
     * @ORM\OneToMany(targetEntity=Nv2::class, mappedBy="nv1")
     */
    private $nv2;

    /**
     * @ORM\OneToMany(targetEntity=UserAffectation::class, mappedBy="nv1")
     */
    private $userAffectations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    public function __construct()
    {
        $this->nv2 = new ArrayCollection();
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

    /**
     * @return Collection|Nv2[]
     */
    public function getNv2(): Collection
    {
        return $this->nv2;
    }

    public function addNv2(Nv2 $nv2): self
    {
        if (!$this->nv2->contains($nv2)) {
            $this->nv2[] = $nv2;
            $nv2->setNv1($this);
        }

        return $this;
    }

    public function removeNv2(Nv2 $nv2): self
    {
        if ($this->nv2->removeElement($nv2)) {
            // set the owning side to null (unless already changed)
            if ($nv2->getNv1() === $this) {
                $nv2->setNv1(null);
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
            $userAffectation->setNv1($this);
        }

        return $this;
    }

    public function removeUserAffectation(UserAffectation $userAffectation): self
    {
        if ($this->userAffectations->removeElement($userAffectation)) {
            // set the owning side to null (unless already changed)
            if ($userAffectation->getNv1() === $this) {
                $userAffectation->setNv1(null);
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
