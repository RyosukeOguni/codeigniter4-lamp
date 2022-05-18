<?php

namespace App\Controllers;

use App\Entities\AssignFormArgumentEntity;
use App\Models\HomeModel;
use CodeIgniter\Model;
use Exception;

class WebHome extends WebBaseController
{
    /**
     * @var Model $model
     */
    private Model $model;

    public function __construct()
    {
        $this->model = new HomeModel();
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $this->assignForm(
            AssignFormArgumentEntity::getInstance(
                array(
                    'controllerName' => WebHome::class,
                    'methodName' => 'register',
                    'requestMethod' => 'post',
                )
            )
        );

        return $this->smarty->view('welcome.tpl', array(
            'title' => 'CodeIgniter Sample Page',
            'message' => 'It Works!',
            'sessionCount' => $this->model->getSessionCount(),
        ));
    }

    /**
     * @return string
     */
    public function register(): string
    {
        $this->checkMethodIsPost();

        try {
            return json_encode($this->request->getPost(), JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }
}
