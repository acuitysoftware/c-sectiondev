<main class="main-content">
    <!-- nav Section -->

    <div class="navarea">
        <div class="menunav">
            <ul>
                <li><a href="#" class="active"><img src="{{ asset('public/frontend/images/n15.png') }}" width="20"
                            alt=""> Home</a> </li>
                {{-- <li><a href="#" class=""><img src="{{ asset('public/frontend/images/n16.png') }}"
                            width="20" alt=""> Image </a></li>
                <li><a href="#" class=""><img src="{{ asset('public/frontend/images/n17.png') }}"
                            width="20" alt=""> Discover </a></li> --}}
            </ul>
        </div>

        <div class="searchb">
            
            <input type="date" placeholder="Search" class="question-field" wire:model="fromDate">
            <input type="date" placeholder="Search" class="question-field" wire:model="toDate">
        </div>

        <div class="searchb">
            <svg class="search-icon" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z">
                </path>
            </svg>
            <input type="text" placeholder="Search" class="question-field" wire:model="searchName">
        </div>

    </div>

    <section class="recent-questions">
        <div class="section-title">
            <h3>My Questions</h3>
            <img src="{{ asset('public/frontend/images/n5.png') }}') }}" alt="">
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
                                $className = "answered";
                                $status = "AI Answered";
                                if($chat->type == 2){
                                    if($chat->active == 0){
                                        $status = "Pending";
                                        $className = "answered2";
                                }
                                else{
                                    $status = "Tutor Answered";
                                }
                                }
                            @endphp
                            <span class="status-badge {{$className}}"> <img
                                    src="{{ asset('public/frontend/images/n6.png') }}') }}" alt=""> 
                                {{$status}}
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
