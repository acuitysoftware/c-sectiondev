<main class="main-content">
    <!-- nav Section -->

    <div class="navarea mb-4">
        <div class="menunav2">
            <ul>
                <li><a href="javascript:void(0)" class="{{ $activeTab == '1' ? 'active' : '' }}"
                        wire:click="changeExamType(1)"><img src="{{ asset('public/frontend/images/n36.png') }}"
                            width="20" alt=""> Weekly</a> </li>
                <li><a href="javascript:void(0)" class="{{ $activeTab == '2' ? 'active' : '' }}"
                        wire:click="changeExamType(2)"><img src="{{ asset('public/frontend/images/n37.png') }}"
                            width="20" alt=""> Monthly </a></li>
            </ul>
        </div>
    </div>

 
    <section class="bannersection">
        <img src="{{ asset('public/frontend/images/n42.png') }}" alt="">
    </section>



    <!-- Your Recent Questions -->
    <section class="recent-questions">
        <div class="section-title">
            <h3>{{ $test_title }}</h3>
            {{-- <img src="{{ asset('public/frontend/images/n5.png') }}') }}" alt="">
              <span class="precious-badge">(Precious)</span> --}}
        </div>
        <div class="shadobox2">
            <div class="filter-dropdown2 filter_sb">
                <div class="filter_L">

                    {{-- <select class="subject-filter">
                  <option>Subject</option>
                  <option>Math</option>
                  <option>Science</option>
                  <option>Coding</option>
                </select>
                <select class="sort-filter">
                  <option>Intony</option>
                  <option>Recent</option>
                  <option>Popular</option>
                </select> --}}
                </div>
                <div class="filter_R">
                    Status :
                    <select class="subject-filter" wire:model="sortDirection">
                        <option value="desc">High to Low</option>
                        <option value="asc">Low to High</option>
                    </select>
                </div>
            </div>

            <div class="question-list">
                @if (count($students) > 0)
                    @foreach ($students as $key => $student)
                        <div class="question-card2">
                            <div class="question-avatar">
                                <div class="status_n">
                                    <img src="{{ asset('public/frontend/images/n8.png') }}" alt="">
                                </div>

                                @if (isset($student->profile_photo_path))
                                    <img src="{{ asset('storage/app/public/' . $student->profile_photo_path) }}"
                                        alt="user">
                                @else
                                    <img src="{{ asset('public/assets/images/no_image.png') }}" alt="user">
                                @endif
                            </div>


                            <div class="question-content">
                                <h4>{{ $student->student_name }}</h4>
                                {{-- <div class="question-meta">
                    <span class="subject">Math :</span>
                    <span class="time">2 min ago</span>
                  </div> --}}
                            </div>
                            <span class="status-badge"> <img src="{{ asset('public/frontend/images/n41.png') }}"
                                    alt=""> {{ $student->total_point }}</span>
                            {{-- <span class="status-badge answered"> <img src="{{asset('public/frontend/images/n6.png')}}" alt=""> AI Answered</span>
                <span class="status-badge answered2"> <img src="{{asset('public/frontend/images/n7.png')}}" alt=""> Math</span> --}}
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No records available</p>
                @endif





            </div>
        </div>
    </section>





</main>
