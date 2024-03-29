<?php

namespace App\Entity;

use App\Repository\OrdenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdenRepository::class)]
class Orden
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $estado = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $iniciada = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $confirmada = null;

    #[ORM\OneToMany(mappedBy: 'orden', targetEntity: Item::class)]
    private Collection $item;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $usuario = null;

    public function __construct()
    {
        $this->item = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIniciada(): ?\DateTimeInterface
    {
        return $this->iniciada;
    }

    public function setIniciada(\DateTimeInterface $iniciada): static
    {
        $this->iniciada = $iniciada;

        return $this;
    }

    public function getConfirmada(): ?\DateTimeInterface
    {
        return $this->confirmada;
    }

    public function setConfirmada(\DateTimeInterface $confirmada): static
    {
        $this->confirmada = $confirmada;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Item $item): static
    {
        if (!$this->item->contains($item)) {
            $this->item->add($item);
            $item->setOrden($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->item->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getOrden() === $this) {
                $item->setOrden(null);
            }
        }

        return $this;
    }

    public function getUsuario(): ?user
    {
        return $this->usuario;
    }

    public function setUsuario(?user $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }
}
