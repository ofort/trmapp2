<?php

namespace App\Entity;

use App\Entity\TrmVersion;

use App\Repository\TrmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrmRepository::class)]

class Trm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\OneToMany(mappedBy: 'trm', targetEntity: TrmVersion::class, orphanRemoval: true)]
    private Collection $trmVersions;

    public function __construct()
    {
        $this->trmVersions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection<int, TrmVersion>
     */
    public function getTrmVersions(): Collection
    {
        return $this->trmVersions;
    }

    public function addTrmVersion(TrmVersion $trmVersion): self
    {
        if (!$this->trmVersions->contains($trmVersion)) {
            $this->trmVersions->add($trmVersion);
            $trmVersion->setTrm($this);
        }

        return $this;
    }

    public function removeTrmVersion(TrmVersion $trmVersion): self
    {
        if ($this->trmVersions->removeElement($trmVersion)) {
            // set the owning side to null (unless already changed)
            if ($trmVersion->getTrm() === $this) {
                $trmVersion->setTrm(null);
            }
        }

        return $this;
    }
}
