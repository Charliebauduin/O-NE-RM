<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122100441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, exercise_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526CE934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, difficulty INT NOT NULL, illustration VARCHAR(255) DEFAULT NULL, advice LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fitness_room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE goal (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, exercise_id INT NOT NULL, repetition INT DEFAULT NULL, weight INT DEFAULT NULL, INDEX IDX_FCDCEB2EA76ED395 (user_id), INDEX IDX_FCDCEB2EE934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progress (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, exercise_id INT NOT NULL, date DATETIME NOT NULL, repetition INT DEFAULT NULL, weight INT DEFAULT NULL, INDEX IDX_2201F246A76ED395 (user_id), INDEX IDX_2201F246E934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, fitness_room_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, gender VARCHAR(10) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(70) NOT NULL, age INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6499E1CFEED (fitness_room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2EE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F246A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F246E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499E1CFEED FOREIGN KEY (fitness_room_id) REFERENCES fitness_room (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE934951A');
        $this->addSql('ALTER TABLE goal DROP FOREIGN KEY FK_FCDCEB2EE934951A');
        $this->addSql('ALTER TABLE progress DROP FOREIGN KEY FK_2201F246E934951A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499E1CFEED');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE goal DROP FOREIGN KEY FK_FCDCEB2EA76ED395');
        $this->addSql('ALTER TABLE progress DROP FOREIGN KEY FK_2201F246A76ED395');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE fitness_room');
        $this->addSql('DROP TABLE goal');
        $this->addSql('DROP TABLE progress');
        $this->addSql('DROP TABLE user');
    }
}
