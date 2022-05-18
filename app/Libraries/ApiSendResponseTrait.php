<?php

namespace App\Libraries;

use CodeIgniter\Format\JSONFormatter;
use Config\Services;
use JetBrains\PhpStorm\NoReturn;

trait ApiSendResponseTrait
{
    #[NoReturn] private function sendResponse(array|string $data, int $statusCode): void
    {
        $mimeType = 'application/json';
        /** @var JSONFormatter $formatter */
        $formatter = Services::format()->getFormatter($mimeType);
        Services::response()
            ->setHeader('Access-Control-Allow-Origin', getenv('CI_APP_API_ACCESS_CONTROL_ALLOW_ORIGIN'))
            ->setHeader('Content-type', $mimeType)
            ->setBody($formatter->format($data))
            ->setStatusCode($statusCode)
            ->send();
        exit;
    }

    #[NoReturn] final protected function sendResponseSucceeded(
        array|string $data = null,
        int $statusCode = 200
    ): void {
        if (is_null($data)) {
            $data = 'No Content';
            $statusCode = 204;
        }

        $this->sendResponse($data, $statusCode);
    }

    #[NoReturn] final protected function sendResponseFailed(string $message, int $statusCode = 400): void
    {
        $this->sendResponse(array('error_message' => $message), $statusCode);
    }
}
