# 🎓 Graduation Project – Laravel 12 E-Commerce API  

A Laravel 12 RESTful API built for an e-commerce platform specialized in **event giveaways and hospitality**.  
The project provides core **CRUD functionalities**, **user accounts**, **shopping carts**, and an **admin dashboard** to manage products, users, and orders.  
It was developed as a graduation project and received a grade of **96/100**.  

---

## 🚀 Features  
- 🔹 **CRUD Operations** for products, users, and orders.  
- 🔹 **User Authentication & Authorization**.  
- 🔹 **Shopping Cart System** to handle customer selections.  
- 🔹 **Admin Dashboard** for monitoring and management.  
- 🔹 Built with **Laravel 12** following scalable API best practices.  

---

## 🛠️ Tech Stack  
- **Framework:** Laravel 12  
- **Database:** MySQL  
- **Authentication:** Laravel Sanctum (or Passport if you used it)  
- **Front-end (Admin Dashboard):** Blade / Vue / React (mention what you actually used)  

---

## 📂 Installation & Setup  

1. Clone the repository:  
   ```bash
   git clone https://github.com/sanaatrsh/graduation-project/
   ```

2. Install dependencies:  
   ```bash
   composer install
   ```

3. Copy `.env.example` to `.env` and set up your database credentials:  
   ```bash
   cp .env.example .env
   ```

4. Generate app key:  
   ```bash
   php artisan key:generate
   ```

5. Run migrations & seeders:  
   ```bash
   php artisan migrate --seed
   ```

6. Start the development server:  
   ```bash
   php artisan serve
   ```

---

## 📌 API Endpoints (Examples)  

| Method | Endpoint             | Description            |
|--------|----------------------|------------------------|
| POST   | `/api/register`      | Register a new user    |
| POST   | `/api/login`         | Login user             |
| GET    | `/api/products`      | List all products      |
| POST   | `/api/products`      | Create a new product   |
| PUT    | `/api/products/{id}` | Update a product       |
| DELETE | `/api/products/{id}` | Delete a product       |


---

## 🏆 Project Evaluation  
This project was successfully defended as a graduation thesis and received **96/100**.  

---

## 👩‍💻 Author  
**Sana Atrash**  
- 💼 Backend Developer (Laravel)  
- 🌐 [LinkedIn](https://sy.linkedin.com/in/sana-atrash)  
- 📧 sanaatrash09@gamil.com  

---
