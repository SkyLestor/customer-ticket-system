# Customer Ticket System

This repository contains a full-featured Customer Support Ticket System built with Laravel, Livewire, and the Flux UI component library. It provides a complete solution for managing user support requests, with distinct roles for regular users and administrators.

## Features

- **User Authentication:** Secure registration, login, password reset, and two-factor authentication powered by Laravel Fortify.
- **Role-Based Access Control:**
    - **User Role:** Can create new support tickets, view their own tickets, and add comments.
    - **Admin Role:** Can view a dashboard with statistics, manage all tickets (search, filter by priority/status, and change status), and participate in ticket discussions.
- **Ticket Management:**
    - Create tickets with a title, description, and priority level (Low, Medium, Critical).
    - View individual tickets with detailed information.
    - Add comments to facilitate discussion between users and admins.
- **File Attachments:** Users can attach up to 7 files (max 10MB each) to a ticket. Admins can view and download these attachments.
- **Email Notifications:** Automated email notifications are sent to admins upon new ticket creation and to users when their ticket is closed.
- **Admin Dashboard:** A dedicated dashboard for administrators provides an overview of ticket statistics, including open, closed, and total ticket counts.
- **User Settings:** A comprehensive settings area allows users to manage their profile, update their password, and configure two-factor authentication and appearance preferences.

## Tech Stack

- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Livewire 4, Tailwind CSS 4, Vite
- **UI Components:** Livewire Flux
- **Database:** SQLite (default), MySQL, PostgreSQL, etc.
- **Queue System:** Supports database, Redis, SQS, etc., for handling background jobs like sending emails.

## Getting Started

Follow these instructions to get a local copy of the project up and running for development and testing purposes.

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & npm
- A configured database (SQLite is set up by default)

### Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/skylestor/customer-ticket-system.git
    cd customer-ticket-system
    ```

2.  **Install Composer dependencies:**
    ```bash
    composer install
    ```

3.  **Set up your environment file:**
    Copy the example environment file and generate an application key.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Update your `.env` file with your database, mail, and other service credentials. For SQLite, simply create an empty file: `touch database/database.sqlite`.

4.  **Install NPM dependencies and build assets:**
    ```bash
    npm install
    npm run build
    ```

5.  **Run database migrations and seed the database:**
    This will create the necessary tables and populate the database with a default admin and user account.
    ```bash
    php artisan migrate
    php artisan db:seed
    ```

### Running the Application

This project includes a convenient script to start the necessary development servers concurrently.

```bash
composer run dev
```

This command will:
- Start the PHP development server (`php artisan serve`).
- Start the queue listener to process background jobs (`php artisan queue:listen`).
- Start the Vite server for frontend asset hot-reloading (`npm run dev`).

You can now access the application at the URL provided by `php artisan serve` (usually `http://127.0.0.1:8000`).

## Usage

After seeding the database, you can log in with the following default accounts:

-   **Admin Account:**
    -   **Email:** `admin@example.com`
    -   **Password:** `password`

-   **User Account:**
    -   **Email:** `test@example.com`
    -   **Password:** `password`
