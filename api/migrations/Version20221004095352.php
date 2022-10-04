<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004095352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setting DROP business_name, DROP vat_number, DROP fiscal_code, DROP postal_code, DROP web_site, DROP business_email, DROP invoice_code');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setting ADD business_name VARCHAR(255) DEFAULT NULL, ADD vat_number VARCHAR(255) DEFAULT NULL, ADD fiscal_code VARCHAR(255) DEFAULT NULL, ADD postal_code INT DEFAULT NULL, ADD web_site VARCHAR(255) DEFAULT NULL, ADD business_email VARCHAR(255) DEFAULT NULL, ADD invoice_code VARCHAR(255) DEFAULT NULL');
    }
}
