<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- With the yield blade function, we output the content of this view to a section that extends thiss layout --}}
    <title>@yield('title', 'Music Forum')</title>
</head>
<body>
    {{-- With include, we import a view file's section, such as the navbar in this case. --}}
    @include('layouts.navbar')
    <main class="container mt-4">
        {{-- Here we yield the content, which will be the factor that we change for other pages --}}
        @yield('content')
    </main>
    @include('layouts.footer')

    {{-- Including bootstrap css and app.js --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Here we will create some flash message functionality with bootstrap styling --}}
    @if(session('status')) 
    {{-- If we passed a status key to this page, we will create the following div --}}                        
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('status')}} {{-- Here we display the currect status message in the session --}}
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            {{-- Close button --}}
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
</body>
</html>