<div class="col-2">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link {{ $package_nav ?? '' }}" id="v-pills-home-tab" data-toggle="pill" href="{{ route('myPackages', Auth::user()->id) }}" role="tab"
            aria-controls="v-pills-home" aria-selected="true">Packages</a>
        <a class="nav-link {{ $variant_nav ?? '' }}" id="v-pills-profile-tab" data-toggle="pill" href="{{ route('myVariants', Auth::user()->id) }}" role="tab"
            aria-controls="v-pills-profile" aria-selected="false">Variants</a>
        <a class="nav-link {{ $booking_nav ?? '' }}" id="v-pills-messages-tab" data-toggle="pill" href="{{ route('myBookings', Auth::user()->id) }}" role="tab"
            aria-controls="v-pills-messages" aria-selected="false">Bookings</a>
        <a class="nav-link {{ $reservation_nav ?? '' }}" id="v-pills-reservation-tab" data-toggle="pill" href="{{ route('reservations', Auth::user()->id) }}" role="tab"
            aria-controls="v-pills-reservation" aria-selected="false">Reservations</a>
      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="{{ route('logs', Auth::user()->id) }}" role="tab"
            aria-controls="v-pills-settings" aria-selected="false">Logs</a>
    </div>
</div>
