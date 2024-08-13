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

    $(document).ready(function() {
        let service = 'select[name="service"]';
        let both = "{{ \App\Enums\Contact\ContactService::Both }}";
        let pickupOnly = "{{ \App\Enums\Contact\ContactService::PickUpOnly }}";
        let dropoffOnly = "{{ \App\Enums\Contact\ContactService::DropOffOnly }}";

        const dropOffRow = document.getElementById('dropOffOnlyRow');
        const pickUpRow = document.getElementById('pickUpOnlyRow');
        const dropOffSession = $('select[name="session_off"], input[name="time_off"]');
        const pickUpSession = $('select[name="session_arrive_school"], input[name="time_arrive_school"]');

        $(service).on('change', function() {
            let selectedValue = $(this).val();

            if (selectedValue == pickupOnly) {
                $(dropOffRow).addClass('d-none').removeClass('d-block');
                $(pickUpRow).addClass('d-block').removeClass('d-none');
                $(dropOffSession).val('');
            } else if (selectedValue == dropoffOnly) {
                $(pickUpRow).addClass('d-none').removeClass('d-block');
                $(dropOffRow).addClass('d-block').removeClass('d-none');
                $(pickUpSession).val('');
            } else {
                $(dropOffRow).addClass('d-block').removeClass('d-none');
                $(pickUpRow).addClass('d-block').removeClass('d-none');
            }
        });


        $('input[name="time_arrive_school"], input[name="time_off"]').prop('disabled', true);

        $('select[name="session_arrive_school"], select[name="session_off"]').on('change', function() {
            let sessionName = $(this).attr('name');
            let relatedTimeInput = sessionName === 'session_arrive_school' ? 'time_arrive_school' :
                'time_off';

            $('input[name="' + relatedTimeInput + '"]').prop('disabled', false);

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

        $('input[name="time_arrive_school"], input[name="time_off"]').on('input', function() {
            let inputName = $(this).attr('name');
            let timeValue = $(this).val();
            let sessionValue = inputName === 'time_arrive_school' ? $(
                    'select[name="session_arrive_school"]').val() : $('select[name="session_off"]')
                .val();

            const morning = '{{ \App\Enums\Session\Session::morning }}';
            const afternoon = '{{ \App\Enums\Session\Session::afternoon }}';

            if (timeValue) {
                let hours = parseInt(timeValue.split(':')[0]);
                let ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12;
                let formattedTime = hours + ':' + timeValue.split(':')[1] + ' ' + ampm;

                if ((sessionValue == morning && ampm != 'AM') || (sessionValue == afternoon && ampm !=
                        'PM')) {
                    Swal.fire({
                        title: 'Không hợp lệ!',
                        text: 'Thời gian phải khớp với buổi bạn chọn!',
                        icon: 'warning'
                    }).then(() => {
                        $(this).val('');
                    });
                }
            }
        });
    });
</script>
