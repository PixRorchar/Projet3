<?php

namespace App\Entity;

use App\Repository\RepasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RepasRepository::class)
 */
class Repas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Alim::class, inversedBy="repas")
     */
    private $alims;

    public function __construct()
    {
        $this->alims = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Alim[]
     */
    public function getAlims(): Collection
    {
        return $this->alims;
    }

    public function addAlim(Alim $alim): self
    {
        if (!$this->alims->contains($alim)) {
            $this->alims[] = $alim;
        }

        return $this;
    }

    public function removeAlim(Alim $alim): self
    {
        $this->alims->removeElement($alim);

        return $this;
    }
}
