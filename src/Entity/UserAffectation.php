<?php

namespace App\Entity;

use App\Repository\UserAffectationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserAffectationRepository::class)
 */
class UserAffectation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userAffectations")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Nv1::class, inversedBy="userAffectations")
     */
    private $nv1;

    /**
     * @ORM\ManyToOne(targetEntity=Nv2::class, inversedBy="userAffectations")
     */
    private $nv2;

    /**
     * @ORM\ManyToOne(targetEntity=Nv3::class, inversedBy="userAffectations")
     */
    private $nv3;

    /**
     * @ORM\OneToMany(targetEntity=Tacces::class, mappedBy="userAffectation")
     */
    private $tacces;

    /**
     * @ORM\ManyToOne(targetEntity=Nv4::class, inversedBy="userAffectations")
     */
    private $nv4;

    /**
     * @ORM\ManyToOne(targetEntity=Nv5::class, inversedBy="userAffectations")
     */
    private $nv5;

    public function __construct()
    {
        $this->tacces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getNv2(): ?Nv2
    {
        return $this->nv2;
    }

    public function setNv2(?Nv2 $nv2): self
    {
        $this->nv2 = $nv2;

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
     * @return Collection|Tacces[]
     */
    public function getTacces(): Collection
    {
        return $this->tacces;
    }

    public function addTacce(Tacces $tacce): self
    {
        if (!$this->tacces->contains($tacce)) {
            $this->tacces[] = $tacce;
            $tacce->setUserAffectation($this);
        }

        return $this;
    }

    public function removeTacce(Tacces $tacce): self
    {
        if ($this->tacces->removeElement($tacce)) {
            // set the owning side to null (unless already changed)
            if ($tacce->getUserAffectation() === $this) {
                $tacce->setUserAffectation(null);
            }
        }

        return $this;
    }

    public function getNv4(): ?Nv4
    {
        return $this->nv4;
    }

    public function setNv4(?Nv4 $nv4): self
    {
        $this->nv4 = $nv4;

        return $this;
    }

    public function getNv5(): ?Nv5
    {
        return $this->nv5;
    }

    public function setNv5(?Nv5 $nv5): self
    {
        $this->nv5 = $nv5;

        return $this;
    }
}
