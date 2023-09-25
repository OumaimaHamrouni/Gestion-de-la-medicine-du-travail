<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RisqueRepository")
 */
class Risque
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
     *      min = 2,
     *      max = 20,
     *      minMessage = "Ce champ doit comporter au moins {{ limit }} caractères",
     *      maxMessage = " Ce champ doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      max = 225,
     *      minMessage = "Ce champ doit comporter au moins {{ limit }} caractères",
     *      maxMessage = " Ce champ doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
