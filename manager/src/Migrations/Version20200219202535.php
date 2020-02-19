<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200219202535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_members_members (id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_members_member_id)\', group_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_members_group_id)\', email VARCHAR(255) NOT NULL COMMENT \'(DC2Type:work_members_member_email)\', status VARCHAR(16) NOT NULL COMMENT \'(DC2Type:work_members_member_status)\', version INT DEFAULT 1 NOT NULL, name_first VARCHAR(255) NOT NULL, name_last VARCHAR(255) NOT NULL, INDEX IDX_30039B6DFE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_members_members ADD CONSTRAINT FK_30039B6DFE54D947 FOREIGN KEY (group_id) REFERENCES work_members_groups (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE work_members_members');
    }
}
