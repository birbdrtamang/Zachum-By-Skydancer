<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oregano:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>
<body>
    
<header>
        <nav class="dark:bg-gray-900 fixed z-20 top-0 start-0 border-b border-gray-200">
       
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
    </header>

    <section class="cartview">
        <p class="title">Menu Cart</p>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-16 py-3">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Product
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            
            <tbody>
                @if (count($cart) > 0)
                @foreach ($cart as $menu_id => $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="{{ asset('menu_img/' . $item['image']) }}" class="w-16 md:w-20 max-w-full max-h-full" alt="Apple iMac">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{ $item['menu_name'] }}
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                       Nu. {{ $item['price'] }} /-
                    </td>
                    <td>
                        <form id="update-form-{{ $menu_id }}" action="{{ route('cart.update', ['menu_id' => $menu_id]) }}" method="post">
                        @csrf
                        @method('PUT')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" onchange="updateQuantity({{ $menu_id }})">

                        </form>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                       Nu. {{ $item['price'] * $item['quantity'] }} /-
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        <form action="{{ route('cart.remove', ['menu_id' => $menu_id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="removebtn">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    </td>
                    <td>
                        
                    </td>
                    <td class="grandtotal px-6 py-4 font-bold text-gray-900 dark:text-white">
                      Grand Total
                    </td>
                    <td class="grandtotal px-6 py-4 font-bold text-gray-900 dark:text-white">
                        Nu. {{$total}} /-
                    </td>
                </tr> 
            @else
                <tr>
                    <td>Your cart is empty.</td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="checkoutdiv">
            @if (count($cart) > 0)
            <form action="#" method="#">
                @csrf
                @method('DELETE')
                <button type="submit" class="loginbtn"><a href="{{route('getInvoice')}}">Checkout</a></button>
            </form>
            @endif
        </div>
        
    </div>
    </section>

<script>
    function updateQuantity(menu_id) {
        var form = document.getElementById('update-form-' + menu_id);
        form.submit();
    }
</script>

<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('js/homepage.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <!-- @if(Session::has('success'))
            <script>
                swal("Message", "{{Session::get('success')}}",'success',{
                    button:true,
                    button:"OK",
                    timer:3000,
                })
            </script>
        @endif -->
</body>
</html>