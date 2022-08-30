<?php

namespace App\Entity;

use App\Repository\FormationSanitaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: FormationSanitaireRepository::class)]
class FormationSanitaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min:1)]
    private $nom_FS;

    #[ORM\Column(type: 'string', length: 255)]
    private $typy_FS;

    #[ORM\Column(type: 'boolean')]
    private $status;

    #[ORM\Column(type: 'string', length: 255)]
    private $adress_FS;

    #[ORM\Column(type: 'string', length: 255)]
    private $coordonner_FS;

    #[ORM\ManyToOne(targetEntity: ServiceOffert::class, inversedBy: 'serv')]
    private $serv;

    #[ORM\ManyToOne(targetEntity: AgentService::class, inversedBy: 'agent')]
    private $agentService;

    #[ORM\ManyToOne(targetEntity: Commune::class, inversedBy: 'Commune')]
    private $commune;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFS(): ?string
    {
        return $this->nom_FS;
    }

    public function setNomFS(string $nom_FS): self
    {
        $this->nom_FS = $nom_FS;

        return $this;
    }

    public function getTypyFS(): ?string
    {
        return $this->typy_FS;
    }

    public function setTypyFS(string $typy_FS): self
    {
        $this->typy_FS = $typy_FS;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAdressFS(): ?string
    {
        return $this->adress_FS;
    }

    public function setAdressFS(string $adress_FS): self
    {
        $this->adress_FS = $adress_FS;

        return $this;
    }

    public function getCoordonnerFS(): ?string
    {
        return $this->coordonner_FS;
    }

    public function setCoordonnerFS(string $coordonner_FS): self
    {
        $this->coordonner_FS = $coordonner_FS;

        return $this;
    }

    public function getServ(): ?ServiceOffert
    {
        return $this->serv;
    }

    public function setServ(?ServiceOffert $serv): self
    {
        $this->serv = $serv;

        return $this;
    }

    public function getAgentService(): ?AgentService
    {
        return $this->agentService;
    }

    public function setAgentService(?AgentService $agentService): self
    {
        $this->agentService = $agentService;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

}
