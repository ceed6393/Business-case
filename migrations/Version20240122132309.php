<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122132309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetement ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_3CB446CF12469DE2 ON vetement (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CF12469DE2');
        $this->addSql('DROP INDEX IDX_3CB446CF12469DE2 ON vetement');
        $this->addSql('ALTER TABLE vetement DROP category_id');
    }
}
