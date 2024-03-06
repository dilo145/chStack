<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306115940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, answer VARCHAR(255) DEFAULT NULL, INDEX IDX_DADD4A25CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, lesson_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_3AF34668CDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exam (id INT AUTO_INCREMENT NOT NULL, lesson_id INT NOT NULL, grade DOUBLE PRECISION NOT NULL, INDEX IDX_38BBA6C6CDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE former (id INT NOT NULL, speciality VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE former_training (former_id INT NOT NULL, training_id INT NOT NULL, INDEX IDX_CFEFB99E6C20F19 (former_id), INDEX IDX_CFEFB99EBEFD98D1 (training_id), PRIMARY KEY(former_id, training_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, level_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, goal VARCHAR(255) DEFAULT NULL, place VARCHAR(255) NOT NULL, INDEX IDX_F87474F35FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, reciver_id INT NOT NULL, message VARCHAR(255) NOT NULL, time DATETIME NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307F93173582 (reciver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organism (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, created_by INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, exam_id INT DEFAULT NULL, answer_question_id INT DEFAULT NULL, question VARCHAR(255) NOT NULL, answer VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E578D5E91 (exam_id), UNIQUE INDEX UNIQ_B6F7494EDF29669C (answer_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, training_id INT NOT NULL, student_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_62A8A7A7BEFD98D1 (training_id), INDEX IDX_62A8A7A7CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, lesson_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BC91F416CDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT NOT NULL, invidual TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, organism_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, goal_training VARCHAR(255) DEFAULT NULL, INDEX IDX_D5128A8F64180A36 (organism_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_lesson (training_id INT NOT NULL, lesson_id INT NOT NULL, INDEX IDX_CB98B39CBEFD98D1 (training_id), INDEX IDX_CB98B39CCDF80196 (lesson_id), PRIMARY KEY(training_id, lesson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', user_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C6CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE former ADD CONSTRAINT FK_53B512EEBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE former_training ADD CONSTRAINT FK_CFEFB99E6C20F19 FOREIGN KEY (former_id) REFERENCES former (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE former_training ADD CONSTRAINT FK_CFEFB99EBEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F35FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F93173582 FOREIGN KEY (reciver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EDF29669C FOREIGN KEY (answer_question_id) REFERENCES answer (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F416CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F64180A36 FOREIGN KEY (organism_id) REFERENCES organism (id)');
        $this->addSql('ALTER TABLE training_lesson ADD CONSTRAINT FK_CB98B39CBEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_lesson ADD CONSTRAINT FK_CB98B39CCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25CB944F1A');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668CDF80196');
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C6CDF80196');
        $this->addSql('ALTER TABLE former DROP FOREIGN KEY FK_53B512EEBF396750');
        $this->addSql('ALTER TABLE former_training DROP FOREIGN KEY FK_CFEFB99E6C20F19');
        $this->addSql('ALTER TABLE former_training DROP FOREIGN KEY FK_CFEFB99EBEFD98D1');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F35FB14BA7');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F93173582');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E578D5E91');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EDF29669C');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7BEFD98D1');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7CB944F1A');
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F416CDF80196');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33BF396750');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F64180A36');
        $this->addSql('ALTER TABLE training_lesson DROP FOREIGN KEY FK_CB98B39CBEFD98D1');
        $this->addSql('ALTER TABLE training_lesson DROP FOREIGN KEY FK_CB98B39CCDF80196');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE exam');
        $this->addSql('DROP TABLE former');
        $this->addSql('DROP TABLE former_training');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE organism');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE training_lesson');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
