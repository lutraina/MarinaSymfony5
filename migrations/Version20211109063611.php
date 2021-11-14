<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211109063611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE contenu_pages ADD pages_id INT NOT NULL');
        //$this->addSql('ALTER TABLE contenu_pages ADD CONSTRAINT FK_6DC0BA13401ADD27 FOREIGN KEY (pages_id) REFERENCES pages (id)');
        //$this->addSql('CREATE INDEX IDX_6DC0BA13401ADD27 ON contenu_pages (pages_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE contenu_pages DROP FOREIGN KEY FK_6DC0BA13401ADD27');
        $this->addSql('DROP INDEX IDX_6DC0BA13401ADD27 ON contenu_pages');
        $this->addSql('ALTER TABLE contenu_pages DROP pages_id');
    }
}
