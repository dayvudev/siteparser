<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service;

use App\SiteParserCore\Work\WorkInterface;

interface ServiceInterface extends WorkInterface
{
    public function execute(): void;
}
