<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231105212534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE text_channel_server (text_channel_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_6EC8039FEE0FA830 (text_channel_id), INDEX IDX_6EC8039F1844E6B7 (server_id), PRIMARY KEY(text_channel_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE text_channel_server ADD CONSTRAINT FK_6EC8039FEE0FA830 FOREIGN KEY (text_channel_id) REFERENCES text_channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE text_channel_server ADD CONSTRAINT FK_6EC8039F1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE text_channel_server DROP FOREIGN KEY FK_6EC8039FEE0FA830');
        $this->addSql('ALTER TABLE text_channel_server DROP FOREIGN KEY FK_6EC8039F1844E6B7');
        $this->addSql('DROP TABLE text_channel_server');
    }
}
