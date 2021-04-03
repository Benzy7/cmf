<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403173245 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intermidiaire ADD valeur_id INT NOT NULL, ADD marche_id INT NOT NULL, ADD profit_id INT NOT NULL, ADD type_compte_id INT NOT NULL, ADD code_adr_intrm_id INT NOT NULL, ADD reglement_id INT DEFAULT NULL, ADD caract VARCHAR(2) DEFAULT NULL, ADD quantite VARCHAR(10) NOT NULL, DROP code_isin, DROP caracteristique, DROP marche, DROP profit, DROP type_compte, DROP qte, DROP code_intermidiaire, DROP reglement, CHANGE pays pays VARCHAR(2) NOT NULL, CHANGE cours cours VARCHAR(7) NOT NULL, CHANGE commission commission VARCHAR(10) NOT NULL, CHANGE valeur libelle_valeur VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE intermidiaire ADD CONSTRAINT FK_56DB26724DAAD26 FOREIGN KEY (valeur_id) REFERENCES valeur (id)');
        $this->addSql('ALTER TABLE intermidiaire ADD CONSTRAINT FK_56DB26729E494911 FOREIGN KEY (marche_id) REFERENCES code_marche (id)');
        $this->addSql('ALTER TABLE intermidiaire ADD CONSTRAINT FK_56DB2672B2F3AF08 FOREIGN KEY (profit_id) REFERENCES code_profit (id)');
        $this->addSql('ALTER TABLE intermidiaire ADD CONSTRAINT FK_56DB267246032730 FOREIGN KEY (type_compte_id) REFERENCES code_compte_intrm (id)');
        $this->addSql('ALTER TABLE intermidiaire ADD CONSTRAINT FK_56DB2672EB906979 FOREIGN KEY (code_adr_intrm_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE intermidiaire ADD CONSTRAINT FK_56DB26726A477111 FOREIGN KEY (reglement_id) REFERENCES reglement_intrm (id)');
        $this->addSql('CREATE INDEX IDX_56DB26724DAAD26 ON intermidiaire (valeur_id)');
        $this->addSql('CREATE INDEX IDX_56DB26729E494911 ON intermidiaire (marche_id)');
        $this->addSql('CREATE INDEX IDX_56DB2672B2F3AF08 ON intermidiaire (profit_id)');
        $this->addSql('CREATE INDEX IDX_56DB267246032730 ON intermidiaire (type_compte_id)');
        $this->addSql('CREATE INDEX IDX_56DB2672EB906979 ON intermidiaire (code_adr_intrm_id)');
        $this->addSql('CREATE INDEX IDX_56DB26726A477111 ON intermidiaire (reglement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intermidiaire DROP FOREIGN KEY FK_56DB26724DAAD26');
        $this->addSql('ALTER TABLE intermidiaire DROP FOREIGN KEY FK_56DB26729E494911');
        $this->addSql('ALTER TABLE intermidiaire DROP FOREIGN KEY FK_56DB2672B2F3AF08');
        $this->addSql('ALTER TABLE intermidiaire DROP FOREIGN KEY FK_56DB267246032730');
        $this->addSql('ALTER TABLE intermidiaire DROP FOREIGN KEY FK_56DB2672EB906979');
        $this->addSql('ALTER TABLE intermidiaire DROP FOREIGN KEY FK_56DB26726A477111');
        $this->addSql('DROP INDEX IDX_56DB26724DAAD26 ON intermidiaire');
        $this->addSql('DROP INDEX IDX_56DB26729E494911 ON intermidiaire');
        $this->addSql('DROP INDEX IDX_56DB2672B2F3AF08 ON intermidiaire');
        $this->addSql('DROP INDEX IDX_56DB267246032730 ON intermidiaire');
        $this->addSql('DROP INDEX IDX_56DB2672EB906979 ON intermidiaire');
        $this->addSql('DROP INDEX IDX_56DB26726A477111 ON intermidiaire');
        $this->addSql('ALTER TABLE intermidiaire ADD code_isin VARCHAR(6) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD marche VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD profit VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD type_compte VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD qte VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD code_intermidiaire VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD reglement VARCHAR(1) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP valeur_id, DROP marche_id, DROP profit_id, DROP type_compte_id, DROP code_adr_intrm_id, DROP reglement_id, DROP quantite, CHANGE pays pays VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cours cours VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE commission commission VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE libelle_valeur valeur VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE caract caracteristique VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
