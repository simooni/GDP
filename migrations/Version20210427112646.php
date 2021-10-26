<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427112646 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A846BCA3C13');
        $this->addSql('CREATE TABLE nv3 (id INT AUTO_INCREMENT NOT NULL, srubrique_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, INDEX IDX_7BBD805E7855ACB4 (srubrique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nv3 ADD CONSTRAINT FK_7BBD805E7855ACB4 FOREIGN KEY (srubrique_id) REFERENCES srubrique (id)');
        $this->addSql('DROP TABLE ssrubrique');
        $this->addSql('DROP INDEX IDX_5DC6A846BCA3C13 ON user_affectation');
        $this->addSql('ALTER TABLE user_affectation CHANGE ssrubrique_id nv3_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A8468E30918B FOREIGN KEY (nv3_id) REFERENCES nv3 (id)');
        $this->addSql('CREATE INDEX IDX_5DC6A8468E30918B ON user_affectation (nv3_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A8468E30918B');
        $this->addSql('CREATE TABLE ssrubrique (id INT AUTO_INCREMENT NOT NULL, srubrique_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_DD5C7FE87855ACB4 (srubrique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ssrubrique ADD CONSTRAINT FK_DD5C7FE87855ACB4 FOREIGN KEY (srubrique_id) REFERENCES srubrique (id)');
        $this->addSql('DROP TABLE nv3');
        $this->addSql('DROP INDEX IDX_5DC6A8468E30918B ON user_affectation');
        $this->addSql('ALTER TABLE user_affectation CHANGE nv3_id ssrubrique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A846BCA3C13 FOREIGN KEY (ssrubrique_id) REFERENCES ssrubrique (id)');
        $this->addSql('CREATE INDEX IDX_5DC6A846BCA3C13 ON user_affectation (ssrubrique_id)');
    }
}
