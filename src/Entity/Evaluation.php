<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\EvaluationRepository")
 */
class Evaluation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "Ce champ doit comporter au moins {{ limit }} caractères",
     *      maxMessage = " Ce champ doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $freqance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      max = 255,
     *      minMessage = "Ce champ doit comporter au moins {{ limit }} caractères",
     *      maxMessage = " Ce champ doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $evaluation;

    /**
     * @ORM\ManyToOne(targetEntity="PosteDeTravail")
     * @ORM\JoinColumn(name="id_pt", referencedColumnName="id")
     */
    private $ID_PT;

    /**
     * @ORM\ManyToOne(targetEntity="Risque")
     * @ORM\JoinColumn(name="id_r", referencedColumnName="id")
     */
    private $ID_R;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getFreqance(): ?string
    {
        return $this->freqance;
    }

    public function setFreqance(string $freqance): self
    {
        $this->freqance = $freqance;

        return $this;
    }

    public function getEvaluation(): ?string
    {
        return $this->evaluation;
    }

    public function setEvaluation(string $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }


    public function getIDPT() :?PosteDeTravail
    {
        return $this->ID_PT;
    }


    public function setIDPT(PosteDeTravail $ID_PT): self
    {
        $this->ID_PT = $ID_PT;
        return $this;
    }


    public function getIDR(): ?Risque
    {
        return $this->ID_R;
    }

    public function setIDR(Risque $ID_R): self
    {
        $this->ID_R = $ID_R;

        return $this;
    }
}
