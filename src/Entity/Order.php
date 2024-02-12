<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   
    private Collection $Commandes;

    #[ORM\Column(length: 255)]
    private ?string $Recapitulatif = null;

    #[ORM\Column]
    private ?float $Total = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    public function __construct()
    {
        $this->Commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getCommandes(): Collection
    {
        return $this->Commandes;
    }

   

    public function getRecapitulatif(): ?string
    {
        return $this->Recapitulatif;
    }

    public function setRecapitulatif(string $Recapitulatif): static
    {
        $this->Recapitulatif = $Recapitulatif;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->Total;
    }

    public function setTotal(float $Total): static
    {
        $this->Total = $Total;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
}
