<?php

declare(strict_types=1);

namespace App\Tests\Unit\Model\User\Entity\User\SignUp;

//use App\Tests\Builder\User\UserBuilder;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\Name;
use App\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;

class ConfirmTest extends TestCase
{
    public function testSuccess(): void
    {
//        $user = (new UserBuilder())->viaEmail()->build();

        $user = User::signUpByEmail(
            $id = Id::next(),
            $date = new \DateTimeImmutable(),
            $name = new Name('First', 'Last'),
            $email = new Email('test@app.test'),
            $hash = 'hash',
            $token = 'token'
        );

        $user->confirmSignUp();

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());

        self::assertNull($user->getConfirmToken());
    }

    public function testAlready(): void
    {
//        $user = (new UserBuilder())->viaEmail()->build();

        $user = User::signUpByEmail(
            $id = Id::next(),
            $date = new \DateTimeImmutable(),
            $name = new Name('First', 'Last'),
            $email = new Email('test@app.test'),
            $hash = 'hash',
            $token = 'token'
        );

        $user->confirmSignUp();
        $this->expectExceptionMessage('User is already confirmed.');
        $user->confirmSignUp();
    }
}
