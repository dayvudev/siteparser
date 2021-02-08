<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Entity\Handler;

use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;

class HandlerResult implements HandlerResultInterface
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function setData(string $key, $value): self
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function getData(string $key)
    {
        return $this->data[$key];
    }
}
