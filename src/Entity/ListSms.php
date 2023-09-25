<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ListSmsRepository")
 */
class ListSms
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
    private $sms;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $freq;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSms(): ?string
    {
        return $this->sms;
    }

    public function setSms(string $sms): self
    {
        $this->sms = $sms;

        return $this;
    }

    public function getFreq(): ?string
    {
        return $this->freq;
    }

    public function setFreq(string $freq): self
    {
        $this->freq = $freq;

        return $this;
    }
}
