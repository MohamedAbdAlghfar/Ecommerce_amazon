<html lang="en">

<head>
<style type="text/css">
    	* {
    margin: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

nav {
    border: solid #008374 1px;
    width: 100%;
    height: 90px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    background-color: #008374;
}

nav a {
    text-decoration: none;
    color: #242424;
    border: solid white 1px;
    padding: 11px;
    border-radius: 5px;
    background-color: white;
    font-weight: bold;
    transition-duration: 0.2s;
    transition-timing-function: linear;
    transition-property: all;
    transition-delay: 0s;
}

nav a:hover {
    border: solid black 1px;
    background-color: black;
    color: white;
}

@media screen and (max-width:767px) {
    nav {
        height: 289px;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    nav a {
        padding: 0;
        width: 60px;
        height: 39px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}

section {
    height: 396px;
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.Counter {
    border: solid #008374 1px;
    width: 200px;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border-radius: 50%;
    background-color: #008374;
    color: white;
    transition-duration: 0.2s;
    transition-timing-function: linear;
    transition-property: all;

}

.Counter:hover {
    box-shadow: 0px 0px 20px 0px #008374;
}

.Counter h3 {
    margin-bottom: 46px;
}

.Counter p:first-of-type {
    margin: 0;
}

.card {
    border: solid;
    width: 300px;
    height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-top: 10px;
    padding-bottom: 10px;
    background-color: #008374;
    color: white;
    border-radius: 5px;
    row-gap: 20px;
}

@media screen and (max-width:767px) {
    section {
        flex-direction: column;
        margin-top: 10px;
        margin-bottom: 10px;
        height: 500px;
        row-gap: 17px;
    }


}

.foot {
    width: 100%;
    height: 300px;
    display: grid;
    grid-template-columns: auto;
    grid-template-rows: 75% 1fr;
    background-color: #008374;
    color: white;
}

.foot_pt1.container {
    display: flex;
    flex-direction: row;
}

.foot_sec2,
.foot_sec3,
.foot_sec4 {
    width: calc(60%/3);
}

.foot_sec1 {
    width: 40%;
}

.foot_sec1 p:first-of-type {
    font-size: xx-large;
    font-weight: bold;
}

.foot_sec1 p:first-of-type+p {
    line-height: 1.4;
}

.icons_foot {
    width: 70%;
    height: 50px;
    display: flex;
    align-items: center;
}

.icons_foot i {
    font-size: large;
    border: solid;
    border-radius: 50%;
    padding: 3%;
    opacity: 0.7;
    cursor: pointer;
    transition: 0.3s linear all;
}

.icons_foot i:hover {
    opacity: 1;
}

.icons_foot i:nth-of-type(2),
.icons_foot i:nth-of-type(3),
.icons_foot i:nth-of-type(4) {
    margin-left: 10px;
}

.foot_sec2,
.foot_sec3,
.foot_sec4 {
    padding-top: 8px;
    padding-left: 10px;
}

.foot_sec2 p:first-of-type,
.foot_sec3 p:first-of-type,
.foot_sec4 p:first-of-type {
    font-size: large;
    font-weight: bold;
}

.foot_sec2 ul,
.foot_sec3 ul {
    list-style: none;
    padding: 0;
    line-height: 2;
}

.foot_sec2 li,
.foot_sec3 li {
    font-size: 15px;
    font-weight: bold;
    opacity: 0.7;
    transition: 0.3s linear all;
}

.foot_sec2 li:hover,
.foot_sec3 li:hover {
    opacity: 1;
}

.foot_sec2 li a,
.foot_sec3 li a {
    text-decoration: none;
    color: white;
}

.foot_sec4 ul {
    list-style: none;
    padding: 0;
    font-size: smaller;
}

.foot_sec4 ul li span {
    font-weight: bold;
}

.foot_pt2.container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.foot_pt2.container p {
    text-align: center;
}

.foot_pt2.container span {
    font-weight: bold;
}

@media screen and (max-width:767px) {
    .foot {
        height: 782px !important;
    }

    .foot_pt1.container {
        flex-wrap: wrap !important;
    }

    .foot_sec1 {
        width: 100% !important;
    }

    .foot_sec2,
    .foot_sec3,
    .foot_sec4 {
        width: calc(80%/2) !important;
    }
}

.circle {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f2f2f2;
}

.circle img {
  width: 100%;
  height: auto;
}
  
  </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dash.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body bgcolor ="black">
    <nav>
        <!-- Links -->
        <a href="admin/product/create">Add Product</a>  <!--  Done!   -->
      <!--  <a href="">Delete Product</a> -->
       <!-- <a href="">Edit Product</a>  -->
      <!--  <a href="">Make Discount</a>  -->
        <a href="admin/product/show">Show Product</a>
        <a href="admin/Product/recent">Recent Sold</a>
        <a href="admin/Product/request">Requests</a>
        <a href="admin/store/show">Delete Store</a>
        <a href="admin/profile/admins">Admins page</a>
        <a href="admin/category/create">Add Category</a>
       <!--  <a href="">Delete Category</a>  -->
        <!--  <a href="">Edit Category</a>  -->
        <a href="admin/category/show">Show Category</a>

</nav>
<div align = "right">
<a href="admin/profile/myprofile">
  <div class="circle">
    
  <img src="https://m.media-amazon.com/images/I/61LjHM2KxfL._AC_UL480_QL65_.jpg" alt="Profile Picture">
  
</div>
</a>
<font color = "white">MY PROFILE</font>   
</div>
    <section>
        <div class="Counter">
            <h3>Total money</h3>
            <p>This Month: ${{ $data['totalPrice_in_month'] }}</p>
            <p>This Day: ${{ $data['totalPrice_in_day'] }}</p>
            <p>in General: ${{ $data['total_order_price'] }}</p>
        </div>
        <div class="card">
            <h2>Number of Users</h2>
            <p>{{ $data['user_count'] }}</p>
        </div>
        <div class="card">
            <h2>Number of Stores</h2>
            <p>{{ $data['store_count'] }}</p>
        </div>
    </section>
    <div class="foot">
        <div class="foot_pt1 container">
            <div class="foot_sec1">
                <p>impact</p>
                <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies
                    darta donna mare
                    fermentum iaculis eu non diam phasellus.</p>
                <div class="icons_foot">
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-linkedin"></i>
                </div>

            </div>
            <div class="foot_sec2">
                <p>Useful Links</p>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">About us</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Terms of service</a></li>
                    <li><a href="">Privacy policy</a></li>
                </ul>
            </div>
         
            <div class="foot_sec4">
                <p>Contact Us</p>
                <ul>
                    <li>A108 Adam Street</li>
                    <li>New York, NY 535022</li>
                    <li>United States</li>
                </ul>
                <br>
                <ul>
                    <li><span>Phone:</span> +1 5589 55488 55</li>
                    <li><span>Email:</span> info@example.com</li>
                </ul>
            </div>
        </div>
        <div class="foot_pt2 container">
            <p>© Copyright <span>Impact</span>. All Rights Reserved <br>
                Designed by BootstrapMade</p>
        </div>
    </div>
    <script src="dash.js "></script>
</body>

</html>