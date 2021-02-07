<?php declare(strict_types=1);
namespace App\SiteParserCore\Business\Event\Parsing;

use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Event\ParsingEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEvent extends Event implements ParsingEventInterface
{
    public const NAME = 'before.parsing';

    private $source;
    private $destination;

    public function __construct(?Source $source, ?Destination $destination)
    {
        $this->source = $source;
        $this->destination = $destination;
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getDestination(): Destination
    {
        return $this->destination;
    }
}
