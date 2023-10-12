<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230916131806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE building (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', building_template_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', village_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E16F61D498263078 (building_template_id), INDEX IDX_E16F61D45E0D5582 (village_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE buildingTemplate (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', creanameted_at VARCHAR(255) NOT NULL, effect VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE building ADD CONSTRAINT FK_E16F61D498263078 FOREIGN KEY (building_template_id) REFERENCES buildingTemplate (id)');
        $this->addSql('ALTER TABLE building ADD CONSTRAINT FK_E16F61D45E0D5582 FOREIGN KEY (village_id) REFERENCES village (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE building DROP FOREIGN KEY FK_E16F61D498263078');
        $this->addSql('ALTER TABLE building DROP FOREIGN KEY FK_E16F61D45E0D5582');
        $this->addSql('DROP TABLE building');
        $this->addSql('DROP TABLE buildingTemplate');
    }
}
