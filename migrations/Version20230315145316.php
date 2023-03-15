<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315145316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE port ADD idpays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE port ADD CONSTRAINT FK_43915DCC79E0102A FOREIGN KEY (idpays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_43915DCC79E0102A ON port (idpays_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE port DROP FOREIGN KEY FK_43915DCC79E0102A');
        $this->addSql('DROP INDEX IDX_43915DCC79E0102A ON port');
        $this->addSql('ALTER TABLE port DROP idpays_id');
    }
}
