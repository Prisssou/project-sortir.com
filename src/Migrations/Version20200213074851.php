<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200213074851 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('CREATE TABLE subscribed (id INT AUTO_INCREMENT NOT NULL, member_id INT NOT NULL, INDEX IDX_59D4EE387597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscribed_outing (subscribed_id INT NOT NULL, outing_id INT NOT NULL, INDEX IDX_7620E9D0D7AB9EE (subscribed_id), INDEX IDX_7620E9D0AF4C7531 (outing_id), PRIMARY KEY(subscribed_id, outing_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(6) NOT NULL, codes_postaux VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subscribed ADD CONSTRAINT FK_59D4EE387597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
       $this->addSql('ALTER TABLE subscribed_outing ADD CONSTRAINT FK_7620E9D0D7AB9EE FOREIGN KEY (subscribed_id) REFERENCES subscribed (id) ON DELETE CASCADE');
       $this->addSql('ALTER TABLE subscribed_outing ADD CONSTRAINT FK_7620E9D0AF4C7531 FOREIGN KEY (outing_id) REFERENCES outing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE city CHANGE name name VARCHAR(255) NOT NULL, CHANGE zip zip VARCHAR(10) NOT NULL');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscribed_outing DROP FOREIGN KEY FK_7620E9D0D7AB9EE');
        $this->addSql('DROP TABLE subscribed');
        $this->addSql('DROP TABLE subscribed_outing');
        $this->addSql('DROP TABLE ville');
        $this->addSql('ALTER TABLE city CHANGE name name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE zip zip VARCHAR(5) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
