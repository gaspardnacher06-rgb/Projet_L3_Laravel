
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>site-commerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        /* The side navigation menu */
        .sidebar {
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #f1f1f1;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        overflow: auto;
        }
 
        /* Sidebar links */
        .sidebar a {
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
        }
 
        /* Active/current link */
        .sidebar a.active {
        background-color: #04AA6D;
        color: white;
        }
 
        /* Links on mouse-over */
        .sidebar a:hover:not(.active) {
        background-color: #555;
        color: white;
        }
 
        .sidebar form {
            margin: 0;
        }
        .sidebar button.logout-link {
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: black;
            padding: 16px;
            font-size: inherit;
            cursor: pointer;
        }
        .sidebar button.logout-link:hover {
            background-color: #555;
            color: white;
        }
 
        /* Page content. The value of the margin-left property should match the value of the sidebar's width property */
        .main-content {
        margin-left: 200px;
        }
 
        /* On screens that are less than 700px wide, make the sidebar into a topbar */
        @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }
        .sidebar a {float: left;}
        .main-content {margin-left: 0;}
        }
 
        /* On screens that are less than 400px, display the bar vertically, instead of horizontally */
        @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
        }
    </style>
 
</head>
<body>
 
    <!-- The sidebar -->
    <div class="sidebar">
        <a class="active" href="{{ route('boutique') }}">Boutique</a>
        <a href="{{ route('panier') }}">Panier</a>
 
        @guest
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}">Inscription</a>
        @endguest
 
        @auth
            <span class="d-block px-3 py-2">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-link">Déconnexion</button>
            </form>
        @endauth
 
        <a href="#about">About</a>
    </div>
 
    <!-- Main content area (navbar + page content) -->
    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">8aHuit Informatique</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
 
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
 
            <form class="form-inline my-2 my-lg-0" action="{{ route('boutique') }}" method="GET">
            <input class="form-control mr-sm-2" type="search" name="q" value="{{ request('q') }}" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        </nav>
 
        <div class="container-fluid mt-4">
            @yield('content')
        </div>
    </div>
 
</body>
</html>
 
