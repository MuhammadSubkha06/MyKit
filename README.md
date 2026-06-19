# MyKit (Native PHP + SQLite) - Minimal Clone

Quick minimal implementation of the MyKit UI/logic using native PHP and SQLite.

Run locally (built-in PHP server):

```bash
php -S localhost:8000 -t public
```

Then open http://localhost:8000

If you updated schema or are running an older DB, run migrations:

```bash
php run_migrations.php
```

Or recreate DB by removing `data/db.sqlite` then start the server — the DB will auto-init from `init_schema.sql`.

Notes:
- SQLite DB file stored in `/data/db.sqlite` and auto-initialized from `init_schema.sql`.
- Routes are in `public/index.php` and simple controllers live in `src/Controllers`.
- Models are in `src/Models`.

Next steps you may want:
- Add user accounts and authentication
- Improve calendar calculations and predictions
- Add forms validation and CSRF protection
