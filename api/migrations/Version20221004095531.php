<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004095531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setting ADD businessname VARCHAR(255) DEFAULT NULL, ADD vatnumber VARCHAR(255) DEFAULT NULL, ADD fiscalcode VARCHAR(255) DEFAULT NULL, ADD postalcode VARCHAR(255) DEFAULT NULL, ADD website VARCHAR(255) DEFAULT NULL, ADD businessemail VARCHAR(255) DEFAULT NULL, ADD invoicecode VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setting DROP businessname, DROP vatnumber, DROP fiscalcode, DROP postalcode, DROP website, DROP businessemail, DROP invoicecode');
    }
}
