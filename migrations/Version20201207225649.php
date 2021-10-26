<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207225649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE taction_reponse (id INT AUTO_INCREMENT NOT NULL, taction_id INT DEFAULT NULL, document_id INT DEFAULT NULL, ref_reponse VARCHAR(255) DEFAULT NULL, intitule VARCHAR(255) DEFAULT NULL, type_reponse VARCHAR(255) DEFAULT NULL, date_creation VARCHAR(255) NOT NULL, date_creationn DATE DEFAULT NULL, user_create VARCHAR(255) DEFAULT NULL, INDEX IDX_F5C93C96713A90F (taction_id), INDEX IDX_F5C93C9C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tdocument_version (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, intitule VARCHAR(255) DEFAULT NULL, type_document VARCHAR(255) DEFAULT NULL, taille VARCHAR(255) DEFAULT NULL, observation LONGTEXT DEFAULT NULL, date_creation DATE DEFAULT NULL, user_create VARCHAR(255) DEFAULT NULL, INDEX IDX_299B264BC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE taction_reponse ADD CONSTRAINT FK_F5C93C96713A90F FOREIGN KEY (taction_id) REFERENCES taction (id)');
        $this->addSql('ALTER TABLE taction_reponse ADD CONSTRAINT FK_F5C93C9C33F7837 FOREIGN KEY (document_id) REFERENCES tdocument (id)');
        $this->addSql('ALTER TABLE tdocument_version ADD CONSTRAINT FK_299B264BC33F7837 FOREIGN KEY (document_id) REFERENCES tdocument (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE taction_reponse');
        $this->addSql('DROP TABLE tdocument_version');
    }
}
