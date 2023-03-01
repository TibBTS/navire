<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301153851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE navire ADD ais_shipt_type_id INT DEFAULT NULL, ADD longueur INT NOT NULL, ADD largeur INT NOT NULL, ADD tirantdeau DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED103832F126D0 FOREIGN KEY (ais_shipt_type_id) REFERENCES aisshiptype (id)');
        $this->addSql('CREATE INDEX IDX_EED103832F126D0 ON navire (ais_shipt_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE navire DROP FOREIGN KEY FK_EED103832F126D0');
        $this->addSql('DROP INDEX IDX_EED103832F126D0 ON navire');
        $this->addSql('ALTER TABLE navire DROP ais_shipt_type_id, DROP longueur, DROP largeur, DROP tirantdeau');
    }
}
