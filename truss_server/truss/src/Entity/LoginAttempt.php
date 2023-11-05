<?php

namespace App\Entity;

use App\Repository\LoginAttemptRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoginAttemptRepository::class)]
class LoginAttempt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Account::class, inversedBy: 'loginAttempts')]
    private Collection $account;

    #[ORM\Column]
    private ?bool $result = null;

    public function __construct()
    {
        $this->account = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Account>
     */
    public function getAccount(): Collection
    {
        return $this->account;
    }

    public function addAccount(Account $account): static
    {
        if (!$this->account->contains($account)) {
            $this->account->add($account);
        }

        return $this;
    }

    public function removeAccount(Account $account): static
    {
        $this->account->removeElement($account);

        return $this;
    }

    public function isResult(): ?bool
    {
        return $this->result;
    }

    public function setResult(bool $result): static
    {
        $this->result = $result;

        return $this;
    }
}
