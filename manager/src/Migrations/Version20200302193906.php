<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302193906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_projects_roles (id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_projects_role_id)\', name VARCHAR(255) NOT NULL, permissions JSON NOT NULL COMMENT \'(DC2Type:work_projects_role_permissions)\', version INT DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_24B53355E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_projects_project_departments (id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_projects_project_department_id)\', project_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_projects_project_id)\', name VARCHAR(255) NOT NULL, INDEX IDX_F870303A166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_projects_projects (id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_projects_project_id)\', name VARCHAR(255) NOT NULL, sort INT NOT NULL, status VARCHAR(16) NOT NULL COMMENT \'(DC2Type:work_projects_project_status)\', version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_projects_project_memberships (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', project_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_projects_project_id)\', member_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_members_member_id)\', INDEX IDX_6884CF98166D1F9C (project_id), INDEX IDX_6884CF987597D3FE (member_id), UNIQUE INDEX UNIQ_6884CF98166D1F9C7597D3FE (project_id, member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_projects_project_membership_departments (membership_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', department_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_projects_project_department_id)\', INDEX IDX_D94281DD1FB354CD (membership_id), INDEX IDX_D94281DDAE80F5DF (department_id), PRIMARY KEY(membership_id, department_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_projects_project_membership_roles (membership_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', role_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_projects_role_id)\', INDEX IDX_42102BF81FB354CD (membership_id), INDEX IDX_42102BF8D60322AC (role_id), PRIMARY KEY(membership_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_projects_project_departments ADD CONSTRAINT FK_F870303A166D1F9C FOREIGN KEY (project_id) REFERENCES work_projects_projects (id)');
        $this->addSql('ALTER TABLE work_projects_project_memberships ADD CONSTRAINT FK_6884CF98166D1F9C FOREIGN KEY (project_id) REFERENCES work_projects_projects (id)');
        $this->addSql('ALTER TABLE work_projects_project_memberships ADD CONSTRAINT FK_6884CF987597D3FE FOREIGN KEY (member_id) REFERENCES work_members_members (id)');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ADD CONSTRAINT FK_D94281DD1FB354CD FOREIGN KEY (membership_id) REFERENCES work_projects_project_memberships (id)');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ADD CONSTRAINT FK_D94281DDAE80F5DF FOREIGN KEY (department_id) REFERENCES work_projects_project_departments (id)');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ADD CONSTRAINT FK_42102BF81FB354CD FOREIGN KEY (membership_id) REFERENCES work_projects_project_memberships (id)');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ADD CONSTRAINT FK_42102BF8D60322AC FOREIGN KEY (role_id) REFERENCES work_projects_roles (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE work_projects_project_membership_roles DROP FOREIGN KEY FK_42102BF8D60322AC');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments DROP FOREIGN KEY FK_D94281DDAE80F5DF');
        $this->addSql('ALTER TABLE work_projects_project_departments DROP FOREIGN KEY FK_F870303A166D1F9C');
        $this->addSql('ALTER TABLE work_projects_project_memberships DROP FOREIGN KEY FK_6884CF98166D1F9C');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments DROP FOREIGN KEY FK_D94281DD1FB354CD');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles DROP FOREIGN KEY FK_42102BF81FB354CD');
        $this->addSql('DROP TABLE work_projects_roles');
        $this->addSql('DROP TABLE work_projects_project_departments');
        $this->addSql('DROP TABLE work_projects_projects');
        $this->addSql('DROP TABLE work_projects_project_memberships');
        $this->addSql('DROP TABLE work_projects_project_membership_departments');
        $this->addSql('DROP TABLE work_projects_project_membership_roles');
    }
}
