<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200609213209 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visite CHANGE aptitude aptitude VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB5859934A FOREIGN KEY (salarie_id) REFERENCES salarie (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB8CED5CB FOREIGN KEY (ido_id) REFERENCES observation (id)');
        $this->addSql('CREATE INDEX IDX_B09C8CBB5859934A ON visite (salarie_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B09C8CBB8CED5CB ON visite (ido_id)');
        $this->addSql('ALTER TABLE enquette ADD CONSTRAINT FK_FE67194DE811A2F8 FOREIGN KEY (ida_id) REFERENCES accident (id)');
        $this->addSql('CREATE INDEX IDX_FE67194DE811A2F8 ON enquette (ida_id)');
        $this->addSql('ALTER TABLE salarie CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE salarie RENAME INDEX matricule TO UNIQ_828E3A1A12B2DC9C');
        $this->addSql('ALTER TABLE observation CHANGE remarque remarque VARCHAR(20) DEFAULT NULL, CHANGE exemen_comp exemen_comp LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F31DB6F146F3EA3 ON accident (ref)');
        $this->addSql('ALTER TABLE booking ADD nom VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE tel tel VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE entreprise RENAME INDEX nom TO UNIQ_D19FA606C6E55B5');
        $this->addSql('ALTER TABLE poste_de_travail CHANGE refrence refrence VARCHAR(255) NOT NULL, CHANGE lieu lieu VARCHAR(255) NOT NULL, CHANGE atelier atelier VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE poste_de_travail RENAME INDEX refrence TO UNIQ_DD84E80A32DF3986');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_8F31DB6F146F3EA3 ON accident');
        $this->addSql('ALTER TABLE booking DROP nom');
        $this->addSql('ALTER TABLE enquette DROP FOREIGN KEY FK_FE67194DE811A2F8');
        $this->addSql('DROP INDEX IDX_FE67194DE811A2F8 ON enquette');
        $this->addSql('ALTER TABLE entreprise CHANGE nom nom VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE tel tel VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE entreprise RENAME INDEX uniq_d19fa606c6e55b5 TO nom');
        $this->addSql('ALTER TABLE observation CHANGE remarque remarque VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE exemen_comp exemen_comp LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE poste_de_travail CHANGE refrence refrence VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE lieu lieu VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE atelier atelier VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE poste_de_travail RENAME INDEX uniq_dd84e80a32df3986 TO refrence');
        $this->addSql('ALTER TABLE salarie CHANGE nom nom VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE prenom prenom VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE salarie RENAME INDEX uniq_828e3a1a12b2dc9c TO matricule');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB5859934A');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB8CED5CB');
        $this->addSql('DROP INDEX IDX_B09C8CBB5859934A ON visite');
        $this->addSql('DROP INDEX UNIQ_B09C8CBB8CED5CB ON visite');
        $this->addSql('ALTER TABLE visite CHANGE aptitude aptitude VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
