<?php

namespace App\Entities;

use Exception;
use InvalidArgumentException;

class AssignFormArgumentEntity extends AbstractArgumentEntity
{
    /**
     * @var string
     */
    public string $controllerName;
    /**
     * @var string
     */
    public string $methodName;
    /**
     * @var string
     */
    public string $requestMethod;
    /**
     * @var array|string
     */
    public mixed $attributes;
    /**
     * @var array
     */
    public array $hidden;
    /**
     * @var string
     */
    public string $tplVar;

    /**
     * @inheritDoc
     */
    protected function validateData(?array $data): void
    {
        try {
            if (!class_exists($data['controllerName'])) {
                throw new InvalidArgumentException('class not exists');
            }
            if (!method_exists($data['controllerName'], $data['methodName'])) {
                throw new InvalidArgumentException('method not exists');
            }
            if (
                gettype($data['requestMethod']) !== 'string'
                || !in_array($data['requestMethod'], array('get', 'post'), true)
            ) {
                throw new InvalidArgumentException('invalid request method');
            }
            if (
                isset($data['attributes'])
                && !in_array(gettype($data['attributes']), array('array', 'string'), true)
            ) {
                throw new InvalidArgumentException('invalid form attributes');
            }
            if (
                isset($data['hidden'])
                && gettype($data['hidden']) !== 'array'
            ) {
                throw new InvalidArgumentException('invalid hidden data');
            }
            if (
                isset($data['tplVar'])
                && gettype($data['tplVar']) !== 'string'
            ) {
                throw new InvalidArgumentException('invalid tplVar');
            }
        } catch (Exception $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    protected function setData(?array $data): void
    {
        $this->controllerName = $data['controllerName'];
        $this->methodName = $data['methodName'];
        $this->requestMethod = $data['requestMethod'];
        $this->attributes = $data['attributes'] ?? [];
        $this->hidden = $data['hidden'] ?? [];
        $this->tplVar = $data['tplVar'] ?? '_form';
    }
}
