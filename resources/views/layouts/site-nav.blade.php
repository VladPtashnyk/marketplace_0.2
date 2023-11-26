<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>

                    <!-- Icon when menu is closed. Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <!-- Icon when menu is open. Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('index') }}">
                        <img class="block h-8 w-auto lg:hidden"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </a>
                    <a href="{{ route('index') }}">
                        <img class="hidden h-8 w-auto lg:block"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="{{ route('index') }}"
                            class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            aria-current="page">{{ __('site-nav.home') }}</a>
                        <a href="{{ route('product') }}"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            aria-current="page">{{ __('site-nav.products') }}</a>
                    @if(isset($seller_id))
                        <a href="{{ route('product.my_products') }}"
                           class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                           aria-current="page">{{ __('site_profile.myProducts') }}</a>
                        <a href="{{ route('order.my_orders') }}"
                           class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                           aria-current="page">{{ __('site_profile.myOrders') }}</a>
                    @endif
                    </div>
                </div>
            </div>

            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                <form class="me-4" action="{{ route('switchLanguage') }}" method="POST">
                    @csrf
                    <button class="inline-block me-2 text-gray-400 hover:text-white" type="submit" name="lang"
                        value="uk">UK</button>
                    <button class="inline-block me-2 text-gray-400 hover:text-white" type="submit" name="lang"
                        value="en">EN</button>
                </form>

                <a class="inline-block me-2 text-gray-400 hover:text-white"
                    href="{{ route('cart') }}">{{ __('site-nav.cart') }} ({{ $cartNum ?? '0' }})</a>

                @if(!isset($seller_name) && !isset($client_name))
                <a class="inline-block ms-3 text-gray-400 hover:text-white"
                    href="{{ route('auth') }}">{{ $seller_name ?? $client_name ?? __('site-nav.signIn') }}</a>
                @else
                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div class="me-2">
                        <button type="button"
                            class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only"></span>
                            <span
                                class="inline-block text-base text-gray-400 hover:text-white">{{ $seller_name ?? $client_name ?? __('site-nav.profile') }}</span>
                        </button>
                    </div>

                    <!-- Dropdown menu, show/hide based on menu state. -->
                    <div class="hidden absolute top-7 right-0 z-10 mt-3 w-40 py-1 origin-top-right rounded-md bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <a href="{{ route('auth') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700"
                            role="menuitem" tabindex="-1" id="user-menu-item-0">{{ __('site-nav.profile') }}</a>
                        <form class="hover:bg-gray-700" action="{{ route('log_out') }}" method="POST">
                            @csrf
                            <button class="block w-full text-left px-4 py-2 text-sm text-gray-300"
                                type="submit">{{ __('site-nav.logout') }}</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="{{ route('index') }}"
                class="bg-gray-900 text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                aria-current="page">{{ __('site-nav.home') }}</a>
            <a href="{{ route('product') }}"
                class="bg-gray-900 text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                aria-current="page">{{ __('site-nav.products') }}</a>
            @if(isset($seller_id))
                <a href="{{ route('product.my_products') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                    aria-current="page">{{ __('site_profile.myProducts') }}</a>
                <a href="{{ route('order.my_orders') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                    aria-current="page">{{ __('site_profile.myOrders') }}</a>
            @endif
        </div>
    </div>
</nav>
