<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251023101910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, type, company, description, expires_at, email FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, image_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, description CLOB NOT NULL, expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , email VARCHAR(255) NOT NULL, CONSTRAINT FK_FBD8E0F83DA5256D FOREIGN KEY (image_id) REFERENCES image (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO job (id, type, company, description, expires_at, email) SELECT id, type, company, description, expires_at, email FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FBD8E0F83DA5256D ON job (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__job AS SELECT id, type, company, description, expires_at, email FROM job');
        $this->addSql('DROP TABLE job');
        $this->addSql('CREATE TABLE job (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, description CLOB NOT NULL, expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , email VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO job (id, type, company, description, expires_at, email) SELECT id, type, company, description, expires_at, email FROM __temp__job');
        $this->addSql('DROP TABLE __temp__job');
    }
}
