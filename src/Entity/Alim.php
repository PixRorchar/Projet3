<?php

namespace App\Entity;

use App\Repository\AlimRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=AlimRepository::class)
 */
class Alim 
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
    private $libal;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity=SousGroupe::class, inversedBy="alims")
     */
    private $SousGroupe;

    /**
     * @ORM\ManyToMany(targetEntity=Repas::class, mappedBy="alims")
     */
    private $repas;

    public function __construct()
    {
        $this->repas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibal(): ?string
    {
        return $this->libal;
    }

    public function setLibal(string $libal): self
    {
        $this->libal = $libal;

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

    public function getSousGroupe(): ?SousGroupe
    {
        return $this->SousGroupe;
    }

    public function setSousGroupe(?SousGroupe $SousGroupe): self
    {
        $this->SousGroupe = $SousGroupe;

        return $this;
    }
    

    /*
    public function __toString()
    {
        return $this->libal;
    }
     */

    /**
     * @return Collection|Repas[]
     */
    public function getRepas(): Collection
    {
        return $this->repas;
    }

    public function addRepa(Repas $repa): self
    {
        if (!$this->repas->contains($repa)) {
            $this->repas[] = $repa;
            $repa->addAlim($this);
        }

        return $this;
    }

    public function removeRepa(Repas $repa): self
    {
        if ($this->repas->removeElement($repa)) {
            $repa->removeAlim($this);
        }

        return $this;
    }
    
}
