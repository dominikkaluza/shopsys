<?php

namespace Shopsys\MicroserviceProductSearchExport\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class LiveCheckController
{
    public function checkAction(): JsonResponse
    {
        return new JsonResponse(['info' => 'running']);
    }
}
