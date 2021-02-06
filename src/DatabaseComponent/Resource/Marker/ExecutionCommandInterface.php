<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker;

use App\SiteParserCore\Work\Command\CommandInterface;

interface ExecutionCommandInterface extends MarkerInterface, CommandInterface
{
}
