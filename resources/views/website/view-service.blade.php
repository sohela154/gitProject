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
            background-color: #f4f4f4;
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

    <div class="container">    
    <div class="row">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center text-danger"><b>{{$data->service_name}}</b></h2>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('uploads/service/'.$data->service_img)}}" alt="Photo" class="recommendation_img" height="190px" width="280px">
                </div>
                <div class="col-md-8">
                    <p style="text-align: justify;">{{($data->service_details)}}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-left text-success"><b>Seating arrangement photo</b></h3>
                    <br>
                    <img src="{{asset('uploads/service/'.$data->seating_img)}}" alt="Photo" class="" height="190px" width="280px">
                </div>
                <div class="col-md-6">
                    <h3 class="text-success"><b>Stage photo</b></h3>
                    <br>
                    <img src="{{asset('uploads/service/'.$data->stage_img)}}" alt="Photo" class="" height="190px" width="280px">
                </div>
            </div>
            <br>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-left text-primary">Price: </h3><h3>{{($data->price)}}</h3>
                </div>
                <div class="col-md-6">
                    <h3 class="text-left text-primary">Type: </h3><h3>{{($data->type)}}</h3>
                </div>
            </div>
            <br>
            <hr>
			<div class="row">
                <div class="col-md-12">
                <h2 class="text-center text-danger"><b>Reviews</b></h2>
                @foreach($allReview as $review)
                <br>
                    <div class="row">
                        <div class="col-md-12">
                        <h4>{{($review->reviewInfo->name)}}</h4>
                        <h4 class="text-left text-primary">{{($review->review)}}</h4><br>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                <br><br>
                    <form method="post" action="{{ route('reviewSubmit') }}" enctype="multipart/form-data">
                    <input type="hidden" name="service_id" value="{{$data->service_id}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-info text-center"><b>Submit Review</b></h4>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control" name="review" rows="3" cols="120" required>{{old('review')}}</textarea>
                            @error('review')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="col-md-5"></div>
                    </div>
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
 <script>
        // Toggle menu on small screens
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('showing');
        }
    </script>

</body>
</html>