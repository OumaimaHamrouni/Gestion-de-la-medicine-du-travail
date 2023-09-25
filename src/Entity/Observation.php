<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObservationRepository")
 */
class Observation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     *   * * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Le nom de l'entreprise doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $observation;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="your message")
     * @Assert\Length(
     *     max=65535,
     *     maxMessage="your message"
     * )
     */
    private $remarque;


    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $exemen_comp;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }


    public function getExemenComp(): ?array
    {
        return $this->exemen_comp;
    }

    public function setExemenComp(array $exemen_comp): self
    {
        $this->exemen_comp = $exemen_comp;

        return $this;
    }

}
