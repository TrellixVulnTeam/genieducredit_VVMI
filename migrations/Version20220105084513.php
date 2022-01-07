<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105084513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, authenvoiemails TINYINT(1) NOT NULL, authenvoisms TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_32EB52E8FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, typeagent_id INT NOT NULL, actif TINYINT(1) NOT NULL, authenvoiemail TINYINT(1) NOT NULL, authenvoisms TINYINT(1) NOT NULL, datecreation DATETIME NOT NULL, datemodification DATETIME NOT NULL, UNIQUE INDEX UNIQ_268B9C9DFB88E14F (utilisateur_id), INDEX IDX_268B9C9D687DFF83 (typeagent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concessionnaire (id INT AUTO_INCREMENT NOT NULL, concessionnairemarchand_id INT NOT NULL, UNIQUE INDEX UNIQ_42384AB56771C043 (concessionnairemarchand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concessionnairemarchand (id INT AUTO_INCREMENT NOT NULL, media_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, actif TINYINT(1) NOT NULL, siteweb VARCHAR(255) NOT NULL, liendealertrack VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_29246D8BEA9FDD75 (media_id), UNIQUE INDEX UNIQ_29246D8BFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concessionnairemarchand_agent (concessionnairemarchand_id INT NOT NULL, agent_id INT NOT NULL, INDEX IDX_A1AA62E06771C043 (concessionnairemarchand_id), INDEX IDX_A1AA62E03414710B (agent_id), PRIMARY KEY(concessionnairemarchand_id, agent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fabriquant (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, actifcrm TINYINT(1) DEFAULT NULL, actifservice TINYINT(1) DEFAULT NULL, actifaccueil TINYINT(1) DEFAULT NULL, lien VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, datecreation DATETIME NOT NULL, datemodification DATETIME NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CFF97A3AEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fabriquant_concessionnairemarchand (fabriquant_id INT NOT NULL, concessionnairemarchand_id INT NOT NULL, INDEX IDX_A3F9D8455E0C7E7D (fabriquant_id), INDEX IDX_A3F9D8456771C043 (concessionnairemarchand_id), PRIMARY KEY(fabriquant_id, concessionnairemarchand_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medias (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, lien VARCHAR(255) NOT NULL, INDEX IDX_12D2AF81C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typeagent (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, datecreation DATETIME NOT NULL, datemodification DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typemedia (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, courriel VARCHAR(180) NOT NULL, telephone VARCHAR(255) NOT NULL, nomutilisateur VARCHAR(255) NOT NULL, datecreation DATETIME NOT NULL, datemodification DATETIME NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B37F1813BC (nomutilisateur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrateur ADD CONSTRAINT FK_32EB52E8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D687DFF83 FOREIGN KEY (typeagent_id) REFERENCES typeagent (id)');
        $this->addSql('ALTER TABLE concessionnaire ADD CONSTRAINT FK_42384AB56771C043 FOREIGN KEY (concessionnairemarchand_id) REFERENCES concessionnairemarchand (id)');
        $this->addSql('ALTER TABLE concessionnairemarchand ADD CONSTRAINT FK_29246D8BEA9FDD75 FOREIGN KEY (media_id) REFERENCES medias (id)');
        $this->addSql('ALTER TABLE concessionnairemarchand ADD CONSTRAINT FK_29246D8BFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE concessionnairemarchand_agent ADD CONSTRAINT FK_A1AA62E06771C043 FOREIGN KEY (concessionnairemarchand_id) REFERENCES concessionnairemarchand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concessionnairemarchand_agent ADD CONSTRAINT FK_A1AA62E03414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fabriquant ADD CONSTRAINT FK_CFF97A3AEA9FDD75 FOREIGN KEY (media_id) REFERENCES medias (id)');
        $this->addSql('ALTER TABLE fabriquant_concessionnairemarchand ADD CONSTRAINT FK_A3F9D8455E0C7E7D FOREIGN KEY (fabriquant_id) REFERENCES fabriquant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fabriquant_concessionnairemarchand ADD CONSTRAINT FK_A3F9D8456771C043 FOREIGN KEY (concessionnairemarchand_id) REFERENCES concessionnairemarchand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medias ADD CONSTRAINT FK_12D2AF81C54C8C93 FOREIGN KEY (type_id) REFERENCES typemedia (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concessionnairemarchand_agent DROP FOREIGN KEY FK_A1AA62E03414710B');
        $this->addSql('ALTER TABLE concessionnaire DROP FOREIGN KEY FK_42384AB56771C043');
        $this->addSql('ALTER TABLE concessionnairemarchand_agent DROP FOREIGN KEY FK_A1AA62E06771C043');
        $this->addSql('ALTER TABLE fabriquant_concessionnairemarchand DROP FOREIGN KEY FK_A3F9D8456771C043');
        $this->addSql('ALTER TABLE fabriquant_concessionnairemarchand DROP FOREIGN KEY FK_A3F9D8455E0C7E7D');
        $this->addSql('ALTER TABLE concessionnairemarchand DROP FOREIGN KEY FK_29246D8BEA9FDD75');
        $this->addSql('ALTER TABLE fabriquant DROP FOREIGN KEY FK_CFF97A3AEA9FDD75');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D687DFF83');
        $this->addSql('ALTER TABLE medias DROP FOREIGN KEY FK_12D2AF81C54C8C93');
        $this->addSql('ALTER TABLE administrateur DROP FOREIGN KEY FK_32EB52E8FB88E14F');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DFB88E14F');
        $this->addSql('ALTER TABLE concessionnairemarchand DROP FOREIGN KEY FK_29246D8BFB88E14F');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE concessionnaire');
        $this->addSql('DROP TABLE concessionnairemarchand');
        $this->addSql('DROP TABLE concessionnairemarchand_agent');
        $this->addSql('DROP TABLE fabriquant');
        $this->addSql('DROP TABLE fabriquant_concessionnairemarchand');
        $this->addSql('DROP TABLE medias');
        $this->addSql('DROP TABLE typeagent');
        $this->addSql('DROP TABLE typemedia');
        $this->addSql('DROP TABLE utilisateur');
    }
}
