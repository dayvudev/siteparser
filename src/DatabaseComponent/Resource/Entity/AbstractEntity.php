<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Entity;

use DateTime;
use DateTimeInterface;

class AbstractEntity implements EntityInterface
{
    /**
     * @var DateTime
     */
    protected $creationDate;

    public function __construct()
    {
        $this->creationDate = new DateTime();
    }

    public function getCreationDate(): ?DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }
}
