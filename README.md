# SimMed

SimMed is a clinical case simulator for medical/health students. An instructor
builds a **caso clínico** (clinical case) — diagnosis, prescription, admission
status — and attaches a set of **variáveis clínicas** (clinical variables:
vitals, labs, imaging, etc.), each with a cost and a scripted result. Students
are assigned to cases, "order" whichever variables they think are relevant,
and submit their own diagnosis and treatment plan at the end. Admins manage
users, specialties (*especialidades médicas*), cases, and the variable bank
from a back-office panel.

Built on **CodeIgniter 3** (PHP) with a **MySQL/MariaDB** database.

## Status

This app was inherited in a non-running state — a syntax error in an
autoloaded model made every single request fatal-error, on top of several
other logic bugs and PHP 8 incompatibilities left over from when it was
written against PHP 5. It has since been fixed and modernized:

- Fixed the fatal parse error and several other outright bugs (an
  always-false `delete()`, an assignment used as a comparison, dead
  copy-pasted controller methods, an undefined-variable redirect).
- Replaced plaintext password storage/comparison with
  `password_hash()` / `password_verify()`.
- Replaced every raw, string-interpolated SQL query with bound parameters —
  the old hand-rolled escaping helper never escaped backslashes and left the
  app open to SQL injection, including on the login form.
- Added an open-redirect guard on the post-login redirect target.
- Moved database credentials and the encryption key out of committed config
  and into a gitignored `.env` (see `.env.example`).
- Patched a small number of PHP 8-incompatible constructs in the CodeIgniter
  3 core itself (removed `each()`, removed curly-brace string-offset syntax,
  missing `#[ReturnTypeWillChange]` attributes) — notably a session-cookie
  validation regex that hardcoded the old PHP-\<7.1 40-character hex session
  ID format, which silently rejected every session cookie under modern PHP
  and meant nobody could ever stay logged in.
- Reconstructed `schema.sql` from the model queries, since no database dump
  existed anywhere in the project.

The framework core is CodeIgniter **3.0.2** (2015) — kept as-is rather than
upgraded to the latest 3.1.x, so the patches above are narrowly scoped to the
handful of constructs that actually broke under PHP 8, not a framework
upgrade.

## Requirements

- PHP 8.1+ with `mysqli`, `mbstring`
- MySQL or MariaDB
- A web server with URL rewriting (Apache + `mod_rewrite`, using the bundled
  `.htaccess`) — or PHP's built-in server for quick local testing

## Setup

1. Copy the environment template and fill in your local DB credentials:

   ```bash
   cp .env.example .env
   ```

2. Create the database and load the schema:

   ```bash
   mysql -u root < schema.sql
   ```

3. Create the first admin user:

   ```bash
   php seed_admin.php <login> <password>
   ```

4. Point your web server's document root at the project root (so
   `.htaccess` and `index.php` are at the top level), or for a quick local
   check:

   ```bash
   php -S localhost:8000
   ```

## Project layout

Standard CodeIgniter 3 layout — `application/controllers`, `application/models`,
`application/views`, `application/config`. Notable custom pieces:

- `application/hooks/acesso.php` — a `post_controller_constructor` hook that
  enforces login on every controller except `Acesso` (the login controller
  itself).
- `application/helpers/sql_helper.php` — legacy helper, no longer used for
  escaping (queries now use bound parameters); kept only where it's used for
  trimming/normalizing form input.
- `schema.sql` / `seed_admin.php` — not part of CodeIgniter; added so the
  project can be stood up from scratch without an existing dump.
