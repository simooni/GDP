<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628150319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tdocument DROP FOREIGN KEY FK_F60DD368F421B53F');
        $this->addSql('DROP INDEX IDX_F60DD368F421B53F ON tdocument');
        $this->addSql('ALTER TABLE tdocument CHANGE tdocument_id folder_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tdocument ADD CONSTRAINT FK_F60DD368162CB942 FOREIGN KEY (folder_id) REFERENCES tdocument (id)');
        $this->addSql('CREATE INDEX IDX_F60DD368162CB942 ON tdocument (folder_id)');
    }

    // public function down(Schema $schema) : void
    // {
    //     // this down() migration is auto-generated, please modify it to your needs
    //     $this->addSql('ALTER TABLE tdocument DROP FOREIGN KEY FK_F60DD368162CB942');
    //     $this->addSql('DROP INDEX IDX_F60DD368162CB942 ON tdocument');
    //     $this->addSql('ALTER TABLE tdocument CHANGE folder_id tdocument_id INT DEFAULT NULL');
    //     $this->addSql('ALTER TABLE tdocument ADD CONSTRAINT FK_F60DD368F421B53F FOREIGN KEY (tdocument_id) REFERENCES tdocument (id)');
    //     $this->addSql('CREATE INDEX IDX_F60DD368F421B53F ON tdocument (tdocument_id)');
    // }
}
