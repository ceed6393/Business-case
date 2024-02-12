<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatRepository::class)]
class Etat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'etat', targetEntity: product::class)]
    private Collection $nom;

    public function __construct()
    {
        $this->nom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, product>
     */
    public function getNom(): Collection
    {
        return $this->nom;
    }

    public function addNom(product $nom): static
    {
        if (!$this->nom->contains($nom)) {
            $this->nom->add($nom);
            $nom->setEtat($this);
        }

        return $this;
    }

    public function removeNom(product $nom): static
    {
        if ($this->nom->removeElement($nom)) {
            // set the owning side to null (unless already changed)
            if ($nom->getEtat() === $this) {
                $nom->setEtat(null);
            }
        }

        return $this;
    }
}
