<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420141813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE payments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tenant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE payments (id INT NOT NULL, tenant_id INT DEFAULT NULL, invoice VARCHAR(255) NOT NULL, amount VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, property VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_65D29B329033212A ON payments (tenant_id)');
        $this->addSql('COMMENT ON COLUMN payments.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE tenant (id INT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, monthly_rate VARCHAR(255) NOT NULL, account_balance VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, "current_date" DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tenant.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN tenant.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B329033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE property ADD tenant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD total_price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE property ALTER title TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE property ALTER address TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE property ALTER additional_address TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE property ALTER city TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE9033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8BF21CDE9033212A ON property (tenant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE property DROP CONSTRAINT FK_8BF21CDE9033212A');
        $this->addSql('DROP SEQUENCE payments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tenant_id_seq CASCADE');
        $this->addSql('ALTER TABLE payments DROP CONSTRAINT FK_65D29B329033212A');
        $this->addSql('DROP TABLE payments');
        $this->addSql('DROP TABLE tenant');
        $this->addSql('DROP INDEX IDX_8BF21CDE9033212A');
        $this->addSql('ALTER TABLE property DROP tenant_id');
        $this->addSql('ALTER TABLE property DROP total_price');
        $this->addSql('ALTER TABLE property ALTER title TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE property ALTER address TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE property ALTER additional_address TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE property ALTER city TYPE VARCHAR(50)');
    }
}
