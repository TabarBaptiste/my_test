<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424131953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaires ADD articles_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C41EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D9BEC0C41EBAF6CC ON commentaires (articles_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C41EBAF6CC
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_D9BEC0C41EBAF6CC ON commentaires
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaires DROP articles_id
        SQL);
    }
}
