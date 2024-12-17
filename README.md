# Bus Booking System (we called in BOOKMYTRIP)

## Overview
This Bus Booking System is a web application that allows users to book bus tickets, manage their bookings, and provides an admin interface for managing buses and users. The application is built using PHP and MySQL, with a focus on user experience and functionality.

## Features
- User registration and login
- Bus search and booking
- Booking confirmation and ticket printing
- User profile management
- Admin panel for managing buses and users
- Review and feedback system

## File Structure

The `/bookmytrip` directory contains the application's files organized as follows:

**Directories:**

* **/admin/** (Contains files for administrator functionalities)
    * `add_bus.php`: Script for adding a new bus.
    * `admin_dashboard.php`: Main page for the admin panel.
    * `admin_details.php`: View details of a specific admin user (optional).
    * `adminEditProfile.php`: Edit admin user profile information.
    * `admin_register.php`: Script for registering a new admin user.
    * `calendar.php` (Optional): Calendar for managing bookings (optional).
    * `delete.php`: Script for deleting data (e.g., buses).
    * **/icons/** (Folder containing icons used in the admin panel).
* **/assets/** (Stores reusable resources)
    * **/css/** (Folder containing CSS stylesheets for the application).
    * **/icons/** (Optional folder for additional icons used throughout the application).
    * **/js/** (Folder containing JavaScript scripts for user interaction).
* **/database/** (Contains the database schema file)
    * `bus_booking.sql`: SQL file for creating the database schema.
* **/uploads/** (Optional folder for storing user uploads, if applicable)
* `db_connection.php`: File containing database connection details.
* `find_booking.php`: Script for searching for a specific booking.
* `home.php`: Main landing page for the application.
* `index.php`: Entry point of the application.
* `login.php`: User login page.
* `logout.php`: Script for user logout functionality.
* `myTickets.php`: Page for users to view their booked tickets.
* `print_ticket.php`: Script for generating a printable ticket.
* `register.php`: User registration form.
* `search.php`: Page for searching available bus routes.
* `update_profile.php`: Script for modifying user profile information.
* `confirmation.php`: Page displayed after booking confirmation.
* `cancel_booking.php`: Script for canceling a user's booking.
* `404.php`: Custom error page for not found resources.


## Installation
1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd bookmytip
   ```

2. **Set up the database**:
   - Import the `bus_booking.sql` file into your MySQL database using phpMyAdmin or any MySQL client.
   - Update the database connection details in `db_connection.php` if necessary.

3. **Run the application**:
   - Start a local server (e.g., XAMPP, WAMP, or MAMP).
   - Place the project folder in the server's root directory (e.g., `htdocs` for XAMPP).
   - Access the application via your web browser at `http://localhost/bookmytrip`.

4. **For admin panel and access**:
    - The login form of user is also for admins means the login page is multi user login page
    - use email : admin@gmai.com
    - password : admin

## Usage
- **User Registration**: New users can register by filling out the registration form.
- **User Login**: Registered users can log in to access their dashboard.
- **Bus Booking**: Users can search for buses based on their travel preferences and book tickets.
- **Manage Bookings**: Users can view, cancel, or print their tickets.
- **Admin Panel**: Admins can manage buses, view user details, and handle bookings.

## Technologies Used
- PHP
- MySQL
- HTML/CSS
- JavaScript
- SVG for icons
