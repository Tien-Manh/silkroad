<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="javascript:void(0);">
        <p><i style="color: coral; font-size: 25px;" class="fas fa-kiss-wink-heart"></i>
        <span style="vertical-align: text-bottom;" class="ms-2 font-weight-bold text-white">SILKROAD</span></p>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white @if(request()->routeIs('admin-cp'))active bg-gradient-primary @endif" href="{{ route('home') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-dragon"></i>
            </div>
            <span class="nav-link-text ms-1">To home</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if(request()->routeIs('download-cp') || request()->routeIs('add-download') || request()->routeIs('edit-download'))active bg-gradient-primary @endif" href="{{ route('download-cp') }} ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-dragon"></i>
            </div>
            <span class="nav-link-text ms-1">Download</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if(request()->routeIs('card-cp') || request()->routeIs('add-card') || request()->routeIs('edit-card'))active bg-gradient-primary @endif" href="{{ route('card-cp') }} ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-dragon"></i>
            </div>
            <span class="nav-link-text ms-1">Card Config</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if(request()->routeIs('card-log-cp'))active bg-gradient-primary @endif" href="{{ route('card-log-cp') }} ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-dragon"></i>
            </div>
            <span class="nav-link-text ms-1">Card Log</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if(request()->routeIs('pay-cp') || request()->routeIs('add-pay') || request()->routeIs('edit-pay'))active bg-gradient-primary @endif" href="{{ route('pay-cp') }} ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-dragon"></i>
            </div>
            <span class="nav-link-text ms-1">Pay pal</span>
          </a>
        </li>
        <li class="nav-item">
           <a class="nav-link text-white @if(request()->routeIs('config-cp') || request()->routeIs('add-config') || request()->routeIs('edit-config'))active bg-gradient-primary @endif" href="{{ route('config-cp') }} ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-dragon"></i>
            </div>
            <span class="nav-link-text ms-1">Server config</span>
          </a>
        </li>
        <li class="nav-item">
         <a class="nav-link text-white @if(request()->routeIs('support-cp') || request()->routeIs('add-support') || request()->routeIs('edit-support'))active bg-gradient-primary @endif" href="{{ route('support-cp') }} ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-dragon"></i>
            </div>
            <span class="nav-link-text ms-1">Support member</span>
          </a>
        </li>

        <li class="nav-item">
         <a class="nav-link text-white @if(request()->routeIs('baner-cp') || request()->routeIs('add-baner') || request()->routeIs('edit-baner'))active bg-gradient-primary @endif" href="{{ route('baner-cp') }} ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-dragon"></i>
            </div>
            <span class="nav-link-text ms-1">Image</span>
          </a>
        </li>
         <li class="nav-item">
         <a class="nav-link text-white @if(request()->routeIs('create-img') || request()->routeIs('create-add') || request()->routeIs('create-edit'))active bg-gradient-primary @endif" href="{{ route('create-img') }} ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-dragon"></i>
            </div>
            <span class="nav-link-text ms-1">Storage Image</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>