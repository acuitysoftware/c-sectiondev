<header class="main-header header-style-one">

      <!-- Header Lower -->
      <div class="header-lower">
         <div class="container">
            <!-- Main box -->
            <div class="main-box">

               <div class="nav-outer">
                  <!-- Main Menu -->
                  <nav class="main-menu navbar-expand-md">
                     <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                           <li class="current">
                              <a href="{{route('home')}}">Home</a>
                           </li>

                           <li class="dropdown">
                              <a href="javascript:void(0)">About</a>
                              <ul>
                     <li><a href="{{route('aboutUs')}}" class="active">About Us</a></li>
                     <li><a href="{{route('visionStatement')}}"  >Vision Statement</a></li>
                     <li><a href="{{route('sustainabilityDevelopmentGoal')}}">Sustainability Development Goal</a></li>
                     <li><a href="{{route('valuesEducation')}}">Values Education</a></li>
                     <li><a href="{{route('ourStaff')}}">Our Staff</a></li>
                              </ul>
                           </li>


                           <li class="dropdown">
                              <a href="javascript:void(0)">Statutory Information</a>
                              <ul>
                                 <li><a href="{{route('commitment')}}">Commitment</a></li>
                                 <li><a href="{{route('policies')}}">Policies</a></li> 
                                 <li><a href="{{route('unrivalledSupport')}}">Unrivalled Support</a></li>
                              </ul>
                           </li>
                           <li class="dropdown">
                              <a href="javascript:void(0)">Pupil Zone</a>
                              <ul>
                                 <li><a href="{{route('timeToThink')}}">Time to Think</a></li>
                                 <li><a href="{{route('resourcesAndFeatures')}}">Resources and Features</a></li>
                                 <li><a href="{{route('whyChooseUs')}}">Why choose us</a></li>
                                 <li><a href="{{route('conclusion')}}">Conclusion</a></li>
                                 <li><a href="{{route('howItWorks')}}">How it works</a></li>
                                 
                              </ul>
                           </li>
                           <li><a href="{{route('contactUs')}}">Contact us</a></li>
                           @if(Auth::user() && Auth::user()->hasRole('STUDENT'))
                           <li><a href="{{route('subscriptions')}}">Subscriptions</a></li>
                           <li><a href="{{route('user.profile')}}">Dashboard</a></li>
                           <li><a href="{{route('super.chat')}}">AI-Powered Q&A</a></li>
                           @endif
                        </ul>
                           <form id="user-logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        <div class="outer-box loginnav sticky_login">
                           <ul class="navigation">
                              @if(Auth::user() && Auth::user()->hasRole('STUDENT'))

                              <div class="outer-box loginnav sticky_login">
                                 <a href="{{route('user.account')}}" class="user-avatar">
                                    <div class="avatar">
                                       @if(isset(Auth::user()->profile_photo_path))
                                         <img src="{{asset('storage/app/public/'.Auth::user()->profile_photo_path) }}" alt="user" class="rounded-circle">
                                         @else
                                         <img src="{{asset('public/assets/images/no_image.png')}}" alt="user" class="rounded-circle">
                                         @endif
                                       
                                    </div>
                                    <div class="username">{{Auth::user()->name}}</div>
                                 </a>
                              </div>
                              <!-- <li><a href="{{route('user.profile')}}">Account</a></li>
                              <li><a href="javascript:void(0)" onclick="event.preventDefault();
                                      document.getElementById('user-logout-form').submit();">Logout</a></li> -->
                              @else
                              <li><a href="{{route('user.login')}}">Login</a></li>
                              <li><a href="{{route('user.register')}}">Sign up</a></li>
                              @endif
                           </ul>
                        </div>

                     </div>
                  </nav>
                  <!-- Main Menu End-->

               </div>

               <div class="outer-box loginnav ">
                  <ul class="navigation">
                     @if(Auth::user() && Auth::user()->hasRole('STUDENT'))
                     <a href="{{route('user.account')}}" class="user-avatar">
                        <div class="avatar">
                           @if(isset(Auth::user()->profile_photo_path))
                             <img src="{{asset('storage/app/public/'.Auth::user()->profile_photo_path) }}" alt="user" class="rounded-circle">
                             @else
                             <img src="{{asset('public/assets/images/no_image.png')}}" alt="user" class="rounded-circle">
                             @endif
                           
                        </div>
                        <div class="username">{{Auth::user()->name}}</div>
                     </a>  
                     @else
                     <li><a href="{{route('user.login')}}">Login</a></li>
                     <li><a href="{{route('user.register')}}">Sign up</a></li>
                     @endif
                  </ul>
               </div>





            </div>
         </div>
      </div>
      <!-- Sticky Header  -->
      <div class="sticky-header">
         <div class="container">
            <div class="main-box">
               <div class="logo-box">
                  <div class="logo"><a href="{{route('home')}}"><img src="{{asset('storage/app/public/'.@$siteSetting->logo) }}" alt="" title=""></a></div>
                  <div class="upper-right">

                     <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><i class="flaticon-menu"></i></a>
                  </div>
               </div>
               <nav class="main-menu navbar-expand-md">
                  <!--Keep This Empty / Menu will come through Javascript-->


               </nav>


            </div>
         </div>
      </div>
      <!-- End Sticky Menu -->
      <!-- Mobile Header -->
      <div class="mobile-header">
         <div class="logo"><a href="{{route('home')}}"><img src="{{asset('storage/app/public/'.@$siteSetting->logo) }}" alt="" title=""></a></div>
         <!--Nav Box-->
         <div class="nav-outer clearfix">
            <div class="outer-box">
               <!-- Search Btn -->

               <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><i class="flaticon-menu"></i></a>
            </div>
         </div>
      </div>
      <!-- Mobile Menu  -->
      <div class="mobile-menu">
         <div class="menu-backdrop"></div>
         <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
         <nav class="menu-box">
            <div class="upper-box">
               <div class="close-btn"><i class="icon flaticon-close"></i></div>
            </div>
            <ul class="navigation clearfix">
               <!--Keep This Empty / Menu will come through Javascript-->


            </ul>

            <ul class="mobilelogin">
               @if(Auth::user() && Auth::user()->hasRole('STUDENT'))
               <li><a href="{{route('user.profile')}}">Account</a></li>
               <!-- <li><a href="javascript:void(0)" onclick="event.preventDefault();
                                      document.getElementById('user-logout-form').submit();">Logout</a></li> -->
               @else
               <li><a href="{{route('user.login')}}">Login</a></li>
               <li><a href="{{route('user.register')}}">Sign up</a></li>
               @endif
            </ul>

            <ul class="social-links">
              @if(count($socialLinks)>0)
              @foreach($socialLinks as $link)
               <li><a href="{{$link->link}}" target="_blank"><span class="{{$link->icon}}"></span></a></li>
              @endforeach
              @endif
            </ul>
         </nav>
      </div>
      <!-- End Mobile Menu -->

   </header>





   <!-- Quick Links -->
   <a href="{{$siteSetting->order_link}}"  class="quicklinks">
      <span>Quick Links</span>
   </a>
   <!--Quick Links-->