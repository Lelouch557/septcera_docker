<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014113242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('insert into resource VALUES
        ( 
            \'24fc0a97-30b2-476a-878d-5915a43a6d86\',
            "energy",
            \'2000-01-01 00:00:01\',
            \'2000-01-01 00:00:01\'
        ),
        ( 
            \'24fc0a97-30b2-476a-878d-5915a43a6d87\',
            "metals",
            \'2000-01-01 00:00:01\',
            \'2000-01-01 00:00:01\'
        )
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('delete from resource where id=\'24fc0a97-30b2-476a-878d-5915a43a6d86\'');
        $this->addSql('delete from resource where id=\'24fc0a97-30b2-476a-878d-5915a43a6d87\'');
    }
}
