<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200210151421 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F7597D3FE');
        $this->addSql('DROP INDEX UNIQ_C53D045F7597D3FE ON image');
        $this->addSql('ALTER TABLE image DROP member_id');
        $this->addSql('ALTER TABLE member ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA783DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA783DA5256D ON member (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image ADD member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F7597D3FE ON image (member_id)');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA783DA5256D');
        $this->addSql('DROP INDEX UNIQ_70E4FA783DA5256D ON member');
        $this->addSql('ALTER TABLE member DROP image_id');
    }
}
