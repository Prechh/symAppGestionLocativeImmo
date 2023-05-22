<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522223023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etat_des_lieux ADD property_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER date_enter TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER date_exit TYPE VARCHAR(10)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER full_adress TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER fullname_lessor TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER full_adress_lessor TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER fullname_tenant TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER name_former_tenant TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER state_boiler TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE property DROP is_manage_by_agency');
        $this->addSql('ALTER TABLE tenant ALTER name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE tenant ALTER firstname TYPE VARCHAR(50)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tenant ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE tenant ALTER firstname TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE property ADD is_manage_by_agency BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE etat_des_lieux DROP property_name');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER date_enter TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER date_exit TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER full_adress TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER fullname_lessor TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER full_adress_lessor TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER fullname_tenant TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER name_former_tenant TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE etat_des_lieux ALTER state_boiler TYPE VARCHAR(255)');
    }
}
