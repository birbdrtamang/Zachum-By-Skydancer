<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oregano&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .custom-button {
    width: 100%;
    color: white;
    background-color: #0f5061;
    border: none;
    border-radius: 0.375rem; /* 6px */
    padding: 0.625rem 1.25rem; /* 10px 20px */
    font-size: 0.875rem; /* 14px */
    font-weight: 500;
    line-height: 1.5;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-button:hover {
    background-color: #0a4051;
}

/* Dark mode styles */
@media (prefers-color-scheme: dark) {
    .custom-button {
        background-color: #0a4051;
    }

    .custom-button:hover {
        background-color: #0f5061;
    }
}
    </style>
  
</head>
<body>
    
<section class="background-section bg-gray-700 bg-blend-multiply">

<div style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
<div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
    <form class="space-y-6" action="{{route('login.post')}}" method="POST">
        @csrf
        <h3 class="text-3xl font-medium text-center oregano-regular" style="color:#0F5061">Admin</h3>
        <h5 class="text-2xl font-medium text- dark:text-white text-center oregano-regular" style="color:#0F5061">Sign In</h5>

        <div>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Email" required />
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
        </div>
        <div class="flex items-start">
        
            <a href="{{route('forgetPassword')}}" class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Forgot Password?</a>
        </div>
        <button type="submit" class="custom-button">Log in</button>

        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
        </div>
    </form>
</div>

</div>

</section>   

@if(Session::has('success'))
            <script>
                swal("Message", "{{Session::get('success')}}",'success',{
                    button:true,
                    button:"OK",
                    timer:3000,
                })
            </script>
        @endif
        @if(Session::has('error'))
            <script>
                swal("Message", "{{Session::get('error')}}",'error',{
                    button:true,
                    button:"OK",
                    timer:3000,
                })
            </script>
        @endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>