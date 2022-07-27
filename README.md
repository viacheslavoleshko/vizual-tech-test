## About Project

This is a test project of the CRUD library, which implements the book management logic.
## Used technologies

For optimal development and ease work with some interface elements, the following technologies were used:

### Backend

- PHP v8.0.10
- Laravel Framework v9.21.5
- L5 Swagger - OpenApi Specification

### Frontend

- Bootstrap v5.0.2
- jQuery v3.6.0
- Select2 v4.1.0

## Installing & Deploying

    git clone
    composer update
    php artisan migrate --seed
    
    API Tokens for authentication in REST API will be generated in `publishers` table.
    API Bearer token located in the Authorization header of the request

## Navigation routes

    /books - list of books
    /api/books/create - create new book
    /api/documentation - OpenAPI interactive documentation
    
### This routes reserved by policies for of books. Only authenticated publisher what related with current book can EDIT and DELETE book.

    /api/books/{book}/edit - edit given book
    /api/books/{book}/destroy - delete given book
    
    
