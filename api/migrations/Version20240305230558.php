<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305230558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE former ADD speciality VARCHAR(255) DEFAULT NULL, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE former ADD CONSTRAINT FK_53B512EEBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CB944F1A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496C20F19');
        $this->addSql('DROP INDEX UNIQ_8D93D6496C20F19 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649CB944F1A ON user');
        $this->addSql('ALTER TABLE user ADD password VARCHAR(255) NOT NULL, ADD user_type VARCHAR(255) NOT NULL, DROP student_id, DROP former_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE former DROP FOREIGN KEY FK_53B512EEBF396750');
        $this->addSql('ALTER TABLE former DROP speciality, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33BF396750');
        $this->addSql('ALTER TABLE student CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD student_id INT DEFAULT NULL, ADD former_id INT DEFAULT NULL, DROP password, DROP user_type');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496C20F19 FOREIGN KEY (former_id) REFERENCES former (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6496C20F19 ON user (former_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649CB944F1A ON user (student_id)');
    }
}
