<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004092846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, fulladdress VARCHAR(255) DEFAULT NULL, postalcode VARCHAR(255) DEFAULT NULL, municipality VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, cel_phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, pec VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipping (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, isdefault TINYINT(1) NOT NULL, businessname VARCHAR(255) DEFAULT NULL, vatnumber VARCHAR(255) DEFAULT NULL, fisclacode VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, postalcode VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, celphone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, note LONGTEXT DEFAULT NULL, INDEX IDX_2D1C17249395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shipping ADD CONSTRAINT FK_2D1C17249395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE customer ADD contact_id INT DEFAULT NULL, DROP external_code, DROP business_name');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09E7A1254A ON customer (contact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09E7A1254A');
        $this->addSql('ALTER TABLE shipping DROP FOREIGN KEY FK_2D1C17249395C3F3');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE shipping');
        $this->addSql('DROP INDEX UNIQ_81398E09E7A1254A ON customer');
        $this->addSql('ALTER TABLE customer ADD external_code VARCHAR(255) DEFAULT NULL, ADD business_name VARCHAR(255) DEFAULT NULL, DROP contact_id');
    }
}
