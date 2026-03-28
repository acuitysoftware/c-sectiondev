<main class="main-content">
        <!-- nav Section -->

        <div class="navarea mb-4">
          <div class="menunav2">
            <ul>
              <li><a href="javascript:void(0)" class="{{$activeTab == '1'?'active':''}}" wire:click="changeExamType(1)"><img src="{{asset('public/frontend/images/n36.png')}}" width="20" alt="" > Weekly</a> </li>
              <li><a href="javascript:void(0)" class="{{$activeTab == '2'?'active':''}}" wire:click="changeExamType(2)"><img src="{{asset('public/frontend/images/n37.png')}}" width="20" alt=""> Monthly </a></li>
            </ul>
          </div>      
        </div>

        {{-- <div class="navarea mb-4">
          <div class="filter_L">
            Ends in :
            <select class="subject-filter">
              <option>5d 8h</option>
            </select>

          </div>
          <div class="filter_R">

          </div>
        </div> --}}


        <section  class="bannersection">
          <img src="{{asset('public/frontend/images/n42.png')}}" alt="">          
        </section>



        <!-- Your Recent Questions -->
        <section class="recent-questions">
          <div class="shadobox2">
            <div class="filter-dropdown2 filter_sb">
              <div class="filter_L">

                <select class="subject-filter">
                  <option>Subject</option>
                  <option>Math</option>
                  <option>Science</option>
                  <option>Coding</option>
                </select>
                <select class="sort-filter">
                  <option>Intony</option>
                  <option>Recent</option>
                  <option>Popular</option>
                </select>
              </div>
              <div class="filter_R">
                Status :
                <select class="subject-filter">
                  <option>Newest</option>
                </select>
              </div>
            </div>

            <div class="question-list">

              <div class="question-card2">
                <div class="question-avatar">
                  <div class="status_n">
                    <img src="{{asset('public/frontend/images/n8.png')}}" alt="">
                  </div>
                  <img
                    src="https://images.pexels.com/photos/4926671/pexels-photo-4926671.jpeg?auto=compress&amp;cs=tinysrgb&amp;h=650&amp;w=940"
                    alt="User">
                </div>


                <div class="question-content">
                  <h4>Dona</h4>
                  <div class="question-meta">
                    <span class="subject">Math :</span>
                    <span class="time">2 min ago</span>
                  </div>
                </div>
                <span class="status-badge answered"> <img src="{{asset('public/frontend/images/n6.png')}}" alt=""> AI Answered</span>
                <span class="status-badge answered2"> <img src="{{asset('public/frontend/images/n7.png')}}" alt=""> Math</span>
              </div>

              <div class="question-card2">
                <div class="question-avatar">
                  <div class="status_n">
                    <img src="{{asset('public/frontend/images/n8.png')}}" alt="">
                  </div>
                  <img
                    src="https://images.pexels.com/photos/4926671/pexels-photo-4926671.jpeg?auto=compress&amp;cs=tinysrgb&amp;h=650&amp;w=940"
                    alt="User">
                </div>


                <div class="question-content">
                  <h4>Dona</h4>
                  <div class="question-meta">
                    <span class="subject">Math :</span>
                    <span class="time">2 min ago</span>
                  </div>
                </div>
                <span class="status-badge answered3"> <img src="{{asset('public/frontend/images/n36.png')}}" alt=""> AI Answered </span>
                <span class="status-badge answered2"> <img src="{{asset('public/frontend/images/n7.png')}}" alt=""> Math</span>
              </div>





            </div>
          </div>
        </section>



        <section class="recent-questions">

          <div class="section-title">
            <h3>Earn Diamonds</h3>
            
          </div>



          <section class="addsection">
            <div class="row">
              <div class="col-md-4">
                <div class="add colorb">
                  <img src="{{asset('public/frontend/images/n38.png')}}" alt="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="add colory">
                  <img src="{{asset('public/frontend/images/n39.png')}}" alt="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="add colorb">
                  <img src="{{asset('public/frontend/images/n40.png')}}" alt="">
                </div>
              </div>

              
            </div>
          </section>



          <div class="shadobox2">
            <div class="question-list">

              @if (count($chats) > 0)
                     @foreach ($chats as $key => $chat)
                         <div class="question-card2">
                             <div class="question-avatar">
                                 <div class="status_n">
                                     <img src="{{ asset('public/frontend/images/n8.png')}}') }}" alt="">
                                 </div>
                                 @if (isset($user->profile_photo_path))
                                      <img src="{{ asset('storage/app/public/' . $user->profile_photo_path) }}" alt="user"
                                         >
                                  @else
                                      <img src="{{ asset('public/assets/images/no_image.png') }}" alt="user">
                                  @endif
                                 
                             </div>


                             <div class="question-content">
                                 <h4>{!! $chat->question !!}</h4>
                                 <div class="question-meta">
                                     <span class="subject">{{ $chat->subject->name ?? '' }} :</span>
                                     <span class="time">
                                         {{ $chat->created_at->diffForHumans(null, true) . ' ' }}</span>
                                 </div>
                             </div>
                             <span class="status-badge answered"> <img
                                     src="{{ asset('public/frontend/images/n6.png')}}') }}" alt=""> AI
                                 Answered</span>
                         </div>
                     @endforeach
                 @else
                     <p class="text-center">No records available</p>
                 @endif
            </div>

          </div>
        </section>







      </main>