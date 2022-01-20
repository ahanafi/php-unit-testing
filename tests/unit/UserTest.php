<?php

use PHPUnit\Framework\TestCase;

use App\Models\User;

class UserTest extends TestCase {

    public function testWeCanGetFirstName(): void
    {
        $user = new User();
        $user->setFirstName('Ahmad');

        self::assertEquals('Ahmad', $user->getFirstName());
    }

    public function testWeCanGetLastName(): void
    {
        $user = new User();
        $user->setLastName('Hanafi');

        self::assertEquals('Hanafi', $user->getLastName());
    }

    public function testFullNameIsReturned(): void
    {
        $user = new User();
        $user->setFirstName('Ahmad');
        $user->setLastName('Hanafi');

        $expected = 'Ahmad Hanafi';
        self::assertEquals($expected, $user->getFullName());
    }

    public function testFirstAndLastNameAreTrimmed(): void
    {
        $user = new User();
        $user->setFirstName('           Ahmad   ');
        $user->setLastName('  Hanafi             ');

        self::assertEquals('Ahmad', $user->getFirstName());
        self::assertEquals('Hanafi', $user->getLastName());
    }

    public function testEmailAddressCanBeSet(): void
    {
        $user = new User();
        $user->setEmail('ahanafi.id@gmail.com');

        self::assertEquals('ahanafi.id@gmail.com', $user->getEmail());
    }

    public function testEmailVariablesContainCorrectValues(): void
    {
        $user = new User();
        $user->setFirstName('Ahmad');
        $user->setLastName('Hanafi');
        $user->setEmail('ahanafi.id@gmail.com');

        $emailVariables = $user->getEmailVariables();

        self::assertArrayHasKey('full_name', $emailVariables);
        self::assertArrayHasKey('email', $emailVariables);

        self::assertEquals('Ahmad Hanafi', $emailVariables['full_name']);
        self::assertEquals('ahanafi.id@gmail.com', $emailVariables['email']);

    }

}