<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <a class="navbar-brand" href="{{route('productList')}}">E-commerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('productList')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>

            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            @auth
                <li class="d-flex ms-5 nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                       <i class="fa fa-user-circle"></i>  {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="{{route('cart.index')}}"> <i class="fa fa-cart-plus" aria-hidden="true"></i> Cart</a></li>
                        <li><a class="dropdown-item" href="{{route('transaction.list')}}"> <i class="fa fa-paper-plane" aria-hidden="true"></i>  Transaction</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{url('/logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
            @endauth

            @guest
            <li class="d-flex ms-5 nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                   <i class="fa fa-user-circle"></i>  Guest
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <li><a class="dropdown-item" href="{{route('login')}}"> Login</a></li>
                    <li><a class="dropdown-item" href="{{route('register')}}">  Register</a></li>
                </ul>
            </li>
            @endguest
        </div>
    </div>

</nav>
