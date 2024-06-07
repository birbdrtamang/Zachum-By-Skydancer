
@if(session('currentUser'))
@auth
@if(auth()->user()->role =='Customer')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zachum</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oregano:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->


</head>
<body>
    
    <header>
        <nav class="dark:bg-gray-900 fixed z-20 top-0 start-0 border-b border-gray-200">
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

    </header>
    <div class="invoice">
        <div class="companyName">
            <h4>Zachum By Skydancer</h4>
        </div>
        <hr>
        <div class="details">
        @if(session('currentUser'))
            <div class="userdetail">
                <p>Customer Name :
                    <span>  
                    @auth
                        {{auth()->user()->name}}
                    @endauth
                    </span>
                </p>
                <p>Phone No : 
                    <span>
                    @auth
                        {{auth()->user()->phoneNo}}
                    @endauth
                    </span>
                </p>
            </div>
            <!-- <div class="invoiceDetail">
                <p>ID : <span>12344</span></p>
                <p>Date : <span>12/3/2024</span></p>
                <p>Status : <span>Pending</span></p>
                <p>Payment : <span>Pending</span></p>
            </div> -->
        @endif
        </div>
        

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $menu_id => $item)
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item['menu_name'] }}
                        </th>
                        <td class="px-6 py-4">
                            {{$item['quantity']}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item['price'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item['price'] * $item['quantity'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <th scope="row" class="px-6 py-3 text-base">SubTotal</th>
                        <td class="px-6 py-3">{{$totalSum}}</td>
                    </tr>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <th scope="row" class="px-6 py-3 text-base">Tax</th>
                        <td class="px-6 py-3">25</td>
                    </tr>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <th scope="row" class="px-6 py-3 text-base">Service Charge</th>
                        <td class="px-6 py-3">25</td>
                    </tr>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <th scope="row" class="px-6 py-3 text-base">GrandTotal</th>
                        <td class="px-6 py-3">Nu. {{$grandTotal}}/-</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <hr>
        <form class="max-w-sm" id="orderForm" action="{{ route('submit.delivery.order') }}" method="POST">
            @csrf
            <div>
                <label for="small-input" class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                <input name="location" placeholder="Enter location..." type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="message" class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                <textarea name="message" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
            </div>
            

            <fieldset class="radio">
                <label for="message" class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-white">Payment Method</label>
                <div class="flex items-center mb-4 mt-4">
                    <input id="online" type="radio" name="paymentmethod" value="online" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="online" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                    Online Payment
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input id="on_delivery" type="radio" name="paymentmethod" value="on_delivery" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="on_delivery" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    On Delivery
                    </label>
                </div>
            </fieldset>

            <button id="onlinebtn" style="display:none" type="submit" class="paybtn">Pay Now</button>
            <button id="on_deliverybtn" style="display:none" type="submit" class="paybtn">Submit Order</button>

        </form>

    </div>

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
    <script>
        // Add an event listener to listen for changes in the radio buttons
        document.querySelectorAll('input[name="paymentmethod"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                // Check which radio button is selected
                if (this.value === "online") {
                    // Show online button and hide on delivery button
                    document.getElementById('onlinebtn').style.display = 'block';
                    document.getElementById('on_deliverybtn').style.display = 'none';
                } else if (this.value === "on_delivery") {
                    // Show on delivery button and hide online button
                    document.getElementById('onlinebtn').style.display = 'none';
                    document.getElementById('on_deliverybtn').style.display = 'block';
                }
            });
        });
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

    <script>
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Get selected payment method
            var paymentMethod = document.querySelector('input[name="paymentmethod"]:checked').value;

            // Set form action URL based on payment method
            if (paymentMethod === 'online') {
                this.action = "{{ route('submit.online.order') }}";
            } else if (paymentMethod === 'on_delivery') {
                this.action = "{{ route('submit.delivery.order') }}";
            }

            // Submit the form
            this.submit();
        });
    </script>
</body>
</html>

@else
<div>404 Page Not Found</div>
@endif
@endauth
@endif