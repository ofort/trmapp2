<?php

namespace App\Entity;

use App\Repository\VersionSectionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VersionSectionRepository::class)]
class VersionSection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

/*    #[ORM\ManyToOne(inversedBy: 'versionSections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TrmVersion $version = null;*/

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVersion(): ?TrmVersion
    {
        return $this->version;
    }

    public function setVersion(?TrmVersion $version): self
    {
        $this->version = $version;

        return $this;
    }
}
