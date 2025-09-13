👇

🚀 Deployment Report: Filament v3 on Hostinger Shared Hosting (Subdomain)
1. Initial Setup

Objective: Deploy Laravel Filament v3 project to Hostinger shared hosting on a subdomain.

Domain: doc.tekniq-system.online

Hosting Environment: Hostinger Shared Hosting

Target Subdomain Root: public_html/doc/public

2. Errors & Fixes During Deployment
Error 1: Session Not Working

Issue: Login form refreshed but did not authenticate.

Cause: Sessions were not being stored properly.

Fix:

Created sessions table:

php artisan session:table
php artisan migrate


Updated .env:

SESSION_DRIVER=database
SESSION_DOMAIN=.tekniq-system.online
SESSION_SECURE_COOKIE=true


Corrected folder permissions:

chmod -R 775 storage bootstrap/cache

Error 2: .env File Missing or Empty

Issue: Running php artisan key:generate caused:

file_get_contents(.env): Failed to open stream: No such file or directory


Cause: .env file was missing after upload.

Fix:

Created a new .env file in project root:

APP_NAME=Laravel
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://doc.tekniq-system.online

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u259178617_doc
DB_USERNAME=u259178617_doc
DB_PASSWORD="4;K6lx[UHk"

SESSION_DRIVER=database
SESSION_DOMAIN=.tekniq-system.online
SESSION_SECURE_COOKIE=true


Generated new key:

php artisan key:generate

Error 3: Wrong Subdomain Root

Issue: Filament routes returned “Page Not Found”.

Cause: Subdomain was pointing to public_html/doc instead of public_html/doc/public.

Fix: Updated Hostinger subdomain settings → set root directory to public_html/doc/public.

Error 4: Routes Not Working (403 / 404)

Issue: After publishing Filament assets, login/dashboard gave 403 or 404.

Cause: Missing .htaccess rewrite rules.

Fix: Added .htaccess in /public:

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [L]
</IfModule>

Error 5: Password Field Visible in Login Form

Issue: Password field wasn’t masked (showed actual characters).

Cause: Incorrect form input type in Filament login page.

Fix: Verified Filament login form (it uses type="password" by default). Issue was due to cached assets.

Cleared caches:

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

Error 6: Login Still Refreshing (No Redirect to Dashboard)

Issue: Login succeeded but redirected back to login page.

Causes:

Session not persisting due to cookie mismatch.

APP_URL misconfigured.

Fixes:

Set correct APP_URL:

APP_URL=https://doc.tekniq-system.online


Ensured database sessions were being written (sessions table checked with php artisan tinker).

Verified session cookie (laravel_session) was stored in browser.

Error 7: “This Page Does Not Exist” After Login

Issue: After login, redirected to dashboard but got error page.

Cause: Wrong UserPanelProvider path.

Fix: In UserPanelProvider.php, set:

->path('/')


so dashboard works at /.

3. Final Working Setup

.env File (Final):

APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=false
APP_URL=https://doc.tekniq-system.online

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u259178617_doc
DB_USERNAME=u259178617_doc
DB_PASSWORD="4;K6lx[UHk"

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_DOMAIN=.tekniq-system.online
SESSION_SECURE_COOKIE=true


Hostinger Subdomain Root: public_html/doc/public

Permissions:

chmod -R 775 storage bootstrap/cache


Caches Cleared:

php artisan optimize:clear


Final Routes:

Login: https://doc.tekniq-system.online/login

Dashboard: https://doc.tekniq-system.online/

4. Lessons Learned

On shared hosting, always point subdomain root to public/.

Sessions are the backbone of Laravel login. If sessions aren’t stored, login will fail silently.

.env file must exist on server — Hostinger doesn’t auto-deploy it.

Permissions matter — without writable storage and bootstrap/cache, Laravel breaks.

APP_URL and SESSION_DOMAIN must match live domain.

✅ After these steps, Filament login and dashboard work perfectly on Hostinger subdomain.
