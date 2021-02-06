<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Service;

use App\DatabaseComponent\Work\WorkInterface;

interface ServiceInterface extends WorkInterface
{
    public function execute(): void;
}
