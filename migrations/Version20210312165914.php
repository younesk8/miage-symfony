<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312165914 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, diplome_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, numero_annee INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_DE92C5CF26F859E2 ON annee (diplome_id)');
        $this->addSql('CREATE TABLE departement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ecole_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C1765B6377EF1B1E ON departement (ecole_id)');
        $this->addSql('CREATE TABLE description_diplome (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mention_id INTEGER DEFAULT NULL, description_bref CLOB NOT NULL, public_concerne CLOB NOT NULL, fiche_pdf VARCHAR(255) NOT NULL, pre_requis CLOB NOT NULL, modalite_inscription CLOB NOT NULL, tarif CLOB NOT NULL, competences CLOB NOT NULL, poursuite_etude CLOB NOT NULL, deboucher_pro CLOB NOT NULL, contact CLOB NOT NULL, atouts CLOB NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_86158F37A4147F0 ON description_diplome (mention_id)');
        $this->addSql('CREATE TABLE diplome (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pole_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, nb_annee INTEGER NOT NULL, niveau_diplome VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_EB4C4D4E419C3385 ON diplome (pole_id)');
        $this->addSql('CREATE TABLE ecole (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE groupe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, promotion_id INTEGER NOT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_4B98C21139DF194 ON groupe (promotion_id)');
        $this->addSql('CREATE TABLE info_etudiant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, num_etu VARCHAR(255) NOT NULL, regime_special VARCHAR(255) DEFAULT NULL, adresse_etu VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_664B5989A76ED395 ON info_etudiant (user_id)');
        $this->addSql('CREATE TABLE inscription_semestre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, etudiant_id INTEGER NOT NULL, secretaire_id INTEGER DEFAULT NULL, enseignant_id INTEGER DEFAULT NULL, annee_scolaire VARCHAR(255) NOT NULL, as_tier_temp BOOLEAN NOT NULL, as_rse BOOLEAN NOT NULL, as_valide BOOLEAN DEFAULT NULL, as_transmise BOOLEAN NOT NULL, message_prof CLOB DEFAULT NULL, regime VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_D8FDF019DDEAB1A3 ON inscription_semestre (etudiant_id)');
        $this->addSql('CREATE INDEX IDX_D8FDF019A90F02B2 ON inscription_semestre (secretaire_id)');
        $this->addSql('CREATE INDEX IDX_D8FDF019E455FCC0 ON inscription_semestre (enseignant_id)');
        $this->addSql('CREATE TABLE mention (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, diplome_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E20259CD26F859E2 ON mention (diplome_id)');
        $this->addSql('CREATE TABLE module (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ue_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, as_obligatoire BOOLEAN NOT NULL, ects INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C24262862E883B1 ON module (ue_id)');
        $this->addSql('CREATE TABLE module_parcours (module_id INTEGER NOT NULL, parcours_id INTEGER NOT NULL, PRIMARY KEY(module_id, parcours_id))');
        $this->addSql('CREATE INDEX IDX_FD710D1DAFC2B591 ON module_parcours (module_id)');
        $this->addSql('CREATE INDEX IDX_FD710D1D6E38C0DB ON module_parcours (parcours_id)');
        $this->addSql('CREATE TABLE parcours (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mention_id INTEGER NOT NULL, description_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_99B1DEE37A4147F0 ON parcours (mention_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_99B1DEE3D9F966B ON parcours (description_id)');
        $this->addSql('CREATE TABLE pole (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, departement_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_FD6042E1CCF9E01E ON pole (departement_id)');
        $this->addSql('CREATE TABLE promotion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mention_id INTEGER DEFAULT NULL, annee_id INTEGER NOT NULL, parcours_id INTEGER DEFAULT NULL, annee_scolaire VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C11D7DD17A4147F0 ON promotion (mention_id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD1543EC5F0 ON promotion (annee_id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD16E38C0DB ON promotion (parcours_id)');
        $this->addSql('CREATE TABLE promotion_user (promotion_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(promotion_id, user_id))');
        $this->addSql('CREATE INDEX IDX_3B695ED6139DF194 ON promotion_user (promotion_id)');
        $this->addSql('CREATE INDEX IDX_3B695ED6A76ED395 ON promotion_user (user_id)');
        $this->addSql('CREATE TABLE proposition (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, inscription_semestre_id INTEGER NOT NULL, module_id INTEGER NOT NULL, as_ajac BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C7CDC353A206320B ON proposition (inscription_semestre_id)');
        $this->addSql('CREATE INDEX IDX_C7CDC353AFC2B591 ON proposition (module_id)');
        $this->addSql('CREATE TABLE responsable (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, ecole_id INTEGER DEFAULT NULL, departement_id INTEGER DEFAULT NULL, pole_id INTEGER DEFAULT NULL, mention_id INTEGER DEFAULT NULL, parcours_id INTEGER DEFAULT NULL, promotion_id INTEGER DEFAULT NULL, annee_scolaire VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_52520D07A76ED395 ON responsable (user_id)');
        $this->addSql('CREATE INDEX IDX_52520D0777EF1B1E ON responsable (ecole_id)');
        $this->addSql('CREATE INDEX IDX_52520D07CCF9E01E ON responsable (departement_id)');
        $this->addSql('CREATE INDEX IDX_52520D07419C3385 ON responsable (pole_id)');
        $this->addSql('CREATE INDEX IDX_52520D077A4147F0 ON responsable (mention_id)');
        $this->addSql('CREATE INDEX IDX_52520D076E38C0DB ON responsable (parcours_id)');
        $this->addSql('CREATE INDEX IDX_52520D07139DF194 ON responsable (promotion_id)');
        $this->addSql('CREATE TABLE responsable_module (responsable_id INTEGER NOT NULL, module_id INTEGER NOT NULL, PRIMARY KEY(responsable_id, module_id))');
        $this->addSql('CREATE INDEX IDX_AFF9B77953C59D72 ON responsable_module (responsable_id)');
        $this->addSql('CREATE INDEX IDX_AFF9B779AFC2B591 ON responsable_module (module_id)');
        $this->addSql('CREATE TABLE semestre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, annee_id INTEGER NOT NULL, mention_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_71688FBC543EC5F0 ON semestre (annee_id)');
        $this->addSql('CREATE INDEX IDX_71688FBC7A4147F0 ON semestre (mention_id)');
        $this->addSql('CREATE TABLE ue (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, semestre_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, coef INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2E490A9B5577AFDB ON ue (semestre_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, tel_fixe VARCHAR(255) DEFAULT NULL, tel_portable VARCHAR(255) DEFAULT NULL, actif BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE user_module (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_ue_id INTEGER NOT NULL, module_id INTEGER NOT NULL, as_ajac BOOLEAN NOT NULL, moyenne INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_69763D15802A78E9 ON user_module (user_ue_id)');
        $this->addSql('CREATE INDEX IDX_69763D15AFC2B591 ON user_module (module_id)');
        $this->addSql('CREATE TABLE user_semestre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, promotion_id INTEGER NOT NULL, etudiant_id INTEGER NOT NULL, annee_id INTEGER NOT NULL, semestre_id INTEGER NOT NULL, as_ajac BOOLEAN DEFAULT NULL, as_valide BOOLEAN DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_91E56BBC139DF194 ON user_semestre (promotion_id)');
        $this->addSql('CREATE INDEX IDX_91E56BBCDDEAB1A3 ON user_semestre (etudiant_id)');
        $this->addSql('CREATE INDEX IDX_91E56BBC543EC5F0 ON user_semestre (annee_id)');
        $this->addSql('CREATE INDEX IDX_91E56BBC5577AFDB ON user_semestre (semestre_id)');
        $this->addSql('CREATE TABLE user_ue (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_semestre_id INTEGER NOT NULL, ue_id INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_361EBE5EFC6C664E ON user_ue (user_semestre_id)');
        $this->addSql('CREATE INDEX IDX_361EBE5E62E883B1 ON user_ue (ue_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE annee');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE description_diplome');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('DROP TABLE ecole');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE info_etudiant');
        $this->addSql('DROP TABLE inscription_semestre');
        $this->addSql('DROP TABLE mention');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE module_parcours');
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE pole');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE promotion_user');
        $this->addSql('DROP TABLE proposition');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('DROP TABLE responsable_module');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE ue');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_module');
        $this->addSql('DROP TABLE user_semestre');
        $this->addSql('DROP TABLE user_ue');
    }
}
