<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014092442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE buildingTemplate ADD resource_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE buildingTemplate ADD CONSTRAINT FK_2D96118289329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('CREATE INDEX IDX_2D96118289329D25 ON buildingTemplate (resource_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE buildingTemplate DROP FOREIGN KEY FK_2D96118289329D25');
        $this->addSql('DROP INDEX IDX_2D96118289329D25 ON buildingTemplate');
        $this->addSql('ALTER TABLE buildingTemplate DROP resource_id');
    }
}
