# MIbox

## About Laravel

Medical Information Box


php artisan make:controller PhotoController --resource --model=Photo

php artisan make:seeder UsersTableSeeder

php artisan make:factory PostFactory --model=Post

Route::resource('photos', 'PhotoController')->names([
    'create' => 'photos.build'
]);

php artisan make:request StoreBlogPost