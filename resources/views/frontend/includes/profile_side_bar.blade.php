<div class="col-xl-3 col-md-3 col-sm-12">
   <div class="widget_col">
      <a  href="{{route('user.account')}}" class="widget_user">
         <div class="widget_user_icon">
            @if(isset($user->profile_photo_path))
            <img src="{{asset('storage/app/public/'.$user->profile_photo_path) }}" alt="user">
            @else
            <img src="{{asset('public/assets/images/no_image.png')}}" alt="user">
            @endif
         </div>
         <div class="widget_user_name">{{$user->name}}</div>
      </a>
   </div>

    <div class="widget_col">
      <h2 class="widge_ttitle">Profile </h2>
      <ul>
          <li><a href="#">Reward Points - <span>{{$total_points}}</span></a>
            <p style="font-size: 12px;">My Referral Code - {{$user->user_referral_code}}</p>
          </li>
      	<!-- <li><a href="javascript:void(0)">My Referral Code - {{$user->user_referral_code}} </a></li> -->
        <li><a href="{{route('user.withdraw')}}">Withdraw </a></li>
          <li><a href="{{route('user.GroupExam.exam',['slug' =>'alfa', 'test_type' =>'monthly'])}}">Group - ALFA</a></li>
          <!-- <li><a href="#">Beata </a></li> -->
          <li><a href="{{route('user.myGroup')}}">Your  Group</a></li>
      </ul>
    </div>
</div>