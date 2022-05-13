<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505153016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pfe DROP FOREIGN KEY FK_A5CFE8B499904FD1');
        $this->addSql('DROP INDEX IDX_A5CFE8B499904FD1 ON pfe');
        $this->addSql('ALTER TABLE pfe CHANGE pfe_collection_id entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pfe ADD CONSTRAINT FK_A5CFE8B4A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_A5CFE8B4A4AEAFEA ON pfe (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pfe DROP FOREIGN KEY FK_A5CFE8B4A4AEAFEA');
        $this->addSql('DROP INDEX IDX_A5CFE8B4A4AEAFEA ON pfe');
        $this->addSql('ALTER TABLE pfe CHANGE entreprise_id pfe_collection_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pfe ADD CONSTRAINT FK_A5CFE8B499904FD1 FOREIGN KEY (pfe_collection_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_A5CFE8B499904FD1 ON pfe (pfe_collection_id)');
    }
}
