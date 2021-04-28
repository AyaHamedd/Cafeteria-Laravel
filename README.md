# ITI-Cafeteria

![alt text](https://github.com/HebaMostafa123/Cafeteria-Vue/blob/feat-readme/demo/landingPage.png)

 **ITI-Cafetria** is a simple application that allows ITI students to order food and drinks from the cafeteria without having to go all the way to the cafeteria, using an online interface to choose available products and make orders! Moreover, It allows cafetria administration to respond to their orders and control products. The project is developed using  **Laravel**,  **Vue.js** frameworks and  **MySQL** database.
---

## Table of Contents

---

<!-- TOC -->

- [Features](#features)
- [Getting Started](#getting-started)
  - [Setup Your Environment](#setup-your-environment)
- [Configurations](#configurations)
- [Dependencies](#dependencies)
- [Possible Improvements](#possible-improvements)
- [About Us](#about-us)
  <!-- /TOC -->

  ## Features
---
### User
- Sign in with your Google / Facebook accounts.
- Change your password in case you forgot it.
- Create an order.
- Track your orders.
- Cancel your order if it is still processing.

### Admin
- Admin can create an order for a user.
- Admin can view all products,add ,update and remove them.
- Admin can view users, add, edit and delete them.
- Admin can view all the checks and filter them by date or user.
- Admin can track incoming orders and change their status.

## Demo

### Login using social accounts.
![alt text](https://github.com/HebaMostafa123/Cafeteria-Vue/blob/feat-readme/demo/login.png)

### Create new order.
![alt text](https://github.com/HebaMostafa123/Cafeteria-Vue/blob/feat-readme/demo/newOrder.gif)

### Track your orders and filter them by date.
![alt text](https://github.com/HebaMostafa123/Cafeteria-Vue/blob/feat-readme/demo/userOrders.gif)

### Administration can track orders and control their status.
![alt text](https://github.com/HebaMostafa123/Cafeteria-Vue/blob/feat-readme/demo/ordersAdmin.png)

### Administration can create and update products.
![alt text](https://github.com/HebaMostafa123/Cafeteria-Vue/blob/feat-readme/demo/products.png)

### Administration can create and update users.
![alt text](https://github.com/HebaMostafa123/Cafeteria-Vue/blob/feat-readme/demo/users.png)

### Administration can view checks and filter them by date and user.
![alt text](https://github.com/HebaMostafa123/Cafeteria-Vue/blob/feat-readme/demo/checks.png)


## Getting Started

---

To use and run this project you need to:

#### Setup Your Environment

Before executing the following commands, please install **Laravel 8.37.0** and **Vue 3.0.11** as stated in the following setup:

- Download Laravel part here:
    - https://github.com/HebaMostafa123/Cafeteria-Vue
- Run Backend using the following command:
```bash
composer install

php artisan serve
```
- Run Frontend using the following command:
```bash
npm install

npm run serve
```
- Paste this URL to your browser:
 **http://localhost:8080**


 ##### Note:

Make sure that your database is up and configured properly for the application to work

---

## Configurations

---

Write your database credentials in the .env file inside Laravel Part then:

- Create database named Cafetria

As for the Facebook and Google API's configurations you will need to:

- write the Google and Facebook APIs' keys in .env file
- Save then close the file

## Dependencies

---

- [Node 14.16.1](https://nodejs.org/en/download/)

- [PHP 7.4.3](https://www.php.net/downloads.php)


## Possible Improvements

---

- Allow payment system

---

## About Us

We are a team of software engineering students at ITI intake 41, Smart Village branch, Open-source application track.

- Ahmed Atef
- Aya Hamed
- Heba Mostafa
- Eman Reda
- Hosam Ali

