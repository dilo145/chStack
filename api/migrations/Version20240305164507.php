<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305164507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE organism_former (organism_id INT NOT NULL, former_id INT NOT NULL, INDEX IDX_9069FCFD64180A36 (organism_id), INDEX IDX_9069FCFD6C20F19 (former_id), PRIMARY KEY(organism_id, former_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE organism_former ADD CONSTRAINT FK_9069FCFD64180A36 FOREIGN KEY (organism_id) REFERENCES organism (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organism_former ADD CONSTRAINT FK_9069FCFD6C20F19 FOREIGN KEY (former_id) REFERENCES former (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organism DROP FOREIGN KEY FK_D538A2C6C20F19');
        $this->addSql('DROP INDEX IDX_D538A2C6C20F19 ON organism');
        $this->addSql('ALTER TABLE organism DROP former_id');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organism_former DROP FOREIGN KEY FK_9069FCFD64180A36');
        $this->addSql('ALTER TABLE organism_former DROP FOREIGN KEY FK_9069FCFD6C20F19');
        $this->addSql('DROP TABLE organism_former');
        $this->addSql('ALTER TABLE user DROP roles, DROP password');
        $this->addSql('ALTER TABLE organism ADD former_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE organism ADD CONSTRAINT FK_D538A2C6C20F19 FOREIGN KEY (former_id) REFERENCES former (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D538A2C6C20F19 ON organism (former_id)');
    }
}
