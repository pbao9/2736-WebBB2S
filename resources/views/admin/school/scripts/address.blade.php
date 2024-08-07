<script>
    $(document).ready(function() {
        function loadDistricts(provinceCode, selectedDistrictCode) {
            var $districtSelect = $('select[name="district_code"]');

            // Disable the district select element
            $districtSelect.prop('disabled', true);

            if (!provinceCode) {
                $districtSelect.html('<option value="">-- Chọn Quận/Huyện --</option>').prop('disabled', false);
                return;
            }

            $.ajax({
                    url: urlHome + '/address/districts',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        province_code: provinceCode
                    },
                })
                .done(function(districtData) {
                    var districtOptions = '<option disabled selected>-- Chọn Quận/Huyện --</option>';

                    if (districtData.length > 0) {
                        districtOptions += districtData.map(function(district) {
                            return '<option value="' + district.code + '"' +
                                (district.code === selectedDistrictCode ? ' selected' : '') + '>' +
                                district.name + '</option>';
                        }).join('');
                    } else {
                        districtOptions += '<option value="">Không có quận huyện tại địa điểm này</option>';
                    }

                    $districtSelect.html(districtOptions).prop('disabled', false).trigger('change');
                })
                .fail(function() {
                    $districtSelect.html('<option value="">Lỗi khi tải quận huyện</option>').prop(
                        'disabled', false);
                });
        }



        // Handle province selection change
        $(document).on('change', 'select[name="province_code"]', function(event) {
            event.preventDefault();
            var provinceCode = $(this).val();
            var selectedDistrictCode = $('select[name="district_code"]').data('district-code');
            loadDistricts(provinceCode, selectedDistrictCode);
        });

        // Initialize the form with existing data
        var selectedProvinceCode = $('select[name="province_code"]').val();
        var selectedDistrictCode = $('select[name="district_code"]').data('district-code');

        if (selectedProvinceCode) {
            loadDistricts(selectedProvinceCode, selectedDistrictCode);
        }
    });
</script>
