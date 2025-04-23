<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424121513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles ADD auteur_id INT DEFAULT NULL, DROP auteur, DROP categorie
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles ADD CONSTRAINT FK_BFDD316860BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_BFDD316860BB6FE6 ON articles (auteur_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316860BB6FE6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auteur
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_BFDD316860BB6FE6 ON articles
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles ADD auteur VARCHAR(50) NOT NULL, ADD categorie VARCHAR(50) DEFAULT NULL, DROP auteur_id
        SQL);
    }
}
