<ol>
<li>
<strong>git clone </strong> gitURL
</li>
<li>
<strong>composer install --ignore-platform-req=ext-sodium</strong>
</li>
<li>
<strong>cp .env.example .env</strong>
</li>
<li>
<strong>php artisan key:generate</strong>
</li>
<li>
<strong>php artisan l5-swagger:generate </strong>
</li>
<li>
<strong>php artisan migrate </strong>
</li>
<li>
<strong>php artisan passport:install</strong>
</li>
</ol>