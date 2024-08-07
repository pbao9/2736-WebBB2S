<x-form id="formCreateVariation" class="d-none" action="#" />
<x-input type="hidden" name="route_search_select_driver" :value="route('admin.search.select.driver')" />
<x-input type="hidden" name="route_search_select_nany" :value="route('admin.search.select.nany')" />
<x-input type="hidden" name="route_search_select_parent" :value="route('admin.search.select.parent')" />
<script>
    $(document).ready(function() {
        let selectedValue = null;
        $('.notification-type').change(function() {
            selectedValue = $(this).val();
            $('#notification-driver-select').hide();
            $('#notification-parent-select').hide();
            $('#notification-nany-select').hide();
            $('#notification-option-select').hide();

            if (selectedValue == '2') {
                select2LoadData($('input[name="route_search_select_driver"]').val());
                $('#notification-option-select').show();
                if($('.notification-option-select-value').val() != {{ \App\Enums\Notification\NotificationOption::All }}){
                    $('#notification-driver-select').show();
                }

            } else if (selectedValue == '3') {
                select2LoadData($('input[name="route_search_select_parent"]').val());
                $('#notification-option-select').show();
                if($('.notification-option-select-value').val() != {{ \App\Enums\Notification\NotificationOption::All }}){
                    $('#notification-parent-select').show();
                }
            } else if (selectedValue == '4') {
                select2LoadData($('input[name="route_search_select_nany"]').val());
                $('#notification-option-select').show();
                if($('.notification-option-select-value').val() != {{ \App\Enums\Notification\NotificationOption::All }}){
                    $('#notification-nany-select').show();
                }
            }
        });
        $('.notification-option-select-value').change(function() {
            const selectedOption = $(this).val();
            $('#notification-driver-select').hide();
            $('#notification-parent-select').hide();
            $('#notification-nany-select').hide();

            if (selectedOption == '2') {
                if(selectedValue == 2){
                    $('#notification-driver-select').show();
                }
                else if(selectedValue == 3){
                    $('#notification-parent-select').show();
                }
                else if(selectedValue == 4){
                    $('#notification-nany-select').show();
                }
            }
        });
    });
</script>
