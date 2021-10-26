<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427123215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nv5 (id INT AUTO_INCREMENT NOT NULL, nv4_id INT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, INDEX IDX_92DE256B13E7A932 (nv4_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nv5 ADD CONSTRAINT FK_92DE256B13E7A932 FOREIGN KEY (nv4_id) REFERENCES nv4 (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE nv5');
    }
}
