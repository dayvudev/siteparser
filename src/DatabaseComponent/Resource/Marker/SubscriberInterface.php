<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Work\Observer\ObserverInterface;

interface SubscriberInterface extends MarkerInterface, ObserverInterface
{
}
