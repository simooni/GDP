<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207230431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tacces (id INT AUTO_INCREMENT NOT NULL, user_affectation_id INT DEFAULT NULL, action_id INT DEFAULT NULL, document_id INT DEFAULT NULL, INDEX IDX_37A7227968F657B (user_affectation_id), INDEX IDX_37A722799D32F035 (action_id), INDEX IDX_37A72279C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tacces ADD CONSTRAINT FK_37A7227968F657B FOREIGN KEY (user_affectation_id) REFERENCES user_affectation (id)');
        $this->addSql('ALTER TABLE tacces ADD CONSTRAINT FK_37A722799D32F035 FOREIGN KEY (action_id) REFERENCES taction (id)');
        $this->addSql('ALTER TABLE tacces ADD CONSTRAINT FK_37A72279C33F7837 FOREIGN KEY (document_id) REFERENCES tdocument (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tacces');
    }
}
