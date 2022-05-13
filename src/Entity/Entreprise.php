<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $designation;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: PFE::class)]
    private $pfeCollection;

    public function __construct()
    {
        $this->pfeCollection = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection<int, PFE>
     */
    public function getPfeCollection(): Collection
    {
        return $this->pfeCollection;
    }

    public function addPfeCollection(PFE $pfeCollection): self
    {
        if (!$this->pfeCollection->contains($pfeCollection)) {
            $this->pfeCollection[] = $pfeCollection;
            $pfeCollection->setEntreprise($this);
        }

        return $this;
    }

    public function removePfeCollection(PFE $pfeCollection): self
    {
        if ($this->pfeCollection->removeElement($pfeCollection)) {
            // set the owning side to null (unless already changed)
            if ($pfeCollection->getEntreprise() === $this) {
                $pfeCollection->setEntreprise(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getDesignation();
    }
}
