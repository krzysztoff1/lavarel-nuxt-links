## Setup

Create `.env` file in the `frontend` directory. Add the following environment variables:
```bash
BACKEND_URL=
```

Make sure to install the dependencies:

```bash
# bun
bun install
```

## Development Server

Start the development server on `http://localhost:3000`:

```bash
# bun
bun run dev
```

## Production

Build the application for production:

```bash
bun run build
```

Locally preview production build:

```bash
bun run preview
```