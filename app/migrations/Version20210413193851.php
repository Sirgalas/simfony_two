<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413193851 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE orders (
                            id INT NOT NULL, 
                            name VARCHAR(100) NOT NULL, 
                            address VARCHAR(255) NOT NULL, 
                            phone VARCHAR(20) NOT NULL, 
                            email VARCHAR(50) NOT NULL, 
                            PRIMARY KEY(id))');
        $this->addSql('ALTER INDEX idx_f31c361016a2a72c RENAME TO IDX_8C9F3610F675F31B');
        $this->addSql('DROP INDEX idx_835033f8727aca70');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_835033F8727ACA70 ON genre (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your n
        $this->addSql('DROP SEQUENCE orders_id_seq CASCADE');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP INDEX UNIQ_835033F8727ACA70');
        $this->addSql('CREATE INDEX idx_835033f8727aca70 ON genre (parent_id)');
        $this->addSql('ALTER INDEX idx_8c9f3610f675f31b RENAME TO idx_f31c361016a2a72c');
    }
}
