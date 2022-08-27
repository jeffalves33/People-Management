<?php

namespace App\Entity;

use App\Repository\MembrosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembrosRepository::class)]
class Membros
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nome = null;

    #[ORM\Column(length: 11)]
    private ?string $cpf = null;

    #[ORM\Column(length: 10)]
    private ?string $data_nascimento = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 12)]
    private ?string $telefone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logradouro = null;

    #[ORM\Column(length: 15)]
    private ?string $cidade = null;

    #[ORM\Column(length: 2)]
    private ?string $estado = null;

    #[ORM\ManyToOne(inversedBy: 'membros')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Igrejas $igreja = null;

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

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getDataNascimento(): ?string
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(string $data_nascimento): self
    {
        $this->data_nascimento = $data_nascimento;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getLogradouro(): ?string
    {
        return $this->logradouro;
    }

    public function setLogradouro(?string $logradouro): self
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIgreja(): ?Igrejas
    {
        return $this->igreja;
    }

    public function setIgreja(?Igrejas $igreja): self
    {
        $this->igreja = $igreja;

        return $this;
    }
}
