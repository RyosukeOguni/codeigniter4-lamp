# CodeIgniter 4 & Smarty Example

## Prerequisites

- Installed Docker

## Get started

### Docker 環境を作成

Docker 環境の作成については [こちら](docker-env/README.md) をご覧ください。

### コンテナ作成・実行

`docker-env` ディレクトリに移動して以下を実行してください。

```shell
cd docker-env
docker-compose up -d
```

### パッケージのインストールとデータベースのマイグレーション

PHP コンテナを検索します。
Docker 環境の作成時にコンテナ名のプレフィックスを変更していない場合、次のようなコマンドとなります。

```shell
docker container ls --filter "name=^/codeigniter4-.*$"
```

NAMES のところで php が含まれているものを探します。この場合は `codeigniter4-php` となります。

```text
CONTAINER ID   IMAGE              COMMAND                  CREATED         STATUS         PORTS                                      NAMES
26bca3f10a1d   docker-env_php     "docker-php-entrypoi…"   3 minutes ago   Up 3 minutes   9000/tcp                                   codeigniter4-php
160b9642ea2e   docker-env_httpd   "httpd-foreground"       3 minutes ago   Up 3 minutes   0.0.0.0:80->80/tcp, 0.0.0.0:443->443/tcp   codeigniter4-httpd
8f29783442bf   docker-env_db      "docker-entrypoint.s…"   3 minutes ago   Up 3 minutes   0.0.0.0:5432->5432/tcp                     codeigniter4-db
```

PHP コンテナにログインします。

```shell
docker exec -it codeigniter4-php ash
```

以下のコマンドを実行して、パッケージのインストールとデータベースのマイグレーションを行います。
データベースに接続できない旨のエラーが出たときは、データベースが起動するのを待ってください。

```shell
composer install
composer run db:migrate
```

---

## for developers

### 導入したときのメモ

```shell
composer create-project codeigniter4/appstarter project-root --prefer-source --ignore-platform-reqs
mkcert -cert-file ./keys/server.crt -key-file ./keys/server.key www.example.com localhost *.localhost codeigniter.example.com *.codeigniter.example.com
```

### phinx

本番環境でも phinx を使ってマイグレーションすることを想定しているので require-dev ではなく require に追記した。

in PHP docker container

```shell
mkdir -p ./phinx && cd $_
phinx init
```

create migration

```shell
# at phinx directory
mkdir -p db/migrations
mkdir -p db/seeds
phinx create CreateTableCiSessions
```

[この辺](https://book.cakephp.org/phinx/0/en/migrations.html) 見ながらやる

migrate

```shell
# at phinx directory
phinx migrate
```
