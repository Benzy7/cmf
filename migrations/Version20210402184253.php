<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402184253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C6C2B102B0700AC2 ON code_compte_intrm (code_compte)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C527D26EC527D26E ON code_marche (code_marche)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8A3C72638A3C7263 ON code_profit (code_profit)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_13225EF813225EF8 ON code_titre (code_titre)');
        $this->addSql('ALTER TABLE intermidiaire CHANGE date_transaction date DATE NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1B44CD5164C295F3 ON valeur (code_valeur)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C6C2B102B0700AC2 ON code_compte_intrm');
        $this->addSql('DROP INDEX UNIQ_C527D26EC527D26E ON code_marche');
        $this->addSql('DROP INDEX UNIQ_8A3C72638A3C7263 ON code_profit');
        $this->addSql('DROP INDEX UNIQ_13225EF813225EF8 ON code_titre');
        $this->addSql('ALTER TABLE intermidiaire CHANGE date date_transaction DATE NOT NULL');
        $this->addSql('DROP INDEX UNIQ_1B44CD5164C295F3 ON valeur');
    }
}
