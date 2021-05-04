<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504140830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE repas (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repas_alim (repas_id INT NOT NULL, alim_id INT NOT NULL, INDEX IDX_F4CD67A51D236AAA (repas_id), INDEX IDX_F4CD67A5BF571CE (alim_id), PRIMARY KEY(repas_id, alim_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE repas_alim ADD CONSTRAINT FK_F4CD67A51D236AAA FOREIGN KEY (repas_id) REFERENCES repas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE repas_alim ADD CONSTRAINT FK_F4CD67A5BF571CE FOREIGN KEY (alim_id) REFERENCES alim (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repas_alim DROP FOREIGN KEY FK_F4CD67A51D236AAA');
        $this->addSql('DROP TABLE repas');
        $this->addSql('DROP TABLE repas_alim');
    }
}
