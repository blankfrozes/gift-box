<div x-data="{
    showModal: false,
    open(payload) {
        this.showModal = true;
        document.body.style.overflow = 'hidden';
        @this.init(payload);
    },
    close() {
        this.showModal = false;
        @this.resetForm();
        document.body.style.overflow = 'auto';
    },
    copy(text) {
        navigator.clipboard.writeText(text);
        toastr.success('Copied!')
    },
}" @open-detail-dialog.window="open(event.detail)" @close-detail-dialog.window="close()" x-cloak>
    <div class="absolute top-0 left-0 z-50 w-full h-full" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        x-show="showModal" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-xl sm:p-6">

                    @if ($voucher)
                        <!--Title-->
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold">
                                Voucher
                            </p>

                            <div class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer hover:bg-gray-300"
                                @click="close()">
                                <i class="text-gray-600 fa fa-times"></i>
                            </div>
                        </div>
                        <p class="pb-2 text-md">
                            <span class="text-gray-500">Status</span>
                            &nbsp;&nbsp;
                            <span class="">
                                {{ $voucher->status }}
                            </span>
                        </p>

                        <!-- content -->
                        <div class="flex-1 max-w-full p-1 overflow-y-auto w-[40vw]">

                            <div class="grid grid-cols-1 gap-8">
                                <div
                                    class="px-4 py-2 mb-1 border border-gray-500 divide-y rounded row-table [*&>p]:py-3">
                                    <p class="font-bold">Voucher Info</p>
                                    <p class="flex items-center text-sm">
                                        <span class="inline-block w-32 text-gray-500">Code</span>
                                        {{ $voucher->code }}
                                        <button
                                            class="px-4 py-1 ml-10 text-sm text-blue-500 border border-blue-500 rounded hover:bg-blue-500 hover:text-white"
                                            x-data @click="copy('{{ $voucher->code }}')">
                                            Copy
                                        </button>
                                    </p>
                                    <p class="flex items-start text-sm">
                                        <span class="inline-block w-32 text-gray-500">Reward Name</span>
                                        {{ $voucher->reward_name }}
                                    </p>
                                    <p class="flex items-start text-sm">
                                        <span class="inline-block w-32 text-gray-500">Reward Image</span>
                                        <img src="{{ asset('storage/' . $voucher->reward_image) }}" alt=""
                                            class="h-40" />
                                    </p>
                                    <p class="flex items-start text-sm">
                                        <span class="inline-block w-32 text-gray-500">Player Email</span>
                                        {{ $voucher->username }}
                                    </p>
                                    <p class="flex items-start text-sm">
                                        <span class="inline-block w-32 text-gray-500">Used At</span>
                                        @if ($voucher->used_at)
                                            {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $voucher->used_at) }}
                                        @else
                                            Voucher are not use yet.
                                        @endif
                                    </p>
                                    <p class="flex items-start text-sm">
                                        <span class="inline-block w-32 text-gray-500">Claim At</span>
                                        @if ($voucher->claim_at)
                                            {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $voucher->claim_at) }}
                                        @else
                                            User have not claim the reward yet.
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex justify-between w-full mt-6 space-x-4">
                                @if ($voucher->status !== VoucherStatus::ABORTED && $voucher->status !== VoucherStatus::CLAIMED)
                                    <button type="button"
                                        class="flex-1 py-3 text-center text-white bg-red-600 rounded shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2"
                                        x-on:click="$dispatch('open-cancel-dialog', {{ $voucher->id }})">
                                        Terminate
                                    </button>
                                @endif

                                @if ($voucher->status === VoucherStatus::USED)
                                    <form wire:submit.prevent="claim" class="flex-1">
                                        <button type="submit"
                                            class=" w-full rounded bg-[#12AA00] py-3 text-center text-white shadow-sm hover:bg-[#0F8900] focus:outline-none focus:ring-2 focus:ring-[#12AA00] focus:ring-offset-2">
                                            <span wire:loading.remove wire:target="claim">Procees Claim</span>
                                            <span wire:loading wire:target="claim">
                                                <x-utils.loader width="24" />
                                            </span>
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    @endif

                    <div wire:loading wire:target="submit" class="absolute top-0 left-0 w-full h-full">
                        @include('include.full-screen-spinner')
                    </div>
                    @if ($initializing)
                        <div class="absolute top-0 left-0 w-full h-full">
                            @include('include.full-screen-spinner')
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
