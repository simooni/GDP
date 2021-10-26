<?php

namespace App\Entity;

use App\Repository\TactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=TactionRepository::class)
 */
class Taction
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
    private $RefAction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank (message = "veuillez remplir ce champ.")
     * 
     */
    private $intitule;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urgence;

    /**
     * @ORM\OneToMany(targetEntity=TactionReponse::class, mappedBy="taction")
     */
    private $tactionReponses;

    /**
     * @ORM\OneToMany(targetEntity=Tacces::class, mappedBy="action")
     */
    private $tacces;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $suspendre;    

    /**
     * @ORM\ManyToOne(targetEntity=Urgence::class, inversedBy="tactions")
     * @Assert\NotBlank (message = "veuillez remplir ce champ.")
     */
    private $etatUrgence;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAction::class, inversedBy="tactions")
     * @Assert\NotBlank (message = "veuillez remplir ce champ.")
     */
    private $Taction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code_nv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $annuler;

    /**
     * @ORM\ManyToOne(targetEntity=Tdocument::class, inversedBy="tactions")
     */
    private $dossier;

    public function __construct()
    {
        $this->tactionReponses = new ArrayCollection();
        $this->tacces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefAction(): ?string
    {
        return $this->RefAction;
    }

    public function setRefAction(?string $RefAction): self
    {
        $this->RefAction = $RefAction;

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

    public function getUrgence(): ?string
    {
        return $this->urgence;
    }

    public function setUrgence(?string $urgence): self
    {
        $this->urgence = $urgence;

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
            $tactionReponse->setTaction($this);
        }

        return $this;
    }

    public function removeTactionReponse(TactionReponse $tactionReponse): self
    {
        if ($this->tactionReponses->removeElement($tactionReponse)) {
            // set the owning side to null (unless already changed)
            if ($tactionReponse->getTaction() === $this) {
                $tactionReponse->setTaction(null);
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
            $tacce->setAction($this);
        }

        return $this;
    }

    public function removeTacce(Tacces $tacce): self
    {
        if ($this->tacces->removeElement($tacce)) {
            // set the owning side to null (unless already changed)
            if ($tacce->getAction() === $this) {
                $tacce->setAction(null);
            }
        }

        return $this;
    }

    public function getSuspendre(): ?int
    {
        return $this->suspendre;
    }

    public function setSuspendre(?int $suspendre): self
    {
        $this->suspendre = $suspendre;

        return $this;
    }

    public function getEtatUrgence(): ?Urgence
    {
        return $this->etatUrgence;
    }

    public function setEtatUrgence(?Urgence $etatUrgence): self
    {
        $this->etatUrgence = $etatUrgence;

        return $this;
    }

    public function getTaction(): ?TypeAction
    {
        return $this->Taction;
    }

    public function setTaction(?TypeAction $Taction): self
    {
        $this->Taction = $Taction;

        return $this;
    }

    public function getCodeNv(): ?string
    {
        return $this->code_nv;
    }

    public function setCodeNv(?string $code_nv): self
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

    public function getAnnuler(): ?string
    {
        return $this->annuler;
    }

    public function setAnnuler(?string $annuler): self
    {
        $this->annuler = $annuler;

        return $this;
    }

    public function getDossier(): ?Tdocument
    {
        return $this->dossier;
    }

    public function setDossier(?Tdocument $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }
}
