<!-- Navbar -->
<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
    {{-- @include('admin.layouts.partials.notification') --}}

    <div class="navbar-nav flex-row order-md-last pe-3">
        @include('admin.layouts.partials.account')
    </div>

    <div class="collapse navbar-collapse" id="navbar-menu">

    </div>
</header>
