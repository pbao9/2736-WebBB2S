<x-input type="hidden" name="route_search_select_school" :value="route('admin.search.select.school')" />


<script>
    $(document).ready(function(e) {
        select2LoadData($('input[name="route_search_select_school"]').val());
    });
</script>
