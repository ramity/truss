<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Server $server = null;

    #[ORM\ManyToMany(targetEntity: TextChannel::class, inversedBy: 'categories')]
    private Collection $textChannels;

    #[ORM\ManyToMany(targetEntity: VoiceChannel::class, inversedBy: 'categories')]
    private Collection $voiceChannels;

    public function __construct()
    {
        $this->textChannels = new ArrayCollection();
        $this->voiceChannels = new ArrayCollection();
    }

    public function __toString()
    {
        return "{$this->name}";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getServer(): ?Server
    {
        return $this->server;
    }

    public function setServer(?Server $server): static
    {
        $this->server = $server;

        return $this;
    }

    /**
     * @return Collection<int, TextChannel>
     */
    public function getTextChannels(): Collection
    {
        return $this->textChannels;
    }

    public function addTextChannel(TextChannel $textChannel): static
    {
        if (!$this->textChannels->contains($textChannel)) {
            $this->textChannels->add($textChannel);
        }

        return $this;
    }

    public function removeTextChannel(TextChannel $textChannel): static
    {
        $this->textChannels->removeElement($textChannel);

        return $this;
    }

    /**
     * @return Collection<int, VoiceChannel>
     */
    public function getVoiceChannels(): Collection
    {
        return $this->voiceChannels;
    }

    public function addVoiceChannel(VoiceChannel $voiceChannel): static
    {
        if (!$this->voiceChannels->contains($voiceChannel)) {
            $this->voiceChannels->add($voiceChannel);
        }

        return $this;
    }

    public function removeVoiceChannel(VoiceChannel $voiceChannel): static
    {
        $this->voiceChannels->removeElement($voiceChannel);

        return $this;
    }
}
