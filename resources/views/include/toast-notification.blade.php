<div x-data="{
    toast(type, message) {
        window.toastr.options = {
            positionClass: 'toast-top-right',
        };
        window.toastr[type](message);
    },
}" @flash.window="toast($event.detail.type, $event.detail.message)" x-cloak class="hidden">
</div>
