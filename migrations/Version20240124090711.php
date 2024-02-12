<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124090711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, vetement_id INT NOT NULL, src VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, INDEX IDX_C53D045F969D8B67 (vetement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, nom_id INT NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_D34A04ADC8121CE9 (nom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC8121CE9 FOREIGN KEY (nom_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CFD6BDC9DC');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F969D8B67');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC8121CE9');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE product');
    }
}
