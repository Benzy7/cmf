<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323054744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CE5EDA05C6E94D92 ON code_nature (code_nature_compte)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1981A66DB5C4DE55 ON operation (code_operation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D2CD79C603F6AB9 ON type_adherent (code_type_adherent)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_CE5EDA05C6E94D92 ON code_nature');
        $this->addSql('DROP INDEX UNIQ_1981A66DB5C4DE55 ON operation');
        $this->addSql('DROP INDEX UNIQ_5D2CD79C603F6AB9 ON type_adherent');
    }
}
