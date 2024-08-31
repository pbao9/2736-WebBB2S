@if ($status == 0)
    <x-button.modal-delete class="btn-icon" data-route="{{ route('admin.contact.delete', $id) }}">
        <i class="ti ti-trash"></i>
    </x-button.modal-delete>
@else
    <a href="#" class="btn btn-icon btn-success text-decoration-none">
        <i class="ti ti-checks"></i>
    </a>
@endif
