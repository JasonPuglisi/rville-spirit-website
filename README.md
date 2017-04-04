# Rville Spirit Website

Apparel e-commerce website for Robbinsville High School.

## Usage

The only component to configure with the website is the database, which
follows the schema listed below. Before inserting a product into the database,
you must create a "button" using PayPal Checkout Express, which is where
transactions take place. You will use information from the button in the
database.

### Database

Make a MySQL database called `rhsstore_store` and a user called
`rhsstore_store` with access to the database. The database should have a single
table called `products` with the following schema:

- `pid int(10) unsigned` Unique ID that will appear in the URL
- `name varchar(255)` Name of the item that will be displayed
- `description varchar(255)`  Description of the item that will be displayed
- `image varchar(255)`  Name of the image to be found in
  [`img/product/`](img/product) that will be displayed
- `price int(10) unsigned` Price of the product before tax in cents (e.g., 1000
  = $10.00)
- `featured int(10) unsigned` Whether or not the product should be featured on
  the main page (1 for yes, 0 for no)
- `shipping int(10) unsigned` Whether or not the product is available for
  shipping (1 for yes, 0 for no)
- `pickup int(10) unsigned` Whether or not the product is available for pickup
  (1 for yes, 0 for no)
- `button_id varchar(255)` The ID of the PayPal Express Checkout button
- `button_options_name varchar(255)` The name of the options that are
  configured on the PayPal Express Checkout button, separated by `|` (e.g.,
  Size|Delivery)
- `button_options varchar(255)` The values of the options that are configured
  on the PayPal Express Checkout button, with values separated by `,` and
  groups separated by `|`  (e.g., S,M,L,XL|Shipping,Pickup for the above
  example of Size|Delivery in `button_options_name`)

## Overview

Hosts product offerings for Robbinsville High School. Products are fetched from
a database, and embed code from PayPal Express Checkout is manipulated for a
custom, user-friendly interface. Transactions are completed on the PayPal
website.
