<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141217165515 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        // Patient
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP DROP CONSTRAINT FK_C6EC0E8B2D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP DROP CONSTRAINT FK_C6EC0E8B5E697A44');
        $this->addSql('DROP INDEX IDX_C6EC0E8B5E697A44');
        $this->addSql('DROP INDEX IDX_C6EC0E8B2D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP RENAME COLUMN fieldId TO fieldValueId');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP RENAME COLUMN optionValueInterface_id TO optionValueId');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP ADD CONSTRAINT FK_C6EC0E8B81F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_patient_field_value (id)');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP ADD CONSTRAINT FK_C6EC0E8BE8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('CREATE INDEX IDX_C6EC0E8B81F9A87C ON ACCARD_PATIENT_FLD_OPT_MAP (optionValueId)');
        $this->addSql('CREATE INDEX IDX_C6EC0E8BE8ED26A9 ON ACCARD_PATIENT_FLD_OPT_MAP (fieldValueId)');
        $this->addSql('ALTER TABLE ACCARD_PATIENT_FLD_OPT_MAP ADD PRIMARY KEY (optionValueId, fieldValueId)');

        // Diagnosis
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP DROP CONSTRAINT FK_38CCD8742D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP DROP CONSTRAINT FK_38CCD8745E697A44');
        $this->addSql('DROP INDEX IDX_38CCD8742D7CB67F');
        $this->addSql('DROP INDEX IDX_38CCD8745E697A44');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP RENAME COLUMN fieldId TO fieldValueId');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP RENAME COLUMN optionValueInterface_id TO optionValueId');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP ADD CONSTRAINT FK_38CCD87481F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_diagnosis_field_value (id)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP ADD CONSTRAINT FK_38CCD874E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('CREATE INDEX IDX_38CCD87481F9A87C ON ACCARD_DIAGNOSIS_FLD_OPT_MAP (optionValueId)');
        $this->addSql('CREATE INDEX IDX_38CCD874E8ED26A9 ON ACCARD_DIAGNOSIS_FLD_OPT_MAP (fieldValueId)');
        $this->addSql('ALTER TABLE ACCARD_DIAGNOSIS_FLD_OPT_MAP ADD PRIMARY KEY (optionValueId, fieldValueId)');

        // Behavior
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLDVAL DROP CONSTRAINT FK_8855F5A4BDE390E1');
        $this->addSql('DROP INDEX IDX_8855F5A4BDE390E1');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLDVAL RENAME COLUMN behavior_prototypeid TO behaviorId');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLDVAL ADD CONSTRAINT FK_8855F5A418AE7509 FOREIGN KEY (behaviorId) REFERENCES accard_behavior (id)');
        $this->addSql('CREATE INDEX IDX_8855F5A418AE7509 ON ACCARD_BHVR_PROTO_FLDVAL (behaviorId)');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP DROP CONSTRAINT FK_5AD23C542D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP DROP CONSTRAINT FK_5AD23C545E697A44');
        $this->addSql('DROP INDEX IDX_5AD23C545E697A44');
        $this->addSql('DROP INDEX IDX_5AD23C542D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP RENAME COLUMN fieldId TO fieldValueId');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP RENAME COLUMN optionValueInterface_id TO optionValueId');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP ADD CONSTRAINT FK_5AD23C5481F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_bhvr_proto_fldval (id)');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP ADD CONSTRAINT FK_5AD23C54E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('CREATE INDEX IDX_5AD23C5481F9A87C ON ACCARD_BHVR_PROTO_FLD_OPT_MAP (optionValueId)');
        $this->addSql('CREATE INDEX IDX_5AD23C54E8ED26A9 ON ACCARD_BHVR_PROTO_FLD_OPT_MAP (fieldValueId)');
        $this->addSql('ALTER TABLE ACCARD_BHVR_PROTO_FLD_OPT_MAP ADD PRIMARY KEY (optionValueId, fieldValueId)');

        // Attribute
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLDVAL DROP CONSTRAINT FK_324CF2E7A6CD9D4A');
        $this->addSql('DROP INDEX IDX_324CF2E7A6CD9D4A');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLDVAL RENAME COLUMN attribute_prototypeid TO attributeId');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLDVAL ADD CONSTRAINT FK_324CF2E7ED407E17 FOREIGN KEY (attributeId) REFERENCES accard_attribute (id)');
        $this->addSql('CREATE INDEX IDX_324CF2E7ED407E17 ON ACCARD_ATTR_PROTO_FLDVAL (attributeId)');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP DROP CONSTRAINT FK_D58BF8B92D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP DROP CONSTRAINT FK_D58BF8B95E697A44');
        $this->addSql('DROP INDEX IDX_D58BF8B92D7CB67F');
        $this->addSql('DROP INDEX IDX_D58BF8B95E697A44');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP RENAME COLUMN fieldId TO fieldValueId');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP RENAME COLUMN optionValueInterface_id TO optionValueId');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP ADD CONSTRAINT FK_D58BF8B981F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_attr_proto_fldval (id)');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP ADD CONSTRAINT FK_D58BF8B9E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('CREATE INDEX IDX_D58BF8B981F9A87C ON ACCARD_ATTR_PROTO_FLD_OPT_MAP (optionValueId)');
        $this->addSql('CREATE INDEX IDX_D58BF8B9E8ED26A9 ON ACCARD_ATTR_PROTO_FLD_OPT_MAP (fieldValueId)');
        $this->addSql('ALTER TABLE ACCARD_ATTR_PROTO_FLD_OPT_MAP ADD PRIMARY KEY (optionValueId, fieldValueId)');

        // Sample
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLDVAL DROP CONSTRAINT FK_FD68D3308D6C621A');
        $this->addSql('DROP INDEX IDX_FD68D3308D6C621A');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLDVAL RENAME COLUMN sample_prototypeid TO sampleId');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLDVAL ADD CONSTRAINT FK_FD68D330730CE27D FOREIGN KEY (sampleId) REFERENCES accard_sample (id)');
        $this->addSql('CREATE INDEX IDX_FD68D330730CE27D ON ACCARD_SAMPLE_PROTO_FLDVAL (sampleId)');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA DROP CONSTRAINT FK_9CECBE042D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA DROP CONSTRAINT FK_9CECBE045E697A44');
        $this->addSql('DROP INDEX IDX_9CECBE045E697A44');
        $this->addSql('DROP INDEX IDX_9CECBE042D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA RENAME COLUMN fieldId TO fieldValueId');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA RENAME COLUMN optionValueInterface_id TO optionValueId');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA ADD CONSTRAINT FK_9CECBE0481F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_sample_proto_fldval (id)');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA ADD CONSTRAINT FK_9CECBE04E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('CREATE INDEX IDX_9CECBE0481F9A87C ON ACCARD_SAMPLE_PROTO_FLD_OPT_MA (optionValueId)');
        $this->addSql('CREATE INDEX IDX_9CECBE04E8ED26A9 ON ACCARD_SAMPLE_PROTO_FLD_OPT_MA (fieldValueId)');
        $this->addSql('ALTER TABLE ACCARD_SAMPLE_PROTO_FLD_OPT_MA ADD PRIMARY KEY (optionValueId, fieldValueId)');

        // Regimen
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLDVAL DROP CONSTRAINT FK_5378E08E9E2C754D');
        $this->addSql('DROP INDEX IDX_5378E08E9E2C754D');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLDVAL RENAME COLUMN regimen_prototypeid TO regimenId');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLDVAL ADD CONSTRAINT FK_5378E08E85CA7E31 FOREIGN KEY (regimenId) REFERENCES accard_regimen (id)');
        $this->addSql('CREATE INDEX IDX_5378E08E85CA7E31 ON ACCARD_REGIMEN_PROTO_FLDVAL (regimenId)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M DROP CONSTRAINT FK_CCCE7B632D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M DROP CONSTRAINT FK_CCCE7B635E697A44');
        $this->addSql('DROP INDEX IDX_CCCE7B635E697A44');
        $this->addSql('DROP INDEX IDX_CCCE7B632D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M RENAME COLUMN fieldId TO fieldValueId');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M RENAME COLUMN optionValueInterface_id TO optionValueId');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M ADD CONSTRAINT FK_CCCE7B6381F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_regimen_proto_fldval (id)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M ADD CONSTRAINT FK_CCCE7B63E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('CREATE INDEX IDX_CCCE7B6381F9A87C ON ACCARD_REGIMEN_PROTO_FLD_OPT_M (optionValueId)');
        $this->addSql('CREATE INDEX IDX_CCCE7B63E8ED26A9 ON ACCARD_REGIMEN_PROTO_FLD_OPT_M (fieldValueId)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTO_FLD_OPT_M ADD PRIMARY KEY (optionValueId, fieldValueId)');

        // Activity
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLDVAL DROP CONSTRAINT FK_182C8B0F959F0496');
        $this->addSql('DROP INDEX IDX_182C8B0F959F0496');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLDVAL RENAME COLUMN activity_prototypeid TO activityId');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLDVAL ADD CONSTRAINT FK_182C8B0F1335E2FC FOREIGN KEY (activityId) REFERENCES accard_activity (id)');
        $this->addSql('CREATE INDEX IDX_182C8B0F1335E2FC ON ACCARD_ACTIVITY_PROTO_FLDVAL (activityId)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ DROP CONSTRAINT FK_359EDC712D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ DROP CONSTRAINT FK_359EDC715E697A44');
        $this->addSql('DROP INDEX IDX_359EDC715E697A44');
        $this->addSql('DROP INDEX IDX_359EDC712D7CB67F');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ RENAME COLUMN fieldId TO fieldValueId');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ RENAME COLUMN optionValueInterface_id TO optionValueId');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ ADD CONSTRAINT FK_359EDC7181F9A87C FOREIGN KEY (optionValueId) REFERENCES accard_activity_proto_fldval (id)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ ADD CONSTRAINT FK_359EDC71E8ED26A9 FOREIGN KEY (fieldValueId) REFERENCES accard_option_value (id)');
        $this->addSql('CREATE INDEX IDX_359EDC7181F9A87C ON ACCARD_ACTIVITY_PROTO_FLD_OPT_ (optionValueId)');
        $this->addSql('CREATE INDEX IDX_359EDC71E8ED26A9 ON ACCARD_ACTIVITY_PROTO_FLD_OPT_ (fieldValueId)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTO_FLD_OPT_ ADD PRIMARY KEY (optionValueId, fieldValueId)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        // Non-reversable :()
    }
}
