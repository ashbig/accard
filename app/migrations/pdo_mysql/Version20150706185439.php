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

        $this->addSql('CREATE TABLE accard_template (id INT AUTO_INCREMENT NOT NULL, parent VARCHAR(180) DEFAULT NULL, name VARCHAR(200) NOT NULL, location VARCHAR(200) NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_FD8FA09C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lexik_translation_file (id INT AUTO_INCREMENT NOT NULL, domain VARCHAR(255) NOT NULL, locale VARCHAR(10) NOT NULL, extention VARCHAR(10) NOT NULL, path VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, UNIQUE INDEX hash_idx (hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lexik_trans_unit_translation (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, trans_unit_id INT DEFAULT NULL, locale VARCHAR(10) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_75CB162F93CB796C (file_id), INDEX IDX_75CB162FC3C583C9 (trans_unit_id), UNIQUE INDEX trans_unit_locale_idx (trans_unit_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lexik_trans_unit (id INT AUTO_INCREMENT NOT NULL, key_name VARCHAR(255) NOT NULL, domain VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX key_domain_idx (key_name, domain), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_import (id INT AUTO_INCREMENT NOT NULL, active TINYINT(1) NOT NULL, startTimestamp NUMERIC(13, 3) NOT NULL, endTimestamp NUMERIC(13, 3) NOT NULL, importer VARCHAR(36) NOT NULL, criteria LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_log (id INT AUTO_INCREMENT NOT NULL, logDate DATETIME NOT NULL, action VARCHAR(16) NOT NULL, resourceName VARCHAR(32) NOT NULL, resourceId INT DEFAULT NULL, route VARCHAR(100) NOT NULL, uriAttributes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', uriQuery LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', uriRequest LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', userId INT NOT NULL, INDEX IDX_2AC893464B64DCC (userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_setting (id INT AUTO_INCREMENT NOT NULL, namespace VARCHAR(120) NOT NULL, name VARCHAR(120) NOT NULL, value LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_activity (id INT AUTO_INCREMENT NOT NULL, activityDate DATE NOT NULL, drugId INT DEFAULT NULL, prototypeId INT NOT NULL, patientId INT NOT NULL, diagnosisId INT DEFAULT NULL, regimenId INT DEFAULT NULL, INDEX IDX_C69BB645DBA88346 (drugId), INDEX IDX_C69BB6459B116E9A (prototypeId), INDEX IDX_C69BB6458F803478 (patientId), INDEX IDX_C69BB645D0EA680C (diagnosisId), INDEX IDX_C69BB64585CA7E31 (regimenId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_attribute (id INT AUTO_INCREMENT NOT NULL, prototypeId INT NOT NULL, patientId INT NOT NULL, INDEX IDX_77180DB19B116E9A (prototypeId), INDEX IDX_77180DB18F803478 (patientId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_behavior (id INT AUTO_INCREMENT NOT NULL, startDate DATETIME NOT NULL, endDate DATETIME DEFAULT NULL, prototypeId INT NOT NULL, patientId INT NOT NULL, INDEX IDX_51441FAF9B116E9A (prototypeId), INDEX IDX_51441FAF8F803478 (patientId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_diagnosis (id INT AUTO_INCREMENT NOT NULL, startDate DATETIME NOT NULL, endDate DATETIME DEFAULT NULL, codeId INT NOT NULL, parentId INT DEFAULT NULL, primaryId INT DEFAULT NULL, patientId INT NOT NULL, INDEX IDX_F3B3ED77B5FC0459 (codeId), INDEX IDX_F3B3ED7710EE4CEE (parentId), INDEX IDX_F3B3ED777BB601C (primaryId), INDEX IDX_F3B3ED778F803478 (patientId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_diagnosis_phase (id INT AUTO_INCREMENT NOT NULL, `label` VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, orderNumber INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_diagnosis_phase_inst (id INT AUTO_INCREMENT NOT NULL, target_id INT DEFAULT NULL, phase_id INT DEFAULT NULL, startDate DATETIME NOT NULL, endDate DATETIME DEFAULT NULL, INDEX IDX_F09D7DB9158E0B66 (target_id), INDEX IDX_F09D7DB999091188 (phase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_import_activity (id INT AUTO_INCREMENT NOT NULL, activityDate DATE NOT NULL, descriptions LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', status INT NOT NULL, drugId INT DEFAULT NULL, patientId INT NOT NULL, diagnosisId INT DEFAULT NULL, INDEX IDX_81CEBD4EDBA88346 (drugId), INDEX IDX_81CEBD4E8F803478 (patientId), INDEX IDX_81CEBD4ED0EA680C (diagnosisId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_import_patient (id INT AUTO_INCREMENT NOT NULL, mrn VARCHAR(36) DEFAULT NULL, firstName VARCHAR(36) NOT NULL, lastName VARCHAR(36) NOT NULL, dateOfBirth DATETIME NOT NULL, dateOfDeath DATETIME DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, race VARCHAR(255) DEFAULT NULL, descriptions LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', status INT NOT NULL, UNIQUE INDEX UNIQ_A2814E1484DD64A (mrn), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_import_sample (id INT AUTO_INCREMENT NOT NULL, amount INT NOT NULL, descriptions LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', status INT NOT NULL, sourceId INT DEFAULT NULL, patientId INT NOT NULL, INDEX IDX_173786F4EE155AE0 (sourceId), INDEX IDX_173786F48F803478 (patientId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_patient (id INT AUTO_INCREMENT NOT NULL, mrn VARCHAR(36) DEFAULT NULL, firstName VARCHAR(36) NOT NULL, lastName VARCHAR(36) NOT NULL, dateOfBirth DATETIME NOT NULL, dateOfDeath DATETIME DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, race VARCHAR(255) DEFAULT NULL, targetId INT DEFAULT NULL, UNIQUE INDEX UNIQ_45453AFA84DD64A (mrn), UNIQUE INDEX UNIQ_45453AFA39659675 (targetId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_patient_phase (id INT AUTO_INCREMENT NOT NULL, `label` VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, orderNumber INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_patient_phase_inst (id INT AUTO_INCREMENT NOT NULL, target_id INT DEFAULT NULL, phase_id INT DEFAULT NULL, startDate DATETIME NOT NULL, endDate DATETIME DEFAULT NULL, INDEX IDX_450F421158E0B66 (target_id), INDEX IDX_450F42199091188 (phase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_regimen (id INT AUTO_INCREMENT NOT NULL, startDate DATETIME NOT NULL, endDate DATETIME DEFAULT NULL, drugId INT DEFAULT NULL, prototypeId INT NOT NULL, patientId INT NOT NULL, diagnosisId INT DEFAULT NULL, INDEX IDX_7E8EF59EDBA88346 (drugId), INDEX IDX_7E8EF59E9B116E9A (prototypeId), INDEX IDX_7E8EF59E8F803478 (patientId), INDEX IDX_7E8EF59ED0EA680C (diagnosisId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_sample (id INT AUTO_INCREMENT NOT NULL, amount INT NOT NULL, sourceId INT DEFAULT NULL, prototypeId INT NOT NULL, patientId INT DEFAULT NULL, INDEX IDX_6B6E6FFAEE155AE0 (sourceId), INDEX IDX_6B6E6FFA9B116E9A (prototypeId), INDEX IDX_6B6E6FFA8F803478 (patientId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_sample_source (id INT AUTO_INCREMENT NOT NULL, sourceDate DATETIME NOT NULL, amount INT DEFAULT NULL, parentSampleId INT DEFAULT NULL, patientId INT DEFAULT NULL, INDEX IDX_5530F9C68C7A1510 (parentSampleId), INDEX IDX_5530F9C68F803478 (patientId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_option_value (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, locked TINYINT(1) NOT NULL, optionId INT NOT NULL, ordering INT DEFAULT 0 NOT NULL, INDEX IDX_96657CDDCE78B7CC (optionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_drug (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, genericId INT DEFAULT NULL, UNIQUE INDEX UNIQ_89DC2B555E237E06 (name), INDEX IDX_89DC2B552179D01F (genericId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_drug_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8FCC09265E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_drugs_groups (groupId INT NOT NULL, drugId INT NOT NULL, INDEX IDX_DAB9D6E4ED8188B0 (groupId), INDEX IDX_DAB9D6E4DBA88346 (drugId), PRIMARY KEY(groupId, drugId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_patient_field (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, type VARCHAR(36) NOT NULL, allowMultiple TINYINT(1) NOT NULL, addable TINYINT(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR(60) NOT NULL, configuration LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', optionId INT DEFAULT NULL, UNIQUE INDEX UNIQ_54CED4B85E237E06 (name), INDEX IDX_54CED4B8CE78B7CC (optionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_patient_field_value (id INT AUTO_INCREMENT NOT NULL, stringValue VARCHAR(255) DEFAULT NULL, dateValue DATETIME DEFAULT NULL, numberValue INT DEFAULT NULL, optionValueId INT DEFAULT NULL, patientId INT NOT NULL, fieldId INT NOT NULL, INDEX IDX_E084E37081F9A87C (optionValueId), INDEX IDX_E084E3708F803478 (patientId), INDEX IDX_E084E3705E697A44 (fieldId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_patient_fld_opt_map (optionValueId INT NOT NULL, fieldValueId INT NOT NULL, INDEX IDX_C6EC0E8B81F9A87C (optionValueId), INDEX IDX_C6EC0E8BE8ED26A9 (fieldValueId), PRIMARY KEY(optionValueId, fieldValueId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_diagnosis_code (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_BD5E178E77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_diagnosis_codes_groups (codeId INT NOT NULL, groupId INT NOT NULL, INDEX IDX_E9D4D81DB5FC0459 (codeId), INDEX IDX_E9D4D81DED8188B0 (groupId), PRIMARY KEY(codeId, groupId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_diagnosis_code_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F7D683B15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_diagnosis_field (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, type VARCHAR(36) NOT NULL, allowMultiple TINYINT(1) NOT NULL, addable TINYINT(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR(60) NOT NULL, configuration LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', optionId INT DEFAULT NULL, UNIQUE INDEX UNIQ_AFEBBB2E5E237E06 (name), INDEX IDX_AFEBBB2ECE78B7CC (optionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_diagnosis_field_value (id INT AUTO_INCREMENT NOT NULL, stringValue VARCHAR(255) DEFAULT NULL, dateValue DATETIME DEFAULT NULL, numberValue INT DEFAULT NULL, optionValueId INT DEFAULT NULL, diagnosisId INT NOT NULL, fieldId INT NOT NULL, INDEX IDX_1EA4358F81F9A87C (optionValueId), INDEX IDX_1EA4358FD0EA680C (diagnosisId), INDEX IDX_1EA4358F5E697A44 (fieldId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_diagnosis_fld_opt_map (optionValueId INT NOT NULL, fieldValueId INT NOT NULL, INDEX IDX_38CCD87481F9A87C (optionValueId), INDEX IDX_38CCD874E8ED26A9 (fieldValueId), PRIMARY KEY(optionValueId, fieldValueId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_bhvr_proto_fld (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, type VARCHAR(36) NOT NULL, allowMultiple TINYINT(1) NOT NULL, addable TINYINT(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR(60) NOT NULL, configuration LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', optionId INT DEFAULT NULL, UNIQUE INDEX UNIQ_D2CFF6735E237E06 (name), INDEX IDX_D2CFF673CE78B7CC (optionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_bhvr_proto_fldval (id INT AUTO_INCREMENT NOT NULL, stringValue VARCHAR(255) DEFAULT NULL, dateValue DATETIME DEFAULT NULL, numberValue INT DEFAULT NULL, optionValueId INT DEFAULT NULL, behaviorId INT NOT NULL, fieldId INT NOT NULL, INDEX IDX_8855F5A481F9A87C (optionValueId), INDEX IDX_8855F5A418AE7509 (behaviorId), INDEX IDX_8855F5A45E697A44 (fieldId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_bhvr_proto_fld_opt_map (optionValueId INT NOT NULL, fieldValueId INT NOT NULL, INDEX IDX_5AD23C5481F9A87C (optionValueId), INDEX IDX_5AD23C54E8ED26A9 (fieldValueId), PRIMARY KEY(optionValueId, fieldValueId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_behavior_prototype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_behavior_prototype_map (prototypeId INT NOT NULL, subjectId INT NOT NULL, INDEX IDX_98CC21519B116E9A (prototypeId), INDEX IDX_98CC21513E0C34EB (subjectId), PRIMARY KEY(prototypeId, subjectId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_attr_proto_fld (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, type VARCHAR(36) NOT NULL, allowMultiple TINYINT(1) NOT NULL, addable TINYINT(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR(60) NOT NULL, configuration LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', optionId INT DEFAULT NULL, UNIQUE INDEX UNIQ_6C2852165E237E06 (name), INDEX IDX_6C285216CE78B7CC (optionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_attr_proto_fldval (id INT AUTO_INCREMENT NOT NULL, stringValue VARCHAR(255) DEFAULT NULL, dateValue DATETIME DEFAULT NULL, numberValue INT DEFAULT NULL, optionValueId INT DEFAULT NULL, attributeId INT NOT NULL, fieldId INT NOT NULL, INDEX IDX_324CF2E781F9A87C (optionValueId), INDEX IDX_324CF2E7ED407E17 (attributeId), INDEX IDX_324CF2E75E697A44 (fieldId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_attr_proto_fld_opt_map (optionValueId INT NOT NULL, fieldValueId INT NOT NULL, INDEX IDX_D58BF8B981F9A87C (optionValueId), INDEX IDX_D58BF8B9E8ED26A9 (fieldValueId), PRIMARY KEY(optionValueId, fieldValueId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_attribute_prototype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_attribute_prototype_map (prototypeId INT NOT NULL, subjectId INT NOT NULL, INDEX IDX_B6E609359B116E9A (prototypeId), INDEX IDX_B6E609353E0C34EB (subjectId), PRIMARY KEY(prototypeId, subjectId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_sample_proto_fld (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, type VARCHAR(36) NOT NULL, allowMultiple TINYINT(1) NOT NULL, addable TINYINT(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR(60) NOT NULL, configuration LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', optionId INT DEFAULT NULL, UNIQUE INDEX UNIQ_D7ABA2F35E237E06 (name), INDEX IDX_D7ABA2F3CE78B7CC (optionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_sample_proto_fldval (id INT AUTO_INCREMENT NOT NULL, stringValue VARCHAR(255) DEFAULT NULL, dateValue DATETIME DEFAULT NULL, numberValue INT DEFAULT NULL, optionValueId INT DEFAULT NULL, sampleId INT NOT NULL, fieldId INT NOT NULL, INDEX IDX_FD68D33081F9A87C (optionValueId), INDEX IDX_FD68D330730CE27D (sampleId), INDEX IDX_FD68D3305E697A44 (fieldId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_sample_proto_fld_opt_ma (optionValueId INT NOT NULL, fieldValueId INT NOT NULL, INDEX IDX_9CECBE0481F9A87C (optionValueId), INDEX IDX_9CECBE04E8ED26A9 (fieldValueId), PRIMARY KEY(optionValueId, fieldValueId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_sample_prototype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_sample_prototype_map (prototypeId INT NOT NULL, subjectId INT NOT NULL, INDEX IDX_B953D8249B116E9A (prototypeId), INDEX IDX_B953D8243E0C34EB (subjectId), PRIMARY KEY(prototypeId, subjectId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_regimen_proto_fld (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, type VARCHAR(36) NOT NULL, allowMultiple TINYINT(1) NOT NULL, addable TINYINT(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR(60) NOT NULL, configuration LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', optionId INT DEFAULT NULL, UNIQUE INDEX UNIQ_E62A58515E237E06 (name), INDEX IDX_E62A5851CE78B7CC (optionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_regimen_proto_fldval (id INT AUTO_INCREMENT NOT NULL, stringValue VARCHAR(255) DEFAULT NULL, dateValue DATETIME DEFAULT NULL, numberValue INT DEFAULT NULL, optionValueId INT DEFAULT NULL, regimenId INT NOT NULL, fieldId INT NOT NULL, INDEX IDX_5378E08E81F9A87C (optionValueId), INDEX IDX_5378E08E85CA7E31 (regimenId), INDEX IDX_5378E08E5E697A44 (fieldId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_regimen_proto_fld_opt_m (optionValueId INT NOT NULL, fieldValueId INT NOT NULL, INDEX IDX_CCCE7B6381F9A87C (optionValueId), INDEX IDX_CCCE7B63E8ED26A9 (fieldValueId), PRIMARY KEY(optionValueId, fieldValueId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_regimen_prototype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, description VARCHAR(255) DEFAULT NULL, allowDrug TINYINT(1) DEFAULT NULL, drugGroupId INT DEFAULT NULL, INDEX IDX_1713F9E8A67C4099 (drugGroupId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_regimen_prototype_map (prototypeId INT NOT NULL, subjectId INT NOT NULL, INDEX IDX_9524569C9B116E9A (prototypeId), INDEX IDX_9524569C3E0C34EB (subjectId), PRIMARY KEY(prototypeId, subjectId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_regimen_activity_map (activityPrototypeId INT NOT NULL, regimenPrototypeId INT NOT NULL, INDEX IDX_447DEB5B2B242F3D (activityPrototypeId), INDEX IDX_447DEB5B438AD5F2 (regimenPrototypeId), PRIMARY KEY(activityPrototypeId, regimenPrototypeId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_activity_proto_fld (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, type VARCHAR(36) NOT NULL, allowMultiple TINYINT(1) NOT NULL, addable TINYINT(1) DEFAULT \'0\' NOT NULL, ordering VARCHAR(60) NOT NULL, configuration LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', optionId INT DEFAULT NULL, UNIQUE INDEX UNIQ_81052DA55E237E06 (name), INDEX IDX_81052DA5CE78B7CC (optionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_activity_proto_fldval (id INT AUTO_INCREMENT NOT NULL, stringValue VARCHAR(255) DEFAULT NULL, dateValue DATETIME DEFAULT NULL, numberValue INT DEFAULT NULL, optionValueId INT DEFAULT NULL, activityId INT NOT NULL, fieldId INT NOT NULL, INDEX IDX_182C8B0F81F9A87C (optionValueId), INDEX IDX_182C8B0F1335E2FC (activityId), INDEX IDX_182C8B0F5E697A44 (fieldId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_activity_proto_fld_opt_ (optionValueId INT NOT NULL, fieldValueId INT NOT NULL, INDEX IDX_359EDC7181F9A87C (optionValueId), INDEX IDX_359EDC71E8ED26A9 (fieldValueId), PRIMARY KEY(optionValueId, fieldValueId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_activity_prototype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, presentation VARCHAR(120) NOT NULL, description VARCHAR(255) DEFAULT NULL, allowDrug TINYINT(1) DEFAULT NULL, drugGroupId INT DEFAULT NULL, INDEX IDX_703C8C1CA67C4099 (drugGroupId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_activity_prototype_map (prototypeId INT NOT NULL, subjectId INT NOT NULL, INDEX IDX_FD0B1419B116E9A (prototypeId), INDEX IDX_FD0B1413E0C34EB (subjectId), PRIMARY KEY(prototypeId, subjectId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dag_user (id INT NOT NULL, username VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lexik_trans_unit_translation ADD CONSTRAINT FK_75CB162F93CB796C FOREIGN KEY (file_id) REFERENCES lexik_translation_file (id)');
        $this->addSql('ALTER TABLE lexik_trans_unit_translation ADD CONSTRAINT FK_75CB162FC3C583C9 FOREIGN KEY (trans_unit_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE accard_log ADD CONSTRAINT FK_2AC893464B64DCC FOREIGN KEY (userId) REFERENCES dag_user (id)');
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
        $this->addSql('ALTER TABLE accard_import_activity ADD CONSTRAINT FK_81CEBD4EDBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('ALTER TABLE accard_import_activity ADD CONSTRAINT FK_81CEBD4E8F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_import_activity ADD CONSTRAINT FK_81CEBD4ED0EA680C FOREIGN KEY (diagnosisId) REFERENCES accard_diagnosis (id)');
        $this->addSql('ALTER TABLE accard_import_sample ADD CONSTRAINT FK_173786F4EE155AE0 FOREIGN KEY (sourceId) REFERENCES accard_sample_source (id)');
        $this->addSql('ALTER TABLE accard_import_sample ADD CONSTRAINT FK_173786F48F803478 FOREIGN KEY (patientId) REFERENCES accard_patient (id)');
        $this->addSql('ALTER TABLE accard_patient ADD CONSTRAINT FK_45453AFA39659675 FOREIGN KEY (targetId) REFERENCES accard_import_patient (id)');
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

        $this->addSql('ALTER TABLE lexik_trans_unit_translation DROP FOREIGN KEY FK_75CB162F93CB796C');
        $this->addSql('ALTER TABLE lexik_trans_unit_translation DROP FOREIGN KEY FK_75CB162FC3C583C9');
        $this->addSql('ALTER TABLE accard_activity_proto_fldval DROP FOREIGN KEY FK_182C8B0F1335E2FC');
        $this->addSql('ALTER TABLE accard_attr_proto_fldval DROP FOREIGN KEY FK_324CF2E7ED407E17');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fldval DROP FOREIGN KEY FK_8855F5A418AE7509');
        $this->addSql('ALTER TABLE accard_activity DROP FOREIGN KEY FK_C69BB645D0EA680C');
        $this->addSql('ALTER TABLE accard_diagnosis DROP FOREIGN KEY FK_F3B3ED7710EE4CEE');
        $this->addSql('ALTER TABLE accard_diagnosis DROP FOREIGN KEY FK_F3B3ED777BB601C');
        $this->addSql('ALTER TABLE accard_diagnosis_phase_inst DROP FOREIGN KEY FK_F09D7DB9158E0B66');
        $this->addSql('ALTER TABLE accard_import_activity DROP FOREIGN KEY FK_81CEBD4ED0EA680C');
        $this->addSql('ALTER TABLE accard_regimen DROP FOREIGN KEY FK_7E8EF59ED0EA680C');
        $this->addSql('ALTER TABLE accard_diagnosis_field_value DROP FOREIGN KEY FK_1EA4358FD0EA680C');
        $this->addSql('ALTER TABLE accard_diagnosis_phase_inst DROP FOREIGN KEY FK_F09D7DB999091188');
        $this->addSql('ALTER TABLE accard_patient DROP FOREIGN KEY FK_45453AFA39659675');
        $this->addSql('ALTER TABLE accard_activity DROP FOREIGN KEY FK_C69BB6458F803478');
        $this->addSql('ALTER TABLE accard_attribute DROP FOREIGN KEY FK_77180DB18F803478');
        $this->addSql('ALTER TABLE accard_behavior DROP FOREIGN KEY FK_51441FAF8F803478');
        $this->addSql('ALTER TABLE accard_diagnosis DROP FOREIGN KEY FK_F3B3ED778F803478');
        $this->addSql('ALTER TABLE accard_import_activity DROP FOREIGN KEY FK_81CEBD4E8F803478');
        $this->addSql('ALTER TABLE accard_import_sample DROP FOREIGN KEY FK_173786F48F803478');
        $this->addSql('ALTER TABLE accard_patient_phase_inst DROP FOREIGN KEY FK_450F421158E0B66');
        $this->addSql('ALTER TABLE accard_regimen DROP FOREIGN KEY FK_7E8EF59E8F803478');
        $this->addSql('ALTER TABLE accard_sample DROP FOREIGN KEY FK_6B6E6FFA8F803478');
        $this->addSql('ALTER TABLE accard_sample_source DROP FOREIGN KEY FK_5530F9C68F803478');
        $this->addSql('ALTER TABLE accard_patient_field_value DROP FOREIGN KEY FK_E084E3708F803478');
        $this->addSql('ALTER TABLE accard_patient_phase_inst DROP FOREIGN KEY FK_450F42199091188');
        $this->addSql('ALTER TABLE accard_activity DROP FOREIGN KEY FK_C69BB64585CA7E31');
        $this->addSql('ALTER TABLE accard_regimen_proto_fldval DROP FOREIGN KEY FK_5378E08E85CA7E31');
        $this->addSql('ALTER TABLE accard_sample_source DROP FOREIGN KEY FK_5530F9C68C7A1510');
        $this->addSql('ALTER TABLE accard_sample_proto_fldval DROP FOREIGN KEY FK_FD68D330730CE27D');
        $this->addSql('ALTER TABLE accard_import_sample DROP FOREIGN KEY FK_173786F4EE155AE0');
        $this->addSql('ALTER TABLE accard_sample DROP FOREIGN KEY FK_6B6E6FFAEE155AE0');
        $this->addSql('ALTER TABLE accard_option_value DROP FOREIGN KEY FK_96657CDDCE78B7CC');
        $this->addSql('ALTER TABLE accard_patient_field DROP FOREIGN KEY FK_54CED4B8CE78B7CC');
        $this->addSql('ALTER TABLE accard_diagnosis_field DROP FOREIGN KEY FK_AFEBBB2ECE78B7CC');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld DROP FOREIGN KEY FK_D2CFF673CE78B7CC');
        $this->addSql('ALTER TABLE accard_attr_proto_fld DROP FOREIGN KEY FK_6C285216CE78B7CC');
        $this->addSql('ALTER TABLE accard_sample_proto_fld DROP FOREIGN KEY FK_D7ABA2F3CE78B7CC');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld DROP FOREIGN KEY FK_E62A5851CE78B7CC');
        $this->addSql('ALTER TABLE accard_activity_proto_fld DROP FOREIGN KEY FK_81052DA5CE78B7CC');
        $this->addSql('ALTER TABLE accard_patient_field_value DROP FOREIGN KEY FK_E084E37081F9A87C');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP FOREIGN KEY FK_C6EC0E8BE8ED26A9');
        $this->addSql('ALTER TABLE accard_diagnosis_field_value DROP FOREIGN KEY FK_1EA4358F81F9A87C');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP FOREIGN KEY FK_38CCD874E8ED26A9');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fldval DROP FOREIGN KEY FK_8855F5A481F9A87C');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP FOREIGN KEY FK_5AD23C54E8ED26A9');
        $this->addSql('ALTER TABLE accard_attr_proto_fldval DROP FOREIGN KEY FK_324CF2E781F9A87C');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP FOREIGN KEY FK_D58BF8B9E8ED26A9');
        $this->addSql('ALTER TABLE accard_sample_proto_fldval DROP FOREIGN KEY FK_FD68D33081F9A87C');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP FOREIGN KEY FK_9CECBE04E8ED26A9');
        $this->addSql('ALTER TABLE accard_regimen_proto_fldval DROP FOREIGN KEY FK_5378E08E81F9A87C');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP FOREIGN KEY FK_CCCE7B63E8ED26A9');
        $this->addSql('ALTER TABLE accard_activity_proto_fldval DROP FOREIGN KEY FK_182C8B0F81F9A87C');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP FOREIGN KEY FK_359EDC71E8ED26A9');
        $this->addSql('ALTER TABLE accard_activity DROP FOREIGN KEY FK_C69BB645DBA88346');
        $this->addSql('ALTER TABLE accard_import_activity DROP FOREIGN KEY FK_81CEBD4EDBA88346');
        $this->addSql('ALTER TABLE accard_regimen DROP FOREIGN KEY FK_7E8EF59EDBA88346');
        $this->addSql('ALTER TABLE accard_drug DROP FOREIGN KEY FK_89DC2B552179D01F');
        $this->addSql('ALTER TABLE accard_drugs_groups DROP FOREIGN KEY FK_DAB9D6E4DBA88346');
        $this->addSql('ALTER TABLE accard_drugs_groups DROP FOREIGN KEY FK_DAB9D6E4ED8188B0');
        $this->addSql('ALTER TABLE accard_regimen_prototype DROP FOREIGN KEY FK_1713F9E8A67C4099');
        $this->addSql('ALTER TABLE accard_activity_prototype DROP FOREIGN KEY FK_703C8C1CA67C4099');
        $this->addSql('ALTER TABLE accard_patient_field_value DROP FOREIGN KEY FK_E084E3705E697A44');
        $this->addSql('ALTER TABLE accard_patient_fld_opt_map DROP FOREIGN KEY FK_C6EC0E8B81F9A87C');
        $this->addSql('ALTER TABLE accard_diagnosis DROP FOREIGN KEY FK_F3B3ED77B5FC0459');
        $this->addSql('ALTER TABLE accard_diagnosis_codes_groups DROP FOREIGN KEY FK_E9D4D81DB5FC0459');
        $this->addSql('ALTER TABLE accard_diagnosis_codes_groups DROP FOREIGN KEY FK_E9D4D81DED8188B0');
        $this->addSql('ALTER TABLE accard_diagnosis_field_value DROP FOREIGN KEY FK_1EA4358F5E697A44');
        $this->addSql('ALTER TABLE accard_diagnosis_fld_opt_map DROP FOREIGN KEY FK_38CCD87481F9A87C');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fldval DROP FOREIGN KEY FK_8855F5A45E697A44');
        $this->addSql('ALTER TABLE accard_behavior_prototype_map DROP FOREIGN KEY FK_98CC21513E0C34EB');
        $this->addSql('ALTER TABLE accard_bhvr_proto_fld_opt_map DROP FOREIGN KEY FK_5AD23C5481F9A87C');
        $this->addSql('ALTER TABLE accard_behavior DROP FOREIGN KEY FK_51441FAF9B116E9A');
        $this->addSql('ALTER TABLE accard_behavior_prototype_map DROP FOREIGN KEY FK_98CC21519B116E9A');
        $this->addSql('ALTER TABLE accard_attr_proto_fldval DROP FOREIGN KEY FK_324CF2E75E697A44');
        $this->addSql('ALTER TABLE accard_attribute_prototype_map DROP FOREIGN KEY FK_B6E609353E0C34EB');
        $this->addSql('ALTER TABLE accard_attr_proto_fld_opt_map DROP FOREIGN KEY FK_D58BF8B981F9A87C');
        $this->addSql('ALTER TABLE accard_attribute DROP FOREIGN KEY FK_77180DB19B116E9A');
        $this->addSql('ALTER TABLE accard_attribute_prototype_map DROP FOREIGN KEY FK_B6E609359B116E9A');
        $this->addSql('ALTER TABLE accard_sample_proto_fldval DROP FOREIGN KEY FK_FD68D3305E697A44');
        $this->addSql('ALTER TABLE accard_sample_prototype_map DROP FOREIGN KEY FK_B953D8243E0C34EB');
        $this->addSql('ALTER TABLE accard_sample_proto_fld_opt_ma DROP FOREIGN KEY FK_9CECBE0481F9A87C');
        $this->addSql('ALTER TABLE accard_sample DROP FOREIGN KEY FK_6B6E6FFA9B116E9A');
        $this->addSql('ALTER TABLE accard_sample_prototype_map DROP FOREIGN KEY FK_B953D8249B116E9A');
        $this->addSql('ALTER TABLE accard_regimen_proto_fldval DROP FOREIGN KEY FK_5378E08E5E697A44');
        $this->addSql('ALTER TABLE accard_regimen_prototype_map DROP FOREIGN KEY FK_9524569C3E0C34EB');
        $this->addSql('ALTER TABLE accard_regimen_proto_fld_opt_m DROP FOREIGN KEY FK_CCCE7B6381F9A87C');
        $this->addSql('ALTER TABLE accard_regimen DROP FOREIGN KEY FK_7E8EF59E9B116E9A');
        $this->addSql('ALTER TABLE accard_regimen_prototype_map DROP FOREIGN KEY FK_9524569C9B116E9A');
        $this->addSql('ALTER TABLE accard_regimen_activity_map DROP FOREIGN KEY FK_447DEB5B2B242F3D');
        $this->addSql('ALTER TABLE accard_activity_proto_fldval DROP FOREIGN KEY FK_182C8B0F5E697A44');
        $this->addSql('ALTER TABLE accard_activity_prototype_map DROP FOREIGN KEY FK_FD0B1413E0C34EB');
        $this->addSql('ALTER TABLE accard_activity_proto_fld_opt_ DROP FOREIGN KEY FK_359EDC7181F9A87C');
        $this->addSql('ALTER TABLE accard_activity DROP FOREIGN KEY FK_C69BB6459B116E9A');
        $this->addSql('ALTER TABLE accard_regimen_activity_map DROP FOREIGN KEY FK_447DEB5B438AD5F2');
        $this->addSql('ALTER TABLE accard_activity_prototype_map DROP FOREIGN KEY FK_FD0B1419B116E9A');
        $this->addSql('ALTER TABLE accard_log DROP FOREIGN KEY FK_2AC893464B64DCC');
        $this->addSql('DROP TABLE accard_template');
        $this->addSql('DROP TABLE lexik_translation_file');
        $this->addSql('DROP TABLE lexik_trans_unit_translation');
        $this->addSql('DROP TABLE lexik_trans_unit');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE accard_import');
        $this->addSql('DROP TABLE accard_log');
        $this->addSql('DROP TABLE accard_setting');
        $this->addSql('DROP TABLE accard_activity');
        $this->addSql('DROP TABLE accard_attribute');
        $this->addSql('DROP TABLE accard_behavior');
        $this->addSql('DROP TABLE accard_diagnosis');
        $this->addSql('DROP TABLE accard_diagnosis_phase');
        $this->addSql('DROP TABLE accard_diagnosis_phase_inst');
        $this->addSql('DROP TABLE accard_import_activity');
        $this->addSql('DROP TABLE accard_import_patient');
        $this->addSql('DROP TABLE accard_import_sample');
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
            '76165519' => 'wormleyw',
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
     * Kill migration if playform is not MySQL.
     *
     * @throws Exception If platform doesn't match.
     */
    private function assertPlatform()
    {
        $platform = $this->platform->getName();

        $this->abortIf($platform != 'mysql', 'Migration can only be executed safely on mysql.');
    }
}
