<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220828053437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent_service ADD actualite_id INT DEFAULT NULL, ADD document_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agent_service ADD CONSTRAINT FK_33CEF878A2843073 FOREIGN KEY (actualite_id) REFERENCES actualite (id)');
        $this->addSql('ALTER TABLE agent_service ADD CONSTRAINT FK_33CEF878C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('CREATE INDEX IDX_33CEF878A2843073 ON agent_service (actualite_id)');
        $this->addSql('CREATE INDEX IDX_33CEF878C33F7837 ON agent_service (document_id)');
        $this->addSql('ALTER TABLE formation_sanitaire ADD agent_service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation_sanitaire ADD CONSTRAINT FK_E576DA099C1A78E9 FOREIGN KEY (agent_service_id) REFERENCES agent_service (id)');
        $this->addSql('CREATE INDEX IDX_E576DA099C1A78E9 ON formation_sanitaire (agent_service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent_service DROP FOREIGN KEY FK_33CEF878A2843073');
        $this->addSql('ALTER TABLE agent_service DROP FOREIGN KEY FK_33CEF878C33F7837');
        $this->addSql('DROP INDEX IDX_33CEF878A2843073 ON agent_service');
        $this->addSql('DROP INDEX IDX_33CEF878C33F7837 ON agent_service');
        $this->addSql('ALTER TABLE agent_service DROP actualite_id, DROP document_id');
        $this->addSql('ALTER TABLE formation_sanitaire DROP FOREIGN KEY FK_E576DA099C1A78E9');
        $this->addSql('DROP INDEX IDX_E576DA099C1A78E9 ON formation_sanitaire');
        $this->addSql('ALTER TABLE formation_sanitaire DROP agent_service_id');
    }
}
