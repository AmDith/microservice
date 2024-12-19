<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241215154343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id SERIAL NOT NULL, usercreate_id INT DEFAULT NULL, userupdate_id INT DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, libelle VARCHAR(50) DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, qte_stock INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E6620537CE3 ON article (usercreate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E661BDB4BD1 ON article (userupdate_id)');
        $this->addSql('CREATE TABLE client (id SERIAL NOT NULL, usercreate_id INT DEFAULT NULL, userupdate_id INT DEFAULT NULL, user_c_id INT DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, tel VARCHAR(50) DEFAULT NULL, adresse VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C744045520537CE3 ON client (usercreate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404551BDB4BD1 ON client (userupdate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455EB56D71A ON client (user_c_id)');
        $this->addSql('CREATE TABLE demande (id SERIAL NOT NULL, usercreate_id INT DEFAULT NULL, userupdate_id INT DEFAULT NULL, client_id INT DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, etat VARCHAR(255) NOT NULL, montant DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2694D7A520537CE3 ON demande (usercreate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2694D7A51BDB4BD1 ON demande (userupdate_id)');
        $this->addSql('CREATE INDEX IDX_2694D7A519EB6921 ON demande (client_id)');
        $this->addSql('CREATE TABLE demande_article (id SERIAL NOT NULL, usercreate_id INT DEFAULT NULL, userupdate_id INT DEFAULT NULL, demande_id INT DEFAULT NULL, article_id INT DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, somme DOUBLE PRECISION DEFAULT NULL, qte_demande INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_32CDB5C920537CE3 ON demande_article (usercreate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_32CDB5C91BDB4BD1 ON demande_article (userupdate_id)');
        $this->addSql('CREATE INDEX IDX_32CDB5C980E95E18 ON demande_article (demande_id)');
        $this->addSql('CREATE INDEX IDX_32CDB5C97294869C ON demande_article (article_id)');
        $this->addSql('CREATE TABLE dette (id SERIAL NOT NULL, usercreate_id INT DEFAULT NULL, userupdate_id INT DEFAULT NULL, demande_id INT DEFAULT NULL, client_id INT DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, etat VARCHAR(255) NOT NULL, montant DOUBLE PRECISION DEFAULT NULL, montant_verser DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_831BC80820537CE3 ON dette (usercreate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_831BC8081BDB4BD1 ON dette (userupdate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_831BC80880E95E18 ON dette (demande_id)');
        $this->addSql('CREATE INDEX IDX_831BC80819EB6921 ON dette (client_id)');
        $this->addSql('CREATE TABLE paiement (id SERIAL NOT NULL, usercreate_id INT DEFAULT NULL, userupdate_id INT DEFAULT NULL, dette_id INT DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, montant DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1DC7A1E20537CE3 ON paiement (usercreate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1DC7A1E1BDB4BD1 ON paiement (userupdate_id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EE11400A1 ON paiement (dette_id)');
        $this->addSql('CREATE TABLE role (id SERIAL NOT NULL, usercreate_id INT DEFAULT NULL, userupdate_id INT DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom_role VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57698A6A20537CE3 ON role (usercreate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57698A6A1BDB4BD1 ON role (userupdate_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, usercreate_id INT DEFAULT NULL, userupdate_id INT DEFAULT NULL, role_id INT DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, etat VARCHAR(255) NOT NULL, login VARCHAR(50) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, password VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON "user" (login)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64935C246D5 ON "user" (password)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64920537CE3 ON "user" (usercreate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6491BDB4BD1 ON "user" (userupdate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D60322AC ON "user" (role_id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6620537CE3 FOREIGN KEY (usercreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661BDB4BD1 FOREIGN KEY (userupdate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045520537CE3 FOREIGN KEY (usercreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404551BDB4BD1 FOREIGN KEY (userupdate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455EB56D71A FOREIGN KEY (user_c_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A520537CE3 FOREIGN KEY (usercreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A51BDB4BD1 FOREIGN KEY (userupdate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande_article ADD CONSTRAINT FK_32CDB5C920537CE3 FOREIGN KEY (usercreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande_article ADD CONSTRAINT FK_32CDB5C91BDB4BD1 FOREIGN KEY (userupdate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande_article ADD CONSTRAINT FK_32CDB5C980E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande_article ADD CONSTRAINT FK_32CDB5C97294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dette ADD CONSTRAINT FK_831BC80820537CE3 FOREIGN KEY (usercreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dette ADD CONSTRAINT FK_831BC8081BDB4BD1 FOREIGN KEY (userupdate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dette ADD CONSTRAINT FK_831BC80880E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dette ADD CONSTRAINT FK_831BC80819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E20537CE3 FOREIGN KEY (usercreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E1BDB4BD1 FOREIGN KEY (userupdate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE11400A1 FOREIGN KEY (dette_id) REFERENCES dette (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A20537CE3 FOREIGN KEY (usercreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A1BDB4BD1 FOREIGN KEY (userupdate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64920537CE3 FOREIGN KEY (usercreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6491BDB4BD1 FOREIGN KEY (userupdate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E6620537CE3');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E661BDB4BD1');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C744045520537CE3');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C74404551BDB4BD1');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455EB56D71A');
        $this->addSql('ALTER TABLE demande DROP CONSTRAINT FK_2694D7A520537CE3');
        $this->addSql('ALTER TABLE demande DROP CONSTRAINT FK_2694D7A51BDB4BD1');
        $this->addSql('ALTER TABLE demande DROP CONSTRAINT FK_2694D7A519EB6921');
        $this->addSql('ALTER TABLE demande_article DROP CONSTRAINT FK_32CDB5C920537CE3');
        $this->addSql('ALTER TABLE demande_article DROP CONSTRAINT FK_32CDB5C91BDB4BD1');
        $this->addSql('ALTER TABLE demande_article DROP CONSTRAINT FK_32CDB5C980E95E18');
        $this->addSql('ALTER TABLE demande_article DROP CONSTRAINT FK_32CDB5C97294869C');
        $this->addSql('ALTER TABLE dette DROP CONSTRAINT FK_831BC80820537CE3');
        $this->addSql('ALTER TABLE dette DROP CONSTRAINT FK_831BC8081BDB4BD1');
        $this->addSql('ALTER TABLE dette DROP CONSTRAINT FK_831BC80880E95E18');
        $this->addSql('ALTER TABLE dette DROP CONSTRAINT FK_831BC80819EB6921');
        $this->addSql('ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1E20537CE3');
        $this->addSql('ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1E1BDB4BD1');
        $this->addSql('ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1EE11400A1');
        $this->addSql('ALTER TABLE role DROP CONSTRAINT FK_57698A6A20537CE3');
        $this->addSql('ALTER TABLE role DROP CONSTRAINT FK_57698A6A1BDB4BD1');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64920537CE3');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6491BDB4BD1');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649D60322AC');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE demande_article');
        $this->addSql('DROP TABLE dette');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE "user"');
    }
}
