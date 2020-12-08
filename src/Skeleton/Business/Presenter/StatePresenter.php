<?php declare(strict_types=1);
namespace App\Skeleton\Business\Presenter;

use Swagger\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/skeleton")
 */
class StatePresenter
{
    /**
    * @Route("/state")
     */
    public function state(): Response
    {
        return new Response('OK');
    }
}