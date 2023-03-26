<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230326175722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE translation (id INT AUTO_INCREMENT NOT NULL, introduction_id INT NOT NULL, locale VARCHAR(255) NOT NULL, keyword VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL, INDEX IDX_B469456F87D2B3A9 (introduction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456F87D2B3A9 FOREIGN KEY (introduction_id) REFERENCES introduction (id)');
        $this->addSql('ALTER TABLE partners ADD available TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456F87D2B3A9');
        $this->addSql('DROP TABLE translation');
        $this->addSql('ALTER TABLE partners DROP available');
    }
}
