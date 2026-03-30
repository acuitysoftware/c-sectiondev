<main class="main-content">
    <!-- Welcome Section -->
    <section class="welcome-section">
        <div class="welcome-content">
            <div class="welcome-text">
                @if (isset($user->profile_photo_path))
                    <img src="{{ asset('storage/app/public/' . $user->profile_photo_path) }}" alt="user"
                        class="welcome-avatar">
                @else
                    <img src="{{ asset('public/assets/images/no_image.png') }}" alt="user" class="welcome-avatar">
                @endif
                {{-- <img src="https://images.pexels.com/photos/4926671/pexels-photo-4926671.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"
                     alt="Emma" class="welcome-avatar"> --}}
                <!-- <div class="status-indicator"></div> -->
                <div class="welcome-message">
                    <h2>Welcome back, <strong>{{ $user->name }}</strong></h2>
                    <p>Ready to learn something new?</p>
                </div>
            </div>
            <div class="ai-mascot">
                <img src="{{ asset('public/assets/images/n3.png')}}" alt="">
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn btn-primary" wire:click="changeTabs(2);">
                <svg class="btn-icon" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                </svg>
                Ask a Question
            </button>
            <button class="btn btn-secondary" wire:click="changeTabs(4);">
                <svg class="btn-icon" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6,2L18,2L22,8L12,22L2,8L6,2Z" />
                </svg>
                Leaderboard
            </button>
        </div>
    </section>

    <!-- Recent Questions Section -->
    {{--  <section class="questions-section">
         <div class="section-header">
             <div class="tabs">
                 <button class="tab active">Recent Questions</button>
                 <button class="tab">All Answered</button>
             </div>
            
         </div>
         @if (count($chats) > 0)
             @foreach ($chats as $key => $chat)
                 <div class="question-item">
                     <img src="{{ asset('public/frontend/images/n4.png') }}" alt="">
                     <span class="question-text">{!! $chat->question !!}</span>


                     <select class="sort-filter">
                         @if (count($subjects) > 0)
                             @foreach ($subjects as $key => $subjectData)
                                 <option value="{{ $subjectData->id }}">{{ $subjectData->name }}</option>
                             @endforeach
                         @endif

                     </select>

               
                 </div>
             @endforeach
         @endif
         <form wire:submit.prevent="sendMessage">

             <div class="question-input">
                 <svg class="search-icon" viewBox="0 0 24 24" fill="currentColor">
                     <path
                         d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                 </svg>
                 <input type="text" placeholder="Type Fietts, here answer aa things ..." class="question-field"
                     wire:model="question">
                 
                 <x-frontend.chat-button name="Submit Question" target="sendMessage"></x-frontend.chat-button>
             </div>
         </form>

         




     </section> --}}

    <!-- Your Recent Questions -->
    <section class="recent-questions">
        <div class="section-title">
            <h3>Your Recent Questions</h3>
            <img src="{{ asset('public/assets/images/n5.png')}}" alt="">
            <span class="precious-badge">(Precious)</span>
        </div>

        <div class="shadobox">
            <div class="filter-dropdown">
                <select class="subject-filter" wire:model="searchSubject">
                    <option value="">Select</option>
                    @if (count($subjects) > 0)
                        @foreach ($subjects as $key => $subjectData)
                            <option value="{{ $subjectData->id }}">{{ $subjectData->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="question-list">

                @if (count($chats) > 0)
                    @foreach ($chats as $key => $chat)
                        <div class="question-card">
                            <div class="question-avatar">
                                <div class="status_n">
                                    <img src="{{ asset('public/frontend/images/n8.png') }}') }}" alt="">
                                </div>
                                @if (isset($user->profile_photo_path))
                                    <img src="{{ asset('storage/app/public/' . $user->profile_photo_path) }}"
                                        alt="user">
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
                            @php
                                $className = 'answered';
                                $status = 'AI Answered';
                                if ($chat->type == 2) {
                                    if ($chat->active == 0) {
                                        $status = 'Pending';
                                        $className = 'answered2';
                                    } else {
                                        $status = 'Tutor Answered';
                                    }
                                }
                            @endphp
                            <span class="status-badge {{ $className }}"> <img
                                    src="{{ asset('public/frontend/images/n6.png') }}') }}" alt="">
                                {{ $status }}
                            </span>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No records available</p>
                @endif

            </div>
        </div>

        {{ $chats->links() }}
    </section>
</main>
