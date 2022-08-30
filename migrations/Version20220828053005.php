<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220828053005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_sanitaire ADD comm_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation_sanitaire ADD CONSTRAINT FK_E576DA09EF7EB489 FOREIGN KEY (comm_id) REFERENCES commune (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E576DA09EF7EB489 ON formation_sanitaire (comm_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_sanitaire DROP FOREIGN KEY FK_E576DA09EF7EB489');
        $this->addSql('DROP INDEX UNIQ_E576DA09EF7EB489 ON formation_sanitaire');
        $this->addSql('ALTER TABLE formation_sanitaire DROP comm_id');
    }
}
