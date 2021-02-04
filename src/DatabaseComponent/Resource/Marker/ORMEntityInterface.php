<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Resource\Entity\EntityInterface;
use DateTimeInterface;

interface ORMEntityInterface extends MarkerInterface, EntityInterface
{
    public const LOGIC_EXCEPTION_MESSAGE = self::class;
    
    public function getId(): int;
    public function getCreationDate(): DateTimeInterface;

    public function setId(int $value): self;
    public function setCreationDate(DateTimeInterface $value): self;
}
