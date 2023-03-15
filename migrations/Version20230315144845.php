<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315144845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE port_ais_ship_type (port_id INT NOT NULL, ais_ship_type_id INT NOT NULL, INDEX IDX_3FD945B376E92A9C (port_id), INDEX IDX_3FD945B3479E0B84 (ais_ship_type_id), PRIMARY KEY(port_id, ais_ship_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE port_ais_ship_type ADD CONSTRAINT FK_3FD945B376E92A9C FOREIGN KEY (port_id) REFERENCES port (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE port_ais_ship_type ADD CONSTRAINT FK_3FD945B3479E0B84 FOREIGN KEY (ais_ship_type_id) REFERENCES aisshiptype (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE port_ais_ship_type DROP FOREIGN KEY FK_3FD945B376E92A9C');
        $this->addSql('ALTER TABLE port_ais_ship_type DROP FOREIGN KEY FK_3FD945B3479E0B84');
        $this->addSql('DROP TABLE port_ais_ship_type');
    }
}
