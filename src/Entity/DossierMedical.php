<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DossierMedicalRepository")
 */
class DossierMedical
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
















    /**
     * @Assert\Length(max=255, minMessage="...", maxMessage="...")
     * @Assert\Regex(
     * pattern = "/^[a-z0-9]+$/i",
     * htmlPattern = "^[a-zA-Z0-9]+$",
     * message="Your name must contain only letter or numbers"
     * )
     */
    private $allergies;
    /**
     * @var string
     * @ORM\Column(type="text", length=65535,nullable=true)
     * @Assert\NotBlank(message="your message")
     * @Assert\Length(
     *     max=65535,
     *     maxMessage="your message"
     * )
     */
    private $description_allergies;

    /**
     * @Assert\Length(max=255, minMessage="...", maxMessage="...")
     * @Assert\Regex(
     * pattern = "/^[a-z0-9]+$/i",
     * htmlPattern = "^[a-zA-Z0-9]+$",
     * message="Your name must contain only letter or numbers"
     * )
     */
    private $vaccinin;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="your message")
     * @Assert\Length(
     *     max=65535,
     *     maxMessage="your message"
     * )
     */
    private $description_vaccinin;

    /**

     * @Assert\Positive
     * @ORM\Column(type="float")
     */
    private $taille;

    /**
     * @Assert\Positive
     * @ORM\Column(type="float")
     */
    private $poids;
    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $tratitements_longues_duree;

    /**
     * @ORM\Column(type="string", length=255)
     *   * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $frequence;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Salarie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $IDS;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $habitude;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(string $allergies): self
    {
        $this->allergies = $allergies;

        return $this;
    }

    public function getDescriptionAllergies(): ?string
    {
        return $this->description_allergies;
    }

    public function setDescriptionAllergies(string $description_allergies): self
    {
        $this->description_allergies = $description_allergies;

        return $this;
    }

    public function getVaccinin(): ?string
    {
        return $this->vaccinin;
    }

    public function setVaccinin(string $vaccinin): self
    {
        $this->vaccinin = $vaccinin;

        return $this;
    }

    public function getDescriptionVaccinin(): ?string
    {
        return $this->description_vaccinin;
    }

    public function setDescriptionVaccinin(string $description_vaccinin): self
    {
        $this->description_vaccinin = $description_vaccinin;

        return $this;
    }

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(float $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getTratitementsLonguesDuree(): ?string
    {
        return $this->tratitements_longues_duree;
    }

    public function setTratitementsLonguesDuree(string $tratitements_longues_duree): self
    {
        $this->tratitements_longues_duree = $tratitements_longues_duree;

        return $this;
    }

    public function getFrequence(): ?string
    {
        return $this->frequence;
    }

    public function setFrequence(string $frequence): self
    {
        $this->frequence = $frequence;

        return $this;
    }

    public function getIDS(): ?Salarie
    {
        return $this->IDS;
    }

    public function setIDS(Salarie $IDS): self
    {
        $this->IDS = $IDS;

        return $this;
    }

    public function getHabitude(): ?string
    {
        return $this->habitude;
    }

    public function setHabitude(?string $habitude): self
    {
        $this->habitude = $habitude;

        return $this;
    }


}
