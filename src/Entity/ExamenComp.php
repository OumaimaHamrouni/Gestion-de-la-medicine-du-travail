<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamenCompRepository")
 */
class ExamenComp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $examen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExamen(): ?string
    {
        return $this->examen;
    }

    public function setExamen(string $examen): self
    {
        $this->examen = $examen;

        return $this;
    }
}
