<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240121224311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unit (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', unit_template_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', village_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', amount INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_DCBB0C539EBD659E (unit_template_id), INDEX IDX_DCBB0C535E0D5582 (village_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C539EBD659E FOREIGN KEY (unit_template_id) REFERENCES unitTemplate (id)');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C535E0D5582 FOREIGN KEY (village_id) REFERENCES village (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unit DROP FOREIGN KEY FK_DCBB0C539EBD659E');
        $this->addSql('ALTER TABLE unit DROP FOREIGN KEY FK_DCBB0C535E0D5582');
        $this->addSql('DROP TABLE unit');
    }
}
