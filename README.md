# laravel-alpine laravel開発環境構築手順
# git clone
$ git clone git@github.com:RyosukeKamei/laravel-alpine.git
$ ls
laravel-alpine
$ cd laravel-alpine
$ ls
README.md		docker			docker-compose.yml
# PHP Composerインストール
$ curl -sS https://getcomposer.org/installer | php
$ ls
README.md		composer.phar		docker			docker-compose.yml
# Laravelをprojectという名前でインストール
$ php composer.phar create-project laravel/laravel project --prefer-dist
# もし、Token (hidden): と聞かれる場合はその度にEnterするか事前に
# GitHubでアクセストークンを取得し、下記を実行
$ php composer.phar config --global github-oauth.github.com {GitHubで取得したトークン}
