<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zachum</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oregano:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>
<body>
    
    <header>
        <video autoplay loop muted plays-inline class="background-clip" src="{{asset('img/ZachumRestaurant/video.mp4')}}" type="Video/mp4"></video>

        <nav class="dark:bg-gray-900 fixed z-20 top-0 start-0 border-b border-gray-200">
            @if($event)
                <div class="highlight">
                    <p class="scrolling-text"><a href="#sec5">{{$event->description}}</a></p>
                </div>
            @endif
            <div id="navlinkscontainer" class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-3 px-5">
                <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
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
                        
                            <a href="#">
                                <span class="username">
                                    
                                    @auth
                                        {{auth()->user()->name}}
                                    @endauth
                                    
                                </span>
                            </a>
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
            <h1 data-aos="zoom-in" data-aos-duration="2000" data-aos-delay="200">Tasty ~ Delicious ~ Savoury</h1>
            <p data-aos="zoom-in" data-aos-duration="2000" data-aos-delay="100">Experience the Magic of Bhutan with an Enchanting Culinary Adventure of the most Authentic Cuisine, Mesmerizing Cultural Shows, Excellent Service in an ambience created only for your comfort</p>
        </div>

    </header>

    <section id="sec1" class="section1">
        <div class="aboutcontainer">
            <div class="imgcontainer">
                <img src="{{asset('img/ZachumRestaurant/a.jpg')}}" alt="" class="img1" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
                <div class="imgcontainer2">
                    <img src="{{asset('img/ZachumRestaurant/b.jpg')}}" alt="" class="img2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <img src="{{asset('img/ZachumRestaurant/c.jpg')}}" alt="" class="img2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                </div>
            </div>
            <div class="aboutcontent">
                <h1 data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">Our Story</h1>
                <p data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100">Experience the Magic of Bhutan with an Enchanting Culinary Adventure of the most Authentic Cuisine, Mesmerizing Cultural Shows, Excellent Service in an ambience created only for your comfort.</p>
                <a data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="50" class="about" href="{{route('aboutUs')}}">About Us</a>
            </div>
        </div>
    </section>

    <section id="sec2" class="section2">
        <div class="menucontainer" data-aos="zoom-in" data-aos-duration="2000" data-aos-delay="200">
            <div class="menubanner">
                <img src="{{asset('img/ZachumFood/menubanner.jpg')}}" alt="">
            </div>
            <div class="menucontent">
                <h1>Daily Special</h1>
                <div class="menuitem">
                @foreach($items as $item)
                    <div class="item">
                        
                        <img src="{{ asset('menu_img/' . $item->image) }}" alt="Menu Image"><br>
                        
                        <div class="desc">
                            <h2 class="title">{{$item->menu_name}} ~ Nu. {{$item->price}}/-</h2>
                            <p class="description">{{$item->description}}</p>
                        </div>
                        <form action="{{route('cart.add',['menu_id' => $item->menu_id])}}" method="post">
                            @csrf
                            <button type="submit">                            
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 48 48"><defs><mask id="ipSShoppingCart0"><g fill="#fff"><path fill="#fff" d="M39 32H13L8 12h36z"/><path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M3 6h3.5L8 12m0 0l5 20h26l5-20z"/><circle cx="13" cy="39" r="3" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/><circle cx="39" cy="39" r="3" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M22 22h8m-4 4v-8"/></g></mask></defs><path fill="#fff" d="M0 0h48v48H0z" mask="url(#ipSShoppingCart0)"/></svg>
                            </button>
                        </form>
                    </div>
                @endforeach
                    <a class="menubtn" href="{{route('menu')}}">All Dishes</a>
                </div>
                
            </div>
        </div>
    </section>

    <section id="sec3" class="section3">
        <div class="reservationcontainer">
            <div class="reservecontent" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                <h3 class="reservetitle">Reservation</h3>
                <p class="reservedesc">At our table reservation service, we understand the importance of making dining arrangements seamless and stress-free. Whether you're craving a cosy corner for an intimate dinner or seeking a lively atmosphere for a group gathering, our service puts you in control of your dining destiny. Skip the uncertainty and frustration of walk-in dining – reserve your table with us and savour the anticipation of a delightful dining adventure.</p>
                <a class="reservebtn" href="{{route('reservation')}}">Make Reservation</a>
            </div>
            <div class="reservebanner">
                <video autoplay loop muted plays-inline src="{{asset('img/ZachumRestaurant/reservevideo.mp4')}}" type="Video/mp4"></video>
            </div>
        </div>
    </section>

    <section id="sec4" class="section4">
        <div class="servicecontainer">
            <h4 data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">What We Focus On</h4>
            <div class="servicecontent">
                <div class="reservation" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                    <img src="{{asset('img/ZachumRestaurant/reservation.png')}}" alt="" height=70 width=70>
                    <p class="reservationtitle">Reservation</p>
                    <p class="reservedesc">Looking to avoid the hassle of waiting for a table at Zachum? Welcome to our table reservation service, where we simplify the dining experience for you.</p>
                </div>
                <div class="onlineorder" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="800">
                <img src="{{asset('img/ZachumRestaurant/order.png')}}" alt="" height=70 width=70>
                    <p class="reservationtitle">Online Order</p>
                    <p class="reservedesc">A hassle-free solution for ordering your favourite meals. Enjoy a seamless experience with secure payments. Order now and have delicious food delivered to your doorstep!</p>
                </div>
                <div class="delivery" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="1600">
                <img src="{{asset('img/ZachumRestaurant/delivery.png')}}" alt="" height=70 width=70>
                    <p class="reservationtitle">Fast Delivery</p>
                    <p class="reservedesc">Experience lightning-fast delivery with our service! We prioritize speed without compromising quality. Sit back, relax, and enjoy your favourite meals delivered to you in record time.</p>
                </div>
            </div>
        </div>
    </section>
    
    @if($event)
    <section id="sec5" class="section5">
        <h4 data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">{{$event->event_name}}</h4>
        <img src="{{ asset('event_img/' . $event->image) }}" alt="" style="width:90%">
    </section>
    @endif

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

</body>
</html>