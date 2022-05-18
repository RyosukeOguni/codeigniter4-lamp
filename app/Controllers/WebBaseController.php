<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Controllers;

use App\Entities\AssignFormArgumentEntity;
use App\Libraries\CI4Smarty;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class WebBaseController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form'];

    /**
     * @var CI4Smarty $smarty Smarty クラス。
     */
    protected CI4Smarty $smarty;

    /**
     * Constructor.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->smarty = new CI4Smarty();
    }

    /**
     * @param AssignFormArgumentEntity $args
     *
     * @return void
     */
    protected function assignForm(AssignFormArgumentEntity $args): void
    {
        $this->smarty->assign($args->tplVar, array(
            'open_tag' => form_open(
                route_to("$args->controllerName::$args->methodName"),
                array('method' => $args->requestMethod)
            ),
            'close_tag' => form_close(),
        ));
    }

    /**
     * POST メソッドのときに用いること。
     *
     * @return void
     * @see https://github.com/codeigniter4/CodeIgniter4/security/advisories/GHSA-4v37-24gm-h554
     */
    protected function checkMethodIsPost(): void
    {
        if (strtolower($this->request->getMethod()) !== 'post') {
            $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }
    }
}
