{{-- // 'message' is the name given in ListingController --}}
@if(session()->has('message'))
  <div class="fixed top-0 transform bg-laravel text-white px-48 py-3 left-1/2 -translate-x-1/2">
      <p>
        {{session('message')}}
      </p>
  </div>

@endif
