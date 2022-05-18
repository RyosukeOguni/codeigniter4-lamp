<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Honeypot extends BaseConfig
{
    /**
     * Makes Honeypot visible or not to human
     *
     * @var bool
     */
    public $hidden = true;

    /**
     * Honeypot Label Content
     *
     * @var string
     */
    public $label = '_hp';

    /**
     * Honeypot Field Name
     *
     * @var string
     */
    public $name = '_hp';

    /**
     * Honeypot HTML Template
     *
     * @var string
     */
    public $template = '<label>{label}</label><input type="text" name="{name}" value=""/>';

    /**
     * Honeypot container
     *
     * @var string
     */
    public $container = '<div style="display:none">{template}</div>';

    /**
     * Honeypot hunting words
     *
     * @var array
     */
    public $huntKeywords = [];
}
