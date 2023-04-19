
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/mobilephones.css">
    
    <!--  -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <!--  -->
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    
</head>
<body>


<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">
    <a class="navbar-brand ml-2 font-weight-bold" href="#">Search by Filters</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor"
        aria-controls="navbarColor" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{url('/homepage')}}">Back to homepage</a> </li>
            <li class="nav-item"><a class="nav-link" href="#">go to offers page</a> </li>
            {{--  --}}
        </ul>
    </div>
    </div>
</nav>
<div class="filter">
    <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#mobile-filter"
        aria-expanded="false" aria-controls="mobile-filter">Filters<span class="fa fa-filter pl-1"></span></button>
</div>
<div id="mobile-filter">
    <div>
        <h6 class="p-1 border-bottom">Mobile Brand</h6>
        <ul>
            <li><a href="#">Samsung</a></li>
            <li><a href="#">Iphone</a></li>
            <li><a href="#">Sony</a></li>
            <li><a href="#">Realme</a></li>
            <li><a href="#">Xaumi</a></li>
        </ul>
    </div>
    <div>
        <h6 class="p-1 border-bottom">Filter By Price</h6>
        <p class="mb-2">Color</p>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mb-2 rounded"><a href="#">
                    <span class="fa fa-circle pr-1" id="red"></span>Red
                </a></li>
            <li class="list-group-item list-group-item-action mb-2 rounded"><a href="#">
                    <span class="fa fa-circle pr-1" id="teal"></span>Teal
                </a></li>
            <li class="list-group-item list-group-item-action mb-2 rounded"><a href="#">
                    <span class="fa fa-circle pr-1" id="blue"></span>green
                </a></li>
        </ul>
    </div>
    <div>
        <h6>Type</h6>
        <form class="ml-md-2">
            <div class="form-inline border rounded p-sm-2 my-2">
                <input type="radio" name="type" id="boring">
                <label for="boring" class="pl-1 pt-sm-0 pt-1">Boring</label>
            </div>
            <div class="form-inline border rounded p-sm-2 my-2">
                <input type="radio" name="type" id="ugly">
                <label for="ugly" class="pl-1 pt-sm-0 pt-1">Ugly</label>
            </div>
            <div class="form-inline border rounded p-md-2 p-sm-1">
                <input type="radio" name="type" id="notugly">
                <label for="notugly" class="pl-1 pt-sm-0 pt-1">Not Ugly</label>
            </div>
        </form>
    </div>
</div>
<section id="sidebar">
    <div>
        <!-- From here you can start in -> sidebar -->
        <h6 class="p-1 border-bottom">Mobile Brand</h6>
        <ul>
            <div class="brand">
                <input id="mac" type="checkbox" name="os" value="Iphone">
                <label for="mac">Redmi</label>
            </div>

        </ul>
    </div>
    <!--  -->
    <div>
        <h6 class="p-1 border-bottom p-1 border-top">Store</h6>
        <ul>
            <div class="store">
                <input id="mac" type="checkbox" name="os" value="Iphone">
                <label for="mac">Redmi</label>
            </div>
        </ul>
    </div>
    <!--  -->
    <div>
        <h6 class="p-1 border-bottom p-1 border-top">Price</h6>
        <ul>
            <div class="price">
                <input id="mac" type="checkbox" name="os" value="Iphone">
                <label for="mac">50$ to 200$</label>
            </div>
        </ul>
    </div>
    <!--  -->












</section>
<section id="products">
    <div class="container">
        <div class="row">
            
            <!--  -->
            <div class="col-lg-3 offset-lg-0 col-sm-4 offset-sm-2 col-11 offset-1">
                <div class="card">
                    <img class="card-img-top" src="https://m.media-amazon.com/images/I/619f09kK7tL._AC_UL400_.jpg"
                        alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">New Smart Phones ..!!</p>
                        <p>$100</p>

                    </div>
                </div>
            </div>
            <!--  -->
            
        </div>
    </div>
</section>


    
</body>
</html>
