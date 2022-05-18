# Docker 環境の作成

## 手順

### オレオレ証明書を作成する

以下の通り、作成します。

- 配置場所: `docker-env/httpd/keys`
- 証明書のファイル名: `server.crt`
- 証明書の鍵ファイル名: `server.key`
- ホスト名: `docker-env/httpd/hostnames.txt` に記載のホスト

[mkcert](https://github.com/FiloSottile/mkcert) を使うと簡単です。

### 環境設定ファイルを作成する

`docker-env` ディレクトリにある `.env.template` をコピーして `.env` という名前で保存します。

設定値について、詳しくは `.env.template` をご覧ください。

### hosts ファイルを編集する

サーバーのホスト名が `codeigniter.example.com` の場合、以下のようなものを追加しておくといいでしょう。

```text
127.0.0.1 codeigniter.example.com
127.0.0.1 other.codeigniter.example.com
```

Windows の hosts ファイルの場所は `C:\Windows\System32\drivers\etc\hosts` であることが多いです。

---

## mkcert を用いた証明書の作成について

### mkcert をインストールする

Windows の場合、 mkcert は [Chocolatey](https://chocolatey.org/)
もしくは [Scoop](https://scoop.sh/) を用いてインストールしてください。

他の OS の場合、 [こちら](https://github.com/FiloSottile/mkcert) をご覧ください。

### 証明書を作成する

Unix コマンドが使える場合

```shell
cd docker-env/httpd
mkcert -key-file keys/server.key -cert-file keys/server.crt $(cat hostnames.txt)
```

PowerShell の場合

```powershell
cd .\docker-env\httpd\
mkcert -key-file .\keys\server.key -cert-file .\keys\server.crt $(Get-Content .\hostnames.txt)
```

コマンドプロンプトの方法はわかりません・・・
