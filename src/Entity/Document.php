<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    /**
     * NOTE:this is not a mapped field of entity metadata, just a sinple proprety.
     */
    #[Vich\UploadableField(mapping:'actualite_fichier', fileNameProperty:'fichier')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $fichier;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomdoc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(?string $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getNomdoc(): ?string
    {
        return $this->nomdoc;
    }

    public function setNomdoc(string $nomdoc): self
    {
        $this->nomdoc = $nomdoc;

        return $this;
    }

#[ORM\Column(type:"datetime")]
    private $createdAt;

    #[ORM\Column(type:"datetime")]
    private $updatedAt;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: AgentService::class)]
    private $doc;

    public function __construct()
    {
        $this->doc = new ArrayCollection();
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateTimestamps(){
        if($this->getCreatedAt() === null){
            $this->setCreatedAt(new \DateTimeImmutable);
        }
        $this->setUpdatedAt(new \DateTimeImmutable);

    }

    /**
     * @return Collection<int, AgentService>
     */
    public function getDoc(): Collection
    {
        return $this->doc;
    }

    public function addDoc(AgentService $doc): self
    {
        if (!$this->doc->contains($doc)) {
            $this->doc[] = $doc;
            $doc->setDocument($this);
        }

        return $this;
    }

    public function removeDoc(AgentService $doc): self
    {
        if ($this->doc->removeElement($doc)) {
            // set the owning side to null (unless already changed)
            if ($doc->getDocument() === $this) {
                $doc->setDocument(null);
            }
        }

        return $this;
    }



    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File|null $imageFile
     */
    public function setImageFile(?File $imageFile = null):void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdatedAt( new \DateTimeImmutable);
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}
