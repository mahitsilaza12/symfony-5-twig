<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220829070556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EEE4158EC');
        $this->addSql('DROP INDEX UNIQ_E2E2D1EEE4158EC ON commune');
        $this->addSql('ALTER TABLE commune CHANGE dist_id district_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEB08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
        $this->addSql('CREATE INDEX IDX_E2E2D1EEB08FA272 ON commune (district_id)');
        $this->addSql('ALTER TABLE formation_sanitaire DROP FOREIGN KEY FK_E576DA09EF7EB489');
        $this->addSql('DROP INDEX UNIQ_E576DA09EF7EB489 ON formation_sanitaire');
        $this->addSql('ALTER TABLE formation_sanitaire CHANGE comm_id commune_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation_sanitaire ADD CONSTRAINT FK_E576DA09131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('CREATE INDEX IDX_E576DA09131A4F72 ON formation_sanitaire (commune_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EEB08FA272');
        $this->addSql('DROP INDEX IDX_E2E2D1EEB08FA272 ON commune');
        $this->addSql('ALTER TABLE commune CHANGE district_id dist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEE4158EC FOREIGN KEY (dist_id) REFERENCES district (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E2E2D1EEE4158EC ON commune (dist_id)');
        $this->addSql('ALTER TABLE formation_sanitaire DROP FOREIGN KEY FK_E576DA09131A4F72');
        $this->addSql('DROP INDEX IDX_E576DA09131A4F72 ON formation_sanitaire');
        $this->addSql('ALTER TABLE formation_sanitaire CHANGE commune_id comm_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation_sanitaire ADD CONSTRAINT FK_E576DA09EF7EB489 FOREIGN KEY (comm_id) REFERENCES commune (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E576DA09EF7EB489 ON formation_sanitaire (comm_id)');
    }
}
