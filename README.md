# Multi-Vendor Ecommerce Project - API Documentation

This is a multi-vendor ecommerce project that consists of various components developed by two developers: 

#### Feel free to reach out if you have any questions, suggestions, or just want to connect!
`Abdullah Omar` <br>
- **LinkedIn:** [Abdullah Omar](https://www.linkedin.com/in/abdullah-omar-81196420a?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app)
- **WhatsApp:** [+01144393582](https://wa.me/01144393582)
- **Email:** [abdullahomarj1@gmail.com](abdullahomarj1@gmail.com)
- **Website:** [Eng-AbdullhOmar.online](https://www.eng-abdullahomar.online)
- **Telegram:** [@abdullahomar_p](https://t.me/abdullahomar_p)

`Mohammed Abdelghafar` <br>
- **Email:**    mohammedabdodv@gmail.com  <br>
- **WhatsApp:** [+01274267314](https://wa.me/01274267314)
- **LinkedIn:** [Mohamed_Abdo](https://www.linkedin.com/in/mohamed-abd-alghfar-ab366b214?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app) 


## **Abdullah Omar's Part** 


### Client Side

This part includes the client-side functionality of the application. The controllers for this part are located in 
this path **Controllers/ClientSide** .

- `Home Page`: The home page displays specific products based on the user's gender (men, women, or children). It also showcases best-selling products and provides main parent categories for easy navigation.
- `Category Page`: This page shows products from a specific category and allows users to filter and sort products by price, brand, or store. It also suggests other popular products in the category.
- `Product Details Page`: This page displays all the details and images of a specific product. Users can add the product to their cart and proceed with the purchase. It also suggests other popular products in the same category.
- `Payment Page`: A payment system has been implemented using Paymob and PayPal (work in progress).

### Store Admin Panel

This part focuses on the administrative panel for store owners.

(TODO: Add description of the store admin panel functionality)

### Authentication System

Abdullah Omar has implemented the authentication system for the project.

(TODO: Add description of the authentication system functionality)

## 
## 
## 
## Mohammed Abdelghafar's Part



### Owner Panel

Mohammed Abdelghafar has worked on the owner panel functionality.

(### Route Descriptions

This Laravel route group is configured with the 'is-owner' middleware, ensuring that only users designated as owners have access to these routes. Below are the descriptions for the routes within this group:

#### Dashboard Route:
- **Owner Dashboard**: `/owner` - Renders the dashboard for the owner.

#### Admin Routes:
- **Create Admin**: `/admin/create` - Renders a form to create a new admin.
- **Store Admin**: `/admin/create` - Stores a newly created admin.
- **Show Admins**: `/owner/admin/show` - Displays a list of all admins.
- **Delete Admin**: `/owner/delete-admin/{user}` - Deletes a specific admin.

#### Owner Routes:
- **Create Owner**: `/owner/create` - Renders a form to create a new owner.
- **Store Owner**: `/owner/create` - Stores a newly created owner.

These routes enable the owner to manage administrators and other owners within the system. Access to these routes is restricted to users who have the 'is-owner' middleware applied.
)

### Shipping Panel

In addition to the owner panel, Mohammed Abdelghafar has developed the shipping panel functionality.

(TODO: Add description of the shipping panel functionality)

### Admin - Owner Assistant Panel

Mohammed Abdelghafar has also contributed to the development of the admin - owner assistant panel.

(### Route Descriptions

This Laravel application includes routes grouped under the 'is-owner-assistant' middleware. These routes are accessible to users who are designated as owner assistants and provide functionalities related to managing products, categories, stores, profiles, and dashboard information.

#### Product Routes:
- **Create Product**: `/admin/product` - Allows creating new products.
- **Store Product**: `/admin/product` - Stores a newly created product.
- **Edit Product**: `/admin/product/{product}` - Allows editing a specific product.
- **Update Product**: `/admin/product/{product}` - Updates a specific product.
- **Show All Products**: `/admin/Product/show` - Displays all products.
- **Delete Product**: `/admin/product/{product}` - Deletes a specific product.
- **Product Requests**: `/admin/Product/request` - Shows product requests.
- **Recent Products**: `/admin/Product/recent` - Displays recently added products.
- **Deleted Products**: `/admin/product/delBy/{id}` - Shows deleted products.
- **Run Out Products**: `/admin/products/RunOut` - Shows products running out of stock.
- **Manage Product Photos**: `/admin/products/showPhotos/{id}`, `/admin/products/deletePhotos/{id}`, `/admin/products/editPhotos/{id}`, `/admin/products/createPhotos/{id}` - Manage photos associated with products.

#### Dashboard Route:
- **Dashboard**: `/admin` - Renders the dashboard with relevant information.

#### Profile Routes:
- **Admin Profiles**: `/admin/profile/admins` - Displays profiles of admins.
- **Edit Profile**: `/admin/profile/myprofile` - Allows the current user to edit their profile.
  
#### Category Routes:
- **Create Category**: `/admin/category` - Allows creating new categories.
- **Store Category**: `/admin/category` - Stores a newly created category.
- **Show All Categories**: `/admin/category/show` - Displays all categories.
- **Delete Category**: `/admin/category/{category}` - Deletes a specific category.
- **Update Category**: `/admin/category/{category}` - Updates a specific category.
- **Edit Category**: `/admin/category/{category}` - Allows editing a specific category.
- **Deleted Categories**: `/admin/category/delBy/{id}` - Shows deleted categories.

#### Store Routes:
- **Delete Store**: `/admin/store/{store}` - Deletes a specific store.
- **Show All Stores**: `/admin/store/show` - Displays all stores.
- **Deleted Stores**: `/admin/store/delBy/{id}` - Shows deleted stores.

These routes provide CRUD operations for managing products, categories, stores, and user profiles. Access to these routes is restricted to users who have the 'is-owner-assistant' middleware applied.
)
