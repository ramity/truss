<?php

namespace App\Test\Controller;

use App\Entity\LoginAttempt;
use App\Repository\LoginAttemptRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginAttemptControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private LoginAttemptRepository $repository;
    private string $path = '/login/attempt/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(LoginAttempt::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('LoginAttempt index');

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
            'login_attempt[result]' => 'Testing',
            'login_attempt[createdAt]' => 'Testing',
            'login_attempt[account]' => 'Testing',
        ]);

        self::assertResponseRedirects('/login/attempt/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new LoginAttempt();
        $fixture->setResult('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setAccount('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('LoginAttempt');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new LoginAttempt();
        $fixture->setResult('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setAccount('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'login_attempt[result]' => 'Something New',
            'login_attempt[createdAt]' => 'Something New',
            'login_attempt[account]' => 'Something New',
        ]);

        self::assertResponseRedirects('/login/attempt/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getResult());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getAccount());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new LoginAttempt();
        $fixture->setResult('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setAccount('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/login/attempt/');
    }
}
