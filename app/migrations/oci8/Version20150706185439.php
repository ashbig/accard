<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Migrations;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Accard\Component\Diagnosis\Model\CodeGroup;
use DAG\Bundle\SecurityBundle\Model\User;

/**
 * Accard 1.0.0 migration.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Version20150706185439 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * Service container.
     *
     * @param ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'Upgrade from 0.0.0 to 1.0.0';
    }

    /**
     * Add data after the migration has run.
     *
     * @param Schema $schema
     */
    public function postUp(Schema $schema)
    {
        // Do not add post data without migration being actually run.
        if (!$this->version->isMigrated()) {
            $this->warnIf(true, 'Post up data not run, migration has not been executed.');
            return;
        }

        $this->addUsers();
        $this->addDiagnosisGroups();
    }

    /**
     * From 0.0.0 to 1.0.0.
     *
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->assertPlatform();

        $this->addSql('CREATE SEQUENCE accard_template_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE ext_log_entries_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE dag_log_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_setting_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_activity_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_attribute_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_behavior_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_diagnosis_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_diagnosis_phase_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_diagnosis_phase_instanc START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_patient_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_patient_phase_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_patient_phase_instance_ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_regimen_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_sample_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_sample_source_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_option_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_option_value_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_drug_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_drug_group_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_patient_field_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_patient_field_value_id_ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_diagnosis_code_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_diagnosis_code_group_id START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_diagnosis_field_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_diagnosis_field_value_i START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_behavior_prototype_fiel START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_behavior_prototype_id_s START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_attribute_prototype_fie START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_attribute_prototype_id_ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_sample_prototype_field_ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_sample_prototype_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_regimen_prototype_field START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_regimen_prototype_id_se START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_activity_prototype_fiel START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_activity_prototype_id_s START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE accard_template (id NUMBER(10) NOT NULL, parent VARCHAR2(180) DEFAULT NULL, name VARCHAR2(200) NOT NULL, location VARCHAR2(200) NOT NULL, content CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD8FA09C5E237E06 ON accard_template (name)');
        $this->addSql('CREATE TABLE lexik_translation_file (id NUMBER(10) NOT NULL, domain VARCHAR2(255) NOT NULL, locale VARCHAR2(10) NOT NULL, extention VARCHAR2(10) NOT NULL, path VARCHAR2(255) NOT NULL, hash VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DECLARE
          constraints_Count NUMBER;
        BEGIN
          SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = \'LEXIK_TRANSLATION_FILE\' AND CONSTRAINT_TYPE = \'P\';
          IF constraints_Count = 0 OR constraints_Count = \'\' THEN
            EXECUTE IMMEDIATE \'ALTER TABLE LEXIK_TRANSLATION_FILE ADD CONSTRAINT LEXIK_TRANSLATION_FILE_AI_PK PRIMARY KEY (ID)\';
          END IF;
        END;');
        $this->addSql('CREATE SEQUENCE LEXIK_TRANSLATION_FILE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TRIGGER LEXIK_TRANSLATION_FILE_AI_PK
           BEFORE INSERT
           ON LEXIK_TRANSLATION_FILE
           FOR EACH ROW
        DECLARE
           last_Sequence NUMBER;
           last_InsertID NUMBER;
        BEGIN
           SELECT LEXIK_TRANSLATION_FILE_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           IF (:NEW.ID IS NULL OR :NEW.ID = 0) THEN
              SELECT LEXIK_TRANSLATION_FILE_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           ELSE
              SELECT NVL(Last_Number, 0) INTO last_Sequence
                FROM User_Sequences
               WHERE Sequence_Name = \'LEXIK_TRANSLATION_FILE_ID_SEQ\';
              SELECT :NEW.ID INTO last_InsertID FROM DUAL;
              WHILE (last_InsertID > last_Sequence) LOOP
                 SELECT LEXIK_TRANSLATION_FILE_ID_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
              END LOOP;
           END IF;
        END;');
        $this->addSql('CREATE UNIQUE INDEX hash_idx ON lexik_translation_file (hash)');
        $this->addSql('CREATE TABLE lexik_trans_unit_translation (id NUMBER(10) NOT NULL, file_id NUMBER(10) DEFAULT NULL, trans_unit_id NUMBER(10) DEFAULT NULL, locale VARCHAR2(10) NOT NULL, content CLOB NOT NULL, created_at TIMESTAMP(0) DEFAULT NULL, updated_at TIMESTAMP(0) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DECLARE
          constraints_Count NUMBER;
        BEGIN
          SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = \'LEXIK_TRANS_UNIT_TRANSLATION\' AND CONSTRAINT_TYPE = \'P\';
          IF constraints_Count = 0 OR constraints_Count = \'\' THEN
            EXECUTE IMMEDIATE \'ALTER TABLE LEXIK_TRANS_UNIT_TRANSLATION ADD CONSTRAINT LEXIK_TRANS_UNIT_T_AI_PK PRIMARY KEY (ID)\';
          END IF;
        END;');
        $this->addSql('CREATE SEQUENCE LEXIK_TRANS_UNIT_T_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TRIGGER LEXIK_TRANS_UNIT_T_AI_PK
           BEFORE INSERT
           ON LEXIK_TRANS_UNIT_TRANSLATION
           FOR EACH ROW
        DECLARE
           last_Sequence NUMBER;
           last_InsertID NUMBER;
        BEGIN
           SELECT LEXIK_TRANS_UNIT_T_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           IF (:NEW.ID IS NULL OR :NEW.ID = 0) THEN
              SELECT LEXIK_TRANS_UNIT_T_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           ELSE
              SELECT NVL(Last_Number, 0) INTO last_Sequence
                FROM User_Sequences
               WHERE Sequence_Name = \'LEXIK_TRANS_UNIT_T_ID_SEQ\';
              SELECT :NEW.ID INTO last_InsertID FROM DUAL;
              WHILE (last_InsertID > last_Sequence) LOOP
                 SELECT LEXIK_TRANS_UNIT_T_ID_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
              END LOOP;
           END IF;
        END;');
        $this->addSql('CREATE INDEX IDX_75CB162F93CB796C ON lexik_trans_unit_translation (file_id)');
        $this->addSql('CREATE INDEX IDX_75CB162FC3C583C9 ON lexik_trans_unit_translation (trans_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX trans_unit_locale_idx ON lexik_trans_unit_translation (trans_unit_id, locale)');
        $this->addSql('CREATE TABLE lexik_trans_unit (id NUMBER(10) NOT NULL, key_name VARCHAR2(255) NOT NULL, domain VARCHAR2(255) NOT NULL, created_at TIMESTAMP(0) DEFAULT NULL, updated_at TIMESTAMP(0) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DECLARE
          constraints_Count NUMBER;
        BEGIN
          SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = \'LEXIK_TRANS_UNIT\' AND CONSTRAINT_TYPE = \'P\';
          IF constraints_Count = 0 OR constraints_Count = \'\' THEN
            EXECUTE IMMEDIATE \'ALTER TABLE LEXIK_TRANS_UNIT ADD CONSTRAINT LEXIK_TRANS_UNIT_AI_PK PRIMARY KEY (ID)\';
          END IF;
        END;');
        $this->addSql('CREATE SEQUENCE LEXIK_TRANS_UNIT_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TRIGGER LEXIK_TRANS_UNIT_AI_PK
           BEFORE INSERT
           ON LEXIK_TRANS_UNIT
           FOR EACH ROW
        DECLARE
           last_Sequence NUMBER;
           last_InsertID NUMBER;
        BEGIN
           SELECT LEXIK_TRANS_UNIT_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           IF (:NEW.ID IS NULL OR :NEW.ID = 0) THEN
              SELECT LEXIK_TRANS_UNIT_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           ELSE
              SELECT NVL(Last_Number, 0) INTO last_Sequence
                FROM User_Sequences
               WHERE Sequence_Name = \'LEXIK_TRANS_UNIT_ID_SEQ\';
              SELECT :NEW.ID INTO last_InsertID FROM DUAL;
              WHILE (last_InsertID > last_Sequence) LOOP
                 SELECT LEXIK_TRANS_UNIT_ID_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
              END LOOP;
           END IF;
        END;');
        $this->addSql('CREATE UNIQUE INDEX key_domain_idx ON lexik_trans_unit (key_name, domain)');
        $this->addSql('CREATE TABLE ext_log_entries (id NUMBER(10) NOT NULL, action VARCHAR2(8) NOT NULL, logged_at TIMESTAMP(0) NOT NULL, object_id VARCHAR2(64) DEFAULT NULL, object_class VARCHAR2(255) NOT NULL, version NUMBER(10) NOT NULL, data CLOB DEFAULT NULL, username VARCHAR2(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX log_class_lookup_idx ON ext_log_entries (object_class)');
        $this->addSql('CREATE INDEX log_date_lookup_idx ON ext_log_entries (logged_at)');
        $this->addSql('CREATE INDEX log_user_lookup_idx ON ext_log_entries (username)');
        $this->addSql('CREATE INDEX log_version_lookup_idx ON ext_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN ext_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE dag_log (id NUMBER(10) NOT NULL, logDate TIMESTAMP(0) NOT NULL, action VARCHAR2(16) NOT NULL, resourceName VARCHAR2(32) NOT NULL, resourceId NUMBER(10) DEFAULT NULL, route VARCHAR2(100) NOT NULL, uriAttributes CLOB DEFAULT NULL, uriQuery CLOB DEFAULT NULL, uriRequest CLOB DEFAULT NULL, userId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2AC893464B64DCC ON dag_log (userId)');
        $this->addSql('COMMENT ON COLUMN dag_log.uriAttributes IS \'(DC2Type:json_array)\'');
        $this->addSql('COMMENT ON COLUMN dag_log.uriQuery IS \'(DC2Type:json_array)\'');
        $this->addSql('COMMENT ON COLUMN dag_log.uriRequest IS \'(DC2Type:json_array)\'');
        $this->addSql('CREATE TABLE accard_setting (id NUMBER(10) NOT NULL, namespace VARCHAR2(120) NOT NULL, name VARCHAR2(120) NOT NULL, value CLOB DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN accard_setting.value IS \'(DC2Type:object)\'');
        $this->addSql('CREATE TABLE accard_activity (id NUMBER(10) NOT NULL, activityDate DATE NOT NULL, drugId NUMBER(10) DEFAULT NULL, prototypeId NUMBER(10) NOT NULL, patientId NUMBER(10) NOT NULL, diagnosisId NUMBER(10) DEFAULT NULL, regimenId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C69BB645DBA88346 ON accard_activity (drugId)');
        $this->addSql('CREATE INDEX IDX_C69BB6459B116E9A ON accard_activity (prototypeId)');
        $this->addSql('CREATE INDEX IDX_C69BB6458F803478 ON accard_activity (patientId)');
        $this->addSql('CREATE INDEX IDX_C69BB645D0EA680C ON accard_activity (diagnosisId)');
        $this->addSql('CREATE INDEX IDX_C69BB64585CA7E31 ON accard_activity (regimenId)');
        $this->addSql('CREATE TABLE accard_attribute (id NUMBER(10) NOT NULL, prototypeId NUMBER(10) NOT NULL, patientId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_77180DB19B116E9A ON accard_attribute (prototypeId)');
        $this->addSql('CREATE INDEX IDX_77180DB18F803478 ON accard_attribute (patientId)');
        $this->addSql('CREATE TABLE accard_behavior (id NUMBER(10) NOT NULL, startDate TIMESTAMP(0) NOT NULL, endDate TIMESTAMP(0) DEFAULT NULL, prototypeId NUMBER(10) NOT NULL, patientId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_51441FAF9B116E9A ON accard_behavior (prototypeId)');
        $this->addSql('CREATE INDEX IDX_51441FAF8F803478 ON accard_behavior (patientId)');
        $this->addSql('CREATE TABLE accard_diagnosis (id NUMBER(10) NOT NULL, startDate TIMESTAMP(0) NOT NULL, endDate TIMESTAMP(0) DEFAULT NULL, codeId NUMBER(10) NOT NULL, parentId NUMBER(10) DEFAULT NULL, primaryId NUMBER(10) DEFAULT NULL, patientId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F3B3ED77B5FC0459 ON accard_diagnosis (codeId)');
        $this->addSql('CREATE INDEX IDX_F3B3ED7710EE4CEE ON accard_diagnosis (parentId)');
        $this->addSql('CREATE INDEX IDX_F3B3ED777BB601C ON accard_diagnosis (primaryId)');
        $this->addSql('CREATE INDEX IDX_F3B3ED778F803478 ON accard_diagnosis (patientId)');
        $this->addSql('CREATE TABLE accard_diagnosis_phase (id NUMBER(10) NOT NULL, label VARCHAR2(255) NOT NULL, presentation VARCHAR2(255) NOT NULL, orderNumber NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE accard_diagnosis_phase_inst (id NUMBER(10) NOT NULL, target_id NUMBER(10) DEFAULT NULL, phase_id NUMBER(10) DEFAULT NULL, startDate TIMESTAMP(0) NOT NULL, endDate TIMESTAMP(0) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F09D7DB9158E0B66 ON accard_diagnosis_phase_inst (target_id)');
        $this->addSql('CREATE INDEX IDX_F09D7DB999091188 ON accard_diagnosis_phase_inst (phase_id)');
        $this->addSql('CREATE TABLE accard_patient (id NUMBER(10) NOT NULL, mrn VARCHAR2(36) DEFAULT NULL, firstName VARCHAR2(36) NOT NULL, lastName VARCHAR2(36) NOT NULL, dateOfBirth TIMESTAMP(0) NOT NULL, dateOfDeath TIMESTAMP(0) DEFAULT NULL, gender VARCHAR2(255) DEFAULT NULL, race VARCHAR2(255) DEFAULT NULL, targetId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45453AFA84DD64A ON accard_patient (mrn)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45453AFA39659675 ON accard_patient (targetId)');
        $this->addSql('CREATE TABLE accard_patient_phase (id NUMBER(10) NOT NULL, label VARCHAR2(255) NOT NULL, presentation VARCHAR2(255) NOT NULL, orderNumber NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE accard_patient_phase_inst (id NUMBER(10) NOT NULL, target_id NUMBER(10) DEFAULT NULL, phase_id NUMBER(10) DEFAULT NULL, startDate TIMESTAMP(0) NOT NULL, endDate TIMESTAMP(0) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_450F421158E0B66 ON accard_patient_phase_inst (target_id)');
        $this->addSql('CREATE INDEX IDX_450F42199091188 ON accard_patient_phase_inst (phase_id)');
        $this->addSql('CREATE TABLE accard_regimen (id NUMBER(10) NOT NULL, startDate TIMESTAMP(0) NOT NULL, endDate TIMESTAMP(0) DEFAULT NULL, drugId NUMBER(10) DEFAULT NULL, prototypeId NUMBER(10) NOT NULL, patientId NUMBER(10) NOT NULL, diagnosisId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7E8EF59EDBA88346 ON accard_regimen (drugId)');
        $this->addSql('CREATE INDEX IDX_7E8EF59E9B116E9A ON accard_regimen (prototypeId)');
        $this->addSql('CREATE INDEX IDX_7E8EF59E8F803478 ON accard_regimen (patientId)');
        $this->addSql('CREATE INDEX IDX_7E8EF59ED0EA680C ON accard_regimen (diagnosisId)');
        $this->addSql('CREATE TABLE accard_sample (id NUMBER(10) NOT NULL, amount NUMBER(10) NOT NULL, sourceId NUMBER(10) DEFAULT NULL, prototypeId NUMBER(10) NOT NULL, patientId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B6E6FFAEE155AE0 ON accard_sample (sourceId)');
        $this->addSql('CREATE INDEX IDX_6B6E6FFA9B116E9A ON accard_sample (prototypeId)');
        $this->addSql('CREATE INDEX IDX_6B6E6FFA8F803478 ON accard_sample (patientId)');
        $this->addSql('CREATE TABLE accard_sample_source (id NUMBER(10) NOT NULL, sourceDate TIMESTAMP(0) NOT NULL, amount NUMBER(10) DEFAULT NULL, parentSampleId NUMBER(10) DEFAULT NULL, patientId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5530F9C68C7A1510 ON accard_sample_source (parentSampleId)');
        $this->addSql('CREATE INDEX IDX_5530F9C68F803478 ON accard_sample_source (patientId)');
        $this->addSql('CREATE TABLE accard_option (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE accard_option_value (id NUMBER(10) NOT NULL, value VARCHAR2(255) NOT NULL, locked NUMBER(1) NOT NULL, ordering NUMBER(10) DEFAULT 0 NOT NULL, optionId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_96657CDDCE78B7CC ON accard_option_value (optionId)');
        $this->addSql('CREATE TABLE accard_drug (id NUMBER(10) NOT NULL, name VARCHAR2(255) NOT NULL, presentation VARCHAR2(255) NOT NULL, genericId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_89DC2B555E237E06 ON accard_drug (name)');
        $this->addSql('CREATE INDEX IDX_89DC2B552179D01F ON accard_drug (genericId)');
        $this->addSql('CREATE TABLE accard_drug_group (id NUMBER(10) NOT NULL, name VARCHAR2(255) NOT NULL, presentation VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8FCC09265E237E06 ON accard_drug_group (name)');
        $this->addSql('CREATE TABLE accard_drugs_groups (groupId NUMBER(10) NOT NULL, drugId NUMBER(10) NOT NULL, PRIMARY KEY(groupId, drugId))');
        $this->addSql('CREATE INDEX IDX_DAB9D6E4ED8188B0 ON accard_drugs_groups (groupId)');
        $this->addSql('CREATE INDEX IDX_DAB9D6E4DBA88346 ON accard_drugs_groups (drugId)');
        $this->addSql('CREATE TABLE accard_patient_field (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, type VARCHAR2(36) NOT NULL, allowMultiple NUMBER(1) NOT NULL, addable NUMBER(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR2(60) DEFAULT \'numeric\' NOT NULL, configuration CLOB NOT NULL, optionId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54CED4B85E237E06 ON accard_patient_field (name)');
        $this->addSql('CREATE INDEX IDX_54CED4B8CE78B7CC ON accard_patient_field (optionId)');
        $this->addSql('COMMENT ON COLUMN accard_patient_field.configuration IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE accard_patient_field_value (id NUMBER(10) NOT NULL, stringValue VARCHAR2(255) DEFAULT NULL, dateValue TIMESTAMP(0) DEFAULT NULL, numberValue NUMBER(10) DEFAULT NULL, optionValueId NUMBER(10) DEFAULT NULL, patientId NUMBER(10) NOT NULL, fieldId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E084E37081F9A87C ON accard_patient_field_value (optionValueId)');
        $this->addSql('CREATE INDEX IDX_E084E3708F803478 ON accard_patient_field_value (patientId)');
        $this->addSql('CREATE INDEX IDX_E084E3705E697A44 ON accard_patient_field_value (fieldId)');
        $this->addSql('CREATE TABLE accard_patient_fld_opt_map (optionValueId NUMBER(10) NOT NULL, fieldValueId NUMBER(10) NOT NULL, PRIMARY KEY(optionValueId, fieldValueId))');
        $this->addSql('CREATE INDEX IDX_C6EC0E8B81F9A87C ON accard_patient_fld_opt_map (optionValueId)');
        $this->addSql('CREATE INDEX IDX_C6EC0E8BE8ED26A9 ON accard_patient_fld_opt_map (fieldValueId)');
        $this->addSql('CREATE TABLE accard_diagnosis_code (id NUMBER(10) NOT NULL, code VARCHAR2(255) NOT NULL, description VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD5E178E77153098 ON accard_diagnosis_code (code)');
        $this->addSql('CREATE TABLE accard_diagnosis_codes_groups (codeId NUMBER(10) NOT NULL, groupId NUMBER(10) NOT NULL, PRIMARY KEY(codeId, groupId))');
        $this->addSql('CREATE INDEX IDX_E9D4D81DB5FC0459 ON accard_diagnosis_codes_groups (codeId)');
        $this->addSql('CREATE INDEX IDX_E9D4D81DED8188B0 ON accard_diagnosis_codes_groups (groupId)');
        $this->addSql('CREATE TABLE accard_diagnosis_code_group (id NUMBER(10) NOT NULL, name VARCHAR2(255) NOT NULL, presentation VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7D683B15E237E06 ON accard_diagnosis_code_group (name)');
        $this->addSql('CREATE TABLE accard_diagnosis_field (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, type VARCHAR2(36) NOT NULL, allowMultiple NUMBER(1) NOT NULL, addable NUMBER(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR2(60) DEFAULT \'numeric\' NOT NULL, configuration CLOB NOT NULL, optionId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AFEBBB2E5E237E06 ON accard_diagnosis_field (name)');
        $this->addSql('CREATE INDEX IDX_AFEBBB2ECE78B7CC ON accard_diagnosis_field (optionId)');
        $this->addSql('COMMENT ON COLUMN accard_diagnosis_field.configuration IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE accard_diagnosis_field_value (id NUMBER(10) NOT NULL, stringValue VARCHAR2(255) DEFAULT NULL, dateValue TIMESTAMP(0) DEFAULT NULL, numberValue NUMBER(10) DEFAULT NULL, optionValueId NUMBER(10) DEFAULT NULL, diagnosisId NUMBER(10) NOT NULL, fieldId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1EA4358F81F9A87C ON accard_diagnosis_field_value (optionValueId)');
        $this->addSql('CREATE INDEX IDX_1EA4358FD0EA680C ON accard_diagnosis_field_value (diagnosisId)');
        $this->addSql('CREATE INDEX IDX_1EA4358F5E697A44 ON accard_diagnosis_field_value (fieldId)');
        $this->addSql('CREATE TABLE accard_diagnosis_fld_opt_map (optionValueId NUMBER(10) NOT NULL, fieldValueId NUMBER(10) NOT NULL, PRIMARY KEY(optionValueId, fieldValueId))');
        $this->addSql('CREATE INDEX IDX_38CCD87481F9A87C ON accard_diagnosis_fld_opt_map (optionValueId)');
        $this->addSql('CREATE INDEX IDX_38CCD874E8ED26A9 ON accard_diagnosis_fld_opt_map (fieldValueId)');
        $this->addSql('CREATE TABLE accard_bhvr_proto_fld (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, type VARCHAR2(36) NOT NULL, allowMultiple NUMBER(1) NOT NULL, addable NUMBER(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR2(60) DEFAULT \'numeric\' NOT NULL, configuration CLOB NOT NULL, optionId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D2CFF6735E237E06 ON accard_bhvr_proto_fld (name)');
        $this->addSql('CREATE INDEX IDX_D2CFF673CE78B7CC ON accard_bhvr_proto_fld (optionId)');
        $this->addSql('COMMENT ON COLUMN accard_bhvr_proto_fld.configuration IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE accard_bhvr_proto_fldval (id NUMBER(10) NOT NULL, stringValue VARCHAR2(255) DEFAULT NULL, dateValue TIMESTAMP(0) DEFAULT NULL, numberValue NUMBER(10) DEFAULT NULL, optionValueId NUMBER(10) DEFAULT NULL, behaviorId NUMBER(10) NOT NULL, fieldId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8855F5A481F9A87C ON accard_bhvr_proto_fldval (optionValueId)');
        $this->addSql('CREATE INDEX IDX_8855F5A418AE7509 ON accard_bhvr_proto_fldval (behaviorId)');
        $this->addSql('CREATE INDEX IDX_8855F5A45E697A44 ON accard_bhvr_proto_fldval (fieldId)');
        $this->addSql('CREATE TABLE accard_bhvr_proto_fld_opt_map (optionValueId NUMBER(10) NOT NULL, fieldValueId NUMBER(10) NOT NULL, PRIMARY KEY(optionValueId, fieldValueId))');
        $this->addSql('CREATE INDEX IDX_5AD23C5481F9A87C ON accard_bhvr_proto_fld_opt_map (optionValueId)');
        $this->addSql('CREATE INDEX IDX_5AD23C54E8ED26A9 ON accard_bhvr_proto_fld_opt_map (fieldValueId)');
        $this->addSql('CREATE TABLE accard_behavior_prototype (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, description VARCHAR2(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE accard_behavior_prototype_map (prototypeId NUMBER(10) NOT NULL, subjectId NUMBER(10) NOT NULL, PRIMARY KEY(prototypeId, subjectId))');
        $this->addSql('CREATE INDEX IDX_98CC21519B116E9A ON accard_behavior_prototype_map (prototypeId)');
        $this->addSql('CREATE INDEX IDX_98CC21513E0C34EB ON accard_behavior_prototype_map (subjectId)');
        $this->addSql('CREATE TABLE accard_attr_proto_fld (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, type VARCHAR2(36) NOT NULL, allowMultiple NUMBER(1) NOT NULL, addable NUMBER(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR2(60) DEFAULT \'numeric\' NOT NULL, configuration CLOB NOT NULL, optionId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6C2852165E237E06 ON accard_attr_proto_fld (name)');
        $this->addSql('CREATE INDEX IDX_6C285216CE78B7CC ON accard_attr_proto_fld (optionId)');
        $this->addSql('COMMENT ON COLUMN accard_attr_proto_fld.configuration IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE accard_attr_proto_fldval (id NUMBER(10) NOT NULL, stringValue VARCHAR2(255) DEFAULT NULL, dateValue TIMESTAMP(0) DEFAULT NULL, numberValue NUMBER(10) DEFAULT NULL, optionValueId NUMBER(10) DEFAULT NULL, attributeId NUMBER(10) NOT NULL, fieldId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_324CF2E781F9A87C ON accard_attr_proto_fldval (optionValueId)');
        $this->addSql('CREATE INDEX IDX_324CF2E7ED407E17 ON accard_attr_proto_fldval (attributeId)');
        $this->addSql('CREATE INDEX IDX_324CF2E75E697A44 ON accard_attr_proto_fldval (fieldId)');
        $this->addSql('CREATE TABLE accard_attr_proto_fld_opt_map (optionValueId NUMBER(10) NOT NULL, fieldValueId NUMBER(10) NOT NULL, PRIMARY KEY(optionValueId, fieldValueId))');
        $this->addSql('CREATE INDEX IDX_D58BF8B981F9A87C ON accard_attr_proto_fld_opt_map (optionValueId)');
        $this->addSql('CREATE INDEX IDX_D58BF8B9E8ED26A9 ON accard_attr_proto_fld_opt_map (fieldValueId)');
        $this->addSql('CREATE TABLE accard_attribute_prototype (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, description VARCHAR2(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE accard_attribute_prototype_map (prototypeId NUMBER(10) NOT NULL, subjectId NUMBER(10) NOT NULL, PRIMARY KEY(prototypeId, subjectId))');
        $this->addSql('CREATE INDEX IDX_B6E609359B116E9A ON accard_attribute_prototype_map (prototypeId)');
        $this->addSql('CREATE INDEX IDX_B6E609353E0C34EB ON accard_attribute_prototype_map (subjectId)');
        $this->addSql('CREATE TABLE accard_sample_proto_fld (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, type VARCHAR2(36) NOT NULL, allowMultiple NUMBER(1) NOT NULL, addable NUMBER(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR2(60) DEFAULT \'numeric\' NOT NULL, configuration CLOB NOT NULL, optionId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D7ABA2F35E237E06 ON accard_sample_proto_fld (name)');
        $this->addSql('CREATE INDEX IDX_D7ABA2F3CE78B7CC ON accard_sample_proto_fld (optionId)');
        $this->addSql('COMMENT ON COLUMN accard_sample_proto_fld.configuration IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE accard_sample_proto_fldval (id NUMBER(10) NOT NULL, stringValue VARCHAR2(255) DEFAULT NULL, dateValue TIMESTAMP(0) DEFAULT NULL, numberValue NUMBER(10) DEFAULT NULL, optionValueId NUMBER(10) DEFAULT NULL, sampleId NUMBER(10) NOT NULL, fieldId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD68D33081F9A87C ON accard_sample_proto_fldval (optionValueId)');
        $this->addSql('CREATE INDEX IDX_FD68D330730CE27D ON accard_sample_proto_fldval (sampleId)');
        $this->addSql('CREATE INDEX IDX_FD68D3305E697A44 ON accard_sample_proto_fldval (fieldId)');
        $this->addSql('CREATE TABLE accard_sample_proto_fld_opt_ma (optionValueId NUMBER(10) NOT NULL, fieldValueId NUMBER(10) NOT NULL, PRIMARY KEY(optionValueId, fieldValueId))');
        $this->addSql('CREATE INDEX IDX_9CECBE0481F9A87C ON accard_sample_proto_fld_opt_ma (optionValueId)');
        $this->addSql('CREATE INDEX IDX_9CECBE04E8ED26A9 ON accard_sample_proto_fld_opt_ma (fieldValueId)');
        $this->addSql('CREATE TABLE accard_sample_prototype (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, description VARCHAR2(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE accard_sample_prototype_map (prototypeId NUMBER(10) NOT NULL, subjectId NUMBER(10) NOT NULL, PRIMARY KEY(prototypeId, subjectId))');
        $this->addSql('CREATE INDEX IDX_B953D8249B116E9A ON accard_sample_prototype_map (prototypeId)');
        $this->addSql('CREATE INDEX IDX_B953D8243E0C34EB ON accard_sample_prototype_map (subjectId)');
        $this->addSql('CREATE TABLE accard_regimen_proto_fld (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, type VARCHAR2(36) NOT NULL, allowMultiple NUMBER(1) NOT NULL, addable NUMBER(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR2(60) DEFAULT \'numeric\' NOT NULL, configuration CLOB NOT NULL, optionId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E62A58515E237E06 ON accard_regimen_proto_fld (name)');
        $this->addSql('CREATE INDEX IDX_E62A5851CE78B7CC ON accard_regimen_proto_fld (optionId)');
        $this->addSql('COMMENT ON COLUMN accard_regimen_proto_fld.configuration IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE accard_regimen_proto_fldval (id NUMBER(10) NOT NULL, stringValue VARCHAR2(255) DEFAULT NULL, dateValue TIMESTAMP(0) DEFAULT NULL, numberValue NUMBER(10) DEFAULT NULL, optionValueId NUMBER(10) DEFAULT NULL, regimenId NUMBER(10) NOT NULL, fieldId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5378E08E81F9A87C ON accard_regimen_proto_fldval (optionValueId)');
        $this->addSql('CREATE INDEX IDX_5378E08E85CA7E31 ON accard_regimen_proto_fldval (regimenId)');
        $this->addSql('CREATE INDEX IDX_5378E08E5E697A44 ON accard_regimen_proto_fldval (fieldId)');
        $this->addSql('CREATE TABLE accard_regimen_proto_fld_opt_m (optionValueId NUMBER(10) NOT NULL, fieldValueId NUMBER(10) NOT NULL, PRIMARY KEY(optionValueId, fieldValueId))');
        $this->addSql('CREATE INDEX IDX_CCCE7B6381F9A87C ON accard_regimen_proto_fld_opt_m (optionValueId)');
        $this->addSql('CREATE INDEX IDX_CCCE7B63E8ED26A9 ON accard_regimen_proto_fld_opt_m (fieldValueId)');
        $this->addSql('CREATE TABLE accard_regimen_prototype (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, description VARCHAR2(255) DEFAULT NULL, allowDrug NUMBER(1) DEFAULT NULL, drugGroupId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1713F9E8A67C4099 ON accard_regimen_prototype (drugGroupId)');
        $this->addSql('CREATE TABLE accard_regimen_prototype_map (prototypeId NUMBER(10) NOT NULL, subjectId NUMBER(10) NOT NULL, PRIMARY KEY(prototypeId, subjectId))');
        $this->addSql('CREATE INDEX IDX_9524569C9B116E9A ON accard_regimen_prototype_map (prototypeId)');
        $this->addSql('CREATE INDEX IDX_9524569C3E0C34EB ON accard_regimen_prototype_map (subjectId)');
        $this->addSql('CREATE TABLE accard_regimen_activity_map (activityPrototypeId NUMBER(10) NOT NULL, regimenPrototypeId NUMBER(10) NOT NULL, PRIMARY KEY(activityPrototypeId, regimenPrototypeId))');
        $this->addSql('CREATE INDEX IDX_447DEB5B2B242F3D ON accard_regimen_activity_map (activityPrototypeId)');
        $this->addSql('CREATE INDEX IDX_447DEB5B438AD5F2 ON accard_regimen_activity_map (regimenPrototypeId)');
        $this->addSql('CREATE TABLE accard_activity_proto_fld (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, type VARCHAR2(36) NOT NULL, allowMultiple NUMBER(1) NOT NULL, addable NUMBER(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR2(60) DEFAULT \'numeric\' NOT NULL, configuration CLOB NOT NULL, optionId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81052DA55E237E06 ON accard_activity_proto_fld (name)');
        $this->addSql('CREATE INDEX IDX_81052DA5CE78B7CC ON accard_activity_proto_fld (optionId)');
        $this->addSql('COMMENT ON COLUMN accard_activity_proto_fld.configuration IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE accard_activity_proto_fldval (id NUMBER(10) NOT NULL, stringValue VARCHAR2(255) DEFAULT NULL, dateValue TIMESTAMP(0) DEFAULT NULL, numberValue NUMBER(10) DEFAULT NULL, optionValueId NUMBER(10) DEFAULT NULL, activityId NUMBER(10) NOT NULL, fieldId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_182C8B0F81F9A87C ON accard_activity_proto_fldval (optionValueId)');
        $this->addSql('CREATE INDEX IDX_182C8B0F1335E2FC ON accard_activity_proto_fldval (activityId)');
        $this->addSql('CREATE INDEX IDX_182C8B0F5E697A44 ON accard_activity_proto_fldval (fieldId)');
        $this->addSql('CREATE TABLE accard_activity_proto_fld_opt_ (optionValueId NUMBER(10) NOT NULL, fieldValueId NUMBER(10) NOT NULL, PRIMARY KEY(optionValueId, fieldValueId))');
        $this->addSql('CREATE INDEX IDX_359EDC7181F9A87C ON accard_activity_proto_fld_opt_ (optionValueId)');
        $this->addSql('CREATE INDEX IDX_359EDC71E8ED26A9 ON accard_activity_proto_fld_opt_ (fieldValueId)');
        $this->addSql('CREATE TABLE accard_activity_prototype (id NUMBER(10) NOT NULL, name VARCHAR2(120) NOT NULL, presentation VARCHAR2(120) NOT NULL, description VARCHAR2(255) DEFAULT NULL, allowDrug NUMBER(1) DEFAULT NULL, drugGroupId NUMBER(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_703C8C1CA67C4099 ON accard_activity_prototype (drugGroupId)');
        $this->addSql('CREATE TABLE accard_activity_prototype_map (prototypeId NUMBER(10) NOT NULL, subjectId NUMBER(10) NOT NULL, PRIMARY KEY(prototypeId, subjectId))');
        $this->addSql('CREATE INDEX IDX_FD0B1419B116E9A ON accard_activity_prototype_map (prototypeId)');
        $this->addSql('CREATE INDEX IDX_FD0B1413E0C34EB ON accard_activity_prototype_map (subjectId)');
        $this->addSql('CREATE TABLE dag_user (id NUMBER(10) NOT NULL, username VARCHAR2(255) NOT NULL, roles CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN dag_user.roles IS \'(DC2Type:simple_array)\'');
        $this->addSql('ALTER TABLE lexik_trans_unit_translation ADD CONSTRAINT FK_75CB162F93CB796C FOREIGN KEY (file_id) REFERENCES lexik_translation_file (id)');
        $this->addSql('ALTER TABLE lexik_trans_unit_translation ADD CONSTRAINT FK_75CB162FC3C583C9 FOREIGN KEY (trans_unit_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE dag_log ADD CONSTRAINT FK_2AC893464B64DCC FOREIGN KEY (userId) REFERENCES dag_user (id)');
        $this->addSql('ALTER TABLE accard_activity ADD CONSTRAINT FK_C69BB645DBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('ALTER TABLE accard_activity ADD CONSTRAINT FK_C69BB6459B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_activity_prototype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accard_activity ADD CONSTRAINT FK_C69BB6458F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_activity ADD CONSTRAINT FK_C69BB645D0EA680C FOREIGN KEY (diagnosisId) REFERENCES accard_diagnosis (id)');
        $this->addSql('ALTER TABLE accard_activity ADD CONSTRAINT FK_C69BB64585CA7E31 FOREIGN KEY (regimenId) REFERENCES accard_regimen (id)');
        $this->addSql('ALTER TABLE accard_attribute ADD CONSTRAINT FK_77180DB19B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_attribute_prototype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accard_attribute ADD CONSTRAINT FK_77180DB18F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_behavior ADD CONSTRAINT FK_51441FAF9B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_behavior_prototype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accard_behavior ADD CONSTRAINT FK_51441FAF8F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_diagnosis ADD CONSTRAINT FK_F3B3ED77B5FC0459 FOREIGN KEY (codeId) REFERENCES accard_diagnosis_code (id)');
        $this->addSql('ALTER TABLE accard_diagnosis ADD CONSTRAINT FK_F3B3ED7710EE4CEE FOREIGN KEY (parentId) REFERENCES accard_diagnosis (id)');
        $this->addSql('ALTER TABLE accard_diagnosis ADD CONSTRAINT FK_F3B3ED777BB601C FOREIGN KEY (primaryId) REFERENCES accard_diagnosis (id)');
        $this->addSql('ALTER TABLE accard_diagnosis ADD CONSTRAINT FK_F3B3ED778F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_phase_inst ADD CONSTRAINT FK_F09D7DB9158E0B66 FOREIGN KEY (target_id) REFERENCES accard_diagnosis (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_phase_inst ADD CONSTRAINT FK_F09D7DB999091188 FOREIGN KEY (phase_id) REFERENCES accard_diagnosis_phase (id)');
        $this->addSql('ALTER TABLE accard_patient_phase_inst ADD CONSTRAINT FK_450F421158E0B66 FOREIGN KEY (target_id) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_patient_phase_inst ADD CONSTRAINT FK_450F42199091188 FOREIGN KEY (phase_id) REFERENCES accard_patient_phase (id)');
        $this->addSql('ALTER TABLE accard_regimen ADD CONSTRAINT FK_7E8EF59EDBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('ALTER TABLE accard_regimen ADD CONSTRAINT FK_7E8EF59E9B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_regimen_prototype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accard_regimen ADD CONSTRAINT FK_7E8EF59E8F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_regimen ADD CONSTRAINT FK_7E8EF59ED0EA680C FOREIGN KEY (diagnosisId) REFERENCES accard_diagnosis (id)');
        $this->addSql('ALTER TABLE accard_sample ADD CONSTRAINT FK_6B6E6FFAEE155AE0 FOREIGN KEY (sourceId) REFERENCES accard_sample_source (id)');
        $this->addSql('ALTER TABLE accard_sample ADD CONSTRAINT FK_6B6E6FFA9B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_sample_prototype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accard_sample ADD CONSTRAINT FK_6B6E6FFA8F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_sample_source ADD CONSTRAINT FK_5530F9C68C7A1510 FOREIGN KEY (parentSampleId) REFERENCES accard_sample (id)');
        $this->addSql('ALTER TABLE accard_sample_source ADD CONSTRAINT FK_5530F9C68F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_option_value ADD CONSTRAINT FK_96657CDDCE78B7CC FOREIGN KEY (optionId) REFERENCES accard_option (id)');
        $this->addSql('ALTER TABLE accard_drug ADD CONSTRAINT FK_89DC2B552179D01F FOREIGN KEY (genericId) REFERENCES accard_drug (id)');
        $this->addSql('ALTER TABLE accard_drugs_groups ADD CONSTRAINT FK_DAB9D6E4ED8188B0 FOREIGN KEY (groupId) REFERENCES accard_drug_group (id)');
        $this->addSql('ALTER TABLE accard_drugs_groups ADD CONSTRAINT FK_DAB9D6E4DBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('ALTER TABLE accard_patient_field ADD CONSTRAINT FK_54CED4B8CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_option (id)');
        $this->addSql('ALTER TABLE accard_patient_field_value ADD CONSTRAINT FK_E084E37081F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_patient_field_value ADD CONSTRAINT FK_E084E3708F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_patient_field_value ADD CONSTRAINT FK_E084E3705E697A44 FOREIGN KEY (fieldId) REFERENCES accard_patient_field (id)');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map ADD CONSTRAINT FK_C6EC0E8B81F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_patient_field_value (id)');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map ADD CONSTRAINT FK_C6EC0E8BE8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_codes_groups ADD CONSTRAINT FK_E9D4D81DB5FC0459 FOREIGN KEY (codeId) REFERENCES accard_diagnosis_code (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_codes_groups ADD CONSTRAINT FK_E9D4D81DED8188B0 FOREIGN KEY (groupId) REFERENCES accard_diagnosis_code_group (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_field ADD CONSTRAINT FK_AFEBBB2ECE78B7CC FOREIGN KEY (optionId) REFERENCES accard_option (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_field_value ADD CONSTRAINT FK_1EA4358F81F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_field_value ADD CONSTRAINT FK_1EA4358FD0EA680C FOREIGN KEY (diagnosisId) REFERENCES accard_diagnosis (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_field_value ADD CONSTRAINT FK_1EA4358F5E697A44 FOREIGN KEY (fieldId) REFERENCES accard_diagnosis_field (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map ADD CONSTRAINT FK_38CCD87481F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_diagnosis_field_value (id)');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map ADD CONSTRAINT FK_38CCD874E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld ADD CONSTRAINT FK_D2CFF673CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_option (id)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fldval ADD CONSTRAINT FK_8855F5A481F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fldval ADD CONSTRAINT FK_8855F5A418AE7509 FOREIGN KEY (behaviorId) REFERENCES accard_behavior (id)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fldval ADD CONSTRAINT FK_8855F5A45E697A44 FOREIGN KEY (fieldId) REFERENCES accard_bhvr_proto_fld (id)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map ADD CONSTRAINT FK_5AD23C5481F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_bhvr_proto_fldval (id)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map ADD CONSTRAINT FK_5AD23C54E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_behavior_prototype_map ADD CONSTRAINT FK_98CC21519B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_behavior_prototype (id)');
        $this->addSql('ALTER TABLE accard_behavior_prototype_map ADD CONSTRAINT FK_98CC21513E0C34EB FOREIGN KEY (subjectId) REFERENCES accard_bhvr_proto_fld (id)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld ADD CONSTRAINT FK_6C285216CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_option (id)');
        $this->addSql('ALTER TABLE accard_attr_proto_fldval ADD CONSTRAINT FK_324CF2E781F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_attr_proto_fldval ADD CONSTRAINT FK_324CF2E7ED407E17 FOREIGN KEY (attributeId) REFERENCES accard_attribute (id)');
        $this->addSql('ALTER TABLE accard_attr_proto_fldval ADD CONSTRAINT FK_324CF2E75E697A44 FOREIGN KEY (fieldId) REFERENCES accard_attr_proto_fld (id)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map ADD CONSTRAINT FK_D58BF8B981F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_attr_proto_fldval (id)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map ADD CONSTRAINT FK_D58BF8B9E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_attribute_prototype_map ADD CONSTRAINT FK_B6E609359B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_attribute_prototype (id)');
        $this->addSql('ALTER TABLE accard_attribute_prototype_map ADD CONSTRAINT FK_B6E609353E0C34EB FOREIGN KEY (subjectId) REFERENCES accard_attr_proto_fld (id)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld ADD CONSTRAINT FK_D7ABA2F3CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_option (id)');
        $this->addSql('ALTER TABLE accard_sample_proto_fldval ADD CONSTRAINT FK_FD68D33081F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_sample_proto_fldval ADD CONSTRAINT FK_FD68D330730CE27D FOREIGN KEY (sampleId) REFERENCES accard_sample (id)');
        $this->addSql('ALTER TABLE accard_sample_proto_fldval ADD CONSTRAINT FK_FD68D3305E697A44 FOREIGN KEY (fieldId) REFERENCES accard_sample_proto_fld (id)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma ADD CONSTRAINT FK_9CECBE0481F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_sample_proto_fldval (id)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma ADD CONSTRAINT FK_9CECBE04E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_sample_prototype_map ADD CONSTRAINT FK_B953D8249B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_sample_prototype (id)');
        $this->addSql('ALTER TABLE accard_sample_prototype_map ADD CONSTRAINT FK_B953D8243E0C34EB FOREIGN KEY (subjectId) REFERENCES accard_sample_proto_fld (id)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld ADD CONSTRAINT FK_E62A5851CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_option (id)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fldval ADD CONSTRAINT FK_5378E08E81F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fldval ADD CONSTRAINT FK_5378E08E85CA7E31 FOREIGN KEY (regimenId) REFERENCES accard_regimen (id)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fldval ADD CONSTRAINT FK_5378E08E5E697A44 FOREIGN KEY (fieldId) REFERENCES accard_regimen_proto_fld (id)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m ADD CONSTRAINT FK_CCCE7B6381F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_regimen_proto_fldval (id)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m ADD CONSTRAINT FK_CCCE7B63E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_regimen_prototype ADD CONSTRAINT FK_1713F9E8A67C4099 FOREIGN KEY (drugGroupId) REFERENCES accard_drug_group (id)');
        $this->addSql('ALTER TABLE accard_regimen_prototype_map ADD CONSTRAINT FK_9524569C9B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_regimen_prototype (id)');
        $this->addSql('ALTER TABLE accard_regimen_prototype_map ADD CONSTRAINT FK_9524569C3E0C34EB FOREIGN KEY (subjectId) REFERENCES accard_regimen_proto_fld (id)');
        $this->addSql('ALTER TABLE accard_regimen_activity_map ADD CONSTRAINT FK_447DEB5B2B242F3D FOREIGN KEY (activityPrototypeId) REFERENCES accard_regimen_prototype (id)');
        $this->addSql('ALTER TABLE accard_regimen_activity_map ADD CONSTRAINT FK_447DEB5B438AD5F2 FOREIGN KEY (regimenPrototypeId) REFERENCES accard_activity_prototype (id)');
        $this->addSql('ALTER TABLE accard_activity_proto_fld ADD CONSTRAINT FK_81052DA5CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_option (id)');
        $this->addSql('ALTER TABLE accard_activity_proto_fldval ADD CONSTRAINT FK_182C8B0F81F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_activity_proto_fldval ADD CONSTRAINT FK_182C8B0F1335E2FC FOREIGN KEY (activityId) REFERENCES accard_activity (id)');
        $this->addSql('ALTER TABLE accard_activity_proto_fldval ADD CONSTRAINT FK_182C8B0F5E697A44 FOREIGN KEY (fieldId) REFERENCES accard_activity_proto_fld (id)');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ ADD CONSTRAINT FK_359EDC7181F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_activity_proto_fldval (id)');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ ADD CONSTRAINT FK_359EDC71E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('ALTER TABLE accard_activity_prototype ADD CONSTRAINT FK_703C8C1CA67C4099 FOREIGN KEY (drugGroupId) REFERENCES accard_drug_group (id)');
        $this->addSql('ALTER TABLE accard_activity_prototype_map ADD CONSTRAINT FK_FD0B1419B116E9A FOREIGN KEY (prototypeId) REFERENCES accard_activity_prototype (id)');
        $this->addSql('ALTER TABLE accard_activity_prototype_map ADD CONSTRAINT FK_FD0B1413E0C34EB FOREIGN KEY (subjectId) REFERENCES accard_activity_proto_fld (id)');
    }

    /**
     * Down from 1.0.0 to 0.0.0.
     *
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->assertPlatform();

        $this->addSql('ALTER TABLE lexik_trans_unit_translation DROP CONSTRAINT FK_75CB162F93CB796C');
        $this->addSql('ALTER TABLE lexik_trans_unit_translation DROP CONSTRAINT FK_75CB162FC3C583C9');
        $this->addSql('ALTER TABLE accard_activity_proto_fldval DROP CONSTRAINT FK_182C8B0F1335E2FC');
        $this->addSql('ALTER TABLE accard_attr_proto_fldval DROP CONSTRAINT FK_324CF2E7ED407E17');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fldval DROP CONSTRAINT FK_8855F5A418AE7509');
        $this->addSql('ALTER TABLE accard_activity DROP CONSTRAINT FK_C69BB645D0EA680C');
        $this->addSql('ALTER TABLE accard_diagnosis DROP CONSTRAINT FK_F3B3ED7710EE4CEE');
        $this->addSql('ALTER TABLE accard_diagnosis DROP CONSTRAINT FK_F3B3ED777BB601C');
        $this->addSql('ALTER TABLE accard_diagnosis_phase_inst DROP CONSTRAINT FK_F09D7DB9158E0B66');
        $this->addSql('ALTER TABLE accard_regimen DROP CONSTRAINT FK_7E8EF59ED0EA680C');
        $this->addSql('ALTER TABLE accard_diagnosis_field_value DROP CONSTRAINT FK_1EA4358FD0EA680C');
        $this->addSql('ALTER TABLE accard_diagnosis_phase_inst DROP CONSTRAINT FK_F09D7DB999091188');
        $this->addSql('ALTER TABLE accard_patient DROP CONSTRAINT FK_45453AFA39659675');
        $this->addSql('ALTER TABLE accard_activity DROP CONSTRAINT FK_C69BB6458F803478');
        $this->addSql('ALTER TABLE accard_attribute DROP CONSTRAINT FK_77180DB18F803478');
        $this->addSql('ALTER TABLE accard_behavior DROP CONSTRAINT FK_51441FAF8F803478');
        $this->addSql('ALTER TABLE accard_diagnosis DROP CONSTRAINT FK_F3B3ED778F803478');
        $this->addSql('ALTER TABLE accard_patient_phase_inst DROP CONSTRAINT FK_450F421158E0B66');
        $this->addSql('ALTER TABLE accard_regimen DROP CONSTRAINT FK_7E8EF59E8F803478');
        $this->addSql('ALTER TABLE accard_sample DROP CONSTRAINT FK_6B6E6FFA8F803478');
        $this->addSql('ALTER TABLE accard_sample_source DROP CONSTRAINT FK_5530F9C68F803478');
        $this->addSql('ALTER TABLE accard_patient_field_value DROP CONSTRAINT FK_E084E3708F803478');
        $this->addSql('ALTER TABLE accard_patient_phase_inst DROP CONSTRAINT FK_450F42199091188');
        $this->addSql('ALTER TABLE accard_activity DROP CONSTRAINT FK_C69BB64585CA7E31');
        $this->addSql('ALTER TABLE accard_regimen_proto_fldval DROP CONSTRAINT FK_5378E08E85CA7E31');
        $this->addSql('ALTER TABLE accard_sample_source DROP CONSTRAINT FK_5530F9C68C7A1510');
        $this->addSql('ALTER TABLE accard_sample_proto_fldval DROP CONSTRAINT FK_FD68D330730CE27D');
        $this->addSql('ALTER TABLE accard_sample DROP CONSTRAINT FK_6B6E6FFAEE155AE0');
        $this->addSql('ALTER TABLE accard_option_value DROP CONSTRAINT FK_96657CDDCE78B7CC');
        $this->addSql('ALTER TABLE accard_patient_field DROP CONSTRAINT FK_54CED4B8CE78B7CC');
        $this->addSql('ALTER TABLE accard_diagnosis_field DROP CONSTRAINT FK_AFEBBB2ECE78B7CC');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld DROP CONSTRAINT FK_D2CFF673CE78B7CC');
        $this->addSql('ALTER TABLE accard_attr_proto_fld DROP CONSTRAINT FK_6C285216CE78B7CC');
        $this->addSql('ALTER TABLE accard_sample_proto_fld DROP CONSTRAINT FK_D7ABA2F3CE78B7CC');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld DROP CONSTRAINT FK_E62A5851CE78B7CC');
        $this->addSql('ALTER TABLE accard_activity_proto_fld DROP CONSTRAINT FK_81052DA5CE78B7CC');
        $this->addSql('ALTER TABLE accard_patient_field_value DROP CONSTRAINT FK_E084E37081F9A87C');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP CONSTRAINT FK_C6EC0E8BE8ED26A9');
        $this->addSql('ALTER TABLE accard_diagnosis_field_value DROP CONSTRAINT FK_1EA4358F81F9A87C');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP CONSTRAINT FK_38CCD874E8ED26A9');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fldval DROP CONSTRAINT FK_8855F5A481F9A87C');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP CONSTRAINT FK_5AD23C54E8ED26A9');
        $this->addSql('ALTER TABLE accard_attr_proto_fldval DROP CONSTRAINT FK_324CF2E781F9A87C');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP CONSTRAINT FK_D58BF8B9E8ED26A9');
        $this->addSql('ALTER TABLE accard_sample_proto_fldval DROP CONSTRAINT FK_FD68D33081F9A87C');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP CONSTRAINT FK_9CECBE04E8ED26A9');
        $this->addSql('ALTER TABLE accard_regimen_proto_fldval DROP CONSTRAINT FK_5378E08E81F9A87C');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP CONSTRAINT FK_CCCE7B63E8ED26A9');
        $this->addSql('ALTER TABLE accard_activity_proto_fldval DROP CONSTRAINT FK_182C8B0F81F9A87C');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP CONSTRAINT FK_359EDC71E8ED26A9');
        $this->addSql('ALTER TABLE accard_activity DROP CONSTRAINT FK_C69BB645DBA88346');
        $this->addSql('ALTER TABLE accard_regimen DROP CONSTRAINT FK_7E8EF59EDBA88346');
        $this->addSql('ALTER TABLE accard_drug DROP CONSTRAINT FK_89DC2B552179D01F');
        $this->addSql('ALTER TABLE accard_drugs_groups DROP CONSTRAINT FK_DAB9D6E4DBA88346');
        $this->addSql('ALTER TABLE accard_drugs_groups DROP CONSTRAINT FK_DAB9D6E4ED8188B0');
        $this->addSql('ALTER TABLE accard_regimen_prototype DROP CONSTRAINT FK_1713F9E8A67C4099');
        $this->addSql('ALTER TABLE accard_activity_prototype DROP CONSTRAINT FK_703C8C1CA67C4099');
        $this->addSql('ALTER TABLE accard_patient_field_value DROP CONSTRAINT FK_E084E3705E697A44');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP CONSTRAINT FK_C6EC0E8B81F9A87C');
        $this->addSql('ALTER TABLE accard_diagnosis DROP CONSTRAINT FK_F3B3ED77B5FC0459');
        $this->addSql('ALTER TABLE accard_diagnosis_codes_groups DROP CONSTRAINT FK_E9D4D81DB5FC0459');
        $this->addSql('ALTER TABLE accard_diagnosis_codes_groups DROP CONSTRAINT FK_E9D4D81DED8188B0');
        $this->addSql('ALTER TABLE accard_diagnosis_field_value DROP CONSTRAINT FK_1EA4358F5E697A44');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP CONSTRAINT FK_38CCD87481F9A87C');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fldval DROP CONSTRAINT FK_8855F5A45E697A44');
        $this->addSql('ALTER TABLE accard_behavior_prototype_map DROP CONSTRAINT FK_98CC21513E0C34EB');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP CONSTRAINT FK_5AD23C5481F9A87C');
        $this->addSql('ALTER TABLE accard_behavior DROP CONSTRAINT FK_51441FAF9B116E9A');
        $this->addSql('ALTER TABLE accard_behavior_prototype_map DROP CONSTRAINT FK_98CC21519B116E9A');
        $this->addSql('ALTER TABLE accard_attr_proto_fldval DROP CONSTRAINT FK_324CF2E75E697A44');
        $this->addSql('ALTER TABLE accard_attribute_prototype_map DROP CONSTRAINT FK_B6E609353E0C34EB');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP CONSTRAINT FK_D58BF8B981F9A87C');
        $this->addSql('ALTER TABLE accard_attribute DROP CONSTRAINT FK_77180DB19B116E9A');
        $this->addSql('ALTER TABLE accard_attribute_prototype_map DROP CONSTRAINT FK_B6E609359B116E9A');
        $this->addSql('ALTER TABLE accard_sample_proto_fldval DROP CONSTRAINT FK_FD68D3305E697A44');
        $this->addSql('ALTER TABLE accard_sample_prototype_map DROP CONSTRAINT FK_B953D8243E0C34EB');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP CONSTRAINT FK_9CECBE0481F9A87C');
        $this->addSql('ALTER TABLE accard_sample DROP CONSTRAINT FK_6B6E6FFA9B116E9A');
        $this->addSql('ALTER TABLE accard_sample_prototype_map DROP CONSTRAINT FK_B953D8249B116E9A');
        $this->addSql('ALTER TABLE accard_regimen_proto_fldval DROP CONSTRAINT FK_5378E08E5E697A44');
        $this->addSql('ALTER TABLE accard_regimen_prototype_map DROP CONSTRAINT FK_9524569C3E0C34EB');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP CONSTRAINT FK_CCCE7B6381F9A87C');
        $this->addSql('ALTER TABLE accard_regimen DROP CONSTRAINT FK_7E8EF59E9B116E9A');
        $this->addSql('ALTER TABLE accard_regimen_prototype_map DROP CONSTRAINT FK_9524569C9B116E9A');
        $this->addSql('ALTER TABLE accard_regimen_activity_map DROP CONSTRAINT FK_447DEB5B2B242F3D');
        $this->addSql('ALTER TABLE accard_activity_proto_fldval DROP CONSTRAINT FK_182C8B0F5E697A44');
        $this->addSql('ALTER TABLE accard_activity_prototype_map DROP CONSTRAINT FK_FD0B1413E0C34EB');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP CONSTRAINT FK_359EDC7181F9A87C');
        $this->addSql('ALTER TABLE accard_activity DROP CONSTRAINT FK_C69BB6459B116E9A');
        $this->addSql('ALTER TABLE accard_regimen_activity_map DROP CONSTRAINT FK_447DEB5B438AD5F2');
        $this->addSql('ALTER TABLE accard_activity_prototype_map DROP CONSTRAINT FK_FD0B1419B116E9A');
        $this->addSql('ALTER TABLE dag_log DROP CONSTRAINT FK_2AC893464B64DCC');
        $this->addSql('DROP SEQUENCE accard_template_id_seq');
        $this->addSql('DROP SEQUENCE ext_log_entries_id_seq');
        $this->addSql('DROP SEQUENCE dag_log_id_seq');
        $this->addSql('DROP SEQUENCE accard_setting_id_seq');
        $this->addSql('DROP SEQUENCE accard_activity_id_seq');
        $this->addSql('DROP SEQUENCE accard_attribute_id_seq');
        $this->addSql('DROP SEQUENCE accard_behavior_id_seq');
        $this->addSql('DROP SEQUENCE accard_diagnosis_id_seq');
        $this->addSql('DROP SEQUENCE accard_diagnosis_phase_id_seq');
        $this->addSql('DROP SEQUENCE accard_diagnosis_phase_instanc');
        $this->addSql('DROP SEQUENCE accard_patient_id_seq');
        $this->addSql('DROP SEQUENCE accard_patient_phase_id_seq');
        $this->addSql('DROP SEQUENCE accard_patient_phase_instance_');
        $this->addSql('DROP SEQUENCE accard_regimen_id_seq');
        $this->addSql('DROP SEQUENCE accard_sample_id_seq');
        $this->addSql('DROP SEQUENCE accard_sample_source_id_seq');
        $this->addSql('DROP SEQUENCE accard_option_id_seq');
        $this->addSql('DROP SEQUENCE accard_option_value_id_seq');
        $this->addSql('DROP SEQUENCE accard_drug_id_seq');
        $this->addSql('DROP SEQUENCE accard_drug_group_id_seq');
        $this->addSql('DROP SEQUENCE accard_patient_field_id_seq');
        $this->addSql('DROP SEQUENCE accard_patient_field_value_id_');
        $this->addSql('DROP SEQUENCE accard_diagnosis_code_id_seq');
        $this->addSql('DROP SEQUENCE accard_diagnosis_code_group_id');
        $this->addSql('DROP SEQUENCE accard_diagnosis_field_id_seq');
        $this->addSql('DROP SEQUENCE accard_diagnosis_field_value_i');
        $this->addSql('DROP SEQUENCE accard_behavior_prototype_fiel');
        $this->addSql('DROP SEQUENCE accard_behavior_prototype_id_s');
        $this->addSql('DROP SEQUENCE accard_attribute_prototype_fie');
        $this->addSql('DROP SEQUENCE accard_attribute_prototype_id_');
        $this->addSql('DROP SEQUENCE accard_sample_prototype_field_');
        $this->addSql('DROP SEQUENCE accard_sample_prototype_id_seq');
        $this->addSql('DROP SEQUENCE accard_regimen_prototype_field');
        $this->addSql('DROP SEQUENCE accard_regimen_prototype_id_se');
        $this->addSql('DROP SEQUENCE accard_activity_prototype_fiel');
        $this->addSql('DROP SEQUENCE accard_activity_prototype_id_s');
        $this->addSql('DROP SEQUENCE lexik_translation_file_id_seq');
        $this->addSql('DROP SEQUENCE lexik_trans_unit_t_id_seq');
        $this->addSql('DROP SEQUENCE lexik_trans_unit_id_seq');
        $this->addSql('DROP TRIGGER lexik_translation_file_ai_pk');
        $this->addSql('DROP TRIGGER lexik_trans_unit_t_ai_pk');
        $this->addSql('DROP TRIGGER lexik_trans_unit_ai_pk');
        $this->addSql('DROP TABLE accard_template');
        $this->addSql('DROP TABLE lexik_translation_file');
        $this->addSql('DROP TABLE lexik_trans_unit_translation');
        $this->addSql('DROP TABLE lexik_trans_unit');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE dag_log');
        $this->addSql('DROP TABLE accard_setting');
        $this->addSql('DROP TABLE accard_activity');
        $this->addSql('DROP TABLE accard_attribute');
        $this->addSql('DROP TABLE accard_behavior');
        $this->addSql('DROP TABLE accard_diagnosis');
        $this->addSql('DROP TABLE accard_diagnosis_phase');
        $this->addSql('DROP TABLE accard_diagnosis_phase_inst');
        $this->addSql('DROP TABLE accard_patient');
        $this->addSql('DROP TABLE accard_patient_phase');
        $this->addSql('DROP TABLE accard_patient_phase_inst');
        $this->addSql('DROP TABLE accard_regimen');
        $this->addSql('DROP TABLE accard_sample');
        $this->addSql('DROP TABLE accard_sample_source');
        $this->addSql('DROP TABLE accard_option');
        $this->addSql('DROP TABLE accard_option_value');
        $this->addSql('DROP TABLE accard_drug');
        $this->addSql('DROP TABLE accard_drug_group');
        $this->addSql('DROP TABLE accard_drugs_groups');
        $this->addSql('DROP TABLE accard_patient_field');
        $this->addSql('DROP TABLE accard_patient_field_value');
        $this->addSql('DROP TABLE accard_patient_fld_opt_map');
        $this->addSql('DROP TABLE accard_diagnosis_code');
        $this->addSql('DROP TABLE accard_diagnosis_codes_groups');
        $this->addSql('DROP TABLE accard_diagnosis_code_group');
        $this->addSql('DROP TABLE accard_diagnosis_field');
        $this->addSql('DROP TABLE accard_diagnosis_field_value');
        $this->addSql('DROP TABLE accard_diagnosis_fld_opt_map');
        $this->addSql('DROP TABLE accard_bhvr_proto_fld');
        $this->addSql('DROP TABLE accard_bhvr_proto_fldval');
        $this->addSql('DROP TABLE accard_bhvr_proto_fld_opt_map');
        $this->addSql('DROP TABLE accard_behavior_prototype');
        $this->addSql('DROP TABLE accard_behavior_prototype_map');
        $this->addSql('DROP TABLE accard_attr_proto_fld');
        $this->addSql('DROP TABLE accard_attr_proto_fldval');
        $this->addSql('DROP TABLE accard_attr_proto_fld_opt_map');
        $this->addSql('DROP TABLE accard_attribute_prototype');
        $this->addSql('DROP TABLE accard_attribute_prototype_map');
        $this->addSql('DROP TABLE accard_sample_proto_fld');
        $this->addSql('DROP TABLE accard_sample_proto_fldval');
        $this->addSql('DROP TABLE accard_sample_proto_fld_opt_ma');
        $this->addSql('DROP TABLE accard_sample_prototype');
        $this->addSql('DROP TABLE accard_sample_prototype_map');
        $this->addSql('DROP TABLE accard_regimen_proto_fld');
        $this->addSql('DROP TABLE accard_regimen_proto_fldval');
        $this->addSql('DROP TABLE accard_regimen_proto_fld_opt_m');
        $this->addSql('DROP TABLE accard_regimen_prototype');
        $this->addSql('DROP TABLE accard_regimen_prototype_map');
        $this->addSql('DROP TABLE accard_regimen_activity_map');
        $this->addSql('DROP TABLE accard_activity_proto_fld');
        $this->addSql('DROP TABLE accard_activity_proto_fldval');
        $this->addSql('DROP TABLE accard_activity_proto_fld_opt_');
        $this->addSql('DROP TABLE accard_activity_prototype');
        $this->addSql('DROP TABLE accard_activity_prototype_map');
        $this->addSql('DROP TABLE dag_user');
    }

    /**
     * Inserts default data into required tables.
     */
    private function addDiagnosisGroups()
    {
        $em = $this->container->get('accard.manager.diagnosis_code_group');

        $mainGroup = new CodeGroup();
        $mainGroup->setName('main');
        $mainGroup->setPresentation('Main');

        $em->persist($mainGroup);
        $em->flush();
    }

    /**
     * Insert default users into tables.
     */
    private function addUsers()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $roles = array('ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPERUSER');
        $users = array(
            '10209669' => 'bardonf',
            '76165519' => 'wwormley',
            '10074769' => 'vasur',
            '79888556' => 'kzipser',
        );

        foreach ($users as $id => $pennkey) {
            $user = new User();
            $user->setId($id);
            $user->setUsername($pennkey);
            $user->setRoles($roles);

            $em->persist($user);
        }

        $em->flush();
    }


    /**
     * Kill migration if playform is not Oracle.
     *
     * @throws Exception If platform doesn't match.
     */
    private function assertPlatform()
    {
        $platform = $this->platform->getName();

        $this->abortIf($platform != 'oracle', 'Migration can only be executed safely on oracle.');
    }
}
