<?php declare(strict_types=1);
namespace DoctrineMigrations;

use App\SiteParserCore\Business\Definition\Database\MigrationDefinitionInterface;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210206105805 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        foreach (MigrationDefinitionInterface::UP_QUERY_LIST as $query) {
            $this->addSql($query);
        }
    }

    public function down(Schema $schema) : void
    {
        foreach (MigrationDefinitionInterface::DOWN_QUERY_LIST as $query) {
            $this->addSql($query);
        }
    }
}
