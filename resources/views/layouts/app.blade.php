<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('include.head')
    @stack('styles')
    @stack('scripts-head')
</head>

<body>
    <div x-data="layoutData" x-init x-cloak>
        @include('include.toast-notification')

        <div class="relative flex justify-start w-full h-[100vh] overflow-y-hidden">
            <div class="fixed inset-y-0 top-0 left-0 z-40 h-[100vh] md:flex md:flex-col w-[75%] md:relative sm:w-64 md:top-auto md:left-auto"
                x-show="openSidebar" x-transition:enter="transition ease-in duration-250"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-out duration-250" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
                <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-[#2C343F] h-[100vh]">
                    <div class="w-full pt-10">
                        <div class="flex items-center justify-center flex-shrink-0 px-4 mb-4">
                            <img class="w-auto h-20" src="{{ asset('images/mystery.png') }}" alt="Huston Lottery">
                        </div>

                        <div class="w-full text-sm text-center text-white sm:text-lg">
                            @php
                                $user = auth()->user();
                            @endphp
                            Hi, {{ $user->name }}
                        </div>
                    </div>

                    <div class="flex flex-col flex-1 mt-5">
                        <nav class="flex-1 px-2 pb-4 space-y-1 [&>a:hover]:bg-[#5D90D2] [&>a:hover>div]:text-white">
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md group {{ \Request::route()->getName() === 'dashboard' ? 'bg-[#5D90D2]' : '' }}">
                                <div
                                    class="flex items-center justify-center w-10 mr-3 text-2xl {{ \Request::route()->getName() === 'dashboard' ? 'text-white' : 'text-[#276FCE]' }}">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                                List All Voucher
                            </a>

                            <a href="{{ route('reward') }}"
                                class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md group {{ \Request::route()->getName() === 'reward' ? 'bg-[#5D90D2]' : '' }}">
                                <div
                                    class="flex items-center justify-center w-10 mr-3 text-2xl {{ \Request::route()->getName() === 'reward' ? 'text-white' : 'text-[#276FCE]' }}">
                                    <i class="fa-solid fa-gifts"></i>
                                </div>
                                Reward
                            </a>

                            <a href="{{ route('profile') }}"
                                class="flex items-center px-2 py-2 text-sm font-medium text-white rounded-md group {{ \Request::route()->getName() === 'profile' ? 'bg-[#5D90D2]' : '' }}">
                                <div
                                    class="flex items-center justify-center w-10 mr-3 text-2xl {{ \Request::route()->getName() === 'profile' ? 'text-white' : 'text-[#276FCE]' }}">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                Profile
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="fixed top-0 left-0 z-20 w-full h-full bg-black opacity-40 md:hidden" x-show="openSidebar"
                @click="openSidebar = false" x-transition:enter="transition ease-in duration-250"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-out duration-250" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"></div>

            <div class="flex flex-col flex-1">
                <div class="sticky top-0 z-10 flex justify-between flex-shrink-0 h-16 pr-6 bg-white shadow">
                    <button type="button" @click="toggleSidebar"
                        class="px-4 text-gray-500 border-r border-gray-200 focus:outline-none focus:ring-2 focus:ring-inset">
                        <span class="sr-only">Open sidebar</span>
                        <!-- Heroicon name: outline/bars-3-bottom-left -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                        </svg>
                    </button>

                    <div class="flex items-center ml-4 md:ml-6">
                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <div>
                                <button type="button"
                                    class="flex items-center max-w-xs text-sm bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true"
                                    @click="toggleDropdown">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('images/avatar.png') }}"
                                        alt="">
                                </button>
                            </div>

                            <div class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1" x-show="showDropdown"
                                x-transition:enter="transition ease-in duration-250"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-out duration-250"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem"
                                        tabindex="-1" id="user-menu-item-2">
                                        <div class="flex">
                                            <div class="flex-1 mr-2">Sign out</div>
                                            <div class="text-black">
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            </div>
                                        </div>
                                    </a>
                                    {{-- <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link> --}}
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <main class="overflow-y-auto">
                    <div class="w-full p-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </div>

    @include('include.script')
    <script>
        document.addEventListener('alpine:init', () => {
            const breakpoint = 768
            Alpine.data('layoutData', () => ({
                openSidebar: window.innerWidth > breakpoint,
                isAboveBreakpoint: window.innerWidth > breakpoint,
                showDropdown: false,
                toggleSidebar() {
                    this.openSidebar = !this.openSidebar
                },
                toggleDropdown() {
                    this.showDropdown = !this.showDropdown
                },
            }))
        })
    </script>
    @stack('scripts')
</body>

</html>
