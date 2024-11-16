<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Puntualitos

**Puntualitos** is a Laravel web application designed for efficient management of employee schedules and attendance. It offers a professional and intuitive interface, allowing quick check-ins and check-outs, as well as detailed reporting of work hours. Ideal for small and medium-sized businesses seeking a streamlined time management solution.

## Features

- **Easy check-ins**: Employees can easily log their working hours.
- **Detailed reporting**: Generate customizable attendance reports.
- **User-friendly interface**: Clean design for an enhanced user experience.
- **Accurate control**: Helps improve punctuality and team efficiency.

## Requirements

Make sure you have the following installed:

- PHP >= 8.1
- Composer
- Node.js (for asset management with Vite)
- MySQL or any other compatible database

## Installation

Follow these steps to set up the project locally:

1. Clone this repository:

    ```bash
    git clone https://github.com/raortega8906/puntualitos.git
    cd puntualitos
    ```

2. Install PHP and Node.js dependencies:

    ```bash
    composer install
    npm install
    ```

3. Install Node.js dependencies and compile assets:

    ```bash
    cd public
    npm install
    npm run dev
    ```

4. Create the `.env` file from the example provided:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Configure the database credentials in the `.env` file.

7. Run the database migrations:

    ```bash
    php artisan migrate
    ```

8. Compile the assets:

    ```bash
    npm run dev
    ```

9. Start the development server:

    ```bash
    php artisan serve
    ```

Your application should be running at [http://localhost:8000](http://localhost:8000).

## Contribution

Contributions are welcome! If you'd like to collaborate, please open an issue or submit a pull request.

## Security

If you discover any security vulnerabilities, please report them to [raortega8906@gmail.com](mailto:raortega8906@gmail.com).

## License

This project is licensed under the [MIT License](LICENSE).
