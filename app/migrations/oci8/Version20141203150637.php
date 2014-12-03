<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141203150637 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('CREATE TABLE accard_regimen_activity_map (activityPrototypeId NUMBER(10) NOT NULL, regimenPrototypeId NUMBER(10) NOT NULL, PRIMARY KEY(activityPrototypeId, regimenPrototypeId))');
        $this->addSql('CREATE INDEX IDX_447DEB5B2B242F3D ON accard_regimen_activity_map (activityPrototypeId)');
        $this->addSql('CREATE INDEX IDX_447DEB5B438AD5F2 ON accard_regimen_activity_map (regimenPrototypeId)');
        $this->addSql('ALTER TABLE accard_regimen_activity_map ADD CONSTRAINT FK_447DEB5B2B242F3D FOREIGN KEY (activityPrototypeId) REFERENCES accard_regimen_prototype (id)');
        $this->addSql('ALTER TABLE accard_regimen_activity_map ADD CONSTRAINT FK_447DEB5B438AD5F2 FOREIGN KEY (regimenPrototypeId) REFERENCES accard_activity_prototype (id)');
        $this->addSql('ALTER TABLE ACCARD_ACTIVITY MODIFY (activityDate DATE DEFAULT NULL)');
        $this->addSql('ALTER TABLE ACCARD_IMPORT_ACTIVITY MODIFY (activityDate DATE DEFAULT NULL)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('DROP TABLE accard_regimen_activity_map');
        $this->addSql('ALTER TABLE accard_activity MODIFY (ACTIVITYDATE TIMESTAMP(0) DEFAULT NULL)');
        $this->addSql('ALTER TABLE accard_import_activity MODIFY (ACTIVITYDATE TIMESTAMP(0) DEFAULT NULL)');
    }
}
