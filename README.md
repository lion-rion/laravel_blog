# Laravel_blog

# Features

Laravelを用いたブログサイトです．

# function

## 機能早見表

|  機能 |  説明  | ルーティング |
| ---- | ---- | ---- |
|  ブログ一覧  |  ブログの一覧が閲覧可能  | / |
|  ブログ作成  |  ブログの作成が可能  | /posts/create |
|  ブログ編集  | ブログの編集が可能   | /posts/edit/{id} |
|  詳細表示  |  ブログの詳細が閲覧可能 | /post/{post} |
|  プロフィール閲覧 |  プロフィール，ブログ一覧が閲覧可能 | /profile/{id} |

## 仕様説明

まず全体のルーティングは次の通りである
主にブログの作成や編集，削除には認可制限がかかっており，ログインしていない場合はログインメニューへとミドルウェアにより飛ばされる仕様となっている．
また，ログイン機能にはlarave/breezeを用いており，ログイン後は元のページへとリダイレクトされるようになっている．

```php

Route::get('/',[PostController::class, 'index'])->name('home');
//詳細表示
Route::get('/post/{post}', [PostController::class, 'show']);

Route::get('/search', [PostController::class, 'showComing'])->name('search');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'showCreate'])->name('create');
    //ブログ登録
    Route::post('/posts/store', [PostController::class, 'exeStore'])->name('store');
    //ブログ編集
    Route::get('/posts/edit/{id}', [PostController::class, 'showEdit'])->name('edit');
    //投稿者情報
    Route::get('/profile/{id}', [ProfileController::class, 'user_profile'])->name('profile');
    //更新
    Route::post('/posts/update', [PostController::class, 'exeUpdate'])->name('update');
    //ブログ削除
    Route::post('/posts/delete/{id}', [PostController::class, 'exeDelete'])->name('delete');
});

require __DIR__.'/auth.php';
```

## 認可設定

編集や削除などのプログラムは動作前に「ブログの作成者idとログインユーザーのidが一致しているか」を検証し一致していない場合は403(Forbidden)を返すようになっている．
その他にもbladeの部分で認可設定を行っており，ブログ作成者とログインユーザーが一致しない場合は「編集」「削除」ボタンが表示されないようになっている．

```php
if(\Auth::user()->id == $post->user_id){
    Post::destroy($id);
}else{
abort(403);
}
```

## データ構造・テーブル情報

デフォルトのテーブル以外にpostsテーブルを追加した
カラムは[id, title, body, user_id, created_at, updated_at]である
user_idカラムはusersテーブルと紐付いており，紐付いているユーザーが消滅したとき，同時にpostsも削除される．

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->text('title');
    $table->text('body');
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->timestamps();
});
```

## ブログ作成のバリデーション

ブログのバリデーションは単純でそれぞれrequireを付けている．文字数制限などは設けていない．

```php
validate([
    'title' => 'required',
    'body' => 'required',
]);
```

## 実装予定機能

時間の都合上以下の機能については実装を行っておらず「準備中」となっている．

1. ユーザーのプロフィール画像機能
2. コメント機能
3. 検索機能
4. タグ機能

# Environment

<div style="display: flex;">
<img height="30" src="https://img.shields.io/badge/-PHP%208.0.23-black.svg?logo=php&style=plastic">
<img height="30" src="https://img.shields.io/badge/-Laravel%208.33.1-black.svg?logo=laravel&style=plastic">
<img height="30" src="https://img.shields.io/badge/-Docker%2020.10.17-black.svg?logo=docker&style=plastic">
<img height="30" src="https://img.shields.io/badge/-Mysql%20%208.0.30-black.svg?logo=mysql&style=plastic">
<img height="30" src="https://img.shields.io/badge/-Apache%202.4.54-black.svg?logo=apache&style=plastic">
</div>

ディレクトリ構成図

```
laravel_docker        
├─┬ apache/
│    └── default.conf
├─┬ php/
│    └── Dockerfile
├── mysql/
├── src/
└── docker-compose.yml
```

# Installation

任意シェルにて以下を実行
 
```bash

# clone
git clone https://github.com/lion-rion/laravel_blog.git

# change dir
cd laravel_blog

# docker-compose and start
docker-compose up -d --build
```

## DB接続

.env.exampleをコピーして.envファイルを作成する

DBの設定を以下の通りに変更する
```
DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=laravel_docker
DB_USERNAME=root
DB_PASSWORD=secret
```
## laravelのセッティング

任意のシェルにて以下を実行

```
# login apache bash
docker-compose exec apache /bin/bash

# package install
composer install

# key setting
php artisan key:generate

# storage setting
chmod -R 666 storage
php artisan storage:link

# DB migration with factory
php artisan migrate
```

# Ports

|  元Port  |  割当  |
| ---- | ---- |
|  tcp:80  |  8080  |
|  mysql:3606  |  4306  |

# Usage

ブラウザにて「 http://localhost:8080 」 を開く
