<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServerRepository::class)]
class Server
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Account::class, inversedBy: 'servers')]
    private Collection $members;

    #[ORM\OneToMany(mappedBy: 'server', targetEntity: Channel::class)]
    private Collection $channels;

    #[ORM\OneToMany(mappedBy: 'server', targetEntity: VoiceChannel::class)]
    private Collection $voiceChannels;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->channels = new ArrayCollection();
        $this->voiceChannels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Account>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Account $member): static
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
        }

        return $this;
    }

    public function removeMember(Account $member): static
    {
        $this->members->removeElement($member);

        return $this;
    }

    /**
     * @return Collection<int, Channel>
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function addChannel(Channel $channel): static
    {
        if (!$this->channels->contains($channel)) {
            $this->channels->add($channel);
            $channel->setServer($this);
        }

        return $this;
    }

    public function removeChannel(Channel $channel): static
    {
        if ($this->channels->removeElement($channel)) {
            // set the owning side to null (unless already changed)
            if ($channel->getServer() === $this) {
                $channel->setServer(null);
            }
        }

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
            $voiceChannel->setServer($this);
        }

        return $this;
    }

    public function removeVoiceChannel(VoiceChannel $voiceChannel): static
    {
        if ($this->voiceChannels->removeElement($voiceChannel)) {
            // set the owning side to null (unless already changed)
            if ($voiceChannel->getServer() === $this) {
                $voiceChannel->setServer(null);
            }
        }

        return $this;
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
}
