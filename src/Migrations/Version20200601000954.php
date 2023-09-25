<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601000954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accident DROP ide');
        $this->addSql('ALTER TABLE enquette ADD ida_id INT NOT NULL');
        $this->addSql('ALTER TABLE enquette ADD CONSTRAINT FK_FE67194DE811A2F8 FOREIGN KEY (ida_id) REFERENCES accident (id)');
        $this->addSql('CREATE INDEX IDX_FE67194DE811A2F8 ON enquette (ida_id)');
        $this->addSql('ALTER TABLE observation CHANGE exemen_comp exemen_comp LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB5859934A FOREIGN KEY (salarie_id) REFERENCES salarie (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB8CED5CB FOREIGN KEY (ido_id) REFERENCES observation (id)');
        $this->addSql('CREATE INDEX IDX_B09C8CBB5859934A ON visite (salarie_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B09C8CBB8CED5CB ON visite (ido_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accident ADD ide INT NOT NULL');
        $this->addSql('ALTER TABLE enquette DROP FOREIGN KEY FK_FE67194DE811A2F8');
        $this->addSql('DROP INDEX IDX_FE67194DE811A2F8 ON enquette');
        $this->addSql('ALTER TABLE enquette DROP ida_id');
        $this->addSql('ALTER TABLE observation CHANGE exemen_comp exemen_comp LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB5859934A');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB8CED5CB');
        $this->addSql('DROP INDEX IDX_B09C8CBB5859934A ON visite');
        $this->addSql('DROP INDEX UNIQ_B09C8CBB8CED5CB ON visite');
    }
}
