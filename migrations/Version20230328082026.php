<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328082026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translation ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456FD823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_B469456FD823E37A ON translation (section_id)');
        $this->addSql('CREATE INDEX IDX_B469456F166D1F9C ON translation (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456FD823E37A');
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456F166D1F9C');
        $this->addSql('DROP INDEX IDX_B469456FD823E37A ON translation');
        $this->addSql('DROP INDEX IDX_B469456F166D1F9C ON translation');
        $this->addSql('ALTER TABLE translation DROP project_id');
    }
}
