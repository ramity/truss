<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 1024)]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Server::class, mappedBy: 'members')]
    private Collection $servers;

    #[ORM\ManyToMany(targetEntity: Post::class, mappedBy: 'author')]
    private Collection $posts;

    #[ORM\ManyToMany(targetEntity: LoginAttempt::class, mappedBy: 'account')]
    private Collection $loginAttempts;

    public function __construct()
    {
        $this->servers = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->loginAttempts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Server>
     */
    public function getServers(): Collection
    {
        return $this->servers;
    }

    public function addServer(Server $server): static
    {
        if (!$this->servers->contains($server)) {
            $this->servers->add($server);
            $server->addMember($this);
        }

        return $this;
    }

    public function removeServer(Server $server): static
    {
        if ($this->servers->removeElement($server)) {
            $server->removeMember($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->addAuthor($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            $post->removeAuthor($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, LoginAttempt>
     */
    public function getLoginAttempts(): Collection
    {
        return $this->loginAttempts;
    }

    public function addLoginAttempt(LoginAttempt $loginAttempt): static
    {
        if (!$this->loginAttempts->contains($loginAttempt)) {
            $this->loginAttempts->add($loginAttempt);
            $loginAttempt->addAccount($this);
        }

        return $this;
    }

    public function removeLoginAttempt(LoginAttempt $loginAttempt): static
    {
        if ($this->loginAttempts->removeElement($loginAttempt)) {
            $loginAttempt->removeAccount($this);
        }

        return $this;
    }
}
