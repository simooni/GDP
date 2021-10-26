<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207222802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_affectation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, rubrique_id INT DEFAULT NULL, srubrique_id INT DEFAULT NULL, ssrubrique_id INT DEFAULT NULL, INDEX IDX_5DC6A846A76ED395 (user_id), INDEX IDX_5DC6A8463BD38833 (rubrique_id), INDEX IDX_5DC6A8467855ACB4 (srubrique_id), INDEX IDX_5DC6A846BCA3C13 (ssrubrique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A846A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A8463BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A8467855ACB4 FOREIGN KEY (srubrique_id) REFERENCES srubrique (id)');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A846BCA3C13 FOREIGN KEY (ssrubrique_id) REFERENCES ssrubrique (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_affectation');
    }
}
