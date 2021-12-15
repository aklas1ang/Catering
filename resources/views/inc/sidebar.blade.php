<div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link @if(Request::is('packages/*')) active @endif" id="v-pills-home-tab" data-toggle="pill" href="/packages/{{Auth::user()->id}}" role="tab"
            aria-controls="v-pills-home" aria-selected="false">Packages</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="/myVariants/{{Auth::user()->id}}" role="tab"
            aria-controls="v-pills-profile" aria-selected="false">Variants</a>
        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="/reservations/{{Auth::user()->id}}"
            role="tab" aria-controls="v-pills-messages" aria-selected="false">Reservations</a>
        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="/"
            role="tab" aria-controls="v-pills-messages" aria-selected="false">Bookings</a>
        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings"
            role="tab" aria-controls="v-pills-settings" aria-selected="false">Logs</a>
    </div>
</div>