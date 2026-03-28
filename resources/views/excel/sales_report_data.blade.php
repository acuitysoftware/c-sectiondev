<table>
    <thead>
        
    <tr>
        <th>Sl No</th>
        <th>Date</th>
        <th>User Name</th>
        <th>Purpose of Sale</th>
        <th>Total Cost</th>
        <th>Notes</th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($reports->saleDetails as $key=>$report)
       
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{date('d/m/Y', strtotime($reports->date))}}</td>
            <td>{{ $reports->name }}</td>
            <td>{{ $report->name }}</td>
            <td>{{ number_format($report->total_sale,2) }}</td>
            @if($key == (count($reports->saleDetails)-1))
            <td>{!! $reports->notes !!}</td>
            @endif
            
        </tr>
    @endforeach
    </tbody>
</table>