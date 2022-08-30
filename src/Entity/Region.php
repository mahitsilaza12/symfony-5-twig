<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle_region;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: District::class)]
    private $Region;

    public function __construct()
    {
        $this->Region = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleRegion(): ?string
    {
        return $this->libelle_region;
    }

    public function setLibelleRegion(string $libelle_region): self
    {
        $this->libelle_region = $libelle_region;

        return $this;
    }

    /**
     * @return Collection<int, District>
     */
    public function getRegion(): Collection
    {
        return $this->Region;
    }

    public function addRegion(District $region): self
    {
        if (!$this->Region->contains($region)) {
            $this->Region[] = $region;
            $region->setRegion($this);
        }

        return $this;
    }

    public function removeRegion(District $region): self
    {
        if ($this->Region->removeElement($region)) {
            // set the owning side to null (unless already changed)
            if ($region->getRegion() === $this) {
                $region->setRegion(null);
            }
        }

        return $this;
    }
}
