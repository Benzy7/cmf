<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325140350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stat_stock (id INT AUTO_INCREMENT NOT NULL, nom_ficher VARCHAR(255) NOT NULL, date_chrg DATE NOT NULL, heure_chrg TIME NOT NULL, date_bourse DATE DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, remarque_motif VARCHAR(255) DEFAULT NULL, nb_lignes INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stat_mvt CHANGE heure_chrg heure_chrg TIME NOT NULL');
        $this->addSql('ALTER TABLE stock ADD code_adherent_id INT NOT NULL, ADD nature_compte_id INT NOT NULL, ADD categorie_avoir_id INT NOT NULL, DROP membership_code, DROP nature_code, DROP category_code');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656606CB185E3 FOREIGN KEY (code_adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660EF84D7E1 FOREIGN KEY (nature_compte_id) REFERENCES code_nature (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660FBEA07B1 FOREIGN KEY (categorie_avoir_id) REFERENCES categorie_avoir (id)');
        $this->addSql('CREATE INDEX IDX_4B3656606CB185E3 ON stock (code_adherent_id)');
        $this->addSql('CREATE INDEX IDX_4B365660EF84D7E1 ON stock (nature_compte_id)');
        $this->addSql('CREATE INDEX IDX_4B365660FBEA07B1 ON stock (categorie_avoir_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE stat_stock');
        $this->addSql('ALTER TABLE stat_mvt CHANGE heure_chrg heure_chrg TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656606CB185E3');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660EF84D7E1');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660FBEA07B1');
        $this->addSql('DROP INDEX IDX_4B3656606CB185E3 ON stock');
        $this->addSql('DROP INDEX IDX_4B365660EF84D7E1 ON stock');
        $this->addSql('DROP INDEX IDX_4B365660FBEA07B1 ON stock');
        $this->addSql('ALTER TABLE stock ADD membership_code VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD nature_code VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD category_code VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP code_adherent_id, DROP nature_compte_id, DROP categorie_avoir_id');
    }
}
