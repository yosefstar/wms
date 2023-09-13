まずは、docker/db/dataがあれば、消す。

https://yutaro-blog.net/2021/05/08/gitlab-clone/#index_id4

秘密鍵を生成して、git labからgit cloneする。


https://qiita.com/naporitan/items/8faa4a2ee180b6fe91e8

中盤の
3. Docker起動
くらいからを参考にする。

// phpコンテナに入る
docker exec -it laravel_app bash
cd laravelapp/


dockerで、rootなどでmysqlに入り、同じ名前のdbを作成する。
mysqlで、仮のテーブルを作成したりすると、権限でのエラーがなくなる。


php artisan migrate

https://zenn.dev/hashi8084/articles/84cf664e587d44

エラーが出たら、configのキャッシュを消す。
sqlのエラーは、docker/db/dataか、
configのキャッシュのせいが大。

マイグレショーン完了後、
seederを実行

この時点で自分は入れた。


あとは、
表示の設定

php artisan storage:link
の後に、
/Desktop/wmstest/wmsTest/src/laravelapp/storage/app/public/
の配下に、ディレクトリを3つ作成。

files
invoices
user_icons

ここに保存データが保存される。

完了
