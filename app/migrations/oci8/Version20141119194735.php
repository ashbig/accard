<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141119194735 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('CREATE SEQUENCE accard_drug_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE accard_drug_group_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE accard_drug (id NUMBER(10) NOT NULL, name VARCHAR2(255) NOT NULL, presentation VARCHAR2(255) NOT NULL, genericId NUMBER(10) DEFAULT NULL NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_89DC2B555E237E06 ON accard_drug (name)');
        $this->addSql('CREATE INDEX IDX_89DC2B552179D01F ON accard_drug (genericId)');
        $this->addSql('CREATE TABLE accard_drug_group (id NUMBER(10) NOT NULL, name VARCHAR2(255) NOT NULL, presentation VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8FCC09265E237E06 ON accard_drug_group (name)');
        $this->addSql('CREATE TABLE accard_drugs_groups (groupId NUMBER(10) NOT NULL, drugId NUMBER(10) NOT NULL, PRIMARY KEY(groupId, drugId))');
        $this->addSql('CREATE INDEX IDX_DAB9D6E4ED8188B0 ON accard_drugs_groups (groupId)');
        $this->addSql('CREATE INDEX IDX_DAB9D6E4DBA88346 ON accard_drugs_groups (drugId)');
        $this->addSql('CREATE TABLE dag_user (id NUMBER(10) NOT NULL, username VARCHAR2(255) NOT NULL, roles CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN dag_user.roles IS \'(DC2Type:simple_array)\'');
        $this->addSql('ALTER TABLE accard_drug ADD CONSTRAINT FK_89DC2B552179D01F FOREIGN KEY (genericId) REFERENCES accard_drug (id)');
        $this->addSql('ALTER TABLE accard_drugs_groups ADD CONSTRAINT FK_DAB9D6E4ED8188B0 FOREIGN KEY (groupId) REFERENCES accard_drug_group (id)');
        $this->addSql('ALTER TABLE accard_drugs_groups ADD CONSTRAINT FK_DAB9D6E4DBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY ADD (drugId NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY MODIFY (activityDate DATE DEFAULT NULL)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY ADD CONSTRAINT FK_C69BB645DBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('CREATE INDEX IDX_C69BB645DBA88346 ON ACCARD_ACTIVITY (drugId)');
        $this->addSql('ALTER TABLE ACCARD_IMPORT_ACTIVITY ADD (drugId NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_IMPORT_ACTIVITY MODIFY (activityDate DATE DEFAULT NULL)');
        $this->addSql('ALTER TABLE ACCARD_IMPORT_ACTIVITY ADD CONSTRAINT FK_81CEBD4EDBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('CREATE INDEX IDX_81CEBD4EDBA88346 ON ACCARD_IMPORT_ACTIVITY (drugId)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN ADD (drugId NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN ADD CONSTRAINT FK_7E8EF59EDBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('CREATE INDEX IDX_7E8EF59EDBA88346 ON ACCARD_REGIMEN (drugId)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTOTYPE ADD (allowDrug NUMBER(1) NULL, drugGroupId NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_REGIMEN_PROTOTYPE ADD CONSTRAINT FK_1713F9E8A67C4099 FOREIGN KEY (drugGroupId) REFERENCES accard_drug_group (id)');
        $this->addSql('CREATE INDEX IDX_1713F9E8A67C4099 ON ACCARD_REGIMEN_PROTOTYPE (drugGroupId)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTOTYPE ADD (allowDrug NUMBER(1) NULL, drugGroupId NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY_PROTOTYPE ADD CONSTRAINT FK_703C8C1CA67C4099 FOREIGN KEY (drugGroupId) REFERENCES accard_drug_group (id)');
        $this->addSql('CREATE INDEX IDX_703C8C1CA67C4099 ON ACCARD_ACTIVITY_PROTOTYPE (drugGroupId)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('ALTER TABLE accard_activity DROP CONSTRAINT FK_C69BB645DBA88346');
        $this->addSql('ALTER TABLE accard_import_activity DROP CONSTRAINT FK_81CEBD4EDBA88346');
        $this->addSql('ALTER TABLE accard_regimen DROP CONSTRAINT FK_7E8EF59EDBA88346');
        $this->addSql('ALTER TABLE accard_drug DROP CONSTRAINT FK_89DC2B552179D01F');
        $this->addSql('ALTER TABLE accard_drugs_groups DROP CONSTRAINT FK_DAB9D6E4DBA88346');
        $this->addSql('ALTER TABLE accard_drugs_groups DROP CONSTRAINT FK_DAB9D6E4ED8188B0');
        $this->addSql('ALTER TABLE accard_regimen_prototype DROP CONSTRAINT FK_1713F9E8A67C4099');
        $this->addSql('ALTER TABLE accard_activity_prototype DROP CONSTRAINT FK_703C8C1CA67C4099');
        $this->addSql('DROP SEQUENCE accard_drug_id_seq');
        $this->addSql('DROP SEQUENCE accard_drug_group_id_seq');
        $this->addSql('DROP TABLE accard_drug');
        $this->addSql('DROP TABLE accard_drug_group');
        $this->addSql('DROP TABLE accard_drugs_groups');
        $this->addSql('DROP TABLE dag_user');
        $this->addSql('DROP INDEX IDX_C69BB645DBA88346');
        $this->addSql('ALTER TABLE accard_activity MODIFY (ACTIVITYDATE TIMESTAMP(0) DEFAULT NULL)');
        $this->addSql('ALTER TABLE accard_activity DROP (drugId)');
        $this->addSql('DROP INDEX IDX_81CEBD4EDBA88346');
        $this->addSql('ALTER TABLE accard_import_activity MODIFY (ACTIVITYDATE TIMESTAMP(0) DEFAULT NULL)');
        $this->addSql('ALTER TABLE accard_import_activity DROP (drugId)');
        $this->addSql('DROP INDEX IDX_7E8EF59EDBA88346');
        $this->addSql('ALTER TABLE accard_regimen DROP (drugId)');
        $this->addSql('DROP INDEX IDX_1713F9E8A67C4099');
        $this->addSql('ALTER TABLE accard_regimen_prototype DROP (allowDrug, drugGroupId)');
        $this->addSql('DROP INDEX IDX_703C8C1CA67C4099');
        $this->addSql('ALTER TABLE accard_activity_prototype DROP (allowDrug, drugGroupId)');
    }
}
