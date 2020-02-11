<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211195539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, zipcode VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(2000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, site_id INT NOT NULL, username VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, phone VARCHAR(20) NOT NULL, email VARCHAR(200) NOT NULL, password VARCHAR(1070) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_70E4FA783DA5256D (image_id), INDEX IDX_70E4FA78F6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE outing (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, site_id INT NOT NULL, state_id INT NOT NULL, place_id INT NOT NULL, name VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, duration INT NOT NULL, limit_date_sub DATETIME NOT NULL, closing_date DATETIME NOT NULL, number_max_sub INT NOT NULL, number_sub INT NOT NULL, description VARCHAR(1000) NOT NULL, cancel_info VARCHAR(400) DEFAULT NULL, UNIQUE INDEX UNIQ_F2A106253DA5256D (image_id), INDEX IDX_F2A10625F6BD1646 (site_id), INDEX IDX_F2A106255D83CC1 (state_id), INDEX IDX_F2A10625DA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, name VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, INDEX IDX_741D53CD8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA783DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE outing ADD CONSTRAINT FK_F2A106253DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE outing ADD CONSTRAINT FK_F2A10625F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE outing ADD CONSTRAINT FK_F2A106255D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE outing ADD CONSTRAINT FK_F2A10625DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD8BAC62AF');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA783DA5256D');
        $this->addSql('ALTER TABLE outing DROP FOREIGN KEY FK_F2A106253DA5256D');
        $this->addSql('ALTER TABLE outing DROP FOREIGN KEY FK_F2A10625DA6A219');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78F6BD1646');
        $this->addSql('ALTER TABLE outing DROP FOREIGN KEY FK_F2A10625F6BD1646');
        $this->addSql('ALTER TABLE outing DROP FOREIGN KEY FK_F2A106255D83CC1');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE outing');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE state');
    }
}
