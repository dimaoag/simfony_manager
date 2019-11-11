<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;


class User
{
    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_BLOCKED = 'blocked';

    /**
     * @var Id
     */
    private $id;
    /**
     * @var \DateTimeImmutable
     */
    private $date;
    /**
     * @var Email
     */
    private $email;
    /**
     * @var Name
     */
    private $name;
    /**
     * @var string
     */
    private $passwordHash;
    /**
     * @var string|null
     */
    private $confirmToken;
    /**
     * @var string
     */
    private $status;

    private function __construct(Id $id, \DateTimeImmutable $date, Name $name)
    {
        $this->id = $id;
        $this->date = $date;
        $this->name = $name;
//        $this->role = Role::user();
//        $this->networks = new ArrayCollection();
    }

    public static function signUpByEmail(Id $id, \DateTimeImmutable $date, Name $name, Email $email, string $hash, string $token): self
    {
        $user = new self($id, $date, $name);
        $user->email = $email;
        $user->passwordHash = $hash;
        $user->confirmToken = $token;
        $user->status = self::STATUS_WAIT;
        return $user;
    }


    public function confirmSignUp(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already confirmed.');
        }

        $this->status = self::STATUS_ACTIVE;
        $this->confirmToken = null;
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('User is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function block(): void
    {
        if ($this->isBlocked()) {
            throw new \DomainException('User is already blocked.');
        }
        $this->status = self::STATUS_BLOCKED;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isBlocked(): bool
    {
        return $this->status === self::STATUS_BLOCKED;
    }


    public function getId(): Id
    {
        return $this->id;
    }


    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }


    public function getEmail(): ?Email
    {
        return $this->email;
    }


    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getConfirmToken(): ?string
    {
        return $this->confirmToken;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getName(): Name
    {
        return $this->name;
    }


}