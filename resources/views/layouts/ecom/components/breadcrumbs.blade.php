<div class="breadcrumbs comtainer-fluid">
    <div class="breadcrumbs-container container">
        <div class="row">
            <div class="col-md-6">
                {{ $slot }}
            </div>
            <div class="col-md-6 text-left text-md-right">
                @include('layouts.ecom.partials.search')
            </div>
        </div>
    </div>
</div>
<!-- !End Breadcrumbs -->
