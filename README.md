# laravel5 on Docker開発環境構築手順(OSはAlpine Linux)
# git cloneする
$ git clone git@github.com:RyosukeKamei/laravel-alpine.git
# laravel-alpineというフォルダの存在を確認
$ ls
laravel-alpine
# laravel-alpineに移動
$ cd laravel-alpine
# ファイルとフォルダを確認
$ ls
README.md		docker			docker-compose.yml
# PHP Composerインストール
$ curl -sS https://getcomposer.org/installer | php
# PHP Composerのインストールを確認（パスが通っているところに移動させてもよい）
$ php composer.phar --version
Composer version 1.3.2 2017-01-27 18:23:41
# Laravelをprojectという名前でインストール
$ php composer.phar create-project laravel/laravel project --prefer-dist
# もし、Token (hidden): と聞かれる場合はその度にEnterするか事前に
# GitHubでアクセストークンを取得し、下記を実行
$ php composer.phar config --global github-oauth.github.com {GitHubで取得したトークン}
