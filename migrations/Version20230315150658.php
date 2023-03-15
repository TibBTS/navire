<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315150658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE escale (id INT AUTO_INCREMENT NOT NULL, idnavire_id INT DEFAULT NULL, idport_id INT DEFAULT NULL, date_heure_arrive DATETIME NOT NULL, date_heure_depart DATETIME DEFAULT NULL, INDEX IDX_C39FEDD3A65B5477 (idnavire_id), INDEX IDX_C39FEDD3A9ED78F2 (idport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE escale ADD CONSTRAINT FK_C39FEDD3A65B5477 FOREIGN KEY (idnavire_id) REFERENCES navire (id)');
        $this->addSql('ALTER TABLE escale ADD CONSTRAINT FK_C39FEDD3A9ED78F2 FOREIGN KEY (idport_id) REFERENCES port (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE escale DROP FOREIGN KEY FK_C39FEDD3A65B5477');
        $this->addSql('ALTER TABLE escale DROP FOREIGN KEY FK_C39FEDD3A9ED78F2');
        $this->addSql('DROP TABLE escale');
    }
}
