<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427124245 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_affectation ADD nv4_id INT DEFAULT NULL, ADD nv5_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A84613E7A932 FOREIGN KEY (nv4_id) REFERENCES nv4 (id)');
        $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A846AB5BCE57 FOREIGN KEY (nv5_id) REFERENCES nv5 (id)');
        $this->addSql('CREATE INDEX IDX_5DC6A84613E7A932 ON user_affectation (nv4_id)');
        $this->addSql('CREATE INDEX IDX_5DC6A846AB5BCE57 ON user_affectation (nv5_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A84613E7A932');
        $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A846AB5BCE57');
        $this->addSql('DROP INDEX IDX_5DC6A84613E7A932 ON user_affectation');
        $this->addSql('DROP INDEX IDX_5DC6A846AB5BCE57 ON user_affectation');
        $this->addSql('ALTER TABLE user_affectation DROP nv4_id, DROP nv5_id');
    }
}
