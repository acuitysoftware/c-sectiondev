<main class="main-content">
    <!-- nav Section -->

    <div class="navarea mb-4">
        <div class="menunav2">
            <ul>
                <li><a href="javascript:void(0);" class="{{ $activeTab == '1' ? 'active' : '' }}"
                        wire:click="changeExamType(1)"><img src="{{ asset('public/frontend/images/n36.png') }}"
                            width="20" alt=""> Weekly</a> </li>
                <li><a href="javascript:void(0);" class="{{ $activeTab == '2' ? 'active' : '' }}"
                        wire:click="changeExamType(2)"><img src="{{ asset('public/frontend/images/n37.png') }}"
                            width="20" alt=""> Monthly </a></li>
            </ul>
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



    {{-- <div class="navarea mb-4">
          <div class="filter_L">
            Ends in :
            <select class="subject-filter">
              <option>5d 8h</option>
            </select>

          </div>
          <div class="filter_R">
            Sort:
            <select class="subject-filter">
              <option>Newest</option>
            </select>
          </div>
        </div> --}}



    <div class="navarea mb-2">
        <div class="menunav">
            <ul>
                <li><a href="#" class="active"> All Questions</a> </li>
                {{-- <li><a href="#" class=""> Al Answered </a></li>
              <li><a href="#" class=""> Tutor Help </a></li> --}}
                {{--  <li><a href="#" class=""> Escalated </a></li>
              <li>
                <select>
                  <option>Math</option>
                </select>
              </li> --}}
            </ul>
        </div>
    </div>








    <!-- Your Recent Questions -->
    <section class="recent-questions">
        <div class="shadobox2">
            <div class="filter-dropdown2 filter_sb">
                <div class="filter_L">

                    <select class="subject-filter" wire:model="searchSubject">
                        <option value="">Select</option>
                        @if (count($subjects) > 0)
                            @foreach ($subjects as $key => $subjectData)
                                <option value="{{ $subjectData->id }}" :wire:key="key-{{ $subjectData->id }}">
                                    {{ $subjectData->name }}</option>
                            @endforeach
                        @endif
                    </select>

                </div>
                <div class="filter_R">
                    Status :
                    <select class="subject-filter" wire:model="sortDirection">
                        <option value="desc">Newest</option>
                        <option value="asc">Oldest</option>
                    </select>
                </div>
            </div>

            <div class="question-list">

                @if (count($firstPart) > 0)
                    @foreach ($firstPart as $key => $chat)
                        <div class="question-card2">
                            <div class="question-avatar">
                                <div class="status_n">
                                    <img src="{{ asset('public/frontend/images/n8.png') }}') }}" alt="">
                                </div>
                                @if (isset($chat->user->profile_photo_path))
                                    <img src="{{ asset('storage/app/public/' . $chat->user->profile_photo_path) }}"
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
    </section>



    <section class="recent-questions">

        <div class="section-title">
            <h3>Earn Diamonds</h3>

        </div>



        <section class="addsection">
            <div class="row">
                <div class="col-md-4">
                    <div class="add colorb">
                        <img src="{{ asset('public/frontend/images/n38.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="add colory">
                        <img src="{{ asset('public/frontend/images/n39.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="add colorb">
                        <img src="{{ asset('public/frontend/images/n40.png') }}" alt="">
                    </div>
                </div>


            </div>
        </section>



        <div class="shadobox2">
            <div class="question-list">

                @if (count($secondPart) > 0)
                    @foreach ($secondPart as $key => $chat)
                        <div class="question-card2">
                            <div class="question-avatar">
                                <div class="status_n">
                                    <img src="{{ asset('public/frontend/images/n8.png') }}') }}" alt="">
                                </div>
                                @if (isset($chat->user->profile_photo_path))
                                    <img src="{{ asset('storage/app/public/' . $chat->user->profile_photo_path) }}"
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

                @endif





            </div>

        </div>

        {{ $chats->links() }}
    </section>







</main>
