<?php

namespace App\Entity;

use App\Repository\TdocumentVersionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=TdocumentVersionRepository::class)
 */
class TdocumentVersion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tdocument::class, inversedBy="tdocumentVersions")
     */
    private $document;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank (message = "veuillez remplir ce champ.")
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeDocument;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $taille;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userCreate;
 
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $suspondu;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(?string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getTypeDocument(): ?string
    {
        return $this->typeDocument;
    }

    public function setTypeDocument(?string $typeDocument): self
    {
        $this->typeDocument = $typeDocument;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(?string $taille): self
    {
        $this->taille = $taille;

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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSuspondu(): ?string
    {
        return $this->suspondu;
    }

    public function setSuspondu(?string $suspondu): self
    {
        $this->suspondu = $suspondu;

        return $this;
    }
}
