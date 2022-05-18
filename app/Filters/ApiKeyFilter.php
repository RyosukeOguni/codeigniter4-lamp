<?php

namespace App\Filters;

use App\Libraries\ApiSendResponseTrait;
use App\Libraries\LoggingTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiKeyFilter implements FilterInterface
{
    use ApiSendResponseTrait;
    use LoggingTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        if ($request->getHeaderLine('x-api-key') !== getenv('CI_APP_API_KEY')) {
            $this->log(CI_APP_LOG_LEVEL_ERROR, 'invalid api key');
            $this->sendResponseFailed('invalid api key');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
