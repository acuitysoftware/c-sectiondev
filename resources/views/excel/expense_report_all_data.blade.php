<table>
    <thead>
        
    <tr>
        <th>Sl No</th>
        <th>Date</th>
        <th>User</th>
        <th>Category Name</th>
        <th>Total Cost</th>
        <th>Notes</th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($reports as $key=>$report)
    @foreach($report->expenseDetails as $key2=>$value)
       
        <tr>
            <td>{{ $key2+1 }}</td>
            <td>{{date('d/m/Y', strtotime($report->date))}}</td>
            <td>{{ $report->name }}</td>
            <td>{{ $value->category->name }}</td>
            <td>{{ number_format($value->total_cost,2) }}</td>
            @if($key2 == (count($report->expenseDetails)-1))
            <td>{!! $report->notes !!}</td>
            @endif
            
        </tr>
    @endforeach
    @endforeach
    </tbody>
</table>