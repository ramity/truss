<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231105211943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voice_channel_server (voice_channel_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_BF2C6CD42D802A09 (voice_channel_id), INDEX IDX_BF2C6CD41844E6B7 (server_id), PRIMARY KEY(voice_channel_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voice_channel_server ADD CONSTRAINT FK_BF2C6CD42D802A09 FOREIGN KEY (voice_channel_id) REFERENCES voice_channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voice_channel_server ADD CONSTRAINT FK_BF2C6CD41844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voice_channel DROP FOREIGN KEY FK_FB8D75D41844E6B7');
        $this->addSql('DROP INDEX IDX_FB8D75D41844E6B7 ON voice_channel');
        $this->addSql('ALTER TABLE voice_channel DROP server_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voice_channel_server DROP FOREIGN KEY FK_BF2C6CD42D802A09');
        $this->addSql('ALTER TABLE voice_channel_server DROP FOREIGN KEY FK_BF2C6CD41844E6B7');
        $this->addSql('DROP TABLE voice_channel_server');
        $this->addSql('ALTER TABLE voice_channel ADD server_id INT NOT NULL');
        $this->addSql('ALTER TABLE voice_channel ADD CONSTRAINT FK_FB8D75D41844E6B7 FOREIGN KEY (server_id) REFERENCES server (id)');
        $this->addSql('CREATE INDEX IDX_FB8D75D41844E6B7 ON voice_channel (server_id)');
    }
}
