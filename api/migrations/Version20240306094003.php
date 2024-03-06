<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306094003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE former_training (former_id INT NOT NULL, training_id INT NOT NULL, INDEX IDX_CFEFB99E6C20F19 (former_id), INDEX IDX_CFEFB99EBEFD98D1 (training_id), PRIMARY KEY(former_id, training_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE former_training ADD CONSTRAINT FK_CFEFB99E6C20F19 FOREIGN KEY (former_id) REFERENCES former (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE former_training ADD CONSTRAINT FK_CFEFB99EBEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organism DROP FOREIGN KEY FK_D538A2C6C20F19');
        $this->addSql('DROP INDEX IDX_D538A2C6C20F19 ON organism');
        $this->addSql('ALTER TABLE organism ADD created_by INT NOT NULL, DROP former_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE former_training DROP FOREIGN KEY FK_CFEFB99E6C20F19');
        $this->addSql('ALTER TABLE former_training DROP FOREIGN KEY FK_CFEFB99EBEFD98D1');
        $this->addSql('DROP TABLE former_training');
        $this->addSql('ALTER TABLE organism ADD former_id INT DEFAULT NULL, DROP created_by');
        $this->addSql('ALTER TABLE organism ADD CONSTRAINT FK_D538A2C6C20F19 FOREIGN KEY (former_id) REFERENCES former (id)');
        $this->addSql('CREATE INDEX IDX_D538A2C6C20F19 ON organism (former_id)');
    }
}
