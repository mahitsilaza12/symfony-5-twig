<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
class Commune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle_commune;

    #[ORM\ManyToOne(targetEntity: District::class, inversedBy: 'District')]
    private $district;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCommune(): ?string
    {
        return $this->libelle_commune;
    }

    public function setLibelleCommune(string $libelle_commune): self
    {
        $this->libelle_commune = $libelle_commune;

        return $this;
    }

    public function getDistrict(): ?District
    {
        return $this->district;
    }

    public function setDistrict(?District $district): self
    {
        $this->district = $district;

        return $this;
    }



}
