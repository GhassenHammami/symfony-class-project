<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251022210114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, type, company, description, expires_at, email FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, description CLOB NOT NULL, expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , email VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO job (id, type, company, description, expires_at, email) SELECT id, type, company, description, expires_at, email FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image');
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, type, company, description, expires_at, email FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, description CLOB NOT NULL, expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , email VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO job (id, type, company, description, expires_at, email) SELECT id, type, company, description, expires_at, email FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
    }
}
