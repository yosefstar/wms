https://yutaro-blog.net/2021/05/08/gitlab-clone/#index_id4

秘密鍵を生成して、git labからgit cloneする。


https://qiita.com/naporitan/items/8faa4a2ee180b6fe91e8

中盤の
3. Docker起動
くらいからを参考にする。

// phpコンテナに入る
docker exec -it laravel_app bash
cd laravelapp/


php artisan migrate
でエラーが出たら、手動で
   environment:
     MYSQL_ROOT_PASSWORD: root
     MYSQL_DATABASE: wms_db
     MYSQL_USER: laravel_user
     MYSQL_PASSWORD: laravel_pass
     TZ: 'Asia/Tokyo'

MYSQL_DATABASE: wms_dbのdbを作成します。
作成までに、権限付与などが必要の場合もあります。

マイグレショーン完了後、
seederを実行

npm install
できない場合は↓

apt update
apt install -y nodejs npm

node -v
npm -v

npm installができたら
npm run build
