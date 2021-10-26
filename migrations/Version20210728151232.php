<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210728151232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taction ADD dossier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_73450677611C0C56 FOREIGN KEY (dossier_id) REFERENCES tdocument (id)');
        $this->addSql('CREATE INDEX IDX_73450677611C0C56 ON taction (dossier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taction DROP FOREIGN KEY FK_73450677611C0C56');
        $this->addSql('DROP INDEX IDX_73450677611C0C56 ON taction');
        $this->addSql('ALTER TABLE taction DROP dossier_id');
    }
}
