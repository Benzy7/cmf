<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325073155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intermidiaire (id INT AUTO_INCREMENT NOT NULL, date_transaction DATE NOT NULL, contract VARCHAR(10) NOT NULL, sens VARCHAR(1) NOT NULL, code_isin VARCHAR(6) DEFAULT NULL, valeur VARCHAR(100) DEFAULT NULL, caracteristique VARCHAR(2) DEFAULT NULL, marche VARCHAR(3) DEFAULT NULL, profit VARCHAR(2) DEFAULT NULL, client VARCHAR(150) DEFAULT NULL, type_compte VARCHAR(2) DEFAULT NULL, pays VARCHAR(2) DEFAULT NULL, qte VARCHAR(10) DEFAULT NULL, cours VARCHAR(3) DEFAULT NULL, code_intermidiaire VARCHAR(3) DEFAULT NULL, reglement VARCHAR(1) DEFAULT NULL, commission VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE intermidiaire');
    }
}
