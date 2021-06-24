<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624070431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("DROP TABLE offer");
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, company VARCHAR(255) NOT NULL, due_date DATE NOT NULL, position VARCHAR(255) NOT NULL, minimum_requirements LONGTEXT DEFAULT NULL, description LONGTEXT NOT NULL, number_of_applyments INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql("
           insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (1, 'Kwimbee', '2020/07/10', 'Food Chemist', 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc.', 'Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla.', 6);
insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (2, 'Ailane', '2020/08/20', 'Research Associate', 'Morbi non quam nec dui luctus rutrum. Nulla tellus.', 'Suspendisse potenti. Nullam porttitor lacus at turpis.', 6);
insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (3, 'Meevee', '2021/01/15', 'Librarian', 'Fusce consequat.', 'Mauris sit amet eros.', 4);
insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (4, 'Dynabox', '2020/12/11', 'Research Nurse', 'Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla.', 'In est risus, auctor sed, tristique in, tempus sit amet, sem.', 5);
insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (5, 'Skibox', '2021/04/28', 'Computer Systems Analyst III', 'Proin eu mi. Nulla ac enim.', 'Nam nulla.', 4);
insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (6, 'Mynte', '2020/12/14', 'Help Desk Technician', 'Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', 'Aliquam quis turpis eget elit sodales scelerisque.', 2);
insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (7, 'Kare', '2020/12/03', 'Account Executive', 'Donec ut mauris eget massa tempor convallis.', 'In hac habitasse platea dictumst. Maecenas ut massa quis augue luctus tincidunt.', 7);
insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (8, 'Flashspan', '2020/10/26', 'VP Product Management', 'Quisque ut erat. Curabitur gravida nisi at nibh.', 'Nam dui.', 4);
insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (9, 'Devcast', '2020/10/20', 'Administrative Officer', 'In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.', 'Pellentesque eget nunc.', 6);
insert into offer (id, company, due_date, position, minimum_requirements, description, number_of_applyments) values (10, 'Twitterworks', '2021/03/17', 'Geologist III', 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst.', 'Nulla tellus.', 1);
           ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE offer');
    }
}
