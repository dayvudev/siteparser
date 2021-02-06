<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Work\Command\CommandInterface;

interface ExecutionCommandInterface extends MarkerInterface, CommandInterface
{
}
