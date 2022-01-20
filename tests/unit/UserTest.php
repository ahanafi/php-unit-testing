<?php

use PHPUnit\Framework\TestCase;

use App\Models\User;

class UserTest extends TestCase {

    protected User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testWeCanGetFirstName(): void
    {
        $this->user->setFirstName('Ahmad');

        self::assertEquals('Ahmad', $this->user->getFirstName());
    }

    public function testWeCanGetLastName(): void
    {
        $this->user->setLastName('Hanafi');

        self::assertEquals('Hanafi', $this->user->getLastName());
    }

    public function testFullNameIsReturned(): void
    {
        $this->user->setFirstName('Ahmad');
        $this->user->setLastName('Hanafi');

        $expected = 'Ahmad Hanafi';
        self::assertEquals($expected, $this->user->getFullName());
    }

    public function testFirstAndLastNameAreTrimmed(): void
    {
        $this->user->setFirstName('           Ahmad   ');
        $this->user->setLastName('  Hanafi             ');

        self::assertEquals('Ahmad', $this->user->getFirstName());
        self::assertEquals('Hanafi', $this->user->getLastName());
    }

    public function testEmailAddressCanBeSet(): void
    {
        $this->user->setEmail('ahanafi.id@gmail.com');

        self::assertEquals('ahanafi.id@gmail.com', $this->user->getEmail());
    }

    public function testEmailVariablesContainCorrectValues(): void
    {
        $this->user->setFirstName('Ahmad');
        $this->user->setLastName('Hanafi');
        $this->user->setEmail('ahanafi.id@gmail.com');

        $emailVariables = $this->user->getEmailVariables();

        self::assertArrayHasKey('full_name', $emailVariables);
        self::assertArrayHasKey('email', $emailVariables);

        self::assertEquals('Ahmad Hanafi', $emailVariables['full_name']);
        self::assertEquals('ahanafi.id@gmail.com', $emailVariables['email']);

    }

}