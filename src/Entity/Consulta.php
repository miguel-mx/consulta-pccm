<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsultaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Consulta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $contenido;

    /**
     * @ORM\Column(type="array", length=255)
     */
    private $habilidades;

    /**
     * @ORM\Column(type="array", length=255)
     */
    private $preguntas;

    /**
     * @ORM\Column(type="array", length=255)
     */
    private $temas;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $opinion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenido()
    {
        return $this->contenido;
    }

    public function setContenido($contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }

    public function getHabilidades(): ?array
    {
        return $this->habilidades;
    }

    public function setHabilidades(array $habilidades): self
    {
        $this->habilidades = $habilidades;

        return $this;
    }

    public function getPreguntas(): ?array
    {
        return $this->preguntas;
    }

    public function setPreguntas(array $preguntas): self
    {
        $this->preguntas = $preguntas;

        return $this;
    }

    public function getTemas(): ?array
    {
        return $this->temas;
    }

    public function setTemas(array $temas): self
    {
        $this->temas = $temas;

        return $this;
    }

    public function getOpinion(): ?string
    {
        return $this->opinion;
    }

    public function setOpinion(?string $opinion): self
    {
        $this->opinion = $opinion;

        return $this;
    }


    /**
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->created = new \DateTime();
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
}
