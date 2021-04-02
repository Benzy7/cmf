<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401104423 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE valeur (id INT AUTO_INCREMENT NOT NULL, code_valeur VARCHAR(10) NOT NULL, libelle_valeur VARCHAR(255) DEFAULT NULL, mnemonique VARCHAR(255) DEFAULT NULL, type_valeur VARCHAR(255) DEFAULT NULL, nb_titresadmis_bourse VARCHAR(255) DEFAULT NULL, nb_cod_flott VARCHAR(255) DEFAULT NULL, group_cotation VARCHAR(3) DEFAULT NULL, super_secteur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE valeur');
    }
}
