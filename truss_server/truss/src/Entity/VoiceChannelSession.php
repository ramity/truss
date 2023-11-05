<?php

namespace App\Entity;

use App\Repository\VoiceChannelConnectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoiceChannelConnectionRepository::class)]
class VoiceChannelConnection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?array $peers = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(nullable: true)]
    private ?array $messages = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeers(): ?array
    {
        return $this->peers;
    }

    public function setPeers(?array $peers): static
    {
        $this->peers = $peers;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getMessages(): ?array
    {
        return $this->messages;
    }

    public function setMessages(?array $messages): static
    {
        $this->messages = $messages;

        return $this;
    }
}
