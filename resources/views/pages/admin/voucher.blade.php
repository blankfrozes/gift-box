<x-app-layout>
    <div class="w-full mb-4">
        <div class="mt-2 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Voucher
                </h2>
            </div>

            <div class="flex flex-shrink-0 mt-4 md:mt-0 md:ml-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center space-x-4">
                        <li>
                            <div class="flex">
                                <span class="text-sm font-medium text-gray-500">Admin</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-4 text-sm font-medium text-gray-500">{{ config('app.name') }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd" />
                                </svg>
                                <a href="#" aria-current="page"
                                    class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Voucher</a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="flex justify-start w-full mt-4">
            <button class="px-4 py-2 text-base text-white bg-blue-700 rounded hover:bg-blue-500" x-data
                x-on:click="$dispatch('open-create-edit-dialog')">
                Create Voucher
                <span class="ml-2">
                    <i class="fa-solid fa-circle-plus"></i>
                </span>
            </button>
        </div>
    </div>

    <livewire:admin.pages.voucher.voucher-table />
    <livewire:admin.pages.voucher.create-edit-voucher-dialog />
    <livewire:admin.pages.voucher.detail-voucher-dialog />
    <livewire:admin.pages.voucher.cancel-voucher-dialog />
</x-app-layout>
