<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331190754 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE SEQUENCE book_book_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TYPE genre_type AS ENUM (\'класика\',\'фантастика\',\'фэнтзи\');');
        $this->addSql('
            CREATE TABLE book (
                book_id INT NOT NULL,
                title VARCHAR(155) NOT NULL, 
                author VARCHAR(150) NOT NULL, 
                price NUMERIC(6, 2) NOT NULL, 
                genre genre_type,
                PRIMARY KEY(book_id))');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP SEQUENCE book_book_id_seq CASCADE');
        $this->addSql('DROP TYPE genre_type CASCADE');
        $this->addSql('DROP TABLE book');
    }
}
