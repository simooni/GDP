<?php

// declare(strict_types=1);

// namespace DoctrineMigrations;

// use Doctrine\DBAL\Schema\Schema;
// use Doctrine\Migrations\AbstractMigration;

// /**
//  * Auto-generated Migration: Please modify to your needs!
//  */
// final class Version20210605151045 extends AbstractMigration
// {
//     public function getDescription() : string
//     {
//         return '';
//     }

//     public function up(Schema $schema) : void
//     {
//         // this up() migration is auto-generated, please modify it to your needs
//         $this->addSql('CREATE TABLE nv1 (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE nv2 (id INT AUTO_INCREMENT NOT NULL, nv1_id INT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, INDEX IDX_CBAB0C824395900 (nv1_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE nv3 (id INT AUTO_INCREMENT NOT NULL, nv2_id INT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, INDEX IDX_7BBD805E368CF6EE (nv2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE nv4 (id INT AUTO_INCREMENT NOT NULL, nv3_id INT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, INDEX IDX_E5D915FD8E30918B (nv3_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE nv5 (id INT AUTO_INCREMENT NOT NULL, nv4_id INT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, INDEX IDX_92DE256B13E7A932 (nv4_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE tacces (id INT AUTO_INCREMENT NOT NULL, user_affectation_id INT DEFAULT NULL, action_id INT DEFAULT NULL, document_id INT DEFAULT NULL, INDEX IDX_37A7227968F657B (user_affectation_id), INDEX IDX_37A722799D32F035 (action_id), INDEX IDX_37A72279C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE taction (id INT AUTO_INCREMENT NOT NULL, etat_urgence_id INT DEFAULT NULL, taction_id INT DEFAULT NULL, ref_action VARCHAR(255) DEFAULT NULL, intitule VARCHAR(255) DEFAULT NULL, date_creation DATE DEFAULT NULL, user_create VARCHAR(255) DEFAULT NULL, active INT DEFAULT NULL, cloturer INT DEFAULT NULL, urgence VARCHAR(255) DEFAULT NULL, suspendre INT DEFAULT NULL, code_nv VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, annuler VARCHAR(255) DEFAULT NULL, INDEX IDX_73450677FEC743A8 (etat_urgence_id), INDEX IDX_734506776713A90F (taction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE taction_reponse (id INT AUTO_INCREMENT NOT NULL, taction_id INT DEFAULT NULL, document_id INT DEFAULT NULL, ref_reponse VARCHAR(255) DEFAULT NULL, intitule VARCHAR(255) DEFAULT NULL, type_reponse VARCHAR(255) DEFAULT NULL, date_creation VARCHAR(255) NOT NULL, date_creationn DATE DEFAULT NULL, user_create VARCHAR(255) DEFAULT NULL, observation LONGTEXT DEFAULT NULL, INDEX IDX_F5C93C96713A90F (taction_id), INDEX IDX_F5C93C9C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE tdocument (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) DEFAULT NULL, type_document VARCHAR(255) DEFAULT NULL, taille VARCHAR(255) DEFAULT NULL, date_creation DATE DEFAULT NULL, user_create VARCHAR(255) DEFAULT NULL, active INT DEFAULT NULL, cloturer INT DEFAULT NULL, slug LONGTEXT DEFAULT NULL, suspondu VARCHAR(255) DEFAULT NULL, code_nv VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, annuler INT DEFAULT NULL, avancement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE tdocument_version (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, intitule VARCHAR(255) DEFAULT NULL, type_document VARCHAR(255) DEFAULT NULL, taille VARCHAR(255) DEFAULT NULL, observation LONGTEXT DEFAULT NULL, date_creation DATE DEFAULT NULL, user_create VARCHAR(255) DEFAULT NULL, slug LONGTEXT DEFAULT NULL, INDEX IDX_299B264BC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE type_action (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE urgence (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE user_affectation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nv1_id INT DEFAULT NULL, nv2_id INT DEFAULT NULL, nv3_id INT DEFAULT NULL, nv4_id INT DEFAULT NULL, nv5_id INT DEFAULT NULL, INDEX IDX_5DC6A846A76ED395 (user_id), INDEX IDX_5DC6A84624395900 (nv1_id), INDEX IDX_5DC6A846368CF6EE (nv2_id), INDEX IDX_5DC6A8468E30918B (nv3_id), INDEX IDX_5DC6A84613E7A932 (nv4_id), INDEX IDX_5DC6A846AB5BCE57 (nv5_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('ALTER TABLE nv2 ADD CONSTRAINT FK_CBAB0C824395900 FOREIGN KEY (nv1_id) REFERENCES nv1 (id)');
//         $this->addSql('ALTER TABLE nv3 ADD CONSTRAINT FK_7BBD805E368CF6EE FOREIGN KEY (nv2_id) REFERENCES nv2 (id)');
//         $this->addSql('ALTER TABLE nv4 ADD CONSTRAINT FK_E5D915FD8E30918B FOREIGN KEY (nv3_id) REFERENCES nv3 (id)');
//         $this->addSql('ALTER TABLE nv5 ADD CONSTRAINT FK_92DE256B13E7A932 FOREIGN KEY (nv4_id) REFERENCES nv4 (id)');
//         $this->addSql('ALTER TABLE tacces ADD CONSTRAINT FK_37A7227968F657B FOREIGN KEY (user_affectation_id) REFERENCES user_affectation (id)');
//         $this->addSql('ALTER TABLE tacces ADD CONSTRAINT FK_37A722799D32F035 FOREIGN KEY (action_id) REFERENCES taction (id)');
//         $this->addSql('ALTER TABLE tacces ADD CONSTRAINT FK_37A72279C33F7837 FOREIGN KEY (document_id) REFERENCES tdocument (id)');
//         $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_73450677FEC743A8 FOREIGN KEY (etat_urgence_id) REFERENCES urgence (id)');
//         $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_734506776713A90F FOREIGN KEY (taction_id) REFERENCES type_action (id)');
//         $this->addSql('ALTER TABLE taction_reponse ADD CONSTRAINT FK_F5C93C96713A90F FOREIGN KEY (taction_id) REFERENCES taction (id)');
//         $this->addSql('ALTER TABLE taction_reponse ADD CONSTRAINT FK_F5C93C9C33F7837 FOREIGN KEY (document_id) REFERENCES tdocument (id)');
//         $this->addSql('ALTER TABLE tdocument_version ADD CONSTRAINT FK_299B264BC33F7837 FOREIGN KEY (document_id) REFERENCES tdocument (id)');
//         $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A846A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
//         $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A84624395900 FOREIGN KEY (nv1_id) REFERENCES nv1 (id)');
//         $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A846368CF6EE FOREIGN KEY (nv2_id) REFERENCES nv2 (id)');
//         $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A8468E30918B FOREIGN KEY (nv3_id) REFERENCES nv3 (id)');
//         $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A84613E7A932 FOREIGN KEY (nv4_id) REFERENCES nv4 (id)');
//         $this->addSql('ALTER TABLE user_affectation ADD CONSTRAINT FK_5DC6A846AB5BCE57 FOREIGN KEY (nv5_id) REFERENCES nv5 (id)');
//     }

