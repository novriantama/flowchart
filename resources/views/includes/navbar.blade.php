<div class="navbar-bg"></div>  
  <nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
      </ul>
      <div class="search-element">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        <div class="search-backdrop"></div>
       
      </div>
    </form>
    <ul class="navbar-nav navbar-right">
     
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
          {{-- <figure class="avatar avatar-sm bg-info mr-2" data-initial="{{substr(Auth::user()->nama, 0, 2)}}"></figure> --}}
        <div class="d-sm-none d-lg-inline-block">Hi, Guest{{-- {{Auth::user()->nama ?? 'Guest'}} --}}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-title">Option Coming soon</div>
         
          <div class="dropdown-divider"></div>
          <a href="{{-- {{ route('logout') }} --}}" class="dropdown-item has-icon text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>