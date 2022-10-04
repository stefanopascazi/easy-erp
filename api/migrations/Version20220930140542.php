<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930140542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meta (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, surname VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, cap VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD meta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64939FCA6F9 FOREIGN KEY (meta_id) REFERENCES meta (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64939FCA6F9 ON user (meta_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64939FCA6F9');
        $this->addSql('DROP TABLE meta');
        $this->addSql('DROP INDEX UNIQ_8D93D64939FCA6F9 ON user');
        $this->addSql('ALTER TABLE user DROP meta_id');
    }
}
