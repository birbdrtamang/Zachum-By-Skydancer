<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Menu</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oregano:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>
<body>
<header>
        <nav class="dark:bg-gray-900 fixed z-20 top-0 start-0 border-b border-gray-200">
        @if($event)
            <div class="highlight">
                <p class="scrolling-text"><a href="#sec5">{{$event->description}}</a></p>
            </div>
        @endif
            <div id="navlinkscontainer" class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-3 px-5">
                <a href="{{route('homepage')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('img/ZachumRestaurant/zachumlogo.png') }}" class="h-8" alt="Zachum Logo">
                </a>
                <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-end hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                    <ul id="navlinks" class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray=600 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="#sec1" class="active link">About</a>
                        </li>
                        <li>
                            <a href="#sec2" class="link">Menu</a>
                        </li>
                        <li>
                            <a href="#sec3" class="link">Reservation</a>
                        </li>
                        <li>
                            <a href="#sec4" class="link">Service</a>
                        </li>
                        <li class="carticon" current-count="{{count($cart)}}">
                            <a href="{{route('cart')}}" >
                                <svg  xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 16 16"><path fill="#fff" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607L1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4a2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2a1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2a1 1 0 0 1 0-2"/></svg>
                            </a>                      
                        </li>
                        <li class="userDetail">
                        @if(session('currentUser'))
                            <span class="username">
                                @auth
                                    {{auth()->user()->name}}
                                @endauth
                            </span>
                            <a href="{{route('logout')}}" class="login">Logout</a>

                        @else
                            <a href="{{route('login')}}" class="login">Login</a>
                        @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <h1 data-aos="zoom-in" data-aos-duration="2000" data-aos-delay="200">Our Menu</h1>
            <p data-aos="zoom-in" data-aos-duration="2000" data-aos-delay="100">We bring to you the unforgettable moment with our delicious dishes.</p>
        </div>
    </header>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 id="header" class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Menu List</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Let's Make Your Meal be Fantastic With Zachum Menu!</p>
            </div>       

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul style="justify-content:center" class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Starter</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Soup/Salad</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Main Course</button>
                    </li>
                    <li class="me-2"  role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Noodles</button>
                    </li>
                    <li role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dessert-tab" data-tabs-target="#dessert" type="button" role="tab" aria-controls="dessert" aria-selected="false">Dessert</button>
                    </li>
                </ul>
            </div>

            <!-- tab content  -->
            <div id="default-tab-content">
                <!-- starter tab  -->
                <div style="justify-content:space-evenly" class="flex flex-wrap hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @foreach ($menu as $menuItem)
                        @if($menuItem->type === 'Starter')
                            <div style="width:300px;height:300px;margin-bottom:30px" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <img style="width:100%;height:70%" class="rounded-t-lg" src="{{ asset('menu_img/' . $menuItem->image) }}" alt="product image" />
                                </a>
                                <div class="px-5 pb-5">
                                    <a href="#">
                                        <h6 class="mt-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$menuItem->menu_name}}</h6>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        <span class="text-l font-bold text-gray-900 dark:text-white">Nu. {{$menuItem->price}}/-</span>
                                        <form action="{{route('cart.add',['menu_id' => $menuItem->menu_id])}}" method="post">
                                            @csrf
                                            <button type="submit">                            
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 20 20"><path fill="currentColor" d="M2.997 3.496a.5.5 0 0 1 .5-.5h.438c.727 0 1.145.473 1.387.945c.165.323.284.717.383 1.059H16a1 1 0 0 1 .962 1.272l-1.496 5.275A2 2 0 0 1 13.542 13H8.463a2 2 0 0 1-1.93-1.473l-.642-2.355l-.01-.032l-1.03-3.498l-.1-.337c-.1-.346-.188-.652-.32-.909c-.159-.31-.305-.4-.496-.4h-.438a.5.5 0 0 1-.5-.5M8.5 17a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m5 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3"/></svg>                                            
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- soup and salad -->
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    @foreach ($menu as $menuItem)
                        @if($menuItem->type === 'Soup/Salad')
                            <div style="width:300px;height:300px;margin-bottom:30px" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <img style="width:100%;height:70%" class="rounded-t-lg" src="{{ asset('menu_img/' . $menuItem->image) }}" alt="product image" />
                                </a>
                                <div class="px-5 pb-5">
                                    <a href="#">
                                        <h6 class="mt-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$menuItem->menu_name}}</h6>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        <span class="text-l font-bold text-gray-900 dark:text-white">Nu. {{$menuItem->price}}/-</span>
                                        <form action="{{route('cart.add',['menu_id' => $menuItem->menu_id])}}" method="post">
                                            @csrf
                                            <button type="submit">                            
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 20 20"><path fill="currentColor" d="M2.997 3.496a.5.5 0 0 1 .5-.5h.438c.727 0 1.145.473 1.387.945c.165.323.284.717.383 1.059H16a1 1 0 0 1 .962 1.272l-1.496 5.275A2 2 0 0 1 13.542 13H8.463a2 2 0 0 1-1.93-1.473l-.642-2.355l-.01-.032l-1.03-3.498l-.1-.337c-.1-.346-.188-.652-.32-.909c-.159-.31-.305-.4-.496-.4h-.438a.5.5 0 0 1-.5-.5M8.5 17a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m5 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3"/></svg>                                            
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach                
                </div>
                </div>
                <!-- main course  -->
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    @foreach ($menu as $menuItem)
                        @if($menuItem->type === 'Main Course')
                            <div style="width:300px;height:300px;margin-bottom:30px" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <img style="width:100%;height:70%" class="rounded-t-lg" src="{{ asset('menu_img/' . $menuItem->image) }}" alt="product image" />
                                </a>
                                <div class="px-5 pb-5">
                                    <a href="#">
                                        <h6 class="mt-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$menuItem->menu_name}}</h6>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        <span class="text-l font-bold text-gray-900 dark:text-white">Nu. {{$menuItem->price}}/-</span>
                                        <form action="{{route('cart.add',['menu_id' => $menuItem->menu_id])}}" method="post">
                                            @csrf
                                            <button type="submit">                            
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 20 20"><path fill="currentColor" d="M2.997 3.496a.5.5 0 0 1 .5-.5h.438c.727 0 1.145.473 1.387.945c.165.323.284.717.383 1.059H16a1 1 0 0 1 .962 1.272l-1.496 5.275A2 2 0 0 1 13.542 13H8.463a2 2 0 0 1-1.93-1.473l-.642-2.355l-.01-.032l-1.03-3.498l-.1-.337c-.1-.346-.188-.652-.32-.909c-.159-.31-.305-.4-.496-.4h-.438a.5.5 0 0 1-.5-.5M8.5 17a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m5 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3"/></svg>                                            
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach      
                </div>
                <!-- noodles  -->
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                    @foreach ($menu as $menuItem)
                        @if($menuItem->type === 'Noodles')
                            <div style="width:300px;height:300px;margin-bottom:30px" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <img style="width:100%;height:70%" class="rounded-t-lg" src="{{ asset('menu_img/' . $menuItem->image) }}" alt="product image" />
                                </a>
                                <div class="px-5 pb-5">
                                    <a href="#">
                                        <h6 class="mt-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$menuItem->menu_name}}</h6>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        <span class="text-l font-bold text-gray-900 dark:text-white">Nu. {{$menuItem->price}}/-</span>
                                        <form action="{{route('cart.add',['menu_id' => $menuItem->menu_id])}}" method="post">
                                            @csrf
                                            <button type="submit">                            
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 20 20"><path fill="currentColor" d="M2.997 3.496a.5.5 0 0 1 .5-.5h.438c.727 0 1.145.473 1.387.945c.165.323.284.717.383 1.059H16a1 1 0 0 1 .962 1.272l-1.496 5.275A2 2 0 0 1 13.542 13H8.463a2 2 0 0 1-1.93-1.473l-.642-2.355l-.01-.032l-1.03-3.498l-.1-.337c-.1-.346-.188-.652-.32-.909c-.159-.31-.305-.4-.496-.4h-.438a.5.5 0 0 1-.5-.5M8.5 17a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m5 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3"/></svg>                                            
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach      
                </div>
                <!-- dessert  -->
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dessert" role="tabpanel" aria-labelledby="dessert-tab">
                    @foreach ($menu as $menuItem)
                        @if($menuItem->type === 'Dessert')
                            <div style="width:300px;height:300px;margin-bottom:30px" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <img style="width:100%;height:70%" class="rounded-t-lg" src="{{ asset('menu_img/' . $menuItem->image) }}" alt="product image" />
                                </a>
                                <div class="px-5 pb-5">
                                    <a href="#">
                                        <h6 class="mt-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$menuItem->menu_name}}</h6>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        <span class="text-l font-bold text-gray-900 dark:text-white">Nu. {{$menuItem->price}}/-</span>
                                        <form action="{{route('cart.add',['menu_id' => $menuItem->menu_id])}}" method="post">
                                            @csrf
                                            <button type="submit">                            
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 20 20"><path fill="currentColor" d="M2.997 3.496a.5.5 0 0 1 .5-.5h.438c.727 0 1.145.473 1.387.945c.165.323.284.717.383 1.059H16a1 1 0 0 1 .962 1.272l-1.496 5.275A2 2 0 0 1 13.542 13H8.463a2 2 0 0 1-1.93-1.473l-.642-2.355l-.01-.032l-1.03-3.498l-.1-.337c-.1-.346-.188-.652-.32-.909c-.159-.31-.305-.4-.496-.4h-.438a.5.5 0 0 1-.5-.5M8.5 17a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m5 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3"/></svg>                                            
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach      
                </div>
            </div>

              
        </div>
    </section>

    <footer id="footercontainer" class="text-gray-600 body-font" >
        <div id="footer" class="px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                <img src="{{ asset('img/ZachumRestaurant/zachumlogo.png') }}" class="h-8" alt="Zachum Logo">
            </a>
            <a href="https://www.yarkayhotels.com/" class="cursor-pointer text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2024 Yarkay Hotels</a>
            <p id="email" class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m-.4 4.25l-7.07 4.42c-.32.2-.74.2-1.06 0L4.4 8.25a.85.85 0 1 1 .9-1.44L12 11l6.7-4.19a.85.85 0 1 1 .9 1.44"/></svg>
                <span>yugel.tshering@dusit.com</span>
            </p>
            <p id="email" class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42a18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/></svg>                
                <span>+975 17 82 90 52</span>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
            
            <a class="text-gray-500 cursor-pointer">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                </svg>
            </a>
            <a class="ml-3 text-gray-500">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                </svg>
            </a>
            <a class="ml-3 text-gray-500">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                <circle cx="4" cy="4" r="2" stroke="none"></circle>
                </svg>
            </a>
            </span>
        </div>
    </footer>


</body>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('js/homepage.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    @if(Session::has('success'))
            <script>
                swal("Message", "{{Session::get('success')}}",'success',{
                    button:true,
                    button:"OK",
                    timer:3000,
                })
            </script>
        @endif
</html>