<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150325203152 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('CREATE SEQUENCE ext_log_entries_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE ext_log_entries (id NUMBER(10) NOT NULL, action VARCHAR2(8) NOT NULL, logged_at TIMESTAMP(0) NOT NULL, object_id VARCHAR2(64) DEFAULT NULL NULL, object_class VARCHAR2(255) NOT NULL, version NUMBER(10) NOT NULL, data CLOB DEFAULT NULL NULL, username VARCHAR2(255) DEFAULT NULL NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX log_class_lookup_idx ON ext_log_entries (object_class)');
        $this->addSql('CREATE INDEX log_date_lookup_idx ON ext_log_entries (logged_at)');
        $this->addSql('CREATE INDEX log_user_lookup_idx ON ext_log_entries (username)');
        $this->addSql('CREATE INDEX log_version_lookup_idx ON ext_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN ext_log_entries.data IS \'(DC2Type:array)\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'oracle', 'Migration can only be executed safely on \'oracle\'.');

        $this->addSql('DROP SEQUENCE ext_log_entries_id_seq');
        $this->addSql('CREATE SEQUENCE ACCARD_CANVAS_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE LEXIK_TRANSLATION_FILE_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE LEXIK_TRANS_UNIT_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE LEXIK_TRANS_UNIT_TRANS_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE ACCARD_CANVAS (GRID CLOB NOT NULL, ID NUMBER(10) NOT NULL, ROUTE VARCHAR2(255) NOT NULL, PRIMARY KEY(ID))');
        $this->addSql('COMMENT ON COLUMN ACCARD_CANVAS.GRID IS \'(DC2Type:json_array)\'');
        $this->addSql('DROP TABLE ext_log_entries');
    }
}
