<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424092449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles ADD categories_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_BFDD3168A21214B7 ON articles (categories_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168A21214B7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categories
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_BFDD3168A21214B7 ON articles
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles DROP categories_id
        SQL);
    }
}
