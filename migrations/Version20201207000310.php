<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207000310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ssrubrique (id INT AUTO_INCREMENT NOT NULL, srubrique_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, INDEX IDX_DD5C7FE87855ACB4 (srubrique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ssrubrique ADD CONSTRAINT FK_DD5C7FE87855ACB4 FOREIGN KEY (srubrique_id) REFERENCES srubrique (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ssrubrique');
    }
}
