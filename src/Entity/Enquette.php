<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnquetteRepository")
 */
class Enquette
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $indice;




    /**
     *
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dateheure_declaration;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $date_premier_soins;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $premier_soins;



    /**
     * @ORM\Column(type="array",nullable=true)
     */
    private $organisation = [];

    /**
     * @ORM\Column(type="array",nullable=true)
     */
    private $environnement = [];

    /**
     * @ORM\Column(type="array",nullable=true)
     */
    private $equipement = [];

    /**
     * @ORM\Column(type="array",nullable=true)
     */
    private $nature_lesion = [];

    /**
     * @ORM\Column(type="array",nullable=true)
     */
    private $siege_lesion = [];

    /**
     * @ORM\Column(type="date")
     */
    private $date_prevue;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Salarie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_s;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_arret;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Accident", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ida;



    public function getId(): ?int
    {
        return $this->id;
    }



    public function getIndice(): ?int
    {
        return $this->indice;
    }

    public function setIndice(int $indice): self
    {
        $this->indice = $indice;

        return $this;
    }







    public function getDateheureDeclaration(): ?\DateTimeInterface
    {
        return $this->dateheure_declaration;
    }

    public function setDateheureDeclaration(\DateTimeInterface $dateheure_declaration): self
    {
        $this->dateheure_declaration = $dateheure_declaration;

        return $this;
    }

    public function getDatePremierSoins(): ?\DateTimeInterface
    {
        return $this->date_premier_soins;
    }

    public function setDatePremierSoins(\DateTimeInterface $date_premier_soins): self
    {
        $this->date_premier_soins = $date_premier_soins;

        return $this;
    }

    public function getPremierSoins(): ?string
    {
        return $this->premier_soins;
    }

    public function setPremierSoins(string $premier_soins): self
    {
        $this->premier_soins = $premier_soins;

        return $this;
    }


    public function getOrganisation(): ?array
    {
        return $this->organisation;
    }

    public function setOrganisation(array $organisation): self
    {
        $this->organisation = $organisation;

        return $this;
    }

    public function getEnvironnement(): ?array
    {
        return $this->environnement;
    }

    public function setEnvironnement(array $environnement): self
    {
        $this->environnement = $environnement;

        return $this;
    }

    public function getEquipement(): ?array
    {
        return $this->equipement;
    }

    public function setEquipement(array $equipement): self
    {
        $this->equipement = $equipement;

        return $this;
    }

    public function getNatureLesion(): ?array
    {
        return $this->nature_lesion;
    }

    public function setNatureLesion(array $nature_lesion): self
    {
        $this->nature_lesion = $nature_lesion;

        return $this;
    }

    public function getSiegeLesion(): ?array
    {
        return $this->siege_lesion;
    }

    public function setSiegeLesion(array $siege_lesion): self
    {
        $this->siege_lesion = $siege_lesion;

        return $this;
    }

    public function getDatePrevue(): ?\DateTimeInterface
    {
        return $this->date_prevue;
    }

    public function setDatePrevue(\DateTimeInterface $date_prevue): self
    {
        $this->date_prevue = $date_prevue;

        return $this;
    }


    public function getIdS(): ?Salarie
    {
        return $this->id_s;
    }

    public function setIdS(?Salarie $id_s): self
    {
        $this->id_s = $id_s;

        return $this;
    }

    public function getDateArret(): ?\DateTimeInterface
    {
        return $this->date_arret;
    }

    public function setDateArret(\DateTimeInterface $date_arret): self
    {
        $this->date_arret = $date_arret;

        return $this;
    }

    public function getIda(): ?Accident
    {
        return $this->ida;
    }

    public function setIda(?Accident $ida): self
    {
        $this->ida = $ida;

        return $this;
    }


}
