<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402052659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE book_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('
                    CREATE TABLE author (
                        id INT NOT NULL, 
                        family VARCHAR(610) NOT NULL, 
                        name VARCHAR(255) NOT NULL, 
                        patronic VARCHAR(255) DEFAULT NULL, 
                        biograpfy TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('
                CREATE TABLE book (
                    id INT NOT NULL,
                     genre_id INT NOT NULL, 
                     title VARCHAR(610) NOT NULL, 
                     description TEXT DEFAULT NULL, 
                     small_description VARCHAR(1000) NOT NULL, 
                     price SMALLINT NOT NULL, PRIMARY KEY(id))');

        $this->addSql('CREATE INDEX IDX_CBE5A3314296D31F ON book (genre_id)');
        $this->addSql('
                CREATE TABLE book_author (
                    book_id INT NOT NULL, 
                    author_id INT NOT NULL, 
                    PRIMARY KEY(book_id, author_id)
                )');
        $this->addSql('CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)');
        $this->addSql('CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)');
        $this->addSql('
                CREATE TABLE comment (
                    id INT NOT NULL, 
                    book_id INT DEFAULT NULL, 
                    title VARCHAR(255) NOT NULL, 
                    description TEXT DEFAULT NULL, 
                    score SMALLINT NOT NULL, 
                    PRIMARY KEY(id))'
        );
        $this->addSql('CREATE INDEX IDX_9474526C16A2B381 ON comment (book_id)');
        $this->addSql('
                CREATE TABLE file (
                    id INT NOT NULL, 
                    book_id INT DEFAULT NULL, 
                    author_id INT DEFAULT NULL, 
                    name VARCHAR(255) NOT NULL, 
                    title VARCHAR(255) NOT NULL, 
                    path VARCHAR(610) NOT NULL, 
                    extension VARCHAR(10) NOT NULL, 
                    created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
                    updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, 
                    PRIMARY KEY(id))'
        );
        $this->addSql('CREATE INDEX IDX_8C9F361016A2B381 ON file (book_id)');
        $this->addSql('CREATE INDEX IDX_F31C361016A2A72C ON file (author_id)');
        $this->addSql('CREATE TABLE genre (id INT NOT NULL, parent_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_835033F8727ACA70 ON genre (parent_id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3314296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F361016A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_F31C361016A2A72C FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE genre ADD CONSTRAINT FK_835033F8727ACA70 FOREIGN KEY (parent_id) REFERENCES genre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE book_author DROP CONSTRAINT FK_9478D345F675F31B');
        $this->addSql('ALTER TABLE book_author DROP CONSTRAINT FK_9478D34516A2B381');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C16A2B381');
        $this->addSql('ALTER TABLE file DROP CONSTRAINT FK_8C9F361016A2B381');
        $this->addSql('ALTER TABLE book DROP CONSTRAINT FK_CBE5A3314296D31F');
        $this->addSql('ALTER TABLE genre DROP CONSTRAINT FK_835033F8727ACA70');
        $this->addSql('DROP SEQUENCE author_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE book_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE file_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE genre_id_seq CASCADE');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE genre');
    }
}
