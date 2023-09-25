<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AccidentRepository")
 */
class Accident
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="your message")
     * @Assert\Length(
     *     max=65535,
     *     maxMessage="your message"
     * )
     */
    private $cause;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="your message")
     * @Assert\Length(
     *     max=65535,
     *     maxMessage="your message"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateheure_accident;

    /**
     * @ORM\Column(type="string", length=20000)
     *  * @Assert\Length(
     *      min = 3,
     *      max = 20000,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $lieu;



    /**
     * @ORM\Column(type="string", length=255 , unique=true)
     *  * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255)
     *  * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $etablissement;




    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCause(): ?string
    {
        return $this->cause;
    }

    public function setCause(string $cause): self
    {
        $this->cause = $cause;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateheureAccident(): ?\DateTimeInterface
    {
        return $this->dateheure_accident;
    }

    public function setDateheureAccident(\DateTimeInterface $dateheure_accident): self
    {
        $this->dateheure_accident = $dateheure_accident;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }



    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }

    public function setEtablissement(string $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }




}
