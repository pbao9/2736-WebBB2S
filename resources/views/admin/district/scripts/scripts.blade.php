<x-input type="hidden" name="route_search_select_province" :value="route('admin.search.select.province')" />


<script>
    $(document).ready(function(e) {
        select2LoadData($('#province_code').data('url'), '#province_code')
    });
</script>
