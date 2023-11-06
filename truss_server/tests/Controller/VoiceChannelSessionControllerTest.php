<?php

namespace App\Test\Controller;

use App\Entity\VoiceChannelSession;
use App\Repository\VoiceChannelSessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VoiceChannelSessionControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private VoiceChannelSessionRepository $repository;
    private string $path = '/voice/channel/session/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(VoiceChannelSession::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VoiceChannelSession index');

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
            'voice_channel_session[peers]' => 'Testing',
            'voice_channel_session[active]' => 'Testing',
            'voice_channel_session[messages]' => 'Testing',
            'voice_channel_session[createdAt]' => 'Testing',
            'voice_channel_session[updatedAt]' => 'Testing',
            'voice_channel_session[voiceChannel]' => 'Testing',
        ]);

        self::assertResponseRedirects('/voice/channel/session/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new VoiceChannelSession();
        $fixture->setPeers('My Title');
        $fixture->setActive('My Title');
        $fixture->setMessages('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setVoiceChannel('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VoiceChannelSession');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new VoiceChannelSession();
        $fixture->setPeers('My Title');
        $fixture->setActive('My Title');
        $fixture->setMessages('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setVoiceChannel('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'voice_channel_session[peers]' => 'Something New',
            'voice_channel_session[active]' => 'Something New',
            'voice_channel_session[messages]' => 'Something New',
            'voice_channel_session[createdAt]' => 'Something New',
            'voice_channel_session[updatedAt]' => 'Something New',
            'voice_channel_session[voiceChannel]' => 'Something New',
        ]);

        self::assertResponseRedirects('/voice/channel/session/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPeers());
        self::assertSame('Something New', $fixture[0]->getActive());
        self::assertSame('Something New', $fixture[0]->getMessages());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getVoiceChannel());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new VoiceChannelSession();
        $fixture->setPeers('My Title');
        $fixture->setActive('My Title');
        $fixture->setMessages('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setVoiceChannel('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/voice/channel/session/');
    }
}
