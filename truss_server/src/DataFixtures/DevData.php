<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Category;
use App\Entity\LoginAttempt;
use App\Entity\Post;
use App\Entity\Server;
use App\Entity\TextChannel;
use App\Entity\VoiceChannel;
use App\Entity\VoiceChannelSession;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DevData extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create an Account and Server

        $username = "db2";
        $password = "dpV~9O&r^gY,|[w's<;f}:>+-G'GM-s1gqe/S8Xy[f<6wI^iF*M-AE2^]@~|~6>";
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $account = new Account();
        $account->setUsername($username);
        $account->setPasswordHash($passwordHash);

        $manager->persist($account);
        $manager->flush();

        $server = new Server();
        $server->setName("hell");
        $server->addMember($account);
        $manager->persist($server);

        // Voice channels

        $category = new Category();
        $category->setName("Voice Channels");
        $category->setServer($server);
        $server->addCategory($category);
        $manager->persist($category);

        $voiceChannel = new VoiceChannel();
        $voiceChannel->setName("General");
        $voiceChannel->addServer($server);
        $server->addVoiceChannel($voiceChannel);
        $category->addVoiceChannel($voiceChannel);
        $manager->persist($voiceChannel);

        // Text channels

        $source = [
            "General Channels" => ["General", "Bets", "Shit post task force", "Nerd shit", "Music", "News", "Events", "Random", "IRL", "Suggestions", "Touch grass"],
            "Daily Games" => ["Wordle", "Sudoku", "Tradle", "Timeguessr", "Lichess"],
            "Video Games" => ["Apex legends", "Battle bit", "Deep rock galactic", "Elden ring", "Escape from tarkov", "Factorio", "Halo", "Mass effect", "Minecraft", "Phasmophobia", "Ready or not", "Risk of rain 2", "Runescape", "Satisfactory", "Stardew valley", "Tabletop simulator", "Trackmania", "Valheim", "Valorant", "Warthunder", "War hammer"],
            "Topics" => ["Aircraft", "Animals", "Art", "Cannabis", "Cars", "Combat", "Copypasta", "Destruction", "Documentaries", "Guns", "Homework", "Horror", "Machinery", "Movies", "Plants", "Podcasts", "Stencils", "Stonks", "Surreal", "Sus guy board", "Tattoos", "Things to see", "Welding"],
            "Sports" => ["Baseball", "Basketball", "Chess", "Climbing", "Disc golf", "Football", "Golf", "Hockey", "Poker", "Pool", "Skateboarding", "Snowboarding and Skiing"],
            "Benchmarks" => ["Cursed volumes", "Hall of shame", "Human benchmark", "Keybr", "Mbti", "Political compass"],
            "Nerd Channels" => ["AI", "AI shit posting", "Anime", "Books", "Chatgpt", "Chemistry", "Cybersecurity", "Crypto", "Finance", "Fusion", "Game dev", "History", "Ideas", "Iris", "Programming", "Research", "Rigs", "Servers", "Stonks", "Space", "Web design", "Wikipedia"],
            "Health Channels" => ["Cooking", "Exercise", "Food"],
            "Pruned Channels" => ["Aphonic gamers", "Democracy", "Music bot", "Overwatch"],
        ];

        foreach ($source as $categoryName => $textChannelNames)
        {
            $category = new Category();
            $category->setName($categoryName);
            $category->setServer($server);
            $server->addCategory($category);
            $manager->persist($category);

            foreach ($textChannelNames as $textChannelName)
            {
                $textChannel = new TextChannel();
                $textChannel->setName($textChannelName);
                $textChannel->addServer($server);
                $server->addTextChannel($textChannel);
                $category->addTextChannel($textChannel);
                $manager->persist($textChannel);
            }
        }

        $manager->flush();
    }
}
