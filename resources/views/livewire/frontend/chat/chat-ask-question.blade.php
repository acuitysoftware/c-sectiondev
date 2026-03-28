<main class="main-content">
    <!-- nav Section -->

    <div class="navarea">
        <div class="menunav">
            <ul>
                <li><a href="#" class="active"><img src="{{ asset('public/frontend/images/n15.png') }}" width="20"
                            alt=""> Home</a> </li>
                {{-- <li><a href="#" class=""><img src="{{asset('public/frontend/images/n16.png')}}" width="20" alt=""> Image </a></li>
              <li><a href="#" class=""><img src="{{asset('public/frontend/images/n17.png')}}" width="20" alt=""> Discover </a></li> --}}
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



    <!-- Recent Questions Section -->
    <section class="section_n">


        {{-- <div class="header">
            <img src="{{asset('public/frontend/images/n4.png')}}" alt="">
            <span class="question-text">How do you calculate the area of a circle?</span>
          </div> --}}

        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <div class="searea">
                        <div class="searearow">
                            Category
                            <select wire:model="subject_id">
                                <option value="">Select Category</option>
                                @if (count($subjects) > 0)
                                    @foreach ($subjects as $key => $subjecItem)
                                        <option value="{{ $subjecItem->id }}">{{ $subjecItem->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        {{-- <div class="searearow">
                            Difficulty
                            <select>
                                <option>(optional)</option>
                            </select>
                        </div> --}}
                    </div>


                    <form wire:submit.prevent="sendMessage">
                        <div class="comarea">
                            @if (isset($last_chat) && count($last_chat->messages))
                                @foreach ($last_chat->messages as $chatData)
                                    <input type="hidden" wire:model="chat_id" />
                                    <div class="header">
                                        <img src="{{ asset('public/frontend/images/n4.png') }}" alt="">
                                        <span class="question-text">{!! $chatData->question !!}</span>
                                    </div>
                                    @if ($chatData->answer)
                                        <div class="header">
                                            <span class="question-text">{!! $chatData->answer !!}</span>
                                            <img src="{{ asset('public/frontend/images/n4.png') }}" alt="">
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <textarea wire:model="question"></textarea>

                            <div class="textfooter">
                                <div class="textfooterL">
                                    {{-- <a href="#"><img src="{{ asset('public/frontend/images/n20.png') }}"
                                            alt=""></a>
                                    <a href="#"><img src="{{ asset('public/frontend/images/n21.png') }}"
                                            alt=""></a>
                                    <a href="#"><img src="{{ asset('public/frontend/images/n22.png') }}"
                                            alt=""></a>
                                    <a href="#"><img src="{{ asset('public/frontend/images/n23.png') }}"
                                            alt=""></a> --}}
                                </div>
                                <div class="textfooterR">
                                    <x-frontend.chat-button name="Submit Question"
                                        target="sendMessage"></x-frontend.chat-button>
                                    {{-- <button type="submit" class="bluebtn">Submit Question</button> --}}
                                </div>

                            </div>
                        </div>
                    </form>


                    {{-- <div class="searea">
                  <div class="searearow">
                    Category
                    <select wire:model="subject_id">
                      @if (count($subjects) > 0)
                     @foreach ($subjects as $key => $subjecItem)
                         <option value="{{ $subjecItem->id }}">{{ $subjecItem->name }}</option>
                     @endforeach
                 @endif
                    </select>
                  </div>
                  <div class="searearow">
                    Difficulty 
                    <select>
                      <option>(optional)</option>
                    </select>
                  </div>
                </div> --}}






                </div>
                <div class="col-md-3">
                    <img src="{{ asset('public/frontend/images/n19.png') }}" alt="">


                    <div class="tipsarea">
                        <h4>Tips</h4>

                        <li>
                            <span><img src="{{ asset('public/frontend/images/n24.png') }}" alt=""></span>
                            <p>Try to be specific with your question</p>
                        </li>
                        <li>
                            <span><img src="{{ asset('public/frontend/images/n25.png') }}" alt=""></span>
                            <p>Include important details</p>
                        </li>
                        <li>
                            <span><img src="{{ asset('public/frontend/images/n26.png') }}" alt=""></span>
                            <p>You may attach files or images for clarity</p>
                        </li>
                    </div>
                </div>
            </div>


            {{-- <div class="col-md-12">
              <div class="buttonarea">
                  <button type="button" class="bluebtn">Submit Question</button>
                </div>
            </div> --}}
        </div>




    </section>
    @if ($last_chat)
        <section>
            <div class="nbtngroup">
                <ul>
                    <li><a href="javascript:void(0);"><img src="{{ asset('public/frontend/images/n30.png') }}"
                                alt=""> Regenerate</a></li>
                    <li wire:click="sendToAdmin({{ $last_chat->id }})"><a href="javascript:void(0);"><img
                                src="{{ asset('public/frontend/images/n31.png') }}" alt=""> Ask Tutor</a></li>
                    <li class="{{ $last_chat->is_bookmarks == '1' ? 'active' : '' }}"
                        wire:click="saveBookmarks({{ $last_chat->id }})"><a href="javascript:void(0);"><img
                                src="{{ asset('public/frontend/images/n32.png') }}" alt=""> Bookmark</a></li>
                </ul>
            </div>
        </section>
    @endif
    <!-- Your Recent Questions -->
    <section class="recent-questions">
        <div class="section-title">
            <h3>Your Recent Questions</h3>
            <img src="{{ asset('public/frontend/images/n5.png') }}" alt="">
            <span class="precious-badge">(Precious)</span>
        </div>

        <div class="shadobox">
            <div class="filter-dropdown">
                <select class="subject-filter" wire:model="searchSubject">
                    <option value="">Select</option>
                    @if (count($subjects) > 0)
                        @foreach ($subjects as $key => $subjecItem)
                            <option value="{{ $subjecItem->id }}">{{ $subjecItem->name }}</option>
                        @endforeach
                    @endif
                </select>
                {{-- <select class="sort-filter">
                     <option>Intony</option>
                     <option>Recent</option>
                     <option>Popular</option>
                 </select> --}}
            </div>

            <div class="question-list">

                @if (count($recent_chats) > 0)
                    @foreach ($recent_chats as $key => $chatItem)
                        <div class="question-card">
                            <div class="question-avatar">
                                <div class="status_n">
                                    <img src="{{ asset('public/frontend/images/n8.png') }}" alt="">
                                </div>
                                @if (isset($user->profile_photo_path))
                                    <img src="{{ asset('storage/app/public/' . $user->profile_photo_path) }}"
                                        alt="user">
                                @else
                                    <img src="{{ asset('public/assets/images/no_image.png') }}" alt="user">
                                @endif
                            </div>


                            <div class="question-content">
                                <h4>{!! $chatItem->question !!}</h4>
                                <div class="question-meta">
                                    <span class="subject">test :</span>
                                    <span class="time">
                                        {{ $chatItem->created_at->diffForHumans(null, true) . ' ' }}</span>
                                </div>
                            </div>
                            @php
                                $className = 'answered';
                                $status = 'AI Answered';
                                if ($chatItem->type == 2) {
                                    if ($chatItem->active == 0) {
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

        {{ $recent_chats->links() }}
    </section>
</main>
