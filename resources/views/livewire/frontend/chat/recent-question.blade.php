<section class="recent-questions">
         <div class="section-title">
             <h3>Your Recent Questions</h3>
             <img src="{{ asset('public/frontend/images/n5.png') }}" alt="">
             <span class="precious-badge">(Precious)</span>
         </div>

         <div class="shadobox">
             <div class="filter-dropdown">
                 <select class="subject-filter">
                     @if (count($subjects) > 0)
                         @foreach ($subjects as $key => $subjectData)
                             <option value="{{ $subjectData->id }}">{{ $subjectData->name }}</option>
                         @endforeach
                     @endif
                 </select>
                 <select class="sort-filter">
                     <option>Intony</option>
                     <option>Recent</option>
                     <option>Popular</option>
                 </select>
             </div>

             <div class="question-list">

                 @if (count($chats) > 0)
                     @foreach ($chats as $key => $chat)
                         <div class="question-card">
                             <div class="question-avatar">
                                 <div class="status_n">
                                     <img src="{{ asset('public/frontend/images/n8.png') }}" alt="">
                                 </div>
                                 <img src="https://images.pexels.com/photos/4926671/pexels-photo-4926671.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"
                                     alt="User">
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
                                     src="{{ asset('public/frontend/images/n6.png') }}" alt=""> AI
                                 Answered</span>
                         </div>
                     @endforeach
                 @else
                     <p class="text-center">No records available</p>
                 @endif





             </div>
         </div>


     </section>