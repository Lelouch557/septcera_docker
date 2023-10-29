<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231012133814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resource (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stockpile (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', resource_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', village_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', amount INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C2E8923F89329D25 (resource_id), INDEX IDX_C2E8923F5E0D5582 (village_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stockpile ADD CONSTRAINT FK_C2E8923F89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('ALTER TABLE stockpile ADD CONSTRAINT FK_C2E8923F5E0D5582 FOREIGN KEY (village_id) REFERENCES village (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stockpile DROP FOREIGN KEY FK_C2E8923F89329D25');
        $this->addSql('ALTER TABLE stockpile DROP FOREIGN KEY FK_C2E8923F5E0D5582');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE stockpile');
    }
}
