<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151021164730 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Seo (id INT AUTO_INCREMENT NOT NULL, seo_title VARCHAR(255) DEFAULT NULL, seo_description VARCHAR(255) DEFAULT NULL, seo_keywords VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Town (id INT AUTO_INCREMENT NOT NULL, seo_id INT DEFAULT NULL, coordinate_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, background VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, visible SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_ECD4689A97E3DD86 (seo_id), UNIQUE INDEX UNIQ_ECD4689A98BBE953 (coordinate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Coordinate (id INT AUTO_INCREMENT NOT NULL, polygon LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Oblast (id INT AUTO_INCREMENT NOT NULL, coordinate_id INT DEFAULT NULL, seo_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, background VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, visible SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_C7A14B8B98BBE953 (coordinate_id), UNIQUE INDEX UNIQ_C7A14B8B97E3DD86 (seo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE BlogPost (id INT AUTO_INCREMENT NOT NULL, seo_id INT DEFAULT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_4BC0361597E3DD86 (seo_id), INDEX IDX_4BC0361512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Town ADD CONSTRAINT FK_ECD4689A97E3DD86 FOREIGN KEY (seo_id) REFERENCES Seo (id)');
        $this->addSql('ALTER TABLE Town ADD CONSTRAINT FK_ECD4689A98BBE953 FOREIGN KEY (coordinate_id) REFERENCES Coordinate (id)');
        $this->addSql('ALTER TABLE Oblast ADD CONSTRAINT FK_C7A14B8B98BBE953 FOREIGN KEY (coordinate_id) REFERENCES Coordinate (id)');
        $this->addSql('ALTER TABLE Oblast ADD CONSTRAINT FK_C7A14B8B97E3DD86 FOREIGN KEY (seo_id) REFERENCES Seo (id)');
        $this->addSql('ALTER TABLE BlogPost ADD CONSTRAINT FK_4BC0361597E3DD86 FOREIGN KEY (seo_id) REFERENCES Seo (id)');
        $this->addSql('ALTER TABLE BlogPost ADD CONSTRAINT FK_4BC0361512469DE2 FOREIGN KEY (category_id) REFERENCES Category (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Town DROP FOREIGN KEY FK_ECD4689A97E3DD86');
        $this->addSql('ALTER TABLE Oblast DROP FOREIGN KEY FK_C7A14B8B97E3DD86');
        $this->addSql('ALTER TABLE BlogPost DROP FOREIGN KEY FK_4BC0361597E3DD86');
        $this->addSql('ALTER TABLE Town DROP FOREIGN KEY FK_ECD4689A98BBE953');
        $this->addSql('ALTER TABLE Oblast DROP FOREIGN KEY FK_C7A14B8B98BBE953');
        $this->addSql('ALTER TABLE BlogPost DROP FOREIGN KEY FK_4BC0361512469DE2');
        $this->addSql('DROP TABLE Seo');
        $this->addSql('DROP TABLE Town');
        $this->addSql('DROP TABLE Coordinate');
        $this->addSql('DROP TABLE Oblast');
        $this->addSql('DROP TABLE BlogPost');
        $this->addSql('DROP TABLE Category');
    }
}