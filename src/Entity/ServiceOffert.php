<?php

namespace App\Entity;

use App\Repository\ServiceOffertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceOffertRepository::class)]
class ServiceOffert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle_offre;

    #[ORM\OneToMany(mappedBy: 'serv', targetEntity: FormationSanitaire::class)]
    private $serv;

    public function __construct()
    {
        $this->serv = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleOffre(): ?string
    {
        return $this->libelle_offre;
    }

    public function setLibelleOffre(string $libelle_offre): self
    {
        $this->libelle_offre = $libelle_offre;

        return $this;
    }

    /**
     * @return Collection<int, FormationSanitaire>
     */
    public function getServ(): Collection
    {
        return $this->serv;
    }

    public function addServ(FormationSanitaire $serv): self
    {
        if (!$this->serv->contains($serv)) {
            $this->serv[] = $serv;
            $serv->setServ($this);
        }

        return $this;
    }

    public function removeServ(FormationSanitaire $serv): self
    {
        if ($this->serv->removeElement($serv)) {
            // set the owning side to null (unless already changed)
            if ($serv->getServ() === $this) {
                $serv->setServ(null);
            }
        }

        return $this;
    }

}
