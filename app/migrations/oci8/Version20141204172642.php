<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141204172642 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('ALTER TABLE ACCARD_ACTIVITY MODIFY (activityDate DATE DEFAULT NULL)');
        $this->addSql('ALTER TABLE ACCARD_IMPORT_ACTIVITY MODIFY (activityDate DATE DEFAULT NULL)');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP DROP CONSTRAINT FK_C6EC0E8BCE78B7CC');
        $this->addSql('DROP INDEX idx_c6ec0e8bce78b7cc');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP RENAME COLUMN optionid TO fieldId');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP ADD CONSTRAINT FK_C6EC0E8B5E697A44 FOREIGN KEY (fieldId) REFERENCES accard_patient_field_value (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C6EC0E8B5E697A44 ON ACCARD_PATIENT_FLD_OPT_MAP (fieldId)');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP DROP CONSTRAINT FK_38CCD874CE78B7CC');
        $this->addSql('DROP INDEX idx_38ccd874ce78b7cc');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP RENAME COLUMN optionid TO fieldId');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP ADD CONSTRAINT FK_38CCD8745E697A44 FOREIGN KEY (fieldId) REFERENCES accard_diagnosis_field_value (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_38CCD8745E697A44 ON ACCARD_DIAGNOSIS_FLD_OPT_MAP (fieldId)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP DROP CONSTRAINT FK_5AD23C54CE78B7CC');
        $this->addSql('DROP INDEX idx_5ad23c54ce78b7cc');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP RENAME COLUMN optionid TO fieldId');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP ADD CONSTRAINT FK_5AD23C545E697A44 FOREIGN KEY (fieldId) REFERENCES accard_bhvr_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_5AD23C545E697A44 ON ACCARD_BHVR_PROTO_FLD_OPT_MAP (fieldId)');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP DROP CONSTRAINT FK_D58BF8B9CE78B7CC');
        $this->addSql('DROP INDEX idx_d58bf8b9ce78b7cc');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP RENAME COLUMN optionid TO fieldId');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP ADD CONSTRAINT FK_D58BF8B95E697A44 FOREIGN KEY (fieldId) REFERENCES accard_attr_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_D58BF8B95E697A44 ON ACCARD_ATTR_PROTO_FLD_OPT_MAP (fieldId)');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA DROP CONSTRAINT FK_9CECBE04CE78B7CC');
        $this->addSql('DROP INDEX idx_9cecbe04ce78b7cc');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA RENAME COLUMN optionid TO fieldId');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA ADD CONSTRAINT FK_9CECBE045E697A44 FOREIGN KEY (fieldId) REFERENCES accard_sample_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_9CECBE045E697A44 ON ACCARD_SAMPLE_PROTO_FLD_OPT_MA (fieldId)');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M DROP CONSTRAINT FK_CCCE7B63CE78B7CC');
        $this->addSql('DROP INDEX idx_ccce7b63ce78b7cc');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M RENAME COLUMN optionid TO fieldId');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M ADD CONSTRAINT FK_CCCE7B635E697A44 FOREIGN KEY (fieldId) REFERENCES accard_regimen_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_CCCE7B635E697A44 ON ACCARD_REGIMEN_PROTO_FLD_OPT_M (fieldId)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTOTYPE MODIFY (allowDrug NUMBER(1) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ DROP CONSTRAINT FK_359EDC71CE78B7CC');
        $this->addSql('DROP INDEX idx_359edc71ce78b7cc');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ RENAME COLUMN optionid TO fieldId');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ ADD CONSTRAINT FK_359EDC715E697A44 FOREIGN KEY (fieldId) REFERENCES accard_activity_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_359EDC715E697A44 ON ACCARD_ACTIVITY_PROTO_FLD_OPT_ (fieldId)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTOTYPE MODIFY (allowDrug NUMBER(1) DEFAULT NULL NULL)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('ALTER TABLE accard_activity MODIFY (ACTIVITYDATE TIMESTAMP(0) DEFAULT NULL)');
        $this->addSql('ALTER TABLE accard_import_activity MODIFY (ACTIVITYDATE TIMESTAMP(0) DEFAULT NULL)');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP CONSTRAINT FK_C6EC0E8B5E697A44');
        $this->addSql('DROP INDEX IDX_C6EC0E8B5E697A44');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map RENAME COLUMN fieldid TO OPTIONID');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map ADD CONSTRAINT FK_C6EC0E8BCE78B7CC FOREIGN KEY (OPTIONID) REFERENCES ACCARD_PATIENT_FIELD_VALUE (ID)');
        $this->addSql('CREATE INDEX idx_c6ec0e8bce78b7cc ON accard_patient_fld_opt_map (OPTIONID)');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map ADD PRIMARY KEY (OPTIONID, OPTIONVALUEINTERFACE_ID)');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP CONSTRAINT FK_38CCD8745E697A44');
        $this->addSql('DROP INDEX IDX_38CCD8745E697A44');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map RENAME COLUMN fieldid TO OPTIONID');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map ADD CONSTRAINT FK_38CCD874CE78B7CC FOREIGN KEY (OPTIONID) REFERENCES ACCARD_DIAGNOSIS_FIELD_VALUE (ID)');
        $this->addSql('CREATE INDEX idx_38ccd874ce78b7cc ON accard_diagnosis_fld_opt_map (OPTIONID)');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map ADD PRIMARY KEY (OPTIONID, OPTIONVALUEINTERFACE_ID)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP CONSTRAINT FK_5AD23C545E697A44');
        $this->addSql('DROP INDEX IDX_5AD23C545E697A44');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map RENAME COLUMN fieldid TO OPTIONID');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map ADD CONSTRAINT FK_5AD23C54CE78B7CC FOREIGN KEY (OPTIONID) REFERENCES ACCARD_BHVR_PROTO_FLDVAL (ID)');
        $this->addSql('CREATE INDEX idx_5ad23c54ce78b7cc ON accard_bhvr_proto_fld_opt_map (OPTIONID)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map ADD PRIMARY KEY (OPTIONID, OPTIONVALUEINTERFACE_ID)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP CONSTRAINT FK_D58BF8B95E697A44');
        $this->addSql('DROP INDEX IDX_D58BF8B95E697A44');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map RENAME COLUMN fieldid TO OPTIONID');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map ADD CONSTRAINT FK_D58BF8B9CE78B7CC FOREIGN KEY (OPTIONID) REFERENCES ACCARD_ATTR_PROTO_FLDVAL (ID)');
        $this->addSql('CREATE INDEX idx_d58bf8b9ce78b7cc ON accard_attr_proto_fld_opt_map (OPTIONID)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map ADD PRIMARY KEY (OPTIONID, OPTIONVALUEINTERFACE_ID)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP CONSTRAINT FK_9CECBE045E697A44');
        $this->addSql('DROP INDEX IDX_9CECBE045E697A44');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma RENAME COLUMN fieldid TO OPTIONID');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma ADD CONSTRAINT FK_9CECBE04CE78B7CC FOREIGN KEY (OPTIONID) REFERENCES ACCARD_SAMPLE_PROTO_FLDVAL (ID)');
        $this->addSql('CREATE INDEX idx_9cecbe04ce78b7cc ON accard_sample_proto_fld_opt_ma (OPTIONID)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma ADD PRIMARY KEY (OPTIONID, OPTIONVALUEINTERFACE_ID)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP CONSTRAINT FK_CCCE7B635E697A44');
        $this->addSql('DROP INDEX IDX_CCCE7B635E697A44');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m RENAME COLUMN fieldid TO OPTIONID');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m ADD CONSTRAINT FK_CCCE7B63CE78B7CC FOREIGN KEY (OPTIONID) REFERENCES ACCARD_REGIMEN_PROTO_FLDVAL (ID)');
        $this->addSql('CREATE INDEX idx_ccce7b63ce78b7cc ON accard_regimen_proto_fld_opt_m (OPTIONID)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m ADD PRIMARY KEY (OPTIONID, OPTIONVALUEINTERFACE_ID)');
        $this->addSql('ALTER TABLE accard_regimen_prototype MODIFY (ALLOWDRUG NUMBER(1) NOT NULL)');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP CONSTRAINT FK_359EDC715E697A44');
        $this->addSql('DROP INDEX IDX_359EDC715E697A44');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ RENAME COLUMN fieldid TO OPTIONID');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ ADD CONSTRAINT FK_359EDC71CE78B7CC FOREIGN KEY (OPTIONID) REFERENCES ACCARD_ACTIVITY_PROTO_FLDVAL (ID)');
        $this->addSql('CREATE INDEX idx_359edc71ce78b7cc ON accard_activity_proto_fld_opt_ (OPTIONID)');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ ADD PRIMARY KEY (OPTIONID, OPTIONVALUEINTERFACE_ID)');
        $this->addSql('ALTER TABLE accard_activity_prototype MODIFY (ALLOWDRUG NUMBER(1) NOT NULL)');
    }
}
