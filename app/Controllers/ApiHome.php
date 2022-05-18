<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;

class ApiHome extends ApiBaseController
{
    #[NoReturn] public function index(): void
    {
        $this->sendResponseSucceeded('hello');
    }
}
