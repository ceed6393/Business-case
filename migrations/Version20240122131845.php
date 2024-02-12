<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122131845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetement ADD main_picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CFD6BDC9DC FOREIGN KEY (main_picture_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3CB446CFD6BDC9DC ON vetement (main_picture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CFD6BDC9DC');
        $this->addSql('DROP INDEX UNIQ_3CB446CFD6BDC9DC ON vetement');
        $this->addSql('ALTER TABLE vetement DROP main_picture_id');
    }
}
