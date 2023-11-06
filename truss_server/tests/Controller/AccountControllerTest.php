<?php

namespace App\Test\Controller;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccountControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AccountRepository $repository;
    private string $path = '/account/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Account::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Account index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'account[username]' => 'Testing',
            'account[passwordHash]' => 'Testing',
            'account[createdAt]' => 'Testing',
            'account[updatedAt]' => 'Testing',
            'account[servers]' => 'Testing',
            'account[posts]' => 'Testing',
            'account[loginAttempts]' => 'Testing',
        ]);

        self::assertResponseRedirects('/account/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Account();
        $fixture->setUsername('My Title');
        $fixture->setPasswordHash('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setServers('My Title');
        $fixture->setPosts('My Title');
        $fixture->setLoginAttempts('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Account');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Account();
        $fixture->setUsername('My Title');
        $fixture->setPasswordHash('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setServers('My Title');
        $fixture->setPosts('My Title');
        $fixture->setLoginAttempts('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'account[username]' => 'Something New',
            'account[passwordHash]' => 'Something New',
            'account[createdAt]' => 'Something New',
            'account[updatedAt]' => 'Something New',
            'account[servers]' => 'Something New',
            'account[posts]' => 'Something New',
            'account[loginAttempts]' => 'Something New',
        ]);

        self::assertResponseRedirects('/account/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUsername());
        self::assertSame('Something New', $fixture[0]->getPasswordHash());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getServers());
        self::assertSame('Something New', $fixture[0]->getPosts());
        self::assertSame('Something New', $fixture[0]->getLoginAttempts());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Account();
        $fixture->setUsername('My Title');
        $fixture->setPasswordHash('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setServers('My Title');
        $fixture->setPosts('My Title');
        $fixture->setLoginAttempts('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/account/');
    }
}
