<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424131718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE etat_des_lieux_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE etat_des_lieux (id INT NOT NULL, date_enter VARCHAR(255) DEFAULT NULL, date_exit VARCHAR(255) DEFAULT NULL, property_type VARCHAR(255) DEFAULT NULL, surface DOUBLE PRECISION DEFAULT NULL, number_main_rooms INT DEFAULT NULL, full_adress VARCHAR(255) DEFAULT NULL, fullname_lessor VARCHAR(255) DEFAULT NULL, full_adress_lessor VARCHAR(255) DEFAULT NULL, fullname_tenant VARCHAR(255) DEFAULT NULL, full_adress_tenant VARCHAR(255) DEFAULT NULL, number_counter_elec INT DEFAULT NULL, number_counter_gaz INT DEFAULT NULL, cubic_meter_cold_water DOUBLE PRECISION DEFAULT NULL, cubic_meter_hot_water DOUBLE PRECISION DEFAULT NULL, name_former_tenant VARCHAR(255) DEFAULT NULL, heating_type VARCHAR(255) DEFAULT NULL, hot_water_type VARCHAR(255) DEFAULT NULL, state_boiler VARCHAR(255) DEFAULT NULL, number_water_radiator INT DEFAULT NULL, number_elec_radiator INT DEFAULT NULL, observation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE etat_des_lieux_id_seq CASCADE');
        $this->addSql('DROP TABLE etat_des_lieux');
    }
}
