<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $date;



    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "Ce champ doit comporter au moins {{ limit }} caractères",
     *      maxMessage = " Ce champ doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $date_prochaine;
    /**
     * @ORM\Column(type="string", length=20,nullable=true)
     */

    private $aptitude;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Salarie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salarie;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Observation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ido;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

   

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateProchaine(): ?\DateTimeInterface
    {
        return $this->date_prochaine;
    }

    public function setDateProchaine(\DateTimeInterface $date_prochaine): self
    {
        $this->date_prochaine = $date_prochaine;

        return $this;
    }

    public function getAptitude(): ?string
    {
        return $this->aptitude;
    }

    public function setAptitude(string $aptitude): self
    {
        $this->aptitude = $aptitude;

        return $this;
    }

    public function getSalarie(): ?Salarie
    {
        return $this->salarie;
    }

    public function setSalarie(?Salarie $salarie): self
    {
        $this->salarie = $salarie;

        return $this;
    }

    public function getIdo(): ?Observation
    {
        return $this->ido;
    }

    public function setIdo(Observation $ido): self
    {
        $this->ido = $ido;

        return $this;
    }










}
