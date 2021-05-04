<?php

namespace App\Entity;

use App\Repository\SousGroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousGroupeRepository::class)
 */
class SousGroupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sougr;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Alim::class, mappedBy="SousGroupe")
     */
    private $alims;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="sousGroupes")
     */
    private $Groupe;

    public function __construct()
    {
        $this->alims = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSougr(): ?string
    {
        return $this->sougr;
    }

    public function setSougr(string $sougr): self
    {
        $this->sougr = $sougr;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

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
            $alim->setSousGroupe($this);
        }

        return $this;
    }

    public function removeAlim(Alim $alim): self
    {
        if ($this->alims->removeElement($alim)) {
            // set the owning side to null (unless already changed)
            if ($alim->getSousGroupe() === $this) {
                $alim->setSousGroupe(null);
            }
        }

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->Groupe;
    }

    public function setGroupe(?Groupe $Groupe): self
    {
        $this->Groupe = $Groupe;

        return $this;
    }

    public function __toString()
    {
        return $this->sougr;
    }

   
}