//     public function down(Schema $schema) : void
//     {
//         // this down() migration is auto-generated, please modify it to your needs
//         $this->addSql('ALTER TABLE nv2 DROP FOREIGN KEY FK_CBAB0C824395900');
//         $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A84624395900');
//         $this->addSql('ALTER TABLE nv3 DROP FOREIGN KEY FK_7BBD805E368CF6EE');
//         $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A846368CF6EE');
//         $this->addSql('ALTER TABLE nv4 DROP FOREIGN KEY FK_E5D915FD8E30918B');
//         $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A8468E30918B');
//         $this->addSql('ALTER TABLE nv5 DROP FOREIGN KEY FK_92DE256B13E7A932');
//         $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A84613E7A932');
//         $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A846AB5BCE57');
//         $this->addSql('ALTER TABLE tacces DROP FOREIGN KEY FK_37A722799D32F035');
//         $this->addSql('ALTER TABLE taction_reponse DROP FOREIGN KEY FK_F5C93C96713A90F');
//         $this->addSql('ALTER TABLE tacces DROP FOREIGN KEY FK_37A72279C33F7837');
//         $this->addSql('ALTER TABLE taction_reponse DROP FOREIGN KEY FK_F5C93C9C33F7837');
//         $this->addSql('ALTER TABLE tdocument_version DROP FOREIGN KEY FK_299B264BC33F7837');
//         $this->addSql('ALTER TABLE taction DROP FOREIGN KEY FK_734506776713A90F');
//         $this->addSql('ALTER TABLE taction DROP FOREIGN KEY FK_73450677FEC743A8');
//         $this->addSql('ALTER TABLE user_affectation DROP FOREIGN KEY FK_5DC6A846A76ED395');
//         $this->addSql('ALTER TABLE tacces DROP FOREIGN KEY FK_37A7227968F657B');
//         $this->addSql('DROP TABLE nv1');
//         $this->addSql('DROP TABLE nv2');
//         $this->addSql('DROP TABLE nv3');
//         $this->addSql('DROP TABLE nv4');
//         $this->addSql('DROP TABLE nv5');
//         $this->addSql('DROP TABLE tacces');
//         $this->addSql('DROP TABLE taction');
//         $this->addSql('DROP TABLE taction_reponse');
//         $this->addSql('DROP TABLE tdocument');
//         $this->addSql('DROP TABLE tdocument_version');
//         $this->addSql('DROP TABLE type_action');
//         $this->addSql('DROP TABLE urgence');
//         $this->addSql('DROP TABLE `user`');
//         $this->addSql('DROP TABLE user_affectation');
//     }
// }
