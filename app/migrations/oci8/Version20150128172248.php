<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150128172248 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('CREATE SEQUENCE accard_canvas_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE accard_canvas (id NUMBER(10) NOT NULL, route VARCHAR2(255) NOT NULL, grid CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN accard_canvas.grid IS \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY MODIFY (activityDate DATE DEFAULT NULL)');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FIELD ADD (addable NUMBER(1) DEFAULT \'0\' NOT NULL)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FIELD ADD (addable NUMBER(1) DEFAULT \'0\' NOT NULL)');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD ADD (addable NUMBER(1) DEFAULT \'0\' NOT NULL)');
        $this->addSql('ALTER TABLE ACCARD_BEHAVIOR_PROTOTYPE ADD (description VARCHAR2(255) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD ADD (addable NUMBER(1) DEFAULT \'0\' NOT NULL)');
        $this->addSql('ALTER TABLE ACCARD_ATTRIBUTE_PROTOTYPE ADD (description VARCHAR2(255) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD ADD (addable NUMBER(1) DEFAULT \'0\' NOT NULL)');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTOTYPE ADD (description VARCHAR2(255) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD ADD (addable NUMBER(1) DEFAULT \'0\' NOT NULL)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTOTYPE ADD (description VARCHAR2(255) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD ADD (addable NUMBER(1) DEFAULT \'0\' NOT NULL)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTOTYPE ADD (description VARCHAR2(255) DEFAULT NULL NULL)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('DROP SEQUENCE accard_canvas_id_seq');
        $this->addSql('DROP TABLE accard_canvas');
        $this->addSql('ALTER TABLE accard_patient_field DROP (addable)');
        $this->addSql('ALTER TABLE accard_diagnosis_field DROP (addable)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld DROP (addable)');
        $this->addSql('ALTER TABLE accard_behavior_prototype DROP (description)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld DROP (addable)');
        $this->addSql('ALTER TABLE accard_attribute_prototype DROP (description)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld DROP (addable)');
        $this->addSql('ALTER TABLE accard_sample_prototype DROP (description)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld DROP (addable)');
        $this->addSql('ALTER TABLE accard_regimen_prototype DROP (description)');
        $this->addSql('ALTER TABLE accard_activity_proto_fld DROP (addable)');
        $this->addSql('ALTER TABLE accard_activity_prototype DROP (description)');
    }
}
