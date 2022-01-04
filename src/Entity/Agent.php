<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 */
class Agent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Actif;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Authenvoiemail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Authenvoisms;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Datecreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Datemodification;

  
    /**
     * @ORM\ManyToMany(targetEntity=Concessionnairemarchand::class, mappedBy="agents")
     */
    private $concessionnairemarchands;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Typeagent::class, inversedBy="agents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeagent;

    public function __construct()
    {
        $this->concessionnairemarchands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActif(): ?bool
    {
        return $this->Actif;
    }

    public function setActif(bool $Actif): self
    {
        $this->Actif = $Actif;

        return $this;
    }

    public function getAuthenvoiemail(): ?bool
    {
        return $this->Authenvoiemail;
    }

    public function setAuthenvoiemail(bool $Authenvoiemail): self
    {
        $this->Authenvoiemail = $Authenvoiemail;

        return $this;
    }

    public function getAuthenvoisms(): ?bool
    {
        return $this->Authenvoisms;
    }

    public function setAuthenvoisms(bool $Authenvoisms): self
    {
        $this->Authenvoisms = $Authenvoisms;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->Datecreation;
    }

    public function setDatecreation(\DateTimeInterface $Datecreation): self
    {
        $this->Datecreation = $Datecreation;

        return $this;
    }

    public function getDatemodification(): ?\DateTimeInterface
    {
        return $this->Datemodification;
    }

    public function setDatemodification(\DateTimeInterface $Datemodification): self
    {
        $this->Datemodification = $Datemodification;

        return $this;
    }

  

    /**
     * @return Collection|Concessionnairemarchand[]
     */
    public function getConcessionnairemarchands(): Collection
    {
        return $this->concessionnairemarchands;
    }

    public function addConcessionnairemarchand(Concessionnairemarchand $concessionnairemarchand): self
    {
        if (!$this->concessionnairemarchands->contains($concessionnairemarchand)) {
            $this->concessionnairemarchands[] = $concessionnairemarchand;
            $concessionnairemarchand->addAgent($this);
        }

        return $this;
    }

    public function removeConcessionnairemarchand(Concessionnairemarchand $concessionnairemarchand): self
    {
        if ($this->concessionnairemarchands->removeElement($concessionnairemarchand)) {
            $concessionnairemarchand->removeAgent($this);
        }

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getTypeagent(): ?Typeagent
    {
        return $this->typeagent;
    }

    public function setTypeagent(?Typeagent $typeagent): self
    {
        $this->typeagent = $typeagent;

        return $this;
    }
}
