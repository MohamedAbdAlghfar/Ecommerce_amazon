<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web\css\all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="body_nav0">
        <div class="body_nav0_pt1">
            Welocome into our market we wish you to find what you need.
        </div>
        <div class="body_nav0_pt2">
            <div class="body_nav0_pt2_icons">
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
            </div>
            <!--||دخل اللينك هنا يا عبدالله|| -->
            <a href="">Contact us</a>
            <a href="">Ask any question?</a>
        </div>
    </div>
    <div class="body_nav container">
        <div class="body_nav_pt1">
            <img src="/images/logo.jpeg" alt="logo">
        </div>
        <div class="body_nav_pt2">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="body_nav_pt3">
            <div class="click">
                <a href="">Login / Sign Up</a>
            </div>
        </div>
    </div>
    <div class="body_nav_links container">
        <div class="container-fluid links_list">
            <button class="navbar-toggler links_list_button" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
                <span class="Bar_lines"></span>
                <span class="Bar_lines"></span>
                <span class="Bar_lines"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg side_bar" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <!--||دخل اللينك هنا يا عبدالله|| -->
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <!--||دخل اللينك هنا يا عبدالله|| -->
                            <a class="nav-link" href="#">Electronics</a>
                        </li>
                        <li class="nav-item">
                            <!--||دخل اللينك هنا يا عبدالله|| -->
                            <a class="nav-link" href="#">PC</a>
                        </li>
                        <li class="nav-item">
                            <!--||دخل اللينك هنا يا عبدالله|| -->
                            <a class="nav-link" href="#">Phones</a>
                        </li>
                        <li class="nav-item">
                            <!--||دخل اللينك هنا يا عبدالله|| -->
                            <a class="nav-link" href="#">Fashion</a>
                        </li>
                        <li class="nav-item">
                            <!--||دخل اللينك هنا يا عبدالله|| -->
                            <a class="nav-link" href="#">Sports</a>
                        </li>
                        <li class="nav-item">
                            <!--||دخل اللينك هنا يا عبدالله|| -->
                            <a class="nav-link" href="#">Books</a>
                        </li>
                        <li class="nav-item">
                            <!--||دخل اللينك هنا يا عبدالله|| -->
                            <a class="nav-link" href="#">Offers</a>
                        </li>
                        <li class="nav-item">
                            <!--||دخل اللينك هنا يا عبدالله|| -->
                            <a class="nav-link" href="#">Beauty & Makeup</a>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="linking">
            <a href="{{url('/filtering')}}">Home</a>
            <a href="">Electronics</a>
            <a href="">PC</a>
            <a href="{{url('/mobilephones')}}">Phones</a>
            <a href="">Fashion</a>
            <a href="">Sports</a>
            <a href="">Kitchenn</a>
            <a href="">Books</a>
            <a href="">Offers</a>
            <a href="">Beauty & Makeup</a>

        </div>
    </div>
    <div class="body1 container">
        <div class="body1_title">
            <p>Our products</p>
        </div>
        <div class="body_cards">
            <div class="card body1_cardX" style="width: 18rem;">
                <img src="/images/pexels-atc-comm-photo-306763.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">We got Electronics that you are going to need as basics in life or additionals
                    </p>
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <a href="">learn more</a>
                </div>
            </div>
            <div class="card body1_cardX" style="width: 18rem;">
                <img src="/images/pexels-r-fera-432059.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">You can buy from here anything to wear
                    </p>
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <a href="">learn more</a>
                </div>
            </div>
            <div class="card body1_cardX" style="width: 18rem;">
                <img src="/images/pexels-bich-tran-1714341.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">We have Personal computers and you can but them into parts
                    </p>
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <a href="">learn more</a>
                </div>
            </div>
            <div class="card body1_cardX" style="width: 18rem;">
                <img src="/images/pexels-tyler-lastovich-699122.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">We also got mobile phones and it can be really useful for your life
                    </p>
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <a href="">learn more</a>
                </div>
            </div>
            <div class="card body1_cardX" style="width: 18rem;">
                <img src="/images/pexels-pixabay-209977.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">From here you can get sports tools in any sport you play
                    </p>
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <a href="">learn more</a>
                </div>
            </div>
            <div class="card body1_cardX" style="width: 18rem;">
                <img src="/images/pexels-cottonbro-studio-4273468.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Here you can get books in anything you like to read
                    </p>
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <a href="">learn more</a>
                </div>
            </div>
            <div class="card body1_cardX" style="width: 18rem;">
                <img src="/images/pexels-rachel-claire-5531017.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Here is the offers and discounts that will help you to buy more things
                    </p>
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <a href="">learn more</a>
                </div>
            </div>
            <div class="card body1_cardX" style="width: 18rem;">
                <img src="/images/pexels-yogendra-singh-3089849.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">From here you can buy and makeup you want
                    </p>
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <a href="">learn more</a>
                </div>
            </div>
        </div>

    </div>
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
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <li><a href="">Home</a></li>
                    <li><a href="">About us</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Terms of service</a></li>
                    <li><a href="">Privacy policy</a></li>
                </ul>
            </div>
            <div class="foot_sec3">
                <p>Our Services</p>
                <ul>
                    <!-- دخل اللينك هنا يا عبدالله -->
                    <li><a href="">Electronics</a></li>
                    <li><a href="">PC</a></li>
                    <li><a href="">Phones</a></li>
                    <li><a href="">Fashion</a></li>
                    <li><a href="">Sports</a></li>
                    <li><a href="">Books</a></li>
                    <li><a href="">Offers</a></li>
                    <li><a href="">Beauty & Makeup</a></li>

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

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
        crossorigin="anonymous"></script>
    <script src="index.js"></script>
</body>

</html>