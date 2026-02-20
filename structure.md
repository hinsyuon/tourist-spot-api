tourist-spot-api/
│
├── public/
│   ├── index.php   # Entry point
│   └── router.php  # Router for built-in server
│
├── config/
│   └── Database.php
│
├── core/
│   ├── Controller.php
│   ├── Model.php
│   └── Response.php
│
├── middleware/
│   └── AuthMiddleware.php
│
├── controllers/
│   ├── UserController.php
│   └── TouristSpotController.php
│
├── models/
│   ├── User.php
│   └── TouristSpot.php
│
├── routes/
│   └── api.php
├── storages/    # For image uploads
└── .htaccess    # Apache rewrite rules