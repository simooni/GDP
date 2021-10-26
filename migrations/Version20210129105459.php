<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210129105459 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_action (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE urgence (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE taction ADD type_action_id INT DEFAULT NULL, ADD etat_urgence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_7345067729F4B125 FOREIGN KEY (type_action_id) REFERENCES type_action (id)');
        $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_73450677FEC743A8 FOREIGN KEY (etat_urgence_id) REFERENCES urgence (id)');
        $this->addSql('CREATE INDEX IDX_7345067729F4B125 ON taction (type_action_id)');
        $this->addSql('CREATE INDEX IDX_73450677FEC743A8 ON taction (etat_urgence_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taction DROP FOREIGN KEY FK_7345067729F4B125');
        $this->addSql('ALTER TABLE taction DROP FOREIGN KEY FK_73450677FEC743A8');
        $this->addSql('DROP TABLE type_action');
        $this->addSql('DROP TABLE urgence');
        $this->addSql('DROP INDEX IDX_7345067729F4B125 ON taction');
        $this->addSql('DROP INDEX IDX_73450677FEC743A8 ON taction');
        $this->addSql('ALTER TABLE taction DROP type_action_id, DROP etat_urgence_id');
    }
}
