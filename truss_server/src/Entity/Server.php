<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity(repositoryClass: ServerRepository::class)]
class Server
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Account::class, inversedBy: 'servers')]
    private Collection $members;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: TextChannel::class, mappedBy: 'servers')]
    private Collection $textChannels;

    #[ORM\OneToMany(mappedBy: 'server', targetEntity: Category::class)]
    private Collection $categories;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: VoiceChannel::class, mappedBy: 'servers')]
    private Collection $voiceChannels;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->textChannels = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->voiceChannels = new ArrayCollection();
    }

    public function __toString()
    {
        return "{$this->name} @ {$this->createdAt->format('r')}";
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
            $textChannel->addServer($this);
        }

        return $this;
    }

    public function removeTextChannel(TextChannel $textChannel): static
    {
        if ($this->textChannels->removeElement($textChannel)) {
            $textChannel->removeServer($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setServer($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getServer() === $this) {
                $category->setServer(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

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
            $voiceChannel->addServer($this);
        }

        return $this;
    }

    public function removeVoiceChannel(VoiceChannel $voiceChannel): static
    {
        if ($this->voiceChannels->removeElement($voiceChannel)) {
            $voiceChannel->removeServer($this);
        }

        return $this;
    }
}
