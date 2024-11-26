# URL Shortener Service

This is a simple URL Shortener application built with Laravel. The service allows users to shorten long URLs and redirect short URLs to their original long URLs.

---

## **Features**

- Shorten long URLs to unique 6-character short URLs.
- Redirect short URLs to their respective original URLs.
- Validation for invalid URLs.
- Handles errors like duplicate short codes or invalid input.
- Includes a user-friendly interface for URL input and short URL display.

---

## **Requirements**

- PHP >= 8.1
- Composer
- MySQL
- Laravel >= 10
- Node.js and npm (optional for running Laravel Mix)

---

## **Installation and Setup**

### **1. Clone the Repository**

```bash
git clone https://github.com/prodhan482/url-shorten.git
cd url-shorten
```

2. **Install dependencies using Composer:**

   ```bash
   composer install
   ```

## Configuration:

1. **Copy the `.env.example` file to `.env`:**

   ```bash
   cp .env.example .env
   ```

2. **Generate the application key:**

   ```bash
   php artisan key:generate
   ```

3. **Update your `.env` file** with your database and mail configuration. Here is an example configuration:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```


### Additional Notes:

- Ensure you have the required database created in your DBMS.

## Database Migration and Seeding

1. **Run the migrations:**

   ```bash
   php artisan migrate
   ```

## Running the Application

1. **Start the local development server:**

   ```bash
   php artisan serve
   ```

2. **Open your browser** and visit [http://localhost:8000](http://localhost:8000).


## Testing

1. **Run Unit Tests:**

   ```bash
   php artisan test
   ```

## Descriptions

**Directory Structure**

   - *Model:* App\Models\URL - Handles database interaction.
   - *Controller:* App\Http\Controllers\URLController - Manages request logic.
   - *View:* resources/views/shortener.blade.php - Frontend for the application.
   - *Routes:* routes/web.php - Defines application routes.



## Data Structure


**The application uses a MySQL table named urls with the following schema:**

   - *id:* Primary key..
   - *long_url:* App\Http\Controllers\URLController - Manages request logic.
   - *short_code:* resources/views/shortener.blade.php - Frontend for the application.
   - *created_at & updated_at:* Timestamps for record tracking.


### Notes:

1. **Error Handling**

   - Invalid or missing URLs return a proper error response.
   - A 404 error is returned for non-existent short URLs.

2. **Short Code Uniqueness:**

   - Randomly generated short codes are checked against the database to avoid duplication.
