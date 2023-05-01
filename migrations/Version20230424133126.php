<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424133126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etat_des_lieux ADD tenant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etat_des_lieux ADD property_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etat_des_lieux ADD CONSTRAINT FK_F72103129033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etat_des_lieux ADD CONSTRAINT FK_F7210312549213EC FOREIGN KEY (property_id) REFERENCES property (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F72103129033212A ON etat_des_lieux (tenant_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7210312549213EC ON etat_des_lieux (property_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE etat_des_lieux DROP CONSTRAINT FK_F72103129033212A');
        $this->addSql('ALTER TABLE etat_des_lieux DROP CONSTRAINT FK_F7210312549213EC');
        $this->addSql('DROP INDEX IDX_F72103129033212A');
        $this->addSql('DROP INDEX UNIQ_F7210312549213EC');
        $this->addSql('ALTER TABLE etat_des_lieux DROP tenant_id');
        $this->addSql('ALTER TABLE etat_des_lieux DROP property_id');
    }
}
