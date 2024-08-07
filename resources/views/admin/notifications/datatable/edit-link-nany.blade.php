@php
    $test = App\Models\Nany::find($nany_id);
@endphp
@if ($test)
<x-link :href="route('admin.user.edit', $test->id)" :title="$test->user->fullname" class="text-decoration-none" />
@endif
