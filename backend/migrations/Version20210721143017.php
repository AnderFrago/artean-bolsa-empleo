<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721143017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applyments (id INT AUTO_INCREMENT NOT NULL, cv_id INT DEFAULT NULL, offer_id INT DEFAULT NULL, state INT NOT NULL, INDEX IDX_4C2BE176CFE419E2 (cv_id), INDEX IDX_4C2BE17653C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artean (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, original_name VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, path_name VARCHAR(255) NOT NULL, txt_path VARCHAR(255) NOT NULL, textcv LONGTEXT DEFAULT NULL, INDEX IDX_B66FFE92CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employer (id INT NOT NULL, state INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, employer_id INT DEFAULT NULL, company VARCHAR(255) NOT NULL, due_date DATE NOT NULL, position VARCHAR(255) NOT NULL, minimum_requirements LONGTEXT DEFAULT NULL, description LONGTEXT NOT NULL, number_of_applyments INT NOT NULL, original_name VARCHAR(255) NOT NULL, file_nam VARCHAR(255) NOT NULL, file_path VARCHAR(255) NOT NULL, INDEX IDX_29D6873E41CD9E7A (employer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT NOT NULL, state INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(500) NOT NULL, is_active TINYINT(1) NOT NULL, roles VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE applyments ADD CONSTRAINT FK_4C2BE176CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE applyments ADD CONSTRAINT FK_4C2BE17653C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE artean ADD CONSTRAINT FK_8DD5E64ABF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE employer ADD CONSTRAINT FK_DE4CF066BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E41CD9E7A FOREIGN KEY (employer_id) REFERENCES employer (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');

        $this->addSql('insert into users (username,password,is_active,roles) values ("artean", "$argon2id$v=19$m=65536,t=4,p=1$0fvkXpHdHuS1IIPYeqj/Tg$WoCUkN4zRl80TedHReCeYruDEd0+cfEwqKoasZCzZGI", true, "artean")' );



    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE applyments DROP FOREIGN KEY FK_4C2BE176CFE419E2');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E41CD9E7A');
        $this->addSql('ALTER TABLE applyments DROP FOREIGN KEY FK_4C2BE17653C674EE');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92CB944F1A');
        $this->addSql('ALTER TABLE artean DROP FOREIGN KEY FK_8DD5E64ABF396750');
        $this->addSql('ALTER TABLE employer DROP FOREIGN KEY FK_DE4CF066BF396750');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33BF396750');
        $this->addSql('DROP TABLE applyments');
        $this->addSql('DROP TABLE artean');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE employer');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE users');
    }
}
