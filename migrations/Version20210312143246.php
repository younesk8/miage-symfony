<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312143246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diplome DROP FOREIGN KEY FK_EB4C4D4E180AA129');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1B3E9C81');
        $this->addSql('ALTER TABLE responsable_niveau DROP FOREIGN KEY FK_E802623AB3E9C81');
        $this->addSql('ALTER TABLE semestre DROP FOREIGN KEY FK_71688FBCB3E9C81');
        $this->addSql('CREATE TABLE annee (id INT AUTO_INCREMENT NOT NULL, diplome_id INT NOT NULL, nom VARCHAR(255) NOT NULL, numero_annee INT NOT NULL, INDEX IDX_DE92C5CF26F859E2 (diplome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, ecole_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_C1765B6377EF1B1E (ecole_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE description_diplome (id INT AUTO_INCREMENT NOT NULL, mention_id INT DEFAULT NULL, description_bref LONGTEXT NOT NULL, public_concerne LONGTEXT NOT NULL, fiche_pdf VARCHAR(255) NOT NULL, pre_requis LONGTEXT NOT NULL, modalite_inscription LONGTEXT NOT NULL, tarif LONGTEXT NOT NULL, competences LONGTEXT NOT NULL, poursuite_etude LONGTEXT NOT NULL, deboucher_pro LONGTEXT NOT NULL, contact LONGTEXT NOT NULL, atouts LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_86158F37A4147F0 (mention_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecole (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mention (id INT AUTO_INCREMENT NOT NULL, diplome_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E20259CD26F859E2 (diplome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_parcours (module_id INT NOT NULL, parcours_id INT NOT NULL, INDEX IDX_FD710D1DAFC2B591 (module_id), INDEX IDX_FD710D1D6E38C0DB (parcours_id), PRIMARY KEY(module_id, parcours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, mention_id INT NOT NULL, description_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_99B1DEE37A4147F0 (mention_id), UNIQUE INDEX UNIQ_99B1DEE3D9F966B (description_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pole (id INT AUTO_INCREMENT NOT NULL, departement_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_FD6042E1CCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, ecole_id INT DEFAULT NULL, departement_id INT DEFAULT NULL, pole_id INT DEFAULT NULL, mention_id INT DEFAULT NULL, parcours_id INT DEFAULT NULL, promotion_id INT DEFAULT NULL, annee_scolaire VARCHAR(255) NOT NULL, INDEX IDX_52520D07A76ED395 (user_id), INDEX IDX_52520D0777EF1B1E (ecole_id), INDEX IDX_52520D07CCF9E01E (departement_id), INDEX IDX_52520D07419C3385 (pole_id), INDEX IDX_52520D077A4147F0 (mention_id), INDEX IDX_52520D076E38C0DB (parcours_id), INDEX IDX_52520D07139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable_module (responsable_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_AFF9B77953C59D72 (responsable_id), INDEX IDX_AFF9B779AFC2B591 (module_id), PRIMARY KEY(responsable_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annee ADD CONSTRAINT FK_DE92C5CF26F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B6377EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('ALTER TABLE description_diplome ADD CONSTRAINT FK_86158F37A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
        $this->addSql('ALTER TABLE mention ADD CONSTRAINT FK_E20259CD26F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE module_parcours ADD CONSTRAINT FK_FD710D1DAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_parcours ADD CONSTRAINT FK_FD710D1D6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE37A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3D9F966B FOREIGN KEY (description_id) REFERENCES description_diplome (id)');
        $this->addSql('ALTER TABLE pole ADD CONSTRAINT FK_FD6042E1CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D0777EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07419C3385 FOREIGN KEY (pole_id) REFERENCES pole (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D077A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D076E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE responsable_module ADD CONSTRAINT FK_AFF9B77953C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsable_module ADD CONSTRAINT FK_AFF9B779AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE filliere');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE responsable_diplome');
        $this->addSql('DROP TABLE responsable_niveau');
        $this->addSql('DROP INDEX IDX_EB4C4D4E180AA129 ON diplome');
        $this->addSql('ALTER TABLE diplome ADD nb_annee INT NOT NULL, ADD niveau_diplome VARCHAR(255) NOT NULL, CHANGE filiere_id pole_id INT NOT NULL');
        $this->addSql('ALTER TABLE diplome ADD CONSTRAINT FK_EB4C4D4E419C3385 FOREIGN KEY (pole_id) REFERENCES pole (id)');
        $this->addSql('CREATE INDEX IDX_EB4C4D4E419C3385 ON diplome (pole_id)');
        $this->addSql('ALTER TABLE inscription_semestre DROP FOREIGN KEY FK_D8FDF019467BF3B5');
        $this->addSql('ALTER TABLE inscription_semestre DROP FOREIGN KEY FK_D8FDF0195577AFDB');
        $this->addSql('DROP INDEX IDX_D8FDF019467BF3B5 ON inscription_semestre');
        $this->addSql('DROP INDEX IDX_D8FDF0195577AFDB ON inscription_semestre');
        $this->addSql('ALTER TABLE inscription_semestre ADD etudiant_id INT NOT NULL, ADD as_tier_temp TINYINT(1) NOT NULL, ADD as_rse TINYINT(1) NOT NULL, ADD as_transmise TINYINT(1) NOT NULL, DROP semestre_id, DROP etudient_id, DROP tier_temp, DROP rse, DROP transmise, CHANGE annee annee_scolaire VARCHAR(255) NOT NULL, CHANGE valide as_valide TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription_semestre ADD CONSTRAINT FK_D8FDF019DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8FDF019DDEAB1A3 ON inscription_semestre (etudiant_id)');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426285577AFDB');
        $this->addSql('DROP INDEX IDX_C2426285577AFDB ON module');
        $this->addSql('ALTER TABLE module ADD ects INT NOT NULL, DROP code_apogee, CHANGE semestre_id ue_id INT NOT NULL, CHANGE obligatoire as_obligatoire TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262862E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('CREATE INDEX IDX_C24262862E883B1 ON module (ue_id)');
        $this->addSql('DROP INDEX IDX_C11D7DD1B3E9C81 ON promotion');
        $this->addSql('ALTER TABLE promotion ADD mention_id INT DEFAULT NULL, ADD parcours_id INT DEFAULT NULL, CHANGE niveau_id annee_id INT NOT NULL, CHANGE annee annee_scolaire VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD17A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD16E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD17A4147F0 ON promotion (mention_id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD1543EC5F0 ON promotion (annee_id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD16E38C0DB ON promotion (parcours_id)');
        $this->addSql('ALTER TABLE proposition CHANGE ajac as_ajac TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX IDX_71688FBCB3E9C81 ON semestre');
        $this->addSql('ALTER TABLE semestre ADD mention_id INT NOT NULL, CHANGE niveau_id annee_id INT NOT NULL');
        $this->addSql('ALTER TABLE semestre ADD CONSTRAINT FK_71688FBC543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE semestre ADD CONSTRAINT FK_71688FBC7A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
        $this->addSql('CREATE INDEX IDX_71688FBC543EC5F0 ON semestre (annee_id)');
        $this->addSql('CREATE INDEX IDX_71688FBC7A4147F0 ON semestre (mention_id)');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9BAFC2B591');
        $this->addSql('DROP INDEX IDX_2E490A9BAFC2B591 ON ue');
        $this->addSql('ALTER TABLE ue CHANGE module_id semestre_id INT NOT NULL');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('CREATE INDEX IDX_2E490A9B5577AFDB ON ue (semestre_id)');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15FC6C664E');
        $this->addSql('DROP INDEX IDX_69763D15FC6C664E ON user_module');
        $this->addSql('ALTER TABLE user_module CHANGE user_semestre_id user_ue_id INT NOT NULL, CHANGE ajac as_ajac TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15802A78E9 FOREIGN KEY (user_ue_id) REFERENCES user_ue (id)');
        $this->addSql('CREATE INDEX IDX_69763D15802A78E9 ON user_module (user_ue_id)');
        $this->addSql('ALTER TABLE user_semestre DROP FOREIGN KEY FK_91E56BBC467BF3B5');
        $this->addSql('DROP INDEX IDX_91E56BBC467BF3B5 ON user_semestre');
        $this->addSql('ALTER TABLE user_semestre ADD annee_id INT NOT NULL, ADD as_ajac TINYINT(1) DEFAULT NULL, ADD as_valide TINYINT(1) DEFAULT NULL, DROP ajac, DROP valide, CHANGE etudient_id etudiant_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_semestre ADD CONSTRAINT FK_91E56BBCDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_semestre ADD CONSTRAINT FK_91E56BBC543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('CREATE INDEX IDX_91E56BBCDDEAB1A3 ON user_semestre (etudiant_id)');
        $this->addSql('CREATE INDEX IDX_91E56BBC543EC5F0 ON user_semestre (annee_id)');
        $this->addSql('ALTER TABLE user_ue DROP FOREIGN KEY FK_361EBE5EAF223875');
        $this->addSql('DROP INDEX IDX_361EBE5EAF223875 ON user_ue');
        $this->addSql('ALTER TABLE user_ue DROP note, CHANGE user_module_id user_semestre_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_ue ADD CONSTRAINT FK_361EBE5EFC6C664E FOREIGN KEY (user_semestre_id) REFERENCES user_semestre (id)');
        $this->addSql('CREATE INDEX IDX_361EBE5EFC6C664E ON user_ue (user_semestre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1543EC5F0');
        $this->addSql('ALTER TABLE semestre DROP FOREIGN KEY FK_71688FBC543EC5F0');
        $this->addSql('ALTER TABLE user_semestre DROP FOREIGN KEY FK_91E56BBC543EC5F0');
        $this->addSql('ALTER TABLE pole DROP FOREIGN KEY FK_FD6042E1CCF9E01E');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07CCF9E01E');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3D9F966B');
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B6377EF1B1E');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D0777EF1B1E');
        $this->addSql('ALTER TABLE description_diplome DROP FOREIGN KEY FK_86158F37A4147F0');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE37A4147F0');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD17A4147F0');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D077A4147F0');
        $this->addSql('ALTER TABLE semestre DROP FOREIGN KEY FK_71688FBC7A4147F0');
        $this->addSql('ALTER TABLE module_parcours DROP FOREIGN KEY FK_FD710D1D6E38C0DB');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD16E38C0DB');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D076E38C0DB');
        $this->addSql('ALTER TABLE diplome DROP FOREIGN KEY FK_EB4C4D4E419C3385');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07419C3385');
        $this->addSql('ALTER TABLE responsable_module DROP FOREIGN KEY FK_AFF9B77953C59D72');
        $this->addSql('CREATE TABLE filliere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, diplome_id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_4BDFF36B26F859E2 (diplome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE responsable_diplome (id INT AUTO_INCREMENT NOT NULL, diplome_id INT NOT NULL, responsable_id INT NOT NULL, annee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F783F1BD53C59D72 (responsable_id), INDEX IDX_F783F1BD26F859E2 (diplome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE responsable_niveau (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, responsable_id INT NOT NULL, annee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E802623A53C59D72 (responsable_id), INDEX IDX_E802623AB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B26F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE responsable_diplome ADD CONSTRAINT FK_F783F1BD26F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE responsable_diplome ADD CONSTRAINT FK_F783F1BD53C59D72 FOREIGN KEY (responsable_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE responsable_niveau ADD CONSTRAINT FK_E802623A53C59D72 FOREIGN KEY (responsable_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE responsable_niveau ADD CONSTRAINT FK_E802623AB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('DROP TABLE annee');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE description_diplome');
        $this->addSql('DROP TABLE ecole');
        $this->addSql('DROP TABLE mention');
        $this->addSql('DROP TABLE module_parcours');
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE pole');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('DROP TABLE responsable_module');
        $this->addSql('DROP INDEX IDX_EB4C4D4E419C3385 ON diplome');
        $this->addSql('ALTER TABLE diplome ADD filiere_id INT NOT NULL, DROP pole_id, DROP nb_annee, DROP niveau_diplome');
        $this->addSql('ALTER TABLE diplome ADD CONSTRAINT FK_EB4C4D4E180AA129 FOREIGN KEY (filiere_id) REFERENCES filliere (id)');
        $this->addSql('CREATE INDEX IDX_EB4C4D4E180AA129 ON diplome (filiere_id)');
        $this->addSql('ALTER TABLE inscription_semestre DROP FOREIGN KEY FK_D8FDF019DDEAB1A3');
        $this->addSql('DROP INDEX IDX_D8FDF019DDEAB1A3 ON inscription_semestre');
        $this->addSql('ALTER TABLE inscription_semestre ADD etudient_id INT NOT NULL, ADD tier_temp TINYINT(1) NOT NULL, ADD rse TINYINT(1) NOT NULL, ADD transmise TINYINT(1) NOT NULL, DROP as_tier_temp, DROP as_rse, DROP as_transmise, CHANGE etudiant_id semestre_id INT NOT NULL, CHANGE annee_scolaire annee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE as_valide valide TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription_semestre ADD CONSTRAINT FK_D8FDF019467BF3B5 FOREIGN KEY (etudient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription_semestre ADD CONSTRAINT FK_D8FDF0195577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('CREATE INDEX IDX_D8FDF019467BF3B5 ON inscription_semestre (etudient_id)');
        $this->addSql('CREATE INDEX IDX_D8FDF0195577AFDB ON inscription_semestre (semestre_id)');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262862E883B1');
        $this->addSql('DROP INDEX IDX_C24262862E883B1 ON module');
        $this->addSql('ALTER TABLE module ADD semestre_id INT NOT NULL, ADD code_apogee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP ue_id, DROP ects, CHANGE as_obligatoire obligatoire TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426285577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('CREATE INDEX IDX_C2426285577AFDB ON module (semestre_id)');
        $this->addSql('DROP INDEX IDX_C11D7DD17A4147F0 ON promotion');
        $this->addSql('DROP INDEX IDX_C11D7DD1543EC5F0 ON promotion');
        $this->addSql('DROP INDEX IDX_C11D7DD16E38C0DB ON promotion');
        $this->addSql('ALTER TABLE promotion DROP mention_id, DROP parcours_id, CHANGE annee_id niveau_id INT NOT NULL, CHANGE annee_scolaire annee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD1B3E9C81 ON promotion (niveau_id)');
        $this->addSql('ALTER TABLE proposition CHANGE as_ajac ajac TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX IDX_71688FBC543EC5F0 ON semestre');
        $this->addSql('DROP INDEX IDX_71688FBC7A4147F0 ON semestre');
        $this->addSql('ALTER TABLE semestre ADD niveau_id INT NOT NULL, DROP annee_id, DROP mention_id');
        $this->addSql('ALTER TABLE semestre ADD CONSTRAINT FK_71688FBCB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_71688FBCB3E9C81 ON semestre (niveau_id)');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B5577AFDB');
        $this->addSql('DROP INDEX IDX_2E490A9B5577AFDB ON ue');
        $this->addSql('ALTER TABLE ue CHANGE semestre_id module_id INT NOT NULL');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9BAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('CREATE INDEX IDX_2E490A9BAFC2B591 ON ue (module_id)');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15802A78E9');
        $this->addSql('DROP INDEX IDX_69763D15802A78E9 ON user_module');
        $this->addSql('ALTER TABLE user_module CHANGE user_ue_id user_semestre_id INT NOT NULL, CHANGE as_ajac ajac TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15FC6C664E FOREIGN KEY (user_semestre_id) REFERENCES user_semestre (id)');
        $this->addSql('CREATE INDEX IDX_69763D15FC6C664E ON user_module (user_semestre_id)');
        $this->addSql('ALTER TABLE user_semestre DROP FOREIGN KEY FK_91E56BBCDDEAB1A3');
        $this->addSql('DROP INDEX IDX_91E56BBCDDEAB1A3 ON user_semestre');
        $this->addSql('DROP INDEX IDX_91E56BBC543EC5F0 ON user_semestre');
        $this->addSql('ALTER TABLE user_semestre ADD etudient_id INT NOT NULL, ADD ajac TINYINT(1) DEFAULT NULL, ADD valide TINYINT(1) DEFAULT NULL, DROP etudiant_id, DROP annee_id, DROP as_ajac, DROP as_valide');
        $this->addSql('ALTER TABLE user_semestre ADD CONSTRAINT FK_91E56BBC467BF3B5 FOREIGN KEY (etudient_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_91E56BBC467BF3B5 ON user_semestre (etudient_id)');
        $this->addSql('ALTER TABLE user_ue DROP FOREIGN KEY FK_361EBE5EFC6C664E');
        $this->addSql('DROP INDEX IDX_361EBE5EFC6C664E ON user_ue');
        $this->addSql('ALTER TABLE user_ue ADD note INT DEFAULT NULL, CHANGE user_semestre_id user_module_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_ue ADD CONSTRAINT FK_361EBE5EAF223875 FOREIGN KEY (user_module_id) REFERENCES user_module (id)');
        $this->addSql('CREATE INDEX IDX_361EBE5EAF223875 ON user_ue (user_module_id)');
    }
}
