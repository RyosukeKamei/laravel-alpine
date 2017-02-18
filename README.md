# laravel5 on Docker開発環境構築手順(OSはAlpine Linux)
# git cloneする
$ git clone git@github.com:RyosukeKamei/laravel-alpine.git
# laravel-alpineに移動
$ cd laravel-alpine
# PHP Composerインストール
$ curl -sS https://getcomposer.org/installer | php
# PHP Composerのインストールを確認（パスが通っているところに移動させてもよい）
$ php composer.phar --version
# Laravelをprojectという名前でインストール
$ php composer.phar create-project laravel/laravel project --prefer-dist
# もし、Token (hidden): と聞かれる場合はその度にEnterするか事前に
# GitHubでアクセストークンを取得し、下記を実行
$ php composer.phar config --global github-oauth.github.com {GitHubで取得したトークン}
