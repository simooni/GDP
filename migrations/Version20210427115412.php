<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427115412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nv2 DROP FOREIGN KEY FK_CBAB0C83BD38833');
        $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A8463BD38833');
        $this->addSql('CREATE TABLE nv1 (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE rubrique');
        $this->addSql('DROP INDEX IDX_CBAB0C83BD38833 ON nv2');
        $this->addSql('ALTER TABLE nv2 CHANGE rubrique_id nv1_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nv2 ADD CONSTRAINT FK_CBAB0C824395900 FOREIGN KEY (nv1_id) REFERENCES nv1 (id)');
        $this->addSql('CREATE INDEX IDX_CBAB0C824395900 ON nv2 (nv1_id)');
        $this->addSql('DROP INDEX IDX_5DC6A8463BD38833 ON user_affectation');
        $this->addSql('ALTER TABLE user_affectation CHANGE rubrique_id nv1_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A84624395900 FOREIGN KEY (nv1_id) REFERENCES nv1 (id)');
        $this->addSql('CREATE INDEX IDX_5DC6A84624395900 ON user_affectation (nv1_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nv2 DROP FOREIGN KEY FK_CBAB0C824395900');
        $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A84624395900');
        $this->addSql('CREATE TABLE rubrique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE nv1');
        $this->addSql('DROP INDEX IDX_CBAB0C824395900 ON nv2');
        $this->addSql('ALTER TABLE nv2 CHANGE nv1_id rubrique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nv2 ADD CONSTRAINT FK_CBAB0C83BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
        $this->addSql('CREATE INDEX IDX_CBAB0C83BD38833 ON nv2 (rubrique_id)');
        $this->addSql('DROP INDEX IDX_5DC6A84624395900 ON user_affectation');
        $this->addSql('ALTER TABLE user_affectation CHANGE nv1_id rubrique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A8463BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
        $this->addSql('CREATE INDEX IDX_5DC6A8463BD38833 ON user_affectation (rubrique_id)');
    }
}
