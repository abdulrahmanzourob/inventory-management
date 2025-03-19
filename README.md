# **Inventory Management System**

## **📌 Project Overview**
This project is an **Inventory Management System** that allows users **(Admin, User)** to efficiently manage product stock. It includes a **role-based authentication system** to control access and functionalities.

---
### ** Project Screenshot **
![Screenshot 2025-03-13 013314](https://github.com/user-attachments/assets/e8eecb34-57b3-4d32-a0f8-f0bf121b454b)

---

## **💡 Key Features**

### **1️⃣ User Authentication**
- Users can **register and log in** to the system.
- Authentication is handled via **MySQL database validation**.
- Each user is assigned a **role (Admin, User)** during registration.

---

### **2️⃣ Inventory Management (Products)**
✅ **View products** available in stock.  
✅ **Search for products.**  
✅ **Add new products** (Admin only).  
✅ **Update product details** such as quantity or price.  
✅ **Delete products** from the inventory (Admin only).  


### **3️⃣ Admin Dashboard**
1️⃣ **Admin Panel (Admin Dashboard)**
- Add, update, and delete products.
- Manage users (add/remove accounts).
- Display the total number of stored products.
- search for products

---

### **4️⃣ API Integration**
- The project includes an **API file** to fetch data from the database using **JavaScript Fetch API** for better performance.

---

## **📂 Project Structure**
```
📁 includes/
    ├── config_session.inc.php
    ├── dbh.inc.php
    ├── login_contr.inc.php
    ├── login_model.inc.php
    ├── login_view.inc.php
    ├── login.inc.php
    ├── register_contr.inc.php
    ├── register.inc.php
    ├── register_model.inc.php
    ├── register_view.inc.php

📁 store/
    ├── 📁 api/![Screenshot 2025-03-13 013314](https://github.com/user-attachments/assets/68357922-cd97-4c73-b0c4-58d5d5781557)

    │   ├── api.php
    │   ├── db.php
    │   ├── function.php
    ├── 📁 assets/
    │   ├── script.js
    ├── index.php
    ├── styles.css
    ├── admin_dashboard.php
    ├── user_dashboard.php
    ├── login.php
```

---

## **🚀 Future Improvements**
🔹 Implement **product categorization**.  
🔹 Add **user activity logs** for security.  
🔹 **Export inventory data** to Excel or PDF.  
🔹 Improve security measures against **SQL Injection & XSS attacks**.  

---

## **📢 Setup Instructions**
### **1️⃣ Requirements**
- PHP & MySQL installed (XAMPP, WAMP, or LAMP recommended).
- A local or online server environment.

--

## **💻 Technologies Used**
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP, MySQL
- **API Communication:** Fetch API

---

📌 **Developed by:** *z3rob*
