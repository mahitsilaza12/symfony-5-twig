<?php

namespace App\Entity;

use App\Repository\DistrictRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DistrictRepository::class)]
class District
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle_district;

    #[ORM\ManyToOne(targetEntity: Region::class, inversedBy: 'Region')]
    private $region;

    #[ORM\OneToMany(mappedBy: 'district', targetEntity: Commune::class)]
    private $District;

    public function __construct()
    {
        $this->District = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleDistrict(): ?string
    {
        return $this->libelle_district;
    }

    public function setLibelleDistrict(string $libelle_district): self
    {
        $this->libelle_district = $libelle_district;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, Commune>
     */
    public function getDistrict(): Collection
    {
        return $this->District;
    }

    public function addDistrict(Commune $district): self
    {
        if (!$this->District->contains($district)) {
            $this->District[] = $district;
            $district->setDistrict($this);
        }

        return $this;
    }

    public function removeDistrict(Commune $district): self
    {
        if ($this->District->removeElement($district)) {
            // set the owning side to null (unless already changed)
            if ($district->getDistrict() === $this) {
                $district->setDistrict(null);
            }
        }

        return $this;
    }


}
