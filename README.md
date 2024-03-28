## Local Development
Create `.env` file in the `frontend` directory. Copy the contents of `.env.example`.
Create `.env` file in the `backend` directory. Copy the contents of `.env.example`.

**Frontend**
<br>
Navigate to the `frontend` directory and install the dependencies:
```bash
bun install
```
Start the development server on `http://localhost:3000`:
```bash
bun run dev
```

**Backend**
<br>
In the separate terminal, navigate to the `backend` directory and install the dependencies:
```bash
composer install
```
Key generation, migration, seeding, and starting the development server on `http://127.0.0.1:8000`.
```bash
php artisan key:generate && php artisan migrate && php artisan db:seed && php artisan serve
```
