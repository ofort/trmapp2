<?php

namespace App\Entity;

use App\Entity\Trm;

use App\Repository\TrmVersionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrmVersionRepository::class)]
class TrmVersion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $memo = null;

    #[ORM\ManyToOne(targetEntity: Trm::class, inversedBy: 'trmVersions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trm $trm = null;

/*    #[ORM\OneToMany(mappedBy: 'version', targetEntity: VersionSection::class)]
    private Collection $versionSections;*/

    #[ORM\OneToMany(mappedBy: 'version', targetEntity: Section::class)]
    private Collection $sections;

    public function __construct()
    {
        $this->versionSections = new ArrayCollection();
        $this->sections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getTrm(): ?Trm
    {
        return $this->trm;
    }

    public function setTrm(?Trm $trm): self
    {
        $this->trm = $trm;

        return $this;
    }

    /**
     * @return Collection<int, VersionSection>
     */
    public function getVersionSections(): Collection
    {
        return $this->versionSections;
    }

    public function addVersionSection(VersionSection $versionSection): self
    {
        if (!$this->versionSections->contains($versionSection)) {
            $this->versionSections->add($versionSection);
            $versionSection->setVersion($this);
        }

        return $this;
    }

    public function removeVersionSection(VersionSection $versionSection): self
    {
        if ($this->versionSections->removeElement($versionSection)) {
            // set the owning side to null (unless already changed)
            if ($versionSection->getVersion() === $this) {
                $versionSection->setVersion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
            $section->setVersion($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getVersion() === $this) {
                $section->setVersion(null);
            }
        }

        return $this;
    }
}
