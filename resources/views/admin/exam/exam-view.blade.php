<x-admin-layout title="Exam Result Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Exam Result View">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('exams.index') }}" value="Exam Result List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Exam Result
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-section">
                <div class="kt-section__content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 250px;">Student Name</th>
                                    <td>{{ $exam->user->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Student Email</th>
                                    <td>{{$exam->user->email}}</td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">Student Phone Number</th>
                                    <td>{{$exam->user->phone}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Board</th>
                                    <td>{{$exam->board?$exam->board->name:""}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Class</th>
                                    <td>{{$exam->class?$exam->class->name:""}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Subject</th>
                                    <td>@if($exam->subject)
                                        {{$exam->subject->name}}
                                    @else
                                        {{$exam->exam_type=='Single'?'All Subject':$exam->exam_type}}
                                    @endif</td>
                                </tr>
                                <tr>
                                    <th scope="row">Chapter</th>
                                    <td>@if($exam->chapter)
                                            {{$exam->chapter->name}}
                                        @else
                                            {{$exam->test_type}}
                                        @endif</td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">Exam Submit Date</th>
                                    <td>{{$exam->created_at->format('d M, Y')}}</td>
                                </tr>

                          
                                <tr>
                                    <th scope="row">Exam Status</th>
                                    <td>@if($exam->is_passed == '0')
				                		Failed
				                	@elseif($exam->is_passed == '1')
				                		Passed
				                	
				                	@endif
				                	</td>
                                </tr>

                             
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
</x-admin-layout>