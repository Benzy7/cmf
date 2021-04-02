<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401133917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement ADD code_valeur_id INT NOT NULL, DROP isin');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EA89FD51E FOREIGN KEY (code_valeur_id) REFERENCES valeur (id)');
        $this->addSql('CREATE INDEX IDX_5B51FC3EA89FD51E ON mouvement (code_valeur_id)');
        $this->addSql('ALTER TABLE stock ADD code_valeur_id INT NOT NULL, DROP isin');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660A89FD51E FOREIGN KEY (code_valeur_id) REFERENCES valeur (id)');
        $this->addSql('CREATE INDEX IDX_4B365660A89FD51E ON stock (code_valeur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EA89FD51E');
        $this->addSql('DROP INDEX IDX_5B51FC3EA89FD51E ON mouvement');
        $this->addSql('ALTER TABLE mouvement ADD isin VARCHAR(12) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP code_valeur_id');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660A89FD51E');
        $this->addSql('DROP INDEX IDX_4B365660A89FD51E ON stock');
        $this->addSql('ALTER TABLE stock ADD isin VARCHAR(12) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP code_valeur_id');
    }
}
