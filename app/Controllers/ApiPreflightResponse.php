<?php

namespace App\Controllers;

use Config\Services;
use JetBrains\PhpStorm\NoReturn;

/**
 * API プリフライトリクエスト用コントローラ。
 *
 * 同期通信の CSRF 対策においてはトークンを使用した方法があるが、非同期通信においてはトークン用のデータベースを用意する手間が負担となります。
 * そのため、プリフライトリクエスト検証における対策を採用します。
 *
 * @see https://developer.mozilla.org/ja/docs/Web/HTTP/CORS#preflighted_requests
 */
class ApiPreflightResponse extends ApiBaseController
{
    /**
     * @return string[]
     */
    private function getAllowedMethods(): array
    {
        $allowedMethods = [];
        $routes = Services::routes();
        $uri_string = ltrim(uri_string(), '/');
        foreach (['get', 'post', 'options'] as $verb) {
            foreach (array_keys($routes->getRoutes($verb)) as $item) {
                if (preg_match('#^' . $item . '$#', $uri_string) === 1) {
                    $allowedMethods[] = strtoupper($verb);
                    break;
                }
            }
        }

        return $allowedMethods;
    }

    #[NoReturn] public function index(): void
    {
        $allowedMethods = $this->getAllowedMethods();

        // このメソッドの処理が行われている時点で、許可されているメソッドが必ず 1 つ以上ある
        if ($allowedMethods === array()) {
            $this->log(CI_APP_LOG_LEVEL_CRITICAL, 'unexpected call of controller methods');
        } elseif (count($allowedMethods) === 1) {
            $this->response->setHeader('Access-Control-Request-Method', $allowedMethods[0]);
        } else {
            $this->response->setHeader('Access-Control-Request-Methods', implode(', ', $allowedMethods));
        }
        $this->response->setHeader('Access-Control-Allow-Headers', 'content-type, x-api-key');
        $this->sendResponseSucceeded();
    }
}
