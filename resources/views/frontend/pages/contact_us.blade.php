@extends('frontend.layouts.app')
@section('css')

@endsection

@section('content')

<!-- logoarea -->
    @include('frontend.includes.slider')
<!-- logoarea -->


   <!-- Start Page Wrapper -->
   <div class="page-wrapper">


      <div class="container">
         <div class="row">

            <div class="col-xl-3 col-md-3 col-sm-12">
               <div class="widget-content">
                   <h2>Helpline No</h2>
                  <a href="tel:{{$siteSetting->phone}}" class="callno">{{$siteSetting->phone}}</a>

               </div>
           </div>




            <div class="col-xl-5 col-md-5 col-sm-12">
                <div class="left_content ">
                     <h1 class="pagetitle">Contact Us</h1>
                     
                     <form action="{{route('contact.us.form.submit')}}" method="POST">
                    @csrf 
                        <div class="mb-3">
                           <label for="name" class="form-label">Name</label>
                           <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}">
                           @error('name') <div class="error">{{ $message }}</div> @enderror
                         </div>
                        <div class="mb-3">
                           <label for="exampleFormControlInput1" class="form-label">Email address</label>
                           <input type="email" class="form-control" name="email" placeholder="name@example.com" value="{{old('email')}}">
                           @error('email') <div class="error">{{ $message }}</div> @enderror
                         </div>
                         <div class="mb-3">
                           <label for="phone" class="form-label">Phone</label>
                           <input type="text" class="form-control" name="phone" placeholder="Phone" onkeypress="return number_check(this,event);" maxlength="10" value="{{old('phone')}}">
                           @error('phone') <div class="error">{{ $message }}</div> @enderror
                         </div>
                         <div class="mb-3">
                           <label for="phone" class="form-label">Message</label>
                           <textarea class="form-control" name="message" > {{old('message')}}</textarea>
                           @error('message') <div class="error">{{ $message }}</div> @enderror
                         </div>
                          <div class="mb-3">
                             <script src="https://www.google.com/recaptcha/api.js" 
                                async defer></script>
                                <div class="g-recaptcha" id="feedback-recaptcha" 
                                     data-sitekey="{{ $siteSetting->google_recaptcha_key}}">
                                </div>
                                @error('g-recaptcha-response') <div class="error">{{ $message }}</div> @enderror
                          </div>
                          <div class="mb-3">
                            <button type="submit" class="exambtn">Submit</button>
                         </div>
                     </form>                
               </div>
            </div>


            <div class="col-xl-4 col-md-4 col-sm-12">
                <div class="right_content">
                    <h2>WE ARE SOCIAL</h2>

                     <ul class="social-main">
                        @if(count($socialLinks)>0)
                          @foreach($socialLinks as $link)
                          @if($link->image)
                           <li><a href="{{$link->link}}" target="_blank"><img src="{{asset('storage/app/public/'.$link->image) }}" alt=""></a></li>
                          @endif
                          @endforeach
                          @endif
                        
                     </ul>

                </div>

                <!-- <div class="blog_widget">
                  <h2>OUR LATEST BLOG POSTS</h2>

                  <ul>
                     <li>
                        <a href="#">
                           <div class="blogdate">SEP 22</div>
                           <p>NEW Oftsed School website requirements</p>
                        </a>                        
                     </li>

                     <li>
                        <a href="#">
                           <div class="blogdate">SEP 22</div>
                           <p>NEW Oftsed School website requirements</p>
                        </a>                        
                     </li>

                     <li>
                        <a href="#">
                           <div class="blogdate">SEP 22</div>
                           <p>NEW Oftsed School website requirements</p>
                        </a>                        
                     </li>


                  </ul>
              </div> -->


            </div>


         </div>
      </div>
   </div>
   <!-- End Page Wrapper -->
    
@endsection

@section('script')

<script type="text/javascript">
   

</script>
@endsection