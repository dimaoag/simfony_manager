<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318191222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment_comments (id CHAR(36) NOT NULL COMMENT \'(DC2Type:comment_comment_id)\', date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', author_id CHAR(36) NOT NULL COMMENT \'(DC2Type:comment_comment_author_id)\', text LONGTEXT NOT NULL, update_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', version INT DEFAULT 1 NOT NULL, entity_type VARCHAR(255) NOT NULL, entity_id VARCHAR(36) NOT NULL, INDEX IDX_42DAF52CAA9E377A (date), INDEX IDX_42DAF52CC412EE0281257D5D (entity_type, entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comment_comments');
    }
}
