# to-do  
- Thêm cái khi bấm vào products card sẽ show detailed info
- Thêm AI chatbox icon góc dưới phải

# Setup dự án
1. **Clone dự án (làm 1 lần):**
```shell
git clone https://github.com/xuankh4ng/laravel-final.git
cd laravel-final
```
2. **Cấu hình:**
```shell
cp .env.example .env
composer install
npm install
npm run build
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan serve
```

**Reset Database**  
```shell
php artisan migrate:fresh --seed
```

3. **Các nhánh trong dự án:**
- `main` : Nhánh chính, dùng để tổng hợp lại và để nộp bài.
- `frontend` : Nhánh làm giao diện (UI).
- `backend` : Nhánh xử lý logic + database.

# Hướng dẫn làm việc với nhánh `frontend`
## 1. Chuyển nhánh:
```shell
git checkout frontend
```
Kiểm tra nhánh hiện tại:
```shell
git branch
```
Dấu `*` phải nằm bên cạnh `frontend`.

## 2. Quy trình:
- Lấy **code mới nhất** từ GitHub:
```shell
git pull origin frontend
```
- Push lên nhánh `frontend`:
```shell
git push origin frontend
```
- Khi cần cập nhật code từ nhánh `main`:
```shell
git checkout main
git pull origin main

git checkout frontend
git merge main
```
> [!CAUTION]
> Nếu có báo ***conflict*** -> Nhắn tui để xử lý.
