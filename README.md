## About Project

This is a test project of the CRUD library, which implements the book management logic.
## Used technologies

For optimal development and ease work with some interface elements, the following technologies were used:

### Backend

- PHP v8.0.10
- Laravel Framework v9.21.5
### Frontend

- Bootstrap v5.0.2
- jQuery v3.6.0
- Select2 v4.1.0
## Installing & Deploying

    git clone
    composer update
    php artisan migrate --seed

## Navigation routes

    /books - list of books
    /books/create - create new book
    /books/{$id}/edit - edit given book
    /books/{$id}/destroy - delete given book
