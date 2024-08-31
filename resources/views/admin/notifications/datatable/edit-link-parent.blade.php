@php
    $test = App\Models\MenusParent::find($parent_id);
@endphp
@if ($test)
<x-link :href="route('admin.parent.edit', $test->id)" :title="$test->user->fullname" class="text-decoration-none" />
@endif
