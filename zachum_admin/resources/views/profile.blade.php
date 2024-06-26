<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <style>
        .custom-button {

    width: 20%;
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
    justify-content: center;

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
   

<nav class="fixed top-0 z-50 w-full navbar-bg border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="#" class="flex ms-2 md:me-24">
          <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" /> -->
          <div class="self-center text-center dark:text-white">
            <h2 class="text-2xl font-semibold sm:text-3xl whitespace-nowrap" style="color:#FFFFFF">Zachum</h2>
            <p><small style="color:#FFFFFF">Manager Dashboard</small></p>
          </div>
        </a>
      </div>
      <div class="flex items-center">
      <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="{{asset('img/avator.jpg')}}" alt="user photo">
              </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                
                  @if(session('currentUser'))
                  @auth
                  <p class="text-sm text-gray-900 dark:text-white" role="none">{{auth()->user()->name}}</p>
                
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                {{auth()->user()->email}}
                </p>
                @endauth
                  @endif
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a href="{{route('profile')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                </li>
                <li>
                  <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 mt-5 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{route('dashboard')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="currentColor" d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.39 3.39 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.39 3.39 0 0 0 15 11a3.5 3.5 0 0 0 0-7"/></svg>
               <span class="ms-3">Manager</span>
            </a>
         </li>
      </ul>
   </div>
</aside>




<div class="p-4 sm:ml-64" style="margin-top:90px"> 

    <h2 class="text-gray-900 dark:text-white text-lg font-medium mb-4">Profile Setting</h2>
    <div class="flex h-50 items-center justify-center mb-4 rounded-lg bg-gray-100 dark:bg-gray-900 shadow-lg" style="background-color: #FFFFFF;">
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
   
    <div class="flex flex-col items-center pb-5 pt-5 bg-white ">
        <!-- <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image"/> -->
        <svg class="w-24 h-24 mb-3 rounded-full shadow-lg"  xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 36 36">
          <path fill="#9ca3af" d="M30.61 24.52a17.16 17.16 0 0 0-25.22 0a1.51 1.51 0 0 0-.39 1v6A1.5 1.5 0 0 0 6.5 33h23a1.5 1.5 0 0 0 1.5-1.5v-6a1.51 1.51 0 0 0-.39-.98" class="clr-i-solid clr-i-solid-path-1"/>
          <circle cx="18" cy="10" r="7" fill="#9ca3af" class="clr-i-solid clr-i-solid-path-2"/>
          <path fill="none" d="M0 0h36v36H0z"/>
        </svg>
        @if(session('currentUser'))
        @auth
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{auth()->user()->name}}</h5>
        <span class="text-sm text-gray-500 dark:text-gray-400">Admin</span>
        <span class="text-sm text-gray-500 dark:text-gray-400">Employee ID: {{auth()->user()->id}}</span>

        @endauth
        @endif
    </div>

    <section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
  @if(session('currentUser'))
        @auth
      <form action="{{route('updateUser',['id'=>auth()->user()->id])}}" method="POST">
        @csrf
        @method('PUT')
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fullname</label>
                  <input value="{{auth()->user()->name}}" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
              </div>
              <div class="w-full">
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                  <input value="{{auth()->user()->email}}" type="email" name="email" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
              </div>
              <div class="w-full">
                  <label for="phoneNo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone No.</label>
                  <input value="{{auth()->user()->phoneNo}}" type="number" name="phoneNo" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
              </div>
              <div class="w-full">
                  <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                  <input value="{{auth()->user()->password}}" type="password" name="password" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
              </div>
          
          </div>
          <button type="submit" class="custom-button mt-5">
                    Update
          </button>
      </form>
      @endauth
        @endif
  </div>
</section>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>