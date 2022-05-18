<?php

namespace App\Services;

use CodeIgniter\Honeypot\Honeypot;
use CodeIgniter\HTTP\RequestInterface;
use JetBrains\PhpStorm\ArrayShape;

class HoneypotServiceOverride extends Honeypot
{
    /**
     * ハニーポットに入力された内容を取得し、特定のキーワードを含んでいる場合はそのキーワードを返します。
     *
     * @note 現在は文字列のみ対応
     *
     * @param RequestInterface $request
     *
     * @return array{content: mixed, matched: array<string>}
     */
    #[ArrayShape(['content' => "mixed", 'matched' => "array"])]
    public function getContent(RequestInterface $request): array
    {
        $content = $request->getPost($this->config->name);
        if (gettype($content) !== 'string') {
            return array(
                'content' => $content,
                'matched' => array(),
            );
        }

        $matched = array();
        foreach ($this->config->huntKeywords as $keyword) {
            if (str_contains($content, $keyword)) {
                $matched[] = $keyword;
            }
        }

        return array(
            'content' => $content,
            'matched' => $matched,
        );
    }
}
