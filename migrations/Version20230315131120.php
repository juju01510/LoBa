<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315131120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA4B89032C');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAA76ED395');
        $this->addSql('DROP INDEX IDX_1CAC12CAA76ED395 ON commentary');
        $this->addSql('DROP INDEX IDX_1CAC12CA4B89032C ON commentary');
        $this->addSql('ALTER TABLE commentary ADD subject VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) NOT NULL, DROP user_id, DROP post_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentary ADD user_id INT DEFAULT NULL, ADD post_id INT DEFAULT NULL, DROP subject, DROP email');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1CAC12CAA76ED395 ON commentary (user_id)');
        $this->addSql('CREATE INDEX IDX_1CAC12CA4B89032C ON commentary (post_id)');
    }
}
