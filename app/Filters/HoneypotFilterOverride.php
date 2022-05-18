<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Filters;

use App\Libraries\LoggingTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Honeypot\Exceptions\HoneypotException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

/**
 * Honeypot filter
 */
class HoneypotFilterOverride implements FilterInterface
{
    use LoggingTrait;

    /**
     * Checks if Honeypot field is empty, if not then the
     * requester is a bot
     *
     * @param array|null $arguments
     *
     * @throws HoneypotException
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $honeypot = Services::honeypot();
        if (!$honeypot->hasContent($request)) {
            return;
        }

        $content = $honeypot->getContent($request);
        if ($content['matched'] !== array()) {
            $this->log(
                CI_APP_LOG_LEVEL_NOTICE,
                'The request sent by the bot contained the following words: ' . json_encode($content['matched'])
            );
        }

        throw HoneypotException::isBot();
    }

    /**
     * Attach a honeypot to the current response.
     *
     * @param array|null $arguments
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        Services::honeypot()->attachHoneypot($response);
    }
}
