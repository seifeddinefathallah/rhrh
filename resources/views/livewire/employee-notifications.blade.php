<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('show-toast', function (data) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            switch (data.type) {
                case 'success':
                    toastr.success(data.message);
                    break;
                case 'error':
                    toastr.error(data.message);
                    break;
                case 'info':
                    toastr.info(data.message);
                    break;
                case 'warning':
                    toastr.warning(data.message);
                    break;
                default:
                    toastr.info(data.message);
                    break;
            }
        });
    });
</script>
