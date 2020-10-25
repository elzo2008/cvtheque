<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201024152140 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE niveau_etude (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE situation_professionnelle (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialiste (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv ADD region_id INT DEFAULT NULL, ADD situation_professionnelle_id INT DEFAULT NULL, ADD specialiste_id INT DEFAULT NULL, ADD niveau_etude_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE9298260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92C633DB53 FOREIGN KEY (situation_professionnelle_id) REFERENCES situation_professionnelle (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE926F1A5C10 FOREIGN KEY (specialiste_id) REFERENCES specialiste (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92FEAD13D1 FOREIGN KEY (niveau_etude_id) REFERENCES niveau_etude (id)');
        $this->addSql('CREATE INDEX IDX_B66FFE9298260155 ON cv (region_id)');
        $this->addSql('CREATE INDEX IDX_B66FFE92C633DB53 ON cv (situation_professionnelle_id)');
        $this->addSql('CREATE INDEX IDX_B66FFE926F1A5C10 ON cv (specialiste_id)');
        $this->addSql('CREATE INDEX IDX_B66FFE92FEAD13D1 ON cv (niveau_etude_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92FEAD13D1');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE9298260155');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92C633DB53');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE926F1A5C10');
        $this->addSql('DROP TABLE niveau_etude');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE situation_professionnelle');
        $this->addSql('DROP TABLE specialiste');
        $this->addSql('DROP INDEX IDX_B66FFE9298260155 ON cv');
        $this->addSql('DROP INDEX IDX_B66FFE92C633DB53 ON cv');
        $this->addSql('DROP INDEX IDX_B66FFE926F1A5C10 ON cv');
        $this->addSql('DROP INDEX IDX_B66FFE92FEAD13D1 ON cv');
        $this->addSql('ALTER TABLE cv DROP region_id, DROP situation_professionnelle_id, DROP specialiste_id, DROP niveau_etude_id');
    }
}
