<style>
    .message-box{
        width: 300px;
    }
</style>
<div class="nav-item dropdown" id="message-box">
    <div style="width: 120px;height: 100%"
       class="nav-link  d-flex align-items-center"
       data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
        <span class="badge bg-red">...</span>
        <span class="ms-2">Thông báo</span>
    </div>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow message-box">

        <div class="dropdown-divider"></div>
        <a href="{{ route('admin.notification.index') }}"
           class="dropdown-item text-center">Xem tất cả
        </a>
    </div>
</div>


