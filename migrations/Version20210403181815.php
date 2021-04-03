<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403181815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stat_intermidiaire ADD nom_adherent_id INT DEFAULT NULL, ADD nb_lignes INT NOT NULL');
        $this->addSql('ALTER TABLE stat_intermidiaire ADD CONSTRAINT FK_6070D399EB90C74C FOREIGN KEY (nom_adherent_id) REFERENCES adherent (id)');
        $this->addSql('CREATE INDEX IDX_6070D399EB90C74C ON stat_intermidiaire (nom_adherent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stat_intermidiaire DROP FOREIGN KEY FK_6070D399EB90C74C');
        $this->addSql('DROP INDEX IDX_6070D399EB90C74C ON stat_intermidiaire');
        $this->addSql('ALTER TABLE stat_intermidiaire DROP nom_adherent_id, DROP nb_lignes');
    }
}
