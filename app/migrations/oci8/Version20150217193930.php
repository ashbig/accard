<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150217193930 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('ALTER TABLE ACCARD_LOG ADD (uriAttributes CLOB DEFAULT NULL NULL, uriQuery CLOB DEFAULT NULL NULL, uriRequest CLOB DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ACCARD_LOG RENAME COLUMN "resource" TO resourceName');
        $this->addSql('ALTER TABLE ACCARD_LOG DROP (ATTRIBUTES, QUERY, REQUEST)');
        $this->addSql('COMMENT ON COLUMN ACCARD_LOG.uriAttributes IS \'(DC2Type:json_array)\'');
        $this->addSql('COMMENT ON COLUMN ACCARD_LOG.uriQuery IS \'(DC2Type:json_array)\'');
        $this->addSql('COMMENT ON COLUMN ACCARD_LOG.uriRequest IS \'(DC2Type:json_array)\'');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('ALTER TABLE accard_log ADD (ATTRIBUTES CLOB DEFAULT NULL NULL, QUERY CLOB DEFAULT NULL NULL, REQUEST CLOB DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE accard_log RENAME COLUMN resourcename TO "resource"');
        $this->addSql('ALTER TABLE accard_log DROP (uriAttributes, uriQuery, uriRequest)');
        $this->addSql('COMMENT ON COLUMN accard_log.ATTRIBUTES IS \'\'');
        $this->addSql('COMMENT ON COLUMN accard_log.QUERY IS \'\'');
        $this->addSql('COMMENT ON COLUMN accard_log.REQUEST IS \'\'');
    }
}
