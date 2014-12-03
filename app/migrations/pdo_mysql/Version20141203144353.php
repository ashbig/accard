<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141203144353 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accard_regimen_activity_map (activityPrototypeId INT NOT NULL, regimenPrototypeId INT NOT NULL, INDEX IDX_447DEB5B2B242F3D (activityPrototypeId), INDEX IDX_447DEB5B438AD5F2 (regimenPrototypeId), PRIMARY KEY(activityPrototypeId, regimenPrototypeId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accard_regimen_activity_map ADD CONSTRAINT FK_447DEB5B2B242F3D FOREIGN KEY (activityPrototypeId) REFERENCES accard_regimen_prototype (id)');
        $this->addSql('ALTER TABLE accard_regimen_activity_map ADD CONSTRAINT FK_447DEB5B438AD5F2 FOREIGN KEY (regimenPrototypeId) REFERENCES accard_activity_prototype (id)');
        $this->addSql('ALTER TABLE accard_regimen_prototype CHANGE allowDrug allowDrug TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE accard_activity_prototype CHANGE allowDrug allowDrug TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE accard_regimen_activity_map');
        $this->addSql('ALTER TABLE accard_activity_prototype CHANGE allowDrug allowDrug TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE accard_regimen_prototype CHANGE allowDrug allowDrug TINYINT(1) NOT NULL');
    }
}
