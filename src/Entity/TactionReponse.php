<?php

namespace App\Entity;

use App\Repository\TactionReponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TactionReponseRepository::class)
 */
class TactionReponse
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
    private $refReponse;

    /**
     * @ORM\ManyToOne(targetEntity=Taction::class, inversedBy="tactionReponses")
     */
    private $taction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank (message = "veuillez remplir ce champ.")
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeReponse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreationn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userCreate;
 
    /**
     * @ORM\ManyToOne(targetEntity=Tdocument::class, inversedBy="tactionReponses")
     */
    private $document;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefReponse(): ?string
    {
        return $this->refReponse;
    }

    public function setRefReponse(?string $refReponse): self
    {
        $this->refReponse = $refReponse;

        return $this;
    }

    public function getTaction(): ?Taction
    {
        return $this->taction;
    }

    public function setTaction(?Taction $taction): self
    {
        $this->taction = $taction;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(?string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getTypeReponse(): ?string
    {
        return $this->typeReponse;
    }

    public function setTypeReponse(?string $typeReponse): self
    {
        $this->typeReponse = $typeReponse;

        return $this;
    }

    public function getDateCreation(): ?string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateCreationn(): ?\DateTimeInterface
    {
        return $this->dateCreationn;
    }

    public function setDateCreationn(?\DateTimeInterface $dateCreationn): self
    {
        $this->dateCreationn = $dateCreationn;

        return $this;
    }

    public function getuserCreate(): ?string
    {
        return $this->userCreate;
    }

    public function setuserCreate(?string $userCreate): self
    {
        $this->userCreate = $userCreate;

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

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }
}
