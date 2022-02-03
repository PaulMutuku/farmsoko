<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class = "container">
  <a class="navbar-brand" href="{{url('/')}}">Farm Soko</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('category')}}">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('cart')}}">Cart
          <span class="badge badge-pill cart-count">0</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('wishlist')}}">Wishlist
          <span class="badge badge-pill wishlist-count">0</span>
        </a>
      </li>
      
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/login') }}">Logout <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('my-orders') }}">My Orders <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
 </div>
</nav>