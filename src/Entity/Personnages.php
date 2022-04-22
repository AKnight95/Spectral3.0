<?php

namespace App\Entity;

use App\Repository\PersonnagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonnagesRepository::class)]
class Personnages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nom;

    #[ORM\Column(type: 'text', nullable: true)]
    private $Histoire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getHistoire(): ?string
    {
        return $this->Histoire;
    }

    public function setHistoire(?string $Histoire): self
    {
        $this->Histoire = $Histoire;

        return $this;
    }
}
