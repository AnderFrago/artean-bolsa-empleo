<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622203956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP TABLE offers');
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, offer_code VARCHAR(255) NOT NULL, offer_type VARCHAR(255) NOT NULL, activation_date DATE NOT NULL, due_date DATE NOT NULL, position VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, duties LONGTEXT NOT NULL, experience_requirements VARCHAR(255) NOT NULL, salary VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, creation_user VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, modification_date DATE NOT NULL, modification_user VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql("
        insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (1, '66992-281', '0378-7187', '2020/07/24', '2021/05/22', 'Dental Hygienist', 'Curabitur convallis. Duis consequat dui nec nisi volutpat eleifend.', 'Vivamus in felis eu sapien cursus vestibulum.', 'Donec posuere metus vitae ipsum. Aliquam non mauris.', '$8.50', 'Wu’erqihan', 'Shelley', '2020/12/06', '2021/01/29', 'Valérie');
insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (2, '67510-0068', '0548-5900', '2021/04/08', '2021/06/09', 'Software Engineer II', 'In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.', 'Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante.', 'Donec semper sapien a libero. Nam dui.', '$6.84', 'Brckovljani', 'Saree', '2020/12/16', '2021/01/18', 'Adélie');
insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (3, '53808-0307', '54868-0431', '2021/03/15', '2020/06/29', 'Senior Sales Associate', 'Morbi a ipsum.', 'Duis consequat dui nec nisi volutpat eleifend.', 'Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.', '$9.95', 'Mmathubudukwane', 'Nelli', '2020/11/13', '2021/01/31', 'Agnès');
insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (4, '0245-0224', '49730-112', '2020/07/13', '2021/01/15', 'Electrical Engineer', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien.', 'Etiam faucibus cursus urna.', 'Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.', '$9.97', 'Saaban', 'Rene', '2021/03/08', '2020/09/23', 'Eliès');
insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (5, '52125-251', '43093-105', '2020/08/15', '2020/10/03', 'Food Chemist', 'Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 'Phasellus in felis.', '$3.43', 'Summerland', 'Jaymee', '2020/09/08', '2021/05/22', 'Célestine');
insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (6, '64117-228', '49288-0284', '2021/03/28', '2021/04/21', 'Clinical Specialist', 'Donec posuere metus vitae ipsum. Aliquam non mauris.', 'Proin eu mi. Nulla ac enim.', 'Aenean lectus.', '$9.08', 'Daweishan', 'Latashia', '2020/08/25', '2021/03/09', 'Yú');
insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (7, '36800-173', '40104-262', '2020/12/11', '2020/12/10', 'Software Test Engineer II', 'Pellentesque at nulla.', 'Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.', 'Cras pellentesque volutpat dui. Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc.', '$6.12', 'Klenje', 'Gaylor', '2021/05/18', '2021/05/03', 'Séverine');
insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (8, '0268-6682', '59762-0222', '2021/05/09', '2020/10/27', 'Safety Technician I', 'Donec posuere metus vitae ipsum.', 'Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.', 'Nunc nisl. Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa.', '$4.68', 'Fubei', 'Silva', '2021/01/23', '2021/05/31', 'Aimée');
insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (9, '52125-923', '65862-406', '2020/11/09', '2021/05/13', 'Account Coordinator', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est.', 'Morbi quis tortor id nulla ultrices aliquet.', 'Nulla ut erat id mauris vulputate elementum.', '$6.42', 'Yoshida-kasugachō', 'Elsie', '2021/02/19', '2020/11/05', 'Bérangère');
insert into offers (id, offer_code, offer_type, activation_date, due_date, position, description, duties, experience_requirements, salary, location, creation_user, creation_date, modification_date, modification_user) values (10, '61010-1122', '0781-3004', '2021/04/07', '2021/01/13', 'Help Desk Operator', 'Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl.', 'Quisque id justo sit amet sapien dignissim vestibulum.', 'Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet.', '$6.85', 'Klau', 'Bing', '2020/12/24', '2021/01/27', 'Léonore');
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE offers');
    }
}
