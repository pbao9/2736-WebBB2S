<script>
    $(document).ready(function() {
        $('input[name="school_other"]').change(function() {
            if ($(this).attr('id') === 'radio_yes') {
                $('#school_other_frm').removeClass('d-none').addClass('d-flex');
                $('#school_select').removeClass('d-block').addClass('d-none');
            } else {
                $('#school_other_frm').removeClass('d-flex').addClass('d-none');
                $('#school_select').removeClass('d-none').addClass('d-block');
            }
        });

        if ($('#radio_no').is(':checked')) {
            $('#school_other_frm').removeClass('d-block').addClass('d-none');
            $('#school_select').removeClass('d-none').addClass('d-block');
        }
    });

    $('input[name="time_pickup"]').on('change', function() {
        var selectedTime = $(this).val();
        var selectedHour = parseInt(selectedTime.split(':')[0], 10);

        var minHour = 7;
        var maxHour = 17;

        if (selectedHour < minHour || selectedHour > maxHour) {
            $(this).val('');
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Thời gian đưa đón phải từ 07:00 sáng đến 17:00 chiều.',
            });
        }
    });
</script>


