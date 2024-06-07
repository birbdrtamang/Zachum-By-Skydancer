<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/managerlogin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oregano&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
    <form action="{{route('managerlogin.post')}}" method="POST" class="space-y-6">
        @csrf
        <h3 class="text-3xl font-medium text-center oregano-regular" style="color:#0F5061">Manager</h3>
        <h5 class="text-2xl font-medium text- dark:text-white text-center oregano-regular" style="color:#0F5061">Sign In</h5>

        <div>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Email" required />
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
        </div>
        <div class="flex items-start">
        
            <a href="{{route('forgetManagerPassword')}}" class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Forgot Password?</a>
        </div>
        <button type="submit" class="custom-button">Log in</button>

        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
        </div>
    </form>
</div>

</div>

</section> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>