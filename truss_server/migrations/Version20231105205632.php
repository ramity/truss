<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231105205632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password_hash VARCHAR(1024) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, server_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64C19C11844E6B7 (server_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_text_channel (category_id INT NOT NULL, text_channel_id INT NOT NULL, INDEX IDX_5C8F82EA12469DE2 (category_id), INDEX IDX_5C8F82EAEE0FA830 (text_channel_id), PRIMARY KEY(category_id, text_channel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_voice_channel (category_id INT NOT NULL, voice_channel_id INT NOT NULL, INDEX IDX_E556509F12469DE2 (category_id), INDEX IDX_E556509F2D802A09 (voice_channel_id), PRIMARY KEY(category_id, voice_channel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE login_attempt (id INT AUTO_INCREMENT NOT NULL, result TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE login_attempt_account (login_attempt_id INT NOT NULL, account_id INT NOT NULL, INDEX IDX_6215EACE7C2626D2 (login_attempt_id), INDEX IDX_6215EACE9B6B5FBA (account_id), PRIMARY KEY(login_attempt_id, account_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_account (post_id INT NOT NULL, account_id INT NOT NULL, INDEX IDX_40DEE1974B89032C (post_id), INDEX IDX_40DEE1979B6B5FBA (account_id), PRIMARY KEY(post_id, account_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server_account (server_id INT NOT NULL, account_id INT NOT NULL, INDEX IDX_F484D181844E6B7 (server_id), INDEX IDX_F484D189B6B5FBA (account_id), PRIMARY KEY(server_id, account_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_channel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_channel_server (text_channel_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_6EC8039FEE0FA830 (text_channel_id), INDEX IDX_6EC8039F1844E6B7 (server_id), PRIMARY KEY(text_channel_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_channel_post (text_channel_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_34AC893DEE0FA830 (text_channel_id), INDEX IDX_34AC893D4B89032C (post_id), PRIMARY KEY(text_channel_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voice_channel (id INT AUTO_INCREMENT NOT NULL, server_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FB8D75D41844E6B7 (server_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voice_channel_session (id INT AUTO_INCREMENT NOT NULL, voice_channel_id INT NOT NULL, peers JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', active TINYINT(1) NOT NULL, messages JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5C1D5892D802A09 (voice_channel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C11844E6B7 FOREIGN KEY (server_id) REFERENCES server (id)');
        $this->addSql('ALTER TABLE category_text_channel ADD CONSTRAINT FK_5C8F82EA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_text_channel ADD CONSTRAINT FK_5C8F82EAEE0FA830 FOREIGN KEY (text_channel_id) REFERENCES text_channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_voice_channel ADD CONSTRAINT FK_E556509F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_voice_channel ADD CONSTRAINT FK_E556509F2D802A09 FOREIGN KEY (voice_channel_id) REFERENCES voice_channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE login_attempt_account ADD CONSTRAINT FK_6215EACE7C2626D2 FOREIGN KEY (login_attempt_id) REFERENCES login_attempt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE login_attempt_account ADD CONSTRAINT FK_6215EACE9B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_account ADD CONSTRAINT FK_40DEE1974B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_account ADD CONSTRAINT FK_40DEE1979B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE server_account ADD CONSTRAINT FK_F484D181844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE server_account ADD CONSTRAINT FK_F484D189B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE text_channel_server ADD CONSTRAINT FK_6EC8039FEE0FA830 FOREIGN KEY (text_channel_id) REFERENCES text_channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE text_channel_server ADD CONSTRAINT FK_6EC8039F1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE text_channel_post ADD CONSTRAINT FK_34AC893DEE0FA830 FOREIGN KEY (text_channel_id) REFERENCES text_channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE text_channel_post ADD CONSTRAINT FK_34AC893D4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voice_channel ADD CONSTRAINT FK_FB8D75D41844E6B7 FOREIGN KEY (server_id) REFERENCES server (id)');
        $this->addSql('ALTER TABLE voice_channel_session ADD CONSTRAINT FK_5C1D5892D802A09 FOREIGN KEY (voice_channel_id) REFERENCES voice_channel (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C11844E6B7');
        $this->addSql('ALTER TABLE category_text_channel DROP FOREIGN KEY FK_5C8F82EA12469DE2');
        $this->addSql('ALTER TABLE category_text_channel DROP FOREIGN KEY FK_5C8F82EAEE0FA830');
        $this->addSql('ALTER TABLE category_voice_channel DROP FOREIGN KEY FK_E556509F12469DE2');
        $this->addSql('ALTER TABLE category_voice_channel DROP FOREIGN KEY FK_E556509F2D802A09');
        $this->addSql('ALTER TABLE login_attempt_account DROP FOREIGN KEY FK_6215EACE7C2626D2');
        $this->addSql('ALTER TABLE login_attempt_account DROP FOREIGN KEY FK_6215EACE9B6B5FBA');
        $this->addSql('ALTER TABLE post_account DROP FOREIGN KEY FK_40DEE1974B89032C');
        $this->addSql('ALTER TABLE post_account DROP FOREIGN KEY FK_40DEE1979B6B5FBA');
        $this->addSql('ALTER TABLE server_account DROP FOREIGN KEY FK_F484D181844E6B7');
        $this->addSql('ALTER TABLE server_account DROP FOREIGN KEY FK_F484D189B6B5FBA');
        $this->addSql('ALTER TABLE text_channel_server DROP FOREIGN KEY FK_6EC8039FEE0FA830');
        $this->addSql('ALTER TABLE text_channel_server DROP FOREIGN KEY FK_6EC8039F1844E6B7');
        $this->addSql('ALTER TABLE text_channel_post DROP FOREIGN KEY FK_34AC893DEE0FA830');
        $this->addSql('ALTER TABLE text_channel_post DROP FOREIGN KEY FK_34AC893D4B89032C');
        $this->addSql('ALTER TABLE voice_channel DROP FOREIGN KEY FK_FB8D75D41844E6B7');
        $this->addSql('ALTER TABLE voice_channel_session DROP FOREIGN KEY FK_5C1D5892D802A09');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_text_channel');
        $this->addSql('DROP TABLE category_voice_channel');
        $this->addSql('DROP TABLE login_attempt');
        $this->addSql('DROP TABLE login_attempt_account');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_account');
        $this->addSql('DROP TABLE server');
        $this->addSql('DROP TABLE server_account');
        $this->addSql('DROP TABLE text_channel');
        $this->addSql('DROP TABLE text_channel_server');
        $this->addSql('DROP TABLE text_channel_post');
        $this->addSql('DROP TABLE voice_channel');
        $this->addSql('DROP TABLE voice_channel_session');
    }
}
