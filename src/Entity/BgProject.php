<?php

namespace App\Entity;

use App\Repository\BgProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BgProjectRepository::class)]
class BgProject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Background1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $background2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBackground1(): ?string
    {
        return $this->Background1;
    }

    public function setBackground1(?string $Background1): self
    {
        $this->Background1 = $Background1;

        return $this;
    }

    public function getBackground2(): ?string
    {
        return $this->background2;
    }

    public function setBackground2(?string $background2): self
    {
        $this->background2 = $background2;

        return $this;
    }
}
