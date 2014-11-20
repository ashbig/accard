<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141119194134 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accard_drug (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, genericId INT DEFAULT NULL, UNIQUE INDEX UNIQ_89DC2B555E237E06 (name), INDEX IDX_89DC2B552179D01F (genericId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_drug_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8FCC09265E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accard_drugs_groups (groupId INT NOT NULL, drugId INT NOT NULL, INDEX IDX_DAB9D6E4ED8188B0 (groupId), INDEX IDX_DAB9D6E4DBA88346 (drugId), PRIMARY KEY(groupId, drugId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dag_user (id INT NOT NULL, username VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accard_drug ADD CONSTRAINT FK_89DC2B552179D01F FOREIGN KEY (genericId) REFERENCES accard_drug (id)');
        $this->addSql('ALTER TABLE accard_drugs_groups ADD CONSTRAINT FK_DAB9D6E4ED8188B0 FOREIGN KEY (groupId) REFERENCES accard_drug_group (id)');
        $this->addSql('ALTER TABLE accard_drugs_groups ADD CONSTRAINT FK_DAB9D6E4DBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('ALTER TABLE accard_activity ADD drugId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accard_activity ADD CONSTRAINT FK_C69BB645DBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('CREATE INDEX IDX_C69BB645DBA88346 ON accard_activity (drugId)');
        $this->addSql('ALTER TABLE accard_import_activity ADD drugId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accard_import_activity ADD CONSTRAINT FK_81CEBD4EDBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('CREATE INDEX IDX_81CEBD4EDBA88346 ON accard_import_activity (drugId)');
        $this->addSql('ALTER TABLE accard_regimen ADD drugId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accard_regimen ADD CONSTRAINT FK_7E8EF59EDBA88346 FOREIGN KEY (drugId) REFERENCES accard_drug (id)');
        $this->addSql('CREATE INDEX IDX_7E8EF59EDBA88346 ON accard_regimen (drugId)');
        $this->addSql('ALTER TABLE accard_regimen_prototype ADD allowDrug TINYINT(1) NULL, ADD drugGroupId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accard_regimen_prototype ADD CONSTRAINT FK_1713F9E8A67C4099 FOREIGN KEY (drugGroupId) REFERENCES accard_drug_group (id)');
        $this->addSql('CREATE INDEX IDX_1713F9E8A67C4099 ON accard_regimen_prototype (drugGroupId)');
        $this->addSql('ALTER TABLE accard_activity_prototype ADD allowDrug TINYINT(1) NULL, ADD drugGroupId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accard_activity_prototype ADD CONSTRAINT FK_703C8C1CA67C4099 FOREIGN KEY (drugGroupId) REFERENCES accard_drug_group (id)');
        $this->addSql('CREATE INDEX IDX_703C8C1CA67C4099 ON accard_activity_prototype (drugGroupId)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accard_activity DROP FOREIGN KEY FK_C69BB645DBA88346');
        $this->addSql('ALTER TABLE accard_import_activity DROP FOREIGN KEY FK_81CEBD4EDBA88346');
        $this->addSql('ALTER TABLE accard_regimen DROP FOREIGN KEY FK_7E8EF59EDBA88346');
        $this->addSql('ALTER TABLE accard_drug DROP FOREIGN KEY FK_89DC2B552179D01F');
        $this->addSql('ALTER TABLE accard_drugs_groups DROP FOREIGN KEY FK_DAB9D6E4DBA88346');
        $this->addSql('ALTER TABLE accard_drugs_groups DROP FOREIGN KEY FK_DAB9D6E4ED8188B0');
        $this->addSql('ALTER TABLE accard_regimen_prototype DROP FOREIGN KEY FK_1713F9E8A67C4099');
        $this->addSql('ALTER TABLE accard_activity_prototype DROP FOREIGN KEY FK_703C8C1CA67C4099');
        $this->addSql('DROP TABLE accard_drug');
        $this->addSql('DROP TABLE accard_drug_group');
        $this->addSql('DROP TABLE accard_drugs_groups');
        $this->addSql('DROP TABLE dag_user');
        $this->addSql('DROP INDEX IDX_C69BB645DBA88346 ON accard_activity');
        $this->addSql('ALTER TABLE accard_activity DROP drugId');
        $this->addSql('DROP INDEX IDX_703C8C1CA67C4099 ON accard_activity_prototype');
        $this->addSql('ALTER TABLE accard_activity_prototype DROP allowDrug, DROP drugGroupId');
        $this->addSql('DROP INDEX IDX_81CEBD4EDBA88346 ON accard_import_activity');
        $this->addSql('ALTER TABLE accard_import_activity DROP drugId');
        $this->addSql('DROP INDEX IDX_7E8EF59EDBA88346 ON accard_regimen');
        $this->addSql('ALTER TABLE accard_regimen DROP drugId');
        $this->addSql('DROP INDEX IDX_1713F9E8A67C4099 ON accard_regimen_prototype');
        $this->addSql('ALTER TABLE accard_regimen_prototype DROP allowDrug, DROP drugGroupId');
    }
}
