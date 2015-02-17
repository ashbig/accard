<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150217181111 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('CREATE SEQUENCE accard_template_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_log_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_diagnosis_phase_instanc START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_patient_phase_instance_ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE accard_template (id NUMBER(10) NOT NULL, parent VARCHAR2(180) DEFAULT NULL NULL, name VARCHAR2(200) NOT NULL, location VARCHAR2(200) NOT NULL, content CLOB NOT NULL, PRIMARY KEY(id))');
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
        $this->addSql('CREATE SEQUENCE LEXIK_TRANSLATION_FILE_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TRIGGER LEXIK_TRANSLATION_FILE_AI_PK
           BEFORE INSERT
           ON LEXIK_TRANSLATION_FILE
           FOR EACH ROW
        DECLARE
           last_Sequence NUMBER;
           last_InsertID NUMBER;
        BEGIN
           SELECT LEXIK_TRANSLATION_FILE_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           IF (:NEW.ID IS NULL OR :NEW.ID = 0) THEN
              SELECT LEXIK_TRANSLATION_FILE_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           ELSE
              SELECT NVL(Last_Number, 0) INTO last_Sequence
                FROM User_Sequences
               WHERE Sequence_Name = \'LEXIK_TRANSLATION_FILE_SEQ\';
              SELECT :NEW.ID INTO last_InsertID FROM DUAL;
              WHILE (last_InsertID > last_Sequence) LOOP
                 SELECT LEXIK_TRANSLATION_FILE_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
              END LOOP;
           END IF;
        END;');
        $this->addSql('CREATE UNIQUE INDEX hash_idx ON lexik_translation_file (hash)');
        $this->addSql('CREATE TABLE lexik_trans_unit_translation (id NUMBER(10) NOT NULL, file_id NUMBER(10) DEFAULT NULL NULL, trans_unit_id NUMBER(10) DEFAULT NULL NULL, locale VARCHAR2(10) NOT NULL, content CLOB NOT NULL, created_at TIMESTAMP(0) DEFAULT NULL NULL, updated_at TIMESTAMP(0) DEFAULT NULL NULL, PRIMARY KEY(id))');
        $this->addSql('DECLARE
          constraints_Count NUMBER;
        BEGIN
          SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = \'LEXIK_TRANS_UNIT_TRANSLATION\' AND CONSTRAINT_TYPE = \'P\';
          IF constraints_Count = 0 OR constraints_Count = \'\' THEN
            EXECUTE IMMEDIATE \'ALTER TABLE LEXIK_TRANS_UNIT_TRANSLATION ADD CONSTRAINT LEXIK_TRANS_UNIT_TRANS_AI_PK PRIMARY KEY (ID)\';
          END IF;
        END;');
        $this->addSql('CREATE SEQUENCE LEXIK_TRANS_UNIT_TRANS_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TRIGGER LEXIK_TRANS_UNIT_TRANS_AI_PK
           BEFORE INSERT
           ON LEXIK_TRANS_UNIT_TRANSLATION
           FOR EACH ROW
        DECLARE
           last_Sequence NUMBER;
           last_InsertID NUMBER;
        BEGIN
           SELECT LEXIK_TRANS_UNIT_TRANS_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           IF (:NEW.ID IS NULL OR :NEW.ID = 0) THEN
              SELECT LEXIK_TRANS_UNIT_TRANS_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           ELSE
              SELECT NVL(Last_Number, 0) INTO last_Sequence
                FROM User_Sequences
               WHERE Sequence_Name = \'LEXIK_TRANS_UNIT_TRANS_SEQ\';
              SELECT :NEW.ID INTO last_InsertID FROM DUAL;
              WHILE (last_InsertID > last_Sequence) LOOP
                 SELECT LEXIK_TRANS_UNIT_TRANS_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
              END LOOP;
           END IF;
        END;');
        $this->addSql('CREATE INDEX IDX_75CB162F93CB796C ON lexik_trans_unit_translation (file_id)');
        $this->addSql('CREATE INDEX IDX_75CB162FC3C583C9 ON lexik_trans_unit_translation (trans_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX trans_unit_locale_idx ON lexik_trans_unit_translation (trans_unit_id, locale)');
        $this->addSql('CREATE TABLE lexik_trans_unit (id NUMBER(10) NOT NULL, key_name VARCHAR2(255) NOT NULL, domain VARCHAR2(255) NOT NULL, created_at TIMESTAMP(0) DEFAULT NULL NULL, updated_at TIMESTAMP(0) DEFAULT NULL NULL, PRIMARY KEY(id))');
        $this->addSql('DECLARE
          constraints_Count NUMBER;
        BEGIN
          SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = \'LEXIK_TRANS_UNIT\' AND CONSTRAINT_TYPE = \'P\';
          IF constraints_Count = 0 OR constraints_Count = \'\' THEN
            EXECUTE IMMEDIATE \'ALTER TABLE LEXIK_TRANS_UNIT ADD CONSTRAINT LEXIK_TRANS_UNIT_AI_PK PRIMARY KEY (ID)\';
          END IF;
        END;');
        $this->addSql('CREATE SEQUENCE LEXIK_TRANS_UNIT_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TRIGGER LEXIK_TRANS_UNIT_AI_PK
           BEFORE INSERT
           ON LEXIK_TRANS_UNIT
           FOR EACH ROW
        DECLARE
           last_Sequence NUMBER;
           last_InsertID NUMBER;
        BEGIN
           SELECT LEXIK_TRANS_UNIT_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           IF (:NEW.ID IS NULL OR :NEW.ID = 0) THEN
              SELECT LEXIK_TRANS_UNIT_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           ELSE
              SELECT NVL(Last_Number, 0) INTO last_Sequence
                FROM User_Sequences
               WHERE Sequence_Name = \'LEXIK_TRANS_UNIT_SEQ\';
              SELECT :NEW.ID INTO last_InsertID FROM DUAL;
              WHILE (last_InsertID > last_Sequence) LOOP
                 SELECT LEXIK_TRANS_UNIT_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
              END LOOP;
           END IF;
        END;');
        $this->addSql('CREATE UNIQUE INDEX key_domain_idx ON lexik_trans_unit (key_name, domain)');
        $this->addSql('CREATE TABLE accard_log (id NUMBER(10) NOT NULL, logDate TIMESTAMP(0) NOT NULL, action VARCHAR2(16) NOT NULL, "resource" VARCHAR2(32) NOT NULL, resourceId NUMBER(10) DEFAULT NULL NULL, route VARCHAR2(100) NOT NULL, attributes CLOB DEFAULT NULL NULL, query CLOB DEFAULT NULL NULL, request CLOB DEFAULT NULL NULL, userId NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2AC893464B64DCC ON accard_log (userId)');
        $this->addSql('COMMENT ON COLUMN accard_log.attributes IS \'(DC2Type:json_array)\'');
        $this->addSql('COMMENT ON COLUMN accard_log.query IS \'(DC2Type:json_array)\'');
        $this->addSql('COMMENT ON COLUMN accard_log.request IS \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE lexik_trans_unit_translation ADD CONSTRAINT FK_75CB162F93CB796C FOREIGN KEY (file_id) REFERENCES lexik_translation_file (id)');
        $this->addSql('ALTER TABLE lexik_trans_unit_translation ADD CONSTRAINT FK_75CB162FC3C583C9 FOREIGN KEY (trans_unit_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE accard_log ADD CONSTRAINT FK_2AC893464B64DCC FOREIGN KEY (userId) REFERENCES dag_user (id)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_PHASE_INST ADD (id NUMBER(10) NOT NULL)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_PHASE_INST MODIFY (phase_id NUMBER(10) DEFAULT NULL NULL, target_id NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_PHASE_INST DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_PHASE_INST ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_PHASE_INST ADD (id NUMBER(10) NOT NULL)');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_PHASE_INST MODIFY (phase_id NUMBER(10) DEFAULT NULL NULL, target_id NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_PHASE_INST DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_PHASE_INST ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('ALTER TABLE lexik_trans_unit_translation DROP CONSTRAINT FK_75CB162F93CB796C');
        $this->addSql('ALTER TABLE lexik_trans_unit_translation DROP CONSTRAINT FK_75CB162FC3C583C9');
        $this->addSql('DROP SEQUENCE accard_template_id_seq');
        $this->addSql('DROP SEQUENCE accard_log_id_seq');
        $this->addSql('DROP SEQUENCE accard_diagnosis_phase_instanc');
        $this->addSql('DROP SEQUENCE accard_patient_phase_instance_');
        $this->addSql('DROP TABLE accard_template');
        $this->addSql('DROP TABLE lexik_translation_file');
        $this->addSql('DROP TABLE lexik_trans_unit_translation');
        $this->addSql('DROP TABLE lexik_trans_unit');
        $this->addSql('DROP TABLE accard_log');
        $this->addSql('ALTER TABLE accard_diagnosis_phase_inst MODIFY (TARGET_ID NUMBER(10) NOT NULL, PHASE_ID NUMBER(10) NOT NULL)');
        $this->addSql('ALTER TABLE accard_diagnosis_phase_inst DROP (id)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_PHASE_INST DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_diagnosis_phase_inst ADD PRIMARY KEY (TARGET_ID, PHASE_ID)');
        $this->addSql('ALTER TABLE accard_patient_phase_inst MODIFY (TARGET_ID NUMBER(10) NOT NULL, PHASE_ID NUMBER(10) NOT NULL)');
        $this->addSql('ALTER TABLE accard_patient_phase_inst DROP (id)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_PHASE_INST DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_patient_phase_inst ADD PRIMARY KEY (TARGET_ID, PHASE_ID)');
    }
}
