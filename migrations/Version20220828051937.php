<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220828051937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_offert DROP FOREIGN KEY FK_7AE594B24C93DBEC');
        $this->addSql('DROP INDEX IDX_7AE594B24C93DBEC ON service_offert');
        $this->addSql('ALTER TABLE service_offert DROP serv_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_offert ADD serv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service_offert ADD CONSTRAINT FK_7AE594B24C93DBEC FOREIGN KEY (serv_id) REFERENCES formation_sanitaire (id)');
        $this->addSql('CREATE INDEX IDX_7AE594B24C93DBEC ON service_offert (serv_id)');
    }
}
