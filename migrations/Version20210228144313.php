<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228144313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diplome (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_EB4C4D4E180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filliere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, promotion_id INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_4B98C21139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_etudient (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, num_etu VARCHAR(255) NOT NULL, regime_special VARCHAR(255) DEFAULT NULL, adresse_etu VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_6142F155A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_semestre (id INT AUTO_INCREMENT NOT NULL, semestre_id INT NOT NULL, etudient_id INT NOT NULL, secretaire_id INT DEFAULT NULL, enseignant_id INT DEFAULT NULL, annee VARCHAR(255) NOT NULL, tier_temp TINYINT(1) NOT NULL, rse TINYINT(1) NOT NULL, valide TINYINT(1) DEFAULT NULL, transmise TINYINT(1) NOT NULL, message_prof LONGTEXT DEFAULT NULL, regime VARCHAR(255) DEFAULT NULL, INDEX IDX_D8FDF0195577AFDB (semestre_id), INDEX IDX_D8FDF019467BF3B5 (etudient_id), INDEX IDX_D8FDF019A90F02B2 (secretaire_id), INDEX IDX_D8FDF019E455FCC0 (enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, semestre_id INT NOT NULL, nom VARCHAR(255) NOT NULL, code_apogee VARCHAR(255) NOT NULL, obligatoire TINYINT(1) NOT NULL, INDEX IDX_C2426285577AFDB (semestre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, diplome_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_4BDFF36B26F859E2 (diplome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, annee VARCHAR(255) NOT NULL, INDEX IDX_C11D7DD1B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion_user (promotion_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3B695ED6139DF194 (promotion_id), INDEX IDX_3B695ED6A76ED395 (user_id), PRIMARY KEY(promotion_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposition (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, inscription_semestre_id INT NOT NULL, ajac TINYINT(1) NOT NULL, INDEX IDX_C7CDC353AFC2B591 (module_id), INDEX IDX_C7CDC353A206320B (inscription_semestre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable_diplome (id INT AUTO_INCREMENT NOT NULL, diplome_id INT NOT NULL, responsable_id INT NOT NULL, annee VARCHAR(255) NOT NULL, INDEX IDX_F783F1BD26F859E2 (diplome_id), INDEX IDX_F783F1BD53C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable_niveau (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, responsable_id INT NOT NULL, annee VARCHAR(255) NOT NULL, INDEX IDX_E802623AB3E9C81 (niveau_id), INDEX IDX_E802623A53C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_71688FBCB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, nom VARCHAR(255) NOT NULL, coef INT NOT NULL, INDEX IDX_2E490A9BAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, tel_fixe VARCHAR(255) DEFAULT NULL, tel_portable VARCHAR(255) DEFAULT NULL, actif TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_module (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, user_semestre_id INT NOT NULL, ajac TINYINT(1) NOT NULL, moyenne INT DEFAULT NULL, INDEX IDX_69763D15AFC2B591 (module_id), INDEX IDX_69763D15FC6C664E (user_semestre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_semestre (id INT AUTO_INCREMENT NOT NULL, semestre_id INT NOT NULL, promotion_id INT NOT NULL, etudient_id INT NOT NULL, ajac TINYINT(1) DEFAULT NULL, valide TINYINT(1) DEFAULT NULL, INDEX IDX_91E56BBC5577AFDB (semestre_id), INDEX IDX_91E56BBC139DF194 (promotion_id), INDEX IDX_91E56BBC467BF3B5 (etudient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_ue (id INT AUTO_INCREMENT NOT NULL, ue_id INT NOT NULL, user_module_id INT NOT NULL, note INT DEFAULT NULL, INDEX IDX_361EBE5E62E883B1 (ue_id), INDEX IDX_361EBE5EAF223875 (user_module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diplome ADD CONSTRAINT FK_EB4C4D4E180AA129 FOREIGN KEY (filiere_id) REFERENCES filliere (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE info_etudient ADD CONSTRAINT FK_6142F155A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription_semestre ADD CONSTRAINT FK_D8FDF0195577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE inscription_semestre ADD CONSTRAINT FK_D8FDF019467BF3B5 FOREIGN KEY (etudient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription_semestre ADD CONSTRAINT FK_D8FDF019A90F02B2 FOREIGN KEY (secretaire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription_semestre ADD CONSTRAINT FK_D8FDF019E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426285577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B26F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE promotion_user ADD CONSTRAINT FK_3B695ED6139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promotion_user ADD CONSTRAINT FK_3B695ED6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353A206320B FOREIGN KEY (inscription_semestre_id) REFERENCES inscription_semestre (id)');
        $this->addSql('ALTER TABLE responsable_diplome ADD CONSTRAINT FK_F783F1BD26F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE responsable_diplome ADD CONSTRAINT FK_F783F1BD53C59D72 FOREIGN KEY (responsable_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE responsable_niveau ADD CONSTRAINT FK_E802623AB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE responsable_niveau ADD CONSTRAINT FK_E802623A53C59D72 FOREIGN KEY (responsable_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE semestre ADD CONSTRAINT FK_71688FBCB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9BAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15FC6C664E FOREIGN KEY (user_semestre_id) REFERENCES user_semestre (id)');
        $this->addSql('ALTER TABLE user_semestre ADD CONSTRAINT FK_91E56BBC5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE user_semestre ADD CONSTRAINT FK_91E56BBC139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE user_semestre ADD CONSTRAINT FK_91E56BBC467BF3B5 FOREIGN KEY (etudient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_ue ADD CONSTRAINT FK_361EBE5E62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE user_ue ADD CONSTRAINT FK_361EBE5EAF223875 FOREIGN KEY (user_module_id) REFERENCES user_module (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B26F859E2');
        $this->addSql('ALTER TABLE responsable_diplome DROP FOREIGN KEY FK_F783F1BD26F859E2');
        $this->addSql('ALTER TABLE diplome DROP FOREIGN KEY FK_EB4C4D4E180AA129');
        $this->addSql('ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC353A206320B');
        $this->addSql('ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC353AFC2B591');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9BAFC2B591');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15AFC2B591');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1B3E9C81');
        $this->addSql('ALTER TABLE responsable_niveau DROP FOREIGN KEY FK_E802623AB3E9C81');
        $this->addSql('ALTER TABLE semestre DROP FOREIGN KEY FK_71688FBCB3E9C81');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21139DF194');
        $this->addSql('ALTER TABLE promotion_user DROP FOREIGN KEY FK_3B695ED6139DF194');
        $this->addSql('ALTER TABLE user_semestre DROP FOREIGN KEY FK_91E56BBC139DF194');
        $this->addSql('ALTER TABLE inscription_semestre DROP FOREIGN KEY FK_D8FDF0195577AFDB');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426285577AFDB');
        $this->addSql('ALTER TABLE user_semestre DROP FOREIGN KEY FK_91E56BBC5577AFDB');
        $this->addSql('ALTER TABLE user_ue DROP FOREIGN KEY FK_361EBE5E62E883B1');
        $this->addSql('ALTER TABLE info_etudient DROP FOREIGN KEY FK_6142F155A76ED395');
        $this->addSql('ALTER TABLE inscription_semestre DROP FOREIGN KEY FK_D8FDF019467BF3B5');
        $this->addSql('ALTER TABLE inscription_semestre DROP FOREIGN KEY FK_D8FDF019A90F02B2');
        $this->addSql('ALTER TABLE inscription_semestre DROP FOREIGN KEY FK_D8FDF019E455FCC0');
        $this->addSql('ALTER TABLE promotion_user DROP FOREIGN KEY FK_3B695ED6A76ED395');
        $this->addSql('ALTER TABLE responsable_diplome DROP FOREIGN KEY FK_F783F1BD53C59D72');
        $this->addSql('ALTER TABLE responsable_niveau DROP FOREIGN KEY FK_E802623A53C59D72');
        $this->addSql('ALTER TABLE user_semestre DROP FOREIGN KEY FK_91E56BBC467BF3B5');
        $this->addSql('ALTER TABLE user_ue DROP FOREIGN KEY FK_361EBE5EAF223875');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15FC6C664E');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('DROP TABLE filliere');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE info_etudient');
        $this->addSql('DROP TABLE inscription_semestre');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE promotion_user');
        $this->addSql('DROP TABLE proposition');
        $this->addSql('DROP TABLE responsable_diplome');
        $this->addSql('DROP TABLE responsable_niveau');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE ue');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_module');
        $this->addSql('DROP TABLE user_semestre');
        $this->addSql('DROP TABLE user_ue');
    }
}
