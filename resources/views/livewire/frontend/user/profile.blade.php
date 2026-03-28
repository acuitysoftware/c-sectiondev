<div>
<!-- --------------- -->
  <div class="container">
     <div class="row">
        <div class="col-xl-3 col-md-3 col-sm-12">
           <div class="widget_col">
              <h2 class="widge_ttitle">Subject </h2>
              <ul>
              	@if(count($subjects)>0)
                @foreach($subjects as $key=>$subject)
                    <li><a href="javascript:void(0)" class="{{$active_menu==$subject->id?'active':''}}" wire:click="changeSubject('{{$subject->id}}')">{{$subject->name}}</a></li>
                @endforeach
                @else
                	<li><a href="javascript:void(0)" >No Subject Found</a></li>
                @endif
                  
              </ul>
          </div>
        </div>

        <div class="col-xl-6 col-md-6 col-sm-12">
           <div class="mid_content">
           		@if(isset($chapter))
              <h1 class="pagetitle">{{$chapter->subject->name}}</h1>
              <div class="content_box">
                 <div class="content_title">{{$chapter->name}}</div>
                 {!! $chapter->description !!}
              
                 <ul class="pdfcol">
                 	@if(count($chapter->chapterFiles)>0)
                	@foreach($chapter->chapterFiles as $key=>$file)
                    <li>
                       <div class="pdf_leftcol">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18.858" height="22" viewBox="0 0 18.858 22">
                             <g id="pdf-file-svgrepo-com" transform="translate(-36.565)">
                               <path id="Path_41963" data-name="Path 41963" d="M66.166,5.065V22H47.791V0H61.1L63.462,2.36Z" transform="translate(-10.744 -0.002)" fill="#b12a27"/>
                               <rect id="Rectangle_966" data-name="Rectangle 966" width="8.813" height="3.943" transform="translate(36.565 1.474)" fill="#f2f2f2"/>
                               <g id="Group_4225" data-name="Group 4225" transform="translate(37.987 2.287)">
                                 <g id="Group_4223" data-name="Group 4223">
                                   <path id="Path_41964" data-name="Path 41964" d="M71.39,53.7a.73.73,0,0,0-.421-.418.922.922,0,0,0-.35-.062h-.969v2.5h.489v-.943h.479a.922.922,0,0,0,.35-.062.748.748,0,0,0,.259-.168.721.721,0,0,0,.162-.249.842.842,0,0,0,0-.6Zm-.528.547a.374.374,0,0,1-.266.094H70.14v-.687H70.6a.362.362,0,0,1,.266.1.374.374,0,0,1,0,.5Z" transform="translate(-69.651 -53.223)" fill="#b12a27"/>
                                   <path id="Path_41965" data-name="Path 41965" d="M124.23,54.19c0-.087-.006-.165-.016-.236a.927.927,0,0,0-.049-.2.707.707,0,0,0-.091-.168.824.824,0,0,0-.314-.279,1.018,1.018,0,0,0-.441-.087h-.9v2.5h.9a1.018,1.018,0,0,0,.441-.087.824.824,0,0,0,.314-.279.707.707,0,0,0,.091-.168.927.927,0,0,0,.049-.2c.01-.071.013-.149.016-.236s0-.178,0-.282S124.233,54.275,124.23,54.19Zm-.489.534a1.4,1.4,0,0,1-.013.185.562.562,0,0,1-.029.126.359.359,0,0,1-.055.1.435.435,0,0,1-.366.152H122.9V53.656h.372a.437.437,0,0,1,.366.155.34.34,0,0,1,.055.094.592.592,0,0,1,.029.13,1.351,1.351,0,0,1,.013.181c0,.071,0,.159,0,.256S123.744,54.654,123.741,54.725Z" transform="translate(-120.152 -53.222)" fill="#b12a27"/>
                                   <path id="Path_41966" data-name="Path 41966" d="M176.459,53.656v-.434H174.81v2.5h.489V54.709h.988v-.437H175.3v-.615Z" transform="translate(-170.291 -53.222)" fill="#b12a27"/>
                                 </g>
                                 <g id="Group_4224" data-name="Group 4224" transform="translate(0 0)">
                                   <path id="Path_41967" data-name="Path 41967" d="M71.39,53.7a.73.73,0,0,0-.421-.418.922.922,0,0,0-.35-.062h-.969v2.5h.489v-.943h.479a.922.922,0,0,0,.35-.062.748.748,0,0,0,.259-.168.721.721,0,0,0,.162-.249.842.842,0,0,0,0-.6Zm-.528.547a.374.374,0,0,1-.266.094H70.14v-.687H70.6a.362.362,0,0,1,.266.1.374.374,0,0,1,0,.5Z" transform="translate(-69.651 -53.223)" fill="#b12a27"/>
                                 </g>
                               </g>
                               <path id="Path_41968" data-name="Path 41968" d="M66.166,57.586V74.523H47.791V70.552l8.59-8.59.509-.509.282-.282.47-.47.557-.557,5.263-5.263Z" transform="translate(-10.744 -52.523)" fill="#040000" opacity="0.08"/>
                               <path id="Path_41969" data-name="Path 41969" d="M362.662,5.063H357.6V0Z" transform="translate(-307.24)" fill="#771b1b"/>
                               <g id="Group_4226" data-name="Group 4226" transform="translate(39.107 6.371)">
                                 <path id="Path_41970" data-name="Path 41970" d="M109.419,157.834a2.117,2.117,0,0,0-.434-.528,3.132,3.132,0,0,0-.522-.379,6.9,6.9,0,0,0-3.479-.7h-.155c-.084-.078-.172-.155-.262-.236a6.946,6.946,0,0,1-1.415-1.739,9.532,9.532,0,0,0,1.011-4.162,2.231,2.231,0,0,0-.087-.564,1.825,1.825,0,0,0-.389-.735l-.006-.007a1.482,1.482,0,0,0-1.1-.509,1.376,1.376,0,0,0-1.066.505,2.008,2.008,0,0,0-.424,1.289,11.053,11.053,0,0,0,.191,2.248c.013.055.023.11.036.165a8.465,8.465,0,0,0,.6,1.788c-.3.619-.612,1.153-.826,1.516-.162.275-.34.564-.525.852a12.705,12.705,0,0,0-2.154.557,5.536,5.536,0,0,0-1.979,1.153,2.274,2.274,0,0,0-.625.946,1.426,1.426,0,0,0,.019.985,1.4,1.4,0,0,0,.59.68,1.494,1.494,0,0,0,.2.1,1.778,1.778,0,0,0,.67.13,2.425,2.425,0,0,0,1.587-.661,16.607,16.607,0,0,0,2.345-2.876c.444-.068.926-.126,1.471-.185.641-.065,1.208-.1,1.723-.123l.457.408a18.272,18.272,0,0,0,1.982,1.61s0,0,.006,0a4.83,4.83,0,0,0,.641.363,1.7,1.7,0,0,0,.722.168,1.456,1.456,0,0,0,.845-.266,1.342,1.342,0,0,0,.505-.722A1.44,1.44,0,0,0,109.419,157.834Zm-7.162-6.488a9.9,9.9,0,0,1-.058-1.26c.006-.418.159-.7.382-.7.168,0,.347.152.428.444a1.348,1.348,0,0,1,.042.3c.006.136,0,.279,0,.424a6.4,6.4,0,0,1-.214,1.318,9.1,9.1,0,0,1-.292.943A7.936,7.936,0,0,1,102.257,151.346Zm-5.4,8.525c-.055-.136.006-.4.343-.722a5.549,5.549,0,0,1,2.446-1.176c-.214.292-.424.557-.628.8a8.7,8.7,0,0,1-.878.933,1.394,1.394,0,0,1-.722.369.829.829,0,0,1-.126.01A.447.447,0,0,1,96.854,159.872Zm5.176-3.443.023-.036-.036.006a.207.207,0,0,1,.026-.045c.136-.23.308-.525.492-.865l.016.036.042-.087c.136.194.285.385.441.57.075.087.152.172.23.256l-.052,0,.045.042c-.133.01-.272.023-.411.036-.087.01-.178.016-.269.026Zm5.451,2.021a11.945,11.945,0,0,1-1.347-1.056,4.458,4.458,0,0,1,1.769.489,1.671,1.671,0,0,1,.418.324c.155.165.211.314.181.415a.269.269,0,0,1-.279.168.579.579,0,0,1-.253-.062,4.206,4.206,0,0,1-.47-.266C107.494,158.463,107.488,158.456,107.482,158.45Z" transform="translate(-95.727 -148.279)" fill="#f2f2f2"/>
                               </g>
                             </g>
                          </svg>
                          {{$file->file_original_name}}
                       </div>

                       <div class="pdf_right">
                          <a href="{{asset('storage/app/public/'.$file->file_name) }}" target="_blank">
                             <svg xmlns="http://www.w3.org/2000/svg" width="19.541" height="14" viewBox="0 0 19.541 14">
                                <g id="view-svgrepo-com" transform="translate(-2.23 -5)">
                                  <circle id="Ellipse_89" data-name="Ellipse 89" cx="3" cy="3" r="3" transform="translate(9 9)" fill="none" stroke="#000" stroke-width="2"/>
                                  <path id="Path_41961" data-name="Path 41961" d="M20.188,10.934c.388.471.582.707.582,1.066s-.194.594-.582,1.066C18.768,14.79,15.636,18,12,18s-6.768-3.21-8.188-4.934c-.388-.471-.582-.707-.582-1.066s.194-.594.582-1.066C5.232,9.21,8.364,6,12,6S18.768,9.21,20.188,10.934Z" fill="none" stroke="#000" stroke-width="2"/>
                                </g>
                             </svg>                                                                   
                          </a>
                          <a href="{{asset('storage/app/public/'.$file->file_name) }}" download="">
                             <svg xmlns="http://www.w3.org/2000/svg" width="21" height="16" viewBox="0 0 21 16">
                                <path id="download-svgrepo-com" d="M8,10a4,4,0,0,1,8,0v1h1a3.5,3.5,0,0,1,0,7h-.1a1,1,0,0,0,0,2H17a5.5,5.5,0,0,0,.93-10.922,6,6,0,0,0-11.859,0A5.5,5.5,0,0,0,7,20h.1a1,1,0,1,0,0-2H7a3.5,3.5,0,0,1,0-7H8Zm5,1a1,1,0,0,0-2,0v5.586L9.707,15.293a1,1,0,1,0-1.414,1.414l3,3a1,1,0,0,0,1.414,0l3-3a1,1,0,1,0-1.414-1.414L13,16.586Z" transform="translate(-1.5 -4)" fill="#404dfc" fill-rule="evenodd"/>
                             </svg>                                  
                          </a>
                       </div>
                    </li>


                    @endforeach
                	@endif
                 </ul>
              
              	@if(isset($questionSet))
                 <div class="col-xl-12 col-md-12 col-sm-12 text-center">
                    <a href="{{route('user.exam',['id' =>$chapter->subject->id,'slug' =>$chapter->subject->slug,'chapter_id' =>$chapter->id,'chapter_slug' =>$chapter->slug])}}" class="exambtn">Exam</a>
                 </div>
                 @endif
             
              </div>
              @else
              <h5 style="text-align: center;" >No records found </h5>
              @endif
           </div>

           <div class="weeklybox">
              <a href="{{route('user.weekly.exam')}}" class="weekly1_btn">Weekly Test</a>
              <a href="{{route('user.GroupExam.exam',['slug' =>$user->group->slug, 'test_type' =>'weekly'])}}" class="weekly2_btn">Group Weekly Test</a>
           </div>

        </div>


        @include('frontend.includes.profile_side_bar')


     </div>
  </div>
  <!-- --------------- -->



  @include('frontend.includes.exam_side_bar')
</div>
