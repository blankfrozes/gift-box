serve:
	php artisan serve

dev:
	pnpm run dev

watch:
	pnpm run watch

migrate-fresh:
	php artisan migrate:fresh

migrate-fresh-seed:
	php artisan migrate:fresh --seed

prepare-autoload:
	composer dump-autoload
