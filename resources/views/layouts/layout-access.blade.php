<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
 <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link href="{{ asset('resources/css/tailwind.css')}}" rel="stylesheet"> 

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-font-awesome-api-key.js"></script> 

    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script> 

    <!-- Vue.js -->
    <script src="https://unpkg.com/vue@3.2.34/dist/vue.global.js"></script> 

    <!-- Vue Router -->
    <script src="https://unpkg.com/vue-router@4.3.2/dist/


    <link rel="stylesheet" href="{{asset('resources/css/app.css')}}"> 

    <!-- Additional CSS and JS
        
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    -->
    

</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Page Content -->
        <main>
            @yield('content-access')
        </main>
    </div>

   
    <script src="{{asset('resources/js/app.js')}}"></script> 
</body>
</html>