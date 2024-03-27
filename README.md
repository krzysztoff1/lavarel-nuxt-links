## Local Development
Create `.env` file in the `frontend` directory. Copy the contents of `.env.example` and replace the values with your own.
Create `.env` file in the `backend` directory. Copy the contents of `.env.example` and replace the values with your own.

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
Start the development server on `http://localhost:8000`:
```bash
php artisan serve
```
