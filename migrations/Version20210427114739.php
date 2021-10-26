<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427114739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nv3 DROP FOREIGN KEY FK_7BBD805E7855ACB4');
        $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A8467855ACB4');
        $this->addSql('CREATE TABLE nv2 (id INT AUTO_INCREMENT NOT NULL, rubrique_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, INDEX IDX_CBAB0C83BD38833 (rubrique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nv2 ADD CONSTRAINT FK_CBAB0C83BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
        $this->addSql('DROP TABLE srubrique');
        $this->addSql('DROP INDEX IDX_7BBD805E7855ACB4 ON nv3');
        $this->addSql('ALTER TABLE nv3 CHANGE srubrique_id nv2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nv3 ADD CONSTRAINT FK_7BBD805E368CF6EE FOREIGN KEY (nv2_id) REFERENCES nv2 (id)');
        $this->addSql('CREATE INDEX IDX_7BBD805E368CF6EE ON nv3 (nv2_id)');
        $this->addSql('DROP INDEX IDX_5DC6A8467855ACB4 ON user_affectation');
        $this->addSql('ALTER TABLE user_affectation CHANGE srubrique_id nv2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A846368CF6EE FOREIGN KEY (nv2_id) REFERENCES nv2 (id)');
        $this->addSql('CREATE INDEX IDX_5DC6A846368CF6EE ON user_affectation (nv2_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nv3 DROP FOREIGN KEY FK_7BBD805E368CF6EE');
        $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A846368CF6EE');
        $this->addSql('CREATE TABLE srubrique (id INT AUTO_INCREMENT NOT NULL, rubrique_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C5A13DAB3BD38833 (rubrique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE srubrique ADD CONSTRAINT FK_C5A13DAB3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
        $this->addSql('DROP TABLE nv2');
        $this->addSql('DROP INDEX IDX_7BBD805E368CF6EE ON nv3');
        $this->addSql('ALTER TABLE nv3 CHANGE nv2_id srubrique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nv3 ADD CONSTRAINT FK_7BBD805E7855ACB4 FOREIGN KEY (srubrique_id) REFERENCES srubrique (id)');
        $this->addSql('CREATE INDEX IDX_7BBD805E7855ACB4 ON nv3 (srubrique_id)');
        $this->addSql('DROP INDEX IDX_5DC6A846368CF6EE ON user_affectation');
        $this->addSql('ALTER TABLE user_affectation CHANGE nv2_id srubrique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A8467855ACB4 FOREIGN KEY (srubrique_id) REFERENCES srubrique (id)');
        $this->addSql('CREATE INDEX IDX_5DC6A8467855ACB4 ON user_affectation (srubrique_id)');
    }
}
