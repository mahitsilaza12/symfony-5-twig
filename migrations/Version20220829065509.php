<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220829065509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE district DROP FOREIGN KEY FK_31C15487990B26CC');
        $this->addSql('DROP INDEX UNIQ_31C15487990B26CC ON district');
        $this->addSql('ALTER TABLE district DROP reg_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE district ADD reg_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C15487990B26CC FOREIGN KEY (reg_id) REFERENCES region (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_31C15487990B26CC ON district (reg_id)');
    }
}
