# WiseChoice-Electronics-Website
This is an electronics e-commerce website built for the company WiseChoice Electronics. It allows users to view and search products, and admins to manage the product catalog.

## Website Pages
- Homepage (index.php) - Provides overview of site and some sample products.
- Filter (filter.php) - Allows searching/filtering products by various criteria.
- Listing (listing.php) - Displays products matching filters, with pagination.
- Details (detail_image.php) - Shows product image and name for given product ID.
- Login (login.php) - User login page, checks credentials.
- Signup (signup.php) - New user signup page, stores user in DB.
- Logout (logout.php) - Logs user out and redirects.

## Admin Pages
Special admin pages only accessible to logged in admins:

- Admin Listing (admin_listing.php) - Displays all products for admin with CRUD controls.
- Admin Search (admin_search.php) - Search products by name keyword.
- Add Product (add_product.php) - Form to add new product to DB.
- Edit Product (edit.php) - Form to modify product details in DB.
- Delete Product (delete_product.php) - Deletes a product by ID.

## Database
MySQL database contains tables for:

- Products
- Brands
- Conditions
- Sales
- Shipping
- Users

Database diagram provided in database_diagram.png.

## Features
- User accounts with password hashing
- Session-based authorization
- Pagination on product listings
- Database CRUD functionality for admins
- Custom font styling

## Installation
1. Import MySQL database schema and data from schema.sql
2. Configure DB credentials in config.php
3. Upload source code files to web server
4. Access homepage at index.php

The font and image assets need to be copied to the fonts and img folders respectively. User uploaded images get stored in the uploads folder.

