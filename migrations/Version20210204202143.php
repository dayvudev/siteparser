<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204202143 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT IDENTITY NOT NULL, source_id INT NOT NULL, destination_id INT NOT NULL, name NVARCHAR(100) NOT NULL, handler_namespace NVARCHAR(2000) NOT NULL, sort_order INT, is_disable BIT, creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_47CC8C92953C1C61 ON action (source_id)');
        $this->addSql('CREATE INDEX IDX_47CC8C92816C6140 ON action (destination_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_action ON action (name, handler_namespace) WHERE name IS NOT NULL AND handler_namespace IS NOT NULL');
        $this->addSql('CREATE TABLE destination (id INT IDENTITY NOT NULL, output_id INT NOT NULL, name NVARCHAR(100) NOT NULL, handler_namespace NVARCHAR(2000) NOT NULL, creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_3EC63EAADE097880 ON destination (output_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_destination ON destination (name, handler_namespace) WHERE name IS NOT NULL AND handler_namespace IS NOT NULL');
        $this->addSql('CREATE TABLE group_parameters (id INT IDENTITY NOT NULL, group_id INT NOT NULL, parameter_id INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_D15E294CFE54D947 ON group_parameters (group_id)');
        $this->addSql('CREATE INDEX IDX_D15E294C7C56DBD6 ON group_parameters (parameter_id)');
        $this->addSql('CREATE TABLE owner (id INT IDENTITY NOT NULL, parser_id INT, name NVARCHAR(100) NOT NULL, url VARCHAR(MAX) NOT NULL, creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_CF60E67CF54E453B ON owner (parser_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_owner ON owner (name) WHERE name IS NOT NULL');
        $this->addSql('CREATE TABLE parameter (id INT IDENTITY NOT NULL, name NVARCHAR(100) NOT NULL, creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE parameter_group (id INT IDENTITY NOT NULL, name NVARCHAR(100) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE parameter_tree (id INT IDENTITY NOT NULL, parent_id INT NOT NULL, child_id INT NOT NULL, creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_18305DD9727ACA70 ON parameter_tree (parent_id)');
        $this->addSql('CREATE INDEX IDX_18305DD9DD62C21B ON parameter_tree (child_id)');
        $this->addSql('CREATE TABLE parser (id INT IDENTITY NOT NULL, name NVARCHAR(100) NOT NULL, sort_order INT, is_disable BIT, creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE parser_actions (id INT IDENTITY NOT NULL, parser_id INT NOT NULL, action_id INT NOT NULL, creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_BAB9095CF54E453B ON parser_actions (parser_id)');
        $this->addSql('CREATE INDEX IDX_BAB9095C9D32F035 ON parser_actions (action_id)');
        $this->addSql('CREATE TABLE parser_tree (id INT IDENTITY NOT NULL, parent_id INT NOT NULL, child_id INT NOT NULL, creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_E457E723727ACA70 ON parser_tree (parent_id)');
        $this->addSql('CREATE INDEX IDX_E457E723DD62C21B ON parser_tree (child_id)');
        $this->addSql('CREATE TABLE source (id INT IDENTITY NOT NULL, input_id INT NOT NULL, name NVARCHAR(100) NOT NULL, handler_namespace NVARCHAR(2000) NOT NULL, creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_5F8A7F7336421AD6 ON source (input_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_source ON source (name, handler_namespace) WHERE name IS NOT NULL AND handler_namespace IS NOT NULL');
        $this->addSql('CREATE TABLE value (id INT IDENTITY NOT NULL, parameter_id INT NOT NULL, value VARCHAR(MAX), creation_date DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_1D7758347C56DBD6 ON value (parameter_id)');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAADE097880 FOREIGN KEY (output_id) REFERENCES parameter (id)');
        $this->addSql('ALTER TABLE group_parameters ADD CONSTRAINT FK_D15E294CFE54D947 FOREIGN KEY (group_id) REFERENCES parameter_group (id)');
        $this->addSql('ALTER TABLE group_parameters ADD CONSTRAINT FK_D15E294C7C56DBD6 FOREIGN KEY (parameter_id) REFERENCES parameter (id)');
        $this->addSql('ALTER TABLE owner ADD CONSTRAINT FK_CF60E67CF54E453B FOREIGN KEY (parser_id) REFERENCES parser (id)');
        $this->addSql('ALTER TABLE parameter_tree ADD CONSTRAINT FK_18305DD9727ACA70 FOREIGN KEY (parent_id) REFERENCES parameter (id)');
        $this->addSql('ALTER TABLE parameter_tree ADD CONSTRAINT FK_18305DD9DD62C21B FOREIGN KEY (child_id) REFERENCES parameter (id)');
        $this->addSql('ALTER TABLE parser_actions ADD CONSTRAINT FK_BAB9095CF54E453B FOREIGN KEY (parser_id) REFERENCES parser (id)');
        $this->addSql('ALTER TABLE parser_actions ADD CONSTRAINT FK_BAB9095C9D32F035 FOREIGN KEY (action_id) REFERENCES action (id)');
        $this->addSql('ALTER TABLE parser_tree ADD CONSTRAINT FK_E457E723727ACA70 FOREIGN KEY (parent_id) REFERENCES parser (id)');
        $this->addSql('ALTER TABLE parser_tree ADD CONSTRAINT FK_E457E723DD62C21B FOREIGN KEY (child_id) REFERENCES parser (id)');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F7336421AD6 FOREIGN KEY (input_id) REFERENCES parameter (id)');
        $this->addSql('ALTER TABLE value ADD CONSTRAINT FK_1D7758347C56DBD6 FOREIGN KEY (parameter_id) REFERENCES parameter (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('CREATE SCHEMA user');
        $this->addSql('ALTER TABLE parser_actions DROP CONSTRAINT FK_BAB9095C9D32F035');
        $this->addSql('ALTER TABLE action DROP CONSTRAINT FK_47CC8C92816C6140');
        $this->addSql('ALTER TABLE destination DROP CONSTRAINT FK_3EC63EAADE097880');
        $this->addSql('ALTER TABLE group_parameters DROP CONSTRAINT FK_D15E294C7C56DBD6');
        $this->addSql('ALTER TABLE parameter_tree DROP CONSTRAINT FK_18305DD9727ACA70');
        $this->addSql('ALTER TABLE parameter_tree DROP CONSTRAINT FK_18305DD9DD62C21B');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F7336421AD6');
        $this->addSql('ALTER TABLE value DROP CONSTRAINT FK_1D7758347C56DBD6');
        $this->addSql('ALTER TABLE group_parameters DROP CONSTRAINT FK_D15E294CFE54D947');
        $this->addSql('ALTER TABLE owner DROP CONSTRAINT FK_CF60E67CF54E453B');
        $this->addSql('ALTER TABLE parser_actions DROP CONSTRAINT FK_BAB9095CF54E453B');
        $this->addSql('ALTER TABLE parser_tree DROP CONSTRAINT FK_E457E723727ACA70');
        $this->addSql('ALTER TABLE parser_tree DROP CONSTRAINT FK_E457E723DD62C21B');
        $this->addSql('ALTER TABLE action DROP CONSTRAINT FK_47CC8C92953C1C61');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE group_parameters');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE parameter');
        $this->addSql('DROP TABLE parameter_group');
        $this->addSql('DROP TABLE parameter_tree');
        $this->addSql('DROP TABLE parser');
        $this->addSql('DROP TABLE parser_actions');
        $this->addSql('DROP TABLE parser_tree');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE value');
    }
}
