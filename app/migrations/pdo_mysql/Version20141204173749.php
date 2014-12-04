<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141204173749 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP FOREIGN KEY FK_C6EC0E8BCE78B7CC');
        $this->addSql('DROP INDEX IDX_C6EC0E8BCE78B7CC ON accard_patient_fld_opt_map');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map CHANGE optionid fieldId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map ADD CONSTRAINT FK_C6EC0E8B5E697A44 FOREIGN KEY (fieldId) REFERENCES accard_patient_field_value (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C6EC0E8B5E697A44 ON accard_patient_fld_opt_map (fieldId)');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP FOREIGN KEY FK_38CCD874CE78B7CC');
        $this->addSql('DROP INDEX IDX_38CCD874CE78B7CC ON accard_diagnosis_fld_opt_map');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map CHANGE optionid fieldId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map ADD CONSTRAINT FK_38CCD8745E697A44 FOREIGN KEY (fieldId) REFERENCES accard_diagnosis_field_value (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_38CCD8745E697A44 ON accard_diagnosis_fld_opt_map (fieldId)');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP FOREIGN KEY FK_5AD23C54CE78B7CC');
        $this->addSql('DROP INDEX IDX_5AD23C54CE78B7CC ON accard_bhvr_proto_fld_opt_map');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map CHANGE optionid fieldId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map ADD CONSTRAINT FK_5AD23C545E697A44 FOREIGN KEY (fieldId) REFERENCES accard_bhvr_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_5AD23C545E697A44 ON accard_bhvr_proto_fld_opt_map (fieldId)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP FOREIGN KEY FK_D58BF8B9CE78B7CC');
        $this->addSql('DROP INDEX IDX_D58BF8B9CE78B7CC ON accard_attr_proto_fld_opt_map');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map CHANGE optionid fieldId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map ADD CONSTRAINT FK_D58BF8B95E697A44 FOREIGN KEY (fieldId) REFERENCES accard_attr_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_D58BF8B95E697A44 ON accard_attr_proto_fld_opt_map (fieldId)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP FOREIGN KEY FK_9CECBE04CE78B7CC');
        $this->addSql('DROP INDEX IDX_9CECBE04CE78B7CC ON accard_sample_proto_fld_opt_ma');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma CHANGE optionid fieldId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma ADD CONSTRAINT FK_9CECBE045E697A44 FOREIGN KEY (fieldId) REFERENCES accard_sample_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_9CECBE045E697A44 ON accard_sample_proto_fld_opt_ma (fieldId)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP FOREIGN KEY FK_CCCE7B63CE78B7CC');
        $this->addSql('DROP INDEX IDX_CCCE7B63CE78B7CC ON accard_regimen_proto_fld_opt_m');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m CHANGE optionid fieldId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m ADD CONSTRAINT FK_CCCE7B635E697A44 FOREIGN KEY (fieldId) REFERENCES accard_regimen_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_CCCE7B635E697A44 ON accard_regimen_proto_fld_opt_m (fieldId)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP FOREIGN KEY FK_359EDC71CE78B7CC');
        $this->addSql('DROP INDEX IDX_359EDC71CE78B7CC ON accard_activity_proto_fld_opt_');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ CHANGE optionid fieldId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ ADD CONSTRAINT FK_359EDC715E697A44 FOREIGN KEY (fieldId) REFERENCES accard_activity_proto_fldval (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_359EDC715E697A44 ON accard_activity_proto_fld_opt_ (fieldId)');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ ADD PRIMARY KEY (fieldId, optionvalueinterface_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP FOREIGN KEY FK_359EDC715E697A44');
        $this->addSql('DROP INDEX IDX_359EDC715E697A44 ON accard_activity_proto_fld_opt_');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ CHANGE fieldid optionId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ ADD CONSTRAINT FK_359EDC71CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_activity_proto_fldval (id)');
        $this->addSql('CREATE INDEX IDX_359EDC71CE78B7CC ON accard_activity_proto_fld_opt_ (optionId)');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ ADD PRIMARY KEY (optionId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP FOREIGN KEY FK_D58BF8B95E697A44');
        $this->addSql('DROP INDEX IDX_D58BF8B95E697A44 ON accard_attr_proto_fld_opt_map');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map CHANGE fieldid optionId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map ADD CONSTRAINT FK_D58BF8B9CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_attr_proto_fldval (id)');
        $this->addSql('CREATE INDEX IDX_D58BF8B9CE78B7CC ON accard_attr_proto_fld_opt_map (optionId)');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map ADD PRIMARY KEY (optionId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP FOREIGN KEY FK_5AD23C545E697A44');
        $this->addSql('DROP INDEX IDX_5AD23C545E697A44 ON accard_bhvr_proto_fld_opt_map');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map CHANGE fieldid optionId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map ADD CONSTRAINT FK_5AD23C54CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_bhvr_proto_fldval (id)');
        $this->addSql('CREATE INDEX IDX_5AD23C54CE78B7CC ON accard_bhvr_proto_fld_opt_map (optionId)');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map ADD PRIMARY KEY (optionId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP FOREIGN KEY FK_38CCD8745E697A44');
        $this->addSql('DROP INDEX IDX_38CCD8745E697A44 ON accard_diagnosis_fld_opt_map');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map CHANGE fieldid optionId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map ADD CONSTRAINT FK_38CCD874CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_diagnosis_field_value (id)');
        $this->addSql('CREATE INDEX IDX_38CCD874CE78B7CC ON accard_diagnosis_fld_opt_map (optionId)');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map ADD PRIMARY KEY (optionId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP FOREIGN KEY FK_C6EC0E8B5E697A44');
        $this->addSql('DROP INDEX IDX_C6EC0E8B5E697A44 ON accard_patient_fld_opt_map');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map CHANGE fieldid optionId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map ADD CONSTRAINT FK_C6EC0E8BCE78B7CC FOREIGN KEY (optionId) REFERENCES accard_patient_field_value (id)');
        $this->addSql('CREATE INDEX IDX_C6EC0E8BCE78B7CC ON accard_patient_fld_opt_map (optionId)');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map ADD PRIMARY KEY (optionId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP FOREIGN KEY FK_CCCE7B635E697A44');
        $this->addSql('DROP INDEX IDX_CCCE7B635E697A44 ON accard_regimen_proto_fld_opt_m');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m CHANGE fieldid optionId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m ADD CONSTRAINT FK_CCCE7B63CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_regimen_proto_fldval (id)');
        $this->addSql('CREATE INDEX IDX_CCCE7B63CE78B7CC ON accard_regimen_proto_fld_opt_m (optionId)');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m ADD PRIMARY KEY (optionId, optionvalueinterface_id)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP FOREIGN KEY FK_9CECBE045E697A44');
        $this->addSql('DROP INDEX IDX_9CECBE045E697A44 ON accard_sample_proto_fld_opt_ma');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma CHANGE fieldid optionId INT NOT NULL');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma ADD CONSTRAINT FK_9CECBE04CE78B7CC FOREIGN KEY (optionId) REFERENCES accard_sample_proto_fldval (id)');
        $this->addSql('CREATE INDEX IDX_9CECBE04CE78B7CC ON accard_sample_proto_fld_opt_ma (optionId)');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma ADD PRIMARY KEY (optionId, optionvalueinterface_id)');
    }
}
