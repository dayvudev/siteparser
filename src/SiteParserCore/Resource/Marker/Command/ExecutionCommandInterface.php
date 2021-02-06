<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Command;

use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Work\Command\CommandInterface;

interface ExecutionCommandInterface extends MarkerInterface, CommandInterface
{
}
