<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124194128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA8433C3');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC8121CE9');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADD5E86FF');
        $this->addSql('DROP INDEX IDX_D34A04ADC8121CE9 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADA8433C3 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADD5E86FF ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('ALTER TABLE product ADD nom VARCHAR(255) NOT NULL, DROP nom_id, DROP état_id, DROP etat_id, DROP category_id, DROP description, DROP photo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD nom_id INT NOT NULL, ADD état_id INT NOT NULL, ADD etat_id INT NOT NULL, ADD category_id INT NOT NULL, ADD photo VARCHAR(255) NOT NULL, CHANGE nom description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA8433C3 FOREIGN KEY (état_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC8121CE9 FOREIGN KEY (nom_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D34A04ADC8121CE9 ON product (nom_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADA8433C3 ON product (état_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADD5E86FF ON product (etat_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
    }
}
