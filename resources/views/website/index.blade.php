<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        /* Basic Styling */
        nav {
            background-color: #5800db;
            padding: 15px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 18px;
        }
        nav a:hover {
            color: #ddd;
        }
        section {
            padding: 60px 20px;
            margin: 20px 0;
            text-align: center;
        }
        #home {
            background-color: #ffffff;
            margin-top:-1px;
            padding: 0; /* Remove padding for full-width slider */
        }
        h2 {
            margin-bottom: 20px;
        }
        .auth-buttons {
            margin-top: 10px;
            text-align: center;
        }
        .auth-buttons a {
            color: white;
            background-color: #555;
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
        }
        .auth-buttons a:hover {
            background-color: #444;
        }

        /* Image Slider Styles */
        .slider {
            position: relative;
            width: 100%;
            max-height: 500px;
            overflow: hidden;
        }
        .slides {
            display: flex;
            width: 300%;
            transition: transform 0.5s ease-in-out;
        }
        .slides img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .caption {
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 36px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .slider-buttons {
            position: absolute;
            width: 100%;
            top: 50%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        .slider-buttons button {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .slider-buttons button:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Responsive Navigation Menu */
        .menu-icon {
            display: none;
            font-size: 54px;
            cursor: pointer;
            color: white;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            display: inline-block;
            margin: 0 10px;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .menu-icon {
                display: block;
                text-align: right;
            }
            nav ul {
                display: none;
                text-align: center;
            }
            nav ul li {
                display: block;
                margin: 10px 0;
            }
            nav ul.showing {
                display: block;
            }
            .caption {
                font-size: 28px;
                top: 20px;
            }
        }

        @media (max-width: 480px) {
            section {
                padding: 40px 15px;
            }
            nav a {
                font-size: 16px;
            }
            h2 {
                font-size: 24px;
            }
            .caption {
                font-size: 24px;
            }
        }
    </style>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <!-- add icon link -->
        <link rel = "icon" href ="{{asset('contents/admin/assets')}}/img/logo.jpeg" type = "image/x-icon">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/all.min.css">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/style.css">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/jquery.dataTables.min.css">
        <script src="{{asset('contents/admin/assets')}}/js/jquery-3.4.1.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/sweetalert2.all.min.js"></script>
</head>
<body>

    <!-- Navigation Menu -->
    <nav>
        <span class="menu-icon" onclick="toggleMenu()">☰</span>
        <ul id="menu">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><a href="{{url('/')}}#about">About</a></li>
            <li><a href="{{url('/')}}#services">Services</a></li>
           
            <li><a href="{{url('login')}}">Sign In</a></li>
            <li><a href="{{url('register')}}">Sign Up</a></li>
        </ul>
    </nav>

    <!-- Home Section with Image Slider -->
    <section id="home">
        <h2>Welcome to Event Planner</h2>
        <h3>From Sohela Showrin, Rahin Toshmi Ohee, Tahsina Tanvin.</h3>
    </section>

    <!-- About Section -->
    <section id="about">
        <h2>About Us</h2>
        <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <p style="text-align: justify;">Event Planner is a website where you can find different packages for events like weddings, corporate meetings, or private parties. It's easy to use and helps you pick the best option for your event.

You can look at detailed descriptions of each package to help you decide. Plus, you can read reviews from other people who have used the packages, so you know what to expect. This way, you can feel confident in your choice.Thank you!!!!
                </p>
            </div>
            <div class="col-md-1"></div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services">
        <h2>Our Services</h2>
        <br>
        <div class="container">
        <div class="row">
            @foreach($all as $data)
            <div class="col-md-4">
                <div class="card" style="margin-bottom:25px">
                    <img class="card-img-top" src="{{asset('uploads/service/'.$data->service_img)}}" alt="Service">
                    <div class="card-body">
                        <h5 class="card-title">{{$data->service_name}}</h5>
                        <p class="card-text"><p style="text-align: justify;">{{Str::limit($data->service_details, 60, '...')}}</p>
                        <a href="{{ route('book_service', ['id' => $data->service_id]) }}" class="btn btn-primary">Book Now</a>
                        <a href="{{ route('web_view_service', ['id' => $data->service_id]) }}" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        </div>
    </section>

    <script>
        // Toggle menu on small screens
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('showing');
        }
    </script>

</body>
</html>
