<?php

namespace App\Entity;

use App\Repository\TypeActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeActionRepository::class)
 */
class TypeAction
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Taction::class, mappedBy="Taction")
     */
    private $tactions;

    public function __construct()
    {
        $this->tactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Taction[]
     */
    public function getTactions(): Collection
    {
        return $this->tactions;
    }

    public function addTaction(Taction $taction): self
    {
        if (!$this->tactions->contains($taction)) {
            $this->tactions[] = $taction;
            $taction->setTaction($this);
        }

        return $this;
    }

    public function removeTaction(Taction $taction): self
    {
        if ($this->tactions->removeElement($taction)) {
            // set the owning side to null (unless already changed)
            if ($taction->getTaction() === $this) {
                $taction->setTaction(null);
            }
        }

        return $this;
    }
}
