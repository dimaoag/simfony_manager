<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309120341 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_projects_tasks (id INT NOT NULL COMMENT \'(DC2Type:work_projects_task_id)\', project_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_projects_project_id)\', author_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_members_member_id)\', parent_id INT DEFAULT NULL COMMENT \'(DC2Type:work_projects_task_id)\', date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', plan_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', start_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', end_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', name VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, type VARCHAR(16) NOT NULL COMMENT \'(DC2Type:work_projects_task_type)\', progress SMALLINT NOT NULL, priority SMALLINT NOT NULL, status VARCHAR(16) NOT NULL COMMENT \'(DC2Type:work_projects_task_status)\', version INT DEFAULT 1 NOT NULL, INDEX IDX_E42D1865166D1F9C (project_id), INDEX IDX_E42D1865F675F31B (author_id), INDEX IDX_E42D1865727ACA70 (parent_id), INDEX IDX_E42D1865AA9E377A (date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_projects_tasks_executors (task_id INT NOT NULL COMMENT \'(DC2Type:work_projects_task_id)\', member_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_members_member_id)\', INDEX IDX_6291D08E8DB60186 (task_id), INDEX IDX_6291D08E7597D3FE (member_id), PRIMARY KEY(task_id, member_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_projects_task_changes (id INT NOT NULL COMMENT \'(DC2Type:work_projects_task_change_id)\', task_id INT NOT NULL COMMENT \'(DC2Type:work_projects_task_id)\', actor_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_members_member_id)\', date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', set_project_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:work_projects_project_id)\', set_name VARCHAR(255) DEFAULT NULL, set_content LONGTEXT DEFAULT NULL, set_file_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:work_projects_task_file_id)\', set_removed_file_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:work_projects_task_file_id)\', set_type VARCHAR(16) DEFAULT NULL COMMENT \'(DC2Type:work_projects_task_type)\', set_status VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:work_projects_task_status)\', set_progress SMALLINT DEFAULT NULL, set_priority SMALLINT DEFAULT NULL, set_parent_id INT DEFAULT NULL COMMENT \'(DC2Type:work_projects_task_id)\', set_removed_parent TINYINT(1) DEFAULT NULL, set_plan DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', set_removed_plan TINYINT(1) DEFAULT NULL, set_executor_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:work_members_member_id)\', set_revoked_executor_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:work_members_member_id)\', INDEX IDX_D8BE114A8DB60186 (task_id), INDEX IDX_D8BE114A10DAF24A (actor_id), PRIMARY KEY(task_id, id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_projects_task_files (id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_projects_task_file_id)\', task_id INT NOT NULL COMMENT \'(DC2Type:work_projects_task_id)\', member_id CHAR(36) NOT NULL COMMENT \'(DC2Type:work_members_member_id)\', date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', info_path VARCHAR(255) NOT NULL, info_name VARCHAR(255) NOT NULL, info_size INT NOT NULL, INDEX IDX_B8A3E1028DB60186 (task_id), INDEX IDX_B8A3E1027597D3FE (member_id), INDEX IDX_B8A3E102AA9E377A (date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_projects_tasks ADD CONSTRAINT FK_E42D1865166D1F9C FOREIGN KEY (project_id) REFERENCES work_projects_projects (id)');
        $this->addSql('ALTER TABLE work_projects_tasks ADD CONSTRAINT FK_E42D1865F675F31B FOREIGN KEY (author_id) REFERENCES work_members_members (id)');
        $this->addSql('ALTER TABLE work_projects_tasks ADD CONSTRAINT FK_E42D1865727ACA70 FOREIGN KEY (parent_id) REFERENCES work_projects_tasks (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ADD CONSTRAINT FK_6291D08E8DB60186 FOREIGN KEY (task_id) REFERENCES work_projects_tasks (id)');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ADD CONSTRAINT FK_6291D08E7597D3FE FOREIGN KEY (member_id) REFERENCES work_members_members (id)');
        $this->addSql('ALTER TABLE work_projects_task_changes ADD CONSTRAINT FK_D8BE114A8DB60186 FOREIGN KEY (task_id) REFERENCES work_projects_tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_projects_task_changes ADD CONSTRAINT FK_D8BE114A10DAF24A FOREIGN KEY (actor_id) REFERENCES work_members_members (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_projects_task_files ADD CONSTRAINT FK_B8A3E1028DB60186 FOREIGN KEY (task_id) REFERENCES work_projects_tasks (id)');
        $this->addSql('ALTER TABLE work_projects_task_files ADD CONSTRAINT FK_B8A3E1027597D3FE FOREIGN KEY (member_id) REFERENCES work_members_members (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE work_projects_tasks DROP FOREIGN KEY FK_E42D1865727ACA70');
        $this->addSql('ALTER TABLE work_projects_tasks_executors DROP FOREIGN KEY FK_6291D08E8DB60186');
        $this->addSql('ALTER TABLE work_projects_task_changes DROP FOREIGN KEY FK_D8BE114A8DB60186');
        $this->addSql('ALTER TABLE work_projects_task_files DROP FOREIGN KEY FK_B8A3E1028DB60186');
        $this->addSql('DROP TABLE work_projects_tasks');
        $this->addSql('DROP TABLE work_projects_tasks_executors');
        $this->addSql('DROP TABLE work_projects_task_changes');
        $this->addSql('DROP TABLE work_projects_task_files');
    }
}
