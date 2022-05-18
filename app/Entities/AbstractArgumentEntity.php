<?php

namespace App\Entities;

use App\Libraries\LoggingTrait;
use InvalidArgumentException;

/**
 * 内部で関数の引数を取り扱うエンティティ抽象クラス。
 * 関数の引数が多くなる懸念があるときに利用すると便利です。
 *
 * これを継承したクラスでは、関数の引数にあたるものをインスタンスプロパティで定義し、以下のメソッドをオーバーライドする必要があります。
 * - バリデーションを行う validateData メソッド
 * - インスタンスプロパティをセットする setData メソッド
 *
 * @note このクラスは、あくまで開発において内部的に使用する関数および引数が正しいことを確認するためのものです。
 * フォームから受け取った値を処理するためにこのクラスを使わないでください。
 */
abstract class AbstractArgumentEntity
{
    use LoggingTrait;

    /**
     * @param array|null $data
     *
     * @return AbstractArgumentEntity
     */
    final public static function getInstance(?array $data = null): AbstractArgumentEntity
    {
        $className = get_called_class();
        /** @var AbstractArgumentEntity $obj */
        $obj = new $className();
        $obj->validateData($data);
        $obj->setData($data);

        return $obj;
    }

    final private function __construct()
    {
    }

    /**
     * 引数のバリデーションを行う関数。
     * バリデーションを通らないデータが存在した場合は、その詳細を InvalidArgumentException のメッセージで出力してください。
     *
     * @param array|null $data
     *
     * @return void
     * @throws InvalidArgumentException if arguments are invalid
     */
    abstract protected function validateData(?array $data): void;

    /**
     * 定義したインスタンスプロパティにデータをセットしてください。
     *
     * @param array|null $data
     *
     * @return void
     */
    abstract protected function setData(?array $data): void;
}
