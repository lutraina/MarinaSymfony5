<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211114073328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE secao_page (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contenu_pages ADD sections_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contenu_pages ADD CONSTRAINT FK_6DC0BA13577906E4 FOREIGN KEY (sections_id) REFERENCES secao_page (id)');
        $this->addSql('CREATE INDEX IDX_6DC0BA13577906E4 ON contenu_pages (sections_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu_pages DROP FOREIGN KEY FK_6DC0BA13577906E4');
        $this->addSql('DROP TABLE secao_page');
        $this->addSql('DROP INDEX IDX_6DC0BA13577906E4 ON contenu_pages');
        $this->addSql('ALTER TABLE contenu_pages DROP sections_id');
    }
}
