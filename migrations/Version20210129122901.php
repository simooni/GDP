<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210129122901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taction DROP FOREIGN KEY FK_7345067729F4B125');
        $this->addSql('DROP INDEX IDX_7345067729F4B125 ON taction');
        $this->addSql('ALTER TABLE taction CHANGE type_action_id taction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_734506776713A90F FOREIGN KEY (taction_id) REFERENCES type_action (id)');
        $this->addSql('CREATE INDEX IDX_734506776713A90F ON taction (taction_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taction DROP FOREIGN KEY FK_734506776713A90F');
        $this->addSql('DROP INDEX IDX_734506776713A90F ON taction');
        $this->addSql('ALTER TABLE taction CHANGE taction_id type_action_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_7345067729F4B125 FOREIGN KEY (type_action_id) REFERENCES type_action (id)');
        $this->addSql('CREATE INDEX IDX_7345067729F4B125 ON taction (type_action_id)');
    }
}
