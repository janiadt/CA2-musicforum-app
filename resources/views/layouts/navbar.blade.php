{{-- In this file (navbar) we will write a navbar and bootstrap css. This will then be included in the app file --}} 
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #6672db;"> 

    <div class="container"> 

        {{-- The navbar will return the app.name from the config file, or it will use Laravel as a fallback. The URL function is used to generate application URLs --}} 

        <a class="navbar-brand" href="{{ url('/') }}"> 
            Music Forum
        </a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> 
        </button> 

        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
            <!-- Left Side Of Navbar --> 
            <ul class="navbar-nav mr-auto"> 
                {{-- If the user isn't registered, they can't see the songs --}}
                @auth
                <li class="nav-item"> 
                    {{-- The route functions here will create a named route url which will interact with the routing. Basically, it links to other parts of the app --}}
                    <a href="{{route('songs.index')}}" class="nav-link">Songs</a> 
                </li> 
                
                {{-- Navbar item that leads to the forum page. --}}
                <li class="nav-item"> 
                    <a href="{{route('threads.index')}}" class="nav-link">Forum</a> 
                </li> 

                <li class="nav-item"> 
                    <a href="{{route('user.announcements.index')}}" class="nav-link">Announcements</a> 
                </li> 

                {{-- Navbar item that leads to the user dashboard page. --}}
                <li class="nav-item"> 
                    <a href="{{route('home.index')}}" class="nav-link">{{Auth::user()->name}}</a> 
                </li> 
                @endauth
            </ul> 
            

            <!-- Right Side Of Navbar --> 
            {{-- Changing the layout of the navbar, and adding a guest view --}}
            <ul class="navbar-nav ml-auto"> 
                
                @guest
                <li class="nav-item"> 
                    {{-- The route will lead us to the register page for newcoming users --}}
                    <a href="{{route('register')}}" class="nav-link">Register</a> 
                </li> 
                <li class="nav-item"> 
                    {{-- The route will lead us to the login page. --}}
                    <a href="{{route('login')}}" class="nav-link">Log In</a> 
                </li> 
                @endguest
            </ul> 
        </div> 
    </div> 
</nav> 