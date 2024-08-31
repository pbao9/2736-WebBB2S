<script>
    $(document).ready(function() {
        let virtualSelect;
        var select = '#school-select';

        function updateVirtualSelect(options) {
            if (virtualSelect) {
                virtualSelect.destroy();
            }

            virtualSelect = VirtualSelect.init({
                ele: select,
                options: options,
                search: true,
                searchBy: 'label',
                placeholder: '— Vui lòng chọn —',
                noSearchResultsText: 'Không có trường này!',
                noOptionsText: 'Không có trường học tại địa điểm này!',
                searchPlaceholderText: 'Tìm kiếm...'
            });

            $(select).on('change', function() {
                let selectedValue = virtualSelect.getValue();
                $('#school_id_input').val(selectedValue);
            
                if (selectedValue) {
                    $('#find-car').fadeIn();
                    $('#car').removeClass('d-none').addClass('d-block').fadeIn();

                    const slotSetting = '{{ $settings['slot_seat'] }}';
                    const slotSeat = parseInt(slotSetting, 10);
                    const randomSeat = Math.ceil(Math.random() * (slotSeat + 1));
                    document.getElementById('slotSeat').innerText = randomSeat;
                } else {
                    $('#car').fadeOut(function() {
                        $(this).removeClass('d-block').addClass('d-none');
                    });
                }
            });
        }

        $('#district-select').on('change', function() {
            let districtCode = $(this).val();

            if (districtCode) {
                $.ajax({
                    url: urlHome + '/address/schools-by-district',
                    method: 'GET',
                    data: {
                        district_code: districtCode
                    },
                    success: function(response) {
                        let options = response.results.map(school => ({
                            label: school.text,
                            value: school.id
                        }));
                        updateVirtualSelect(options);

                        $('#school_id_input').val('');
                        $('#car').fadeOut(function() {
                            $(this).removeClass('d-block').addClass('d-none');
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                updateVirtualSelect([]);
            }
        });
        updateVirtualSelect([]);
    });
</script>
