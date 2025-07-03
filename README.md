Requirements:

PHP 7.x or later

MySQL database

Apache or any compatible web server

A local environment like XAMPP/Laragon, or a live server

Installation Steps:

Clone or download the project to your web root folder (htdocs in XAMPP).

Import the SQL file (e.g., pp_db.sql) into phpMyAdmin to set up the database.

Make sure the database name in your .php files (like mysqli_connect) matches the name of the imported database.

Start Apache and MySQL in your local server control panel.

Access the app via:
http://localhost/your_project_folder/login.php

FILE DESCRIPTIONS
1. register.php
Purpose:
Allows new users to sign up.

Functionality:

Collects user info via a form (name, email, password, etc.)

Validates input and checks for existing accounts

Inserts new user into the users table

Starts a session after successful registration

2. login.php
Purpose:
Authenticates users to access protected pages.

Functionality:

Accepts email and password

Verifies credentials from the users table

Starts a session and redirects to offerings.php

Displays error messages on failure

3. offerings.php (Product listing page)
Purpose:
Displays products available for purchase.

Functionality:

Fetches product data from the products table

Shows product name, image, price, and “Add to Cart” button

Allows logged-in users to add items to their cart

4. cart.php
Purpose:
Shows current items in the user’s cart.

Functionality:

Retrieves cart items from the cart table based on session/user ID

Displays product name, quantity, subtotal

Allows quantity updates or item removal

Shows total cart value

5. checkout.php
Purpose:
Finalizes the user's order.

Functionality:

Displays cart summary and total amount

Confirms purchase (may insert order in orders table)

Empties the cart after successful checkout

Shows success message or redirect

6. logout.php
Purpose:
Ends user session.

Functionality:

Clears $_SESSION variables

Destroys the session

Redirects to login.php
![image](https://github.com/user-attachments/assets/f776d992-ed83-4c2e-9985-b774495d176c)
![image](https://github.com/user-attachments/assets/ac1ab193-00a9-44ba-83bb-fa55287a0c93)
![image](https://github.com/user-attachments/assets/74116f1a-6204-4058-b760-c5f80825f7a8)
![image](https://github.com/user-attachments/assets/1eb91a38-c8cd-4d42-8781-64d9b8489314)
![image](https://github.com/user-attachments/assets/c72b88ce-fc18-459a-8fbe-2c167c69dfde)
![image](https://github.com/user-attachments/assets/86984e2c-af09-4418-a95d-c2ae964fbc45)

