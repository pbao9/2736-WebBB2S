<script>
    $(document).ready(function () {
        function loadDistricts(provinceCode, selectedDistrictCode) {
            var $districtSelect = $('select[name="district_code"]');

            // Disable the district select element
            $districtSelect.prop('disabled', true);

            if (!provinceCode) {
                $districtSelect.html('<option value="">-- Chọn Quận/Huyện --</option>').prop('disabled', false);
                return;
            }

            $.ajax({
                url: urlHome + '/admin/address/districts',
                type: 'GET',
                dataType: 'json',
                data: {province_code: provinceCode},
            })
            .done(function (districtData) {
                var districtOptions = districtData.map(function (district) {
                    return '<option value="' + district.code + '"' + (district.code === selectedDistrictCode ? ' selected' : '') + '>' + district.name + '</option>';
                }).join('');
                $districtSelect.html(districtOptions).prop('disabled', false).trigger('change');
            })
            .fail(function () {
                $districtSelect.html('<option value="">Lỗi khi tải quận huyện</option>').prop('disabled', false);
            });
        }

        function loadWards(districtCode, selectedWardCode) {
            var $wardSelect = $('select[name="ward_code"]');

            // Disable the ward select element
            $wardSelect.prop('disabled', true);

            if (!districtCode || districtCode === '') {
                $wardSelect.html('<option value="">-- Chọn Phường/Xã --</option>').prop('disabled', false);
                return;
            }

            $.ajax({
                url: urlHome + '/admin/address/wards',
                type: 'GET',
                dataType: 'json',
                data: {district_code: districtCode},
            })
            .done(function (wardData) {
                var wardOptions = wardData.map(function (ward) {
                    return '<option value="' + ward.code + '"' + (ward.code === selectedWardCode ? ' selected' : '') + '>' + ward.name + '</option>';
                }).join('');
                $wardSelect.html(wardOptions).prop('disabled', false);
            })
            .fail(function () {
                $wardSelect.html('<option value="">Lỗi khi tải phường/xã</option>').prop('disabled', false);
            });
        }

        // Handle province selection change
        $(document).on('change', 'select[name="province_code"]', function (event) {
            event.preventDefault();
            var provinceCode = $(this).val();
            var selectedDistrictCode = $('select[name="district_code"]').data('district-code');
            loadDistricts(provinceCode, selectedDistrictCode);
        });

        // Handle district selection change
        $(document).on('change', 'select[name="district_code"]', function (event) {
            event.preventDefault();
            var districtCode = $(this).val();
            var selectedWardCode = $('select[name="ward_code"]').data('ward-code');
            loadWards(districtCode, selectedWardCode);
        });

        // Initialize the form with existing data
        var selectedProvinceCode = $('select[name="province_code"]').val();
        var selectedDistrictCode = $('select[name="district_code"]').data('district-code');
        var selectedWardCode = $('select[name="ward_code"]').data('ward-code');

        if (selectedProvinceCode) {
            loadDistricts(selectedProvinceCode, selectedDistrictCode);
        }
        if (selectedDistrictCode) {
            loadWards(selectedDistrictCode, selectedWardCode);
        }
    });
</script>
