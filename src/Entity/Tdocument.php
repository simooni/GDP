<?php

namespace App\Entity;

use App\Repository\TdocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=TdocumentRepository::class)
 */
class Tdocument
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userCreate;
 
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cloturer;

    /**
     * @ORM\OneToMany(targetEntity=TactionReponse::class, mappedBy="document")
     */
    private $tactionReponses;

    /**
     * @ORM\OneToMany(targetEntity=TdocumentVersion::class, mappedBy="document")
     */
    private $tdocumentVersions;

    /**
     * @ORM\OneToMany(targetEntity=Tacces::class, mappedBy="document")
     */
    private $tacces;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $suspondu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code_nv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $annuler;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avancement;

    /**
     * @ORM\ManyToOne(targetEntity=Tdocument::class, inversedBy="tdocuments")
     */
    private $folder;

    /**
     * @ORM\OneToMany(targetEntity=Tdocument::class, mappedBy="folder")
     */
    private $tdocuments;

    /**
     * @ORM\OneToMany(targetEntity=Taction::class, mappedBy="dossier")
     */
    private $tactions;


    public function __construct()
    {
        $this->tactionReponses = new ArrayCollection();
        $this->tdocumentVersions = new ArrayCollection();
        $this->tacces = new ArrayCollection();
        $this->tdocuments = new ArrayCollection();
        $this->tactions = new ArrayCollection();
      
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(?int $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCloturer(): ?int
    {
        return $this->cloturer;
    }

    public function setCloturer(?int $cloturer): self
    {
        $this->cloturer = $cloturer;

        return $this;
    }

    /**
     * @return Collection|TactionReponse[]
     */
    public function getTactionReponses(): Collection
    {
        return $this->tactionReponses;
    }

    public function addTactionReponse(TactionReponse $tactionReponse): self
    {
        if (!$this->tactionReponses->contains($tactionReponse)) {
            $this->tactionReponses[] = $tactionReponse;
            $tactionReponse->setDocument($this);
        }

        return $this;
    }

    public function removeTactionReponse(TactionReponse $tactionReponse): self
    {
        if ($this->tactionReponses->removeElement($tactionReponse)) {
            // set the owning side to null (unless already changed)
            if ($tactionReponse->getDocument() === $this) {
                $tactionReponse->setDocument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TdocumentVersion[]
     */
    public function getTdocumentVersions(): Collection
    {
        return $this->tdocumentVersions;
    }

    public function addTdocumentVersion(TdocumentVersion $tdocumentVersion): self
    {
        if (!$this->tdocumentVersions->contains($tdocumentVersion)) {
            $this->tdocumentVersions[] = $tdocumentVersion;
            $tdocumentVersion->setDocument($this);
        }

        return $this;
    }

    public function removeTdocumentVersion(TdocumentVersion $tdocumentVersion): self
    {
        if ($this->tdocumentVersions->removeElement($tdocumentVersion)) {
            // set the owning side to null (unless already changed)
            if ($tdocumentVersion->getDocument() === $this) {
                $tdocumentVersion->setDocument(null);
            }
        }

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
            $tacce->setDocument($this);
        }

        return $this;
    }

    public function removeTacce(Tacces $tacce): self
    {
        if ($this->tacces->removeElement($tacce)) {
            // set the owning side to null (unless already changed)
            if ($tacce->getDocument() === $this) {
                $tacce->setDocument(null);
            }
        }

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

    public function getCode_nv(): ?string
    {
        return $this->code_nv;
    }

    public function setCode_nv(?string $code_nv): self
    {
        $this->code_nv = $code_nv;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getAnnuler(): ?int
    {
        return $this->annuler;
    }

    public function setAnnuler(?int $annuler): self
    {
        $this->annuler = $annuler;

        return $this;
    }

    public function getAvancement(): ?string
    {
        return $this->avancement;
    }

    public function setAvancement(?string $avancement): self
    {
        $this->avancement = $avancement;

        return $this;
    }

    public function getFolder(): ?self
    {
        return $this->folder;
    }

    public function setFolder(?self $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getTdocuments(): Collection
    {
        return $this->tdocuments;
    }

    public function addTdocument(self $tdocument): self
    {
        if (!$this->tdocuments->contains($tdocument)) {
            $this->tdocuments[] = $tdocument;
            $tdocument->setFolder($this);
        }

        return $this;
    }

    public function removeTdocument(self $tdocument): self
    {
        if ($this->tdocuments->removeElement($tdocument)) {
            // set the owning side to null (unless already changed)
            if ($tdocument->getFolder() === $this) {
                $tdocument->setFolder(null);
            }
        }

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
            $taction->setDossier($this);
        }

        return $this;
    }

    public function removeTaction(Taction $taction): self
    {
        if ($this->tactions->removeElement($taction)) {
            // set the owning side to null (unless already changed)
            if ($taction->getDossier() === $this) {
                $taction->setDossier(null);
            }
        }

        return $this;
    }

  
}
