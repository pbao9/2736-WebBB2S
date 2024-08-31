<script>
    $(document).ready(function() {
        function loadDistricts(provinceCode, selectedDistrictCode) {
            var $districtSelect = $('select[name="district_code"]');

            $districtSelect.prop('disabled', false);

            if (!provinceCode) {
                $districtSelect.html('<option value="">— Chọn Quận/Huyện —</option>').prop('disabled', false);
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
                    var districtOptions = '<option disabled selected>— Chọn Quận/Huyện —</option>';

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

        $(document).on('change', 'select[name="province_code"]', function(event) {
            event.preventDefault();
            var provinceCode = $(this).val();
            var selectedDistrictCode = $('select[name="district_code"]').data('district-code');
            var selectedWardCode = $('select[name="ward_code"]').data('ward-code');
            loadDistricts(provinceCode, selectedDistrictCode, selectedWardCode);
        });

        var selectedProvinceCode = $('select[name="province_code"]').val();
        var selectedDistrictCode = $('select[name="district_code"]').data('district-code');

        if (selectedProvinceCode) {
            loadDistricts(selectedProvinceCode, selectedDistrictCode);
        }
    });
</script>
