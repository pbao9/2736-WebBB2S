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
    })

    $(document).ready(function() {
        function formatTime(input) {
            let timeValue = input.val();
            let timeParts = timeValue.split(':');
            let hours = parseInt(timeParts[0]);
            let minutes = timeParts[1];

            let ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;

            return hours + ':' + minutes + ' ' + ampm;
        }

        $('input[name="time_arrive_school"], input[name="time_off"]').on('input', function() {
            let inputName = $(this).attr('name');
            let formattedTime = formatTime($(this));
            console.log(`Input Name: ${inputName}, Formatted Time: ${formattedTime}`);
        });

        $('select[name="session_arrive_school"], select[name="session_off"]').on('change', function() {
            let arriveValue = $('select[name="session_arrive_school"]').val();
            let offValue = $('select[name="session_off"]').val();

            const morning = '{{ \App\Enums\Session\Session::morning }}';
            const afternoon = '{{ \App\Enums\Session\Session::afternoon }}';
            
            if (arriveValue == afternoon && offValue == morning) {
                Swal.fire({
                    title: 'Không hợp lệ!',
                    text: 'Buổi đưa tới trường phải nhỏ hơn buổi về!',
                    icon: 'error'
                }).then(() => {
                    $('select[name="session_arrive_school"]').val(morning);
                    $('select[name="session_off"]').val(afternoon);
                });
            }
        });


    });
</script>
