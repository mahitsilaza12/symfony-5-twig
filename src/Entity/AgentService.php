<?php

namespace App\Entity;

use App\Repository\AgentServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentServiceRepository::class)]
class AgentService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type_S;

    #[ORM\ManyToOne(targetEntity: Actualite::class, inversedBy: 'actu')]
    private $actualite;

    #[ORM\ManyToOne(targetEntity: Document::class, inversedBy: 'doc')]
    private $document;

    #[ORM\OneToMany(mappedBy: 'agentService', targetEntity: FormationSanitaire::class)]
    private $agent;

    public function __construct()
    {
        $this->agent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeS(): ?string
    {
        return $this->type_S;
    }

    public function setTypeS(string $type_S): self
    {
        $this->type_S = $type_S;

        return $this;
    }

    public function getActualite(): ?Actualite
    {
        return $this->actualite;
    }

    public function setActualite(?Actualite $actualite): self
    {
        $this->actualite = $actualite;

        return $this;
    }

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @return Collection<int, FormationSanitaire>
     */
    public function getAgent(): Collection
    {
        return $this->agent;
    }

    public function addAgent(FormationSanitaire $agent): self
    {
        if (!$this->agent->contains($agent)) {
            $this->agent[] = $agent;
            $agent->setAgentService($this);
        }

        return $this;
    }

    public function removeAgent(FormationSanitaire $agent): self
    {
        if ($this->agent->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getAgentService() === $this) {
                $agent->setAgentService(null);
            }
        }

        return $this;
    }
}
