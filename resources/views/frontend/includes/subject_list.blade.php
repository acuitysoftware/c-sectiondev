<div class="widget_col">
  <h2 class="widge_ttitle">Subject </h2>
  <ul>
      @if(count($subjects)>0)
    @foreach($subjects as $key=>$subjectData)
        <li><a href="{{route('user.profile',['subject_name' => $subjectData->slug])}}" class="{{@$subject->id==$subjectData->id?'active':''}}" >{{$subjectData->name}}</a></li>
    @endforeach
    @else
    	<li><a href="javascript:void(0)" >No Subject Found</a></li>
    @endif
  </ul>
</div>