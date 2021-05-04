<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504134840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alim (id INT AUTO_INCREMENT NOT NULL, sous_groupe_id INT DEFAULT NULL, libal VARCHAR(255) NOT NULL, code INT NOT NULL, INDEX IDX_642FB035614CDEC3 (sous_groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, email_confirm VARCHAR(255) NOT NULL, age INT NOT NULL, sexe SMALLINT NOT NULL, poids INT NOT NULL, taille INT NOT NULL, tel INT NOT NULL, mdp VARCHAR(255) NOT NULL, mdp_confirm VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, groupe VARCHAR(255) NOT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_groupe (id INT AUTO_INCREMENT NOT NULL, groupe_id INT DEFAULT NULL, sougr VARCHAR(255) NOT NULL, code INT NOT NULL, INDEX IDX_D4A67ED67A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alim ADD CONSTRAINT FK_642FB035614CDEC3 FOREIGN KEY (sous_groupe_id) REFERENCES sous_groupe (id)');
        $this->addSql('ALTER TABLE sous_groupe ADD CONSTRAINT FK_D4A67ED67A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_groupe DROP FOREIGN KEY FK_D4A67ED67A45358C');
        $this->addSql('ALTER TABLE alim DROP FOREIGN KEY FK_642FB035614CDEC3');
        $this->addSql('DROP TABLE alim');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE sous_groupe');
    }
}
