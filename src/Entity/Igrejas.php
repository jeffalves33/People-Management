<?php

namespace App\Entity;

use App\Repository\IgrejasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IgrejasRepository::class)]
class Igrejas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $endereco = null;

    #[ORM\Column(length: 255)]
    private ?string $website = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto_igreja = null;

    #[ORM\OneToMany(mappedBy: 'igreja', targetEntity: Membros::class)]
    private Collection $membros;

    public function __construct()
    {
        $this->membros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getFotoIgreja(): ?string
    {
        return $this->foto_igreja;
    }

    public function setFotoIgreja(?string $foto_igreja): self
    {
        $this->foto_igreja = $foto_igreja;

        return $this;
    }

    /**
     * @return Collection<int, Membros>
     */
    public function getMembros(): Collection
    {
        return $this->membros;
    }

    public function addMembro(Membros $membro): self
    {
        if (!$this->membros->contains($membro)) {
            $this->membros->add($membro);
            $membro->setIgreja($this);
        }

        return $this;
    }

    public function removeMembro(Membros $membro): self
    {
        if ($this->membros->removeElement($membro)) {
            // set the owning side to null (unless already changed)
            if ($membro->getIgreja() === $this) {
                $membro->setIgreja(null);
            }
        }

        return $this;
    }
}
