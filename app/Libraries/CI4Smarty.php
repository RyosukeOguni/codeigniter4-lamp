<?php

namespace App\Libraries;

use Exception;
use Smarty;

class CI4Smarty extends Smarty
{
    use LoggingTrait;

    /**
     * Constructor.
     *
     * https://qiita.com/idani/items/12abe952754ecf0a3de6 を参考にしています。
     */
    public function __construct()
    {
        parent::__construct();

        // DO NOT EDIT THIS LINE
        $this->escape_html = true;

        $this->setTemplateDir(APPPATH . 'Views/templates');
        $this->setCompileDir(ROOTPATH . 'writable/cache/smarty/templates_c');
        $this->setCacheDir(ROOTPATH . 'writable/cache');
        if (!is_writable($this->getCompileDir())) {
            // make sure to compile directory can be written to
            @chmod($this->getCompileDir(), 0777);
        }
        $this->left_delimiter = '{{';
        $this->right_delimiter = '}}';

        $this->log(CI_APP_LOG_LEVEL_DEBUG, "Smarty Class Initialized");
    }

    /**
     * @param string               $template
     * @param array<string, mixed> $data
     *
     * @return string
     */
    public function view(string $template, array $data = array()): string
    {
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }

        try {
            $rendered_template = $this->fetch($template, $this->cache_id, $this->compile_id);
        } catch (Exception $e) {
            $this->log(CI_APP_LOG_LEVEL_ERROR, 'Smarty: render failed.');
            $this->log(CI_APP_LOG_LEVEL_DEBUG, $e->getTraceAsString());

            return '';
        }

        return $rendered_template;
    }
}
