<?php

/**
 * Migration to create/drop table
 *
 * PHP version 7.4
 *
 * @author Mohan Jadhav <mohan212jadhav@gmail.com>
 */

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221031171615 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * 
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE mean_kinetic_temperature (id INT AUTO_INCREMENT NOT NULL, data_set_name VARCHAR(255) NOT NULL, activation_energy DECIMAL(5,2) NOT NULL, kinetic_temperature DECIMAL(5,2) NOT NULL, ip VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temperature_details (id INT AUTO_INCREMENT NOT NULL, kinetic_temperature_id INT NOT NULL, time VARCHAR(255) NOT NULL, temperature DECIMAL(5,2) NOT NULL, INDEX IDX_7042E4B8C20B656C (kinetic_temperature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE temperature_details ADD CONSTRAINT FK_7042E4B8C20B656C FOREIGN KEY (kinetic_temperature_id) REFERENCES mean_kinetic_temperature (id)');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE temperature_details DROP FOREIGN KEY FK_7042E4B8C20B656C');
        $this->addSql('DROP TABLE mean_kinetic_temperature');
        $this->addSql('DROP TABLE temperature_details');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
