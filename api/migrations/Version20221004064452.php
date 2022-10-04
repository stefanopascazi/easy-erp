<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004064452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, business_name VARCHAR(255) DEFAULT NULL, vat_number VARCHAR(255) DEFAULT NULL, fiscal_code VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, postal_code INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, web_site VARCHAR(255) DEFAULT NULL, business_email VARCHAR(255) DEFAULT NULL, pec VARCHAR(255) DEFAULT NULL, invoice_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meta DROP state');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE setting');
        $this->addSql('ALTER TABLE meta ADD state VARCHAR(255) DEFAULT NULL');
    }
}
