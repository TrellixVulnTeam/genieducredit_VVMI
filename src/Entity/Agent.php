<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use DateTime;
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
    private $actif;

    /**
     * @ORM\Column(type="boolean")
     */
    private $authenvoiemail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $authenvoisms;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datemodification;

  
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

    /**
     * @ORM\ManyToMany(targetEntity=Partenaires::class, mappedBy="agents")
     */
    private $partenaires;

    public function __construct()
    {
        $this->concessionnairemarchands = new ArrayCollection();

        if($this->datecreation == null){
            $this->datecreation = new DateTime('now');
        }
        
        $this->datemodification = new DateTime('now');
        $this->partenaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getAuthenvoiemail(): ?bool
    {
        return $this->authenvoiemail;
    }

    public function setAuthenvoiemail(bool $authenvoiemail): self
    {
        $this->authenvoiemail = $authenvoiemail;

        return $this;
    }

    public function getAuthenvoisms(): ?bool
    {
        return $this->authenvoisms;
    }

    public function setAuthenvoisms(bool $authenvoisms): self
    {
        $this->authenvoisms = $authenvoisms;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getdatemodification(): ?\DateTimeInterface
    {
        return $this->datemodification;
    }

    public function setDatemodification(\DateTimeInterface $datemodification): self
    {
        $this->datemodification = $datemodification;

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

    /**
     * @return Collection|Partenaires[]
     */
    public function getPartenaires(): Collection
    {
        return $this->partenaires;
    }

    public function addPartenaire(Partenaires $partenaire): self
    {
        if (!$this->partenaires->contains($partenaire)) {
            $this->partenaires[] = $partenaire;
            $partenaire->addAgent($this);
        }

        return $this;
    }

    public function removePartenaire(Partenaires $partenaire): self
    {
        if ($this->partenaires->removeElement($partenaire)) {
            $partenaire->removeAgent($this);
        }

        return $this;
    }

   




}
