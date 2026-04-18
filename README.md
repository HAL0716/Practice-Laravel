# Practice-Laravel

## セットアップ手順

### 1. リポジトリをクローン

```bash
git clone https://github.com/HAL0716/Practice-Laravel.git
cd Practice-Laravel
````

## 2. Dockerコンテナを起動

```bash
docker compose up -d --build
```

## 3. アプリコンテナに入る

```bash
docker compose exec app bash
```

---

## 4. Laravelの依存関係インストール

（初回のみ or vendorが無い場合）

```bash
composer install
```

---

## 5. .envファイル作成

```bash
cp .env.example .env
```

---

## 6. アプリキー生成

```bash
php artisan key:generate
```

---

## 7. DB設定確認（.env）

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

---

## 8. マイグレーション実行

```bash
php artisan migrate
```

---

## 9. フロントエンドビルド（別ターミナル）

```bash
npm install
npm run build
```

---

## 10. ブラウザでアクセス

```
http://localhost:8080
```

---

# よく使うコマンド

## コンテナ再起動

```bash
docker compose restart
```

## ログ確認

```bash
docker compose logs -f
```

## コンテナ停止

```bash
docker compose down
```
