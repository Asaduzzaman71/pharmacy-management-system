 <div class="br-header">
      <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>

      </div><!-- br-header-left -->
      <div class="br-header-right">
        <nav class="nav">
          <div class="dropdown">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down">{{Auth::user()->user_name}}</span>
              <img src="{{asset(Auth::user()->image)}}" class="wd-32 rounded-circle" alt="">
              <span class="square-10 bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-250">
              <div class="tx-center">
              <a href=""><img src="{{asset(Auth::user()->image)}}" class="wd-80 rounded-circle" alt=""></a>
              <h6 class="logged-fullname">{{Auth::user()->user_name}}</h6>
                <p>{{Auth::user()->email}}</p>
              </div>
              <hr>
              <hr>
              <ul class="list-unstyled user-profile-nav">
                @if (Auth::user()->user_type =="admin")
                <li><a href="{{route('executive.edit',base64_encode(Auth::user()->id))}}"><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                @endif
              <li><a href="{{route('logout.index')}}"><i class="icon ion-power"></i> Sign Out</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>

      </div><!-- br-header-right -->
    </div><!-- br-header -->
