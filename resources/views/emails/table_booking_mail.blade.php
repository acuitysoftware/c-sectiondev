<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>{{ config('app.name', 'Wild Spice Indian Restaurant') }}</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Raleway" rel="stylesheet">
<style>
body{
  font-family: 'Open Sans', sans-serif;
  color:#333;
  font-size:14px;
  
}
​
</style>
</head>
<body>
​@php
    $logo = \App\Models\Setting::first();
@endphp
<div style="width:625px; margin:0 auto; display:table; border:1px solid #999;  ">
    <div style="width:100%; padding:20px 0; float:left; text-align:center;background: #e4e4e4;">
        <a href="#"><img src="{{asset('storage/app/public/'.@$logo->logo) }}"></a>
    </div>
    
    <div style=" padding:10px; float:left; width:100%;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="padding:8px 5px; font-size:13px;" width="26%"><b>{{$data['message']}}</b></td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:13px;" width="26%">Table Booking Details :</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">UserName : {{$booking->name}}</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Phone No : {{$booking->phone}}</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Email : {{$booking->email}}</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Booking Date : {$booking->date}} </td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Booking Time :  {{$booking->time}}</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">No of People : {{$booking->no_of_people}}</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Message : {{$booking->message}}</td>
          </tr>
        </table>           
    </div>
    
    
     <div style=" padding:10px; float:left; width:100%; margin-top:-1px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <td><img src="{{asset('public/assets/images/list.png')}}" style="float:left; margin:3px 10px 0 0; opacity:.5;">{{ config('app.name', 'Wild Spice Indian Restaurant') }}</td>
          </tr>
          <tr>
          <td><img src="{{asset('public/assets/images/email.png')}}" style="float:left; margin:3px 10px 0 0; opacity:.5;"><a href="mailto:{{$logo->email}}" target="_blank">{{$logo->email}}</a></td>
          </tr>
          <tr>
          <td><img src="{{asset('public/assets/images/intexp.png')}}" style="float:left; margin:3px 10px 0 0; opacity:.5;">Website : <a href="{{asset('')}}" target="_blank">{{asset('')}}</a></td>
          </tr>
        </table>           
    </div>
​
    <div style="width:100%; padding:25px 5px; float:left; width:100%;border-top:1px solid rgba(204, 204, 204, 0.70); background:#ececec;box-sizing: border-box;">
        <div style="width:45%; float:left; font-size:13px;">Copyright &copy; {{date('Y'); }}</div>
        
        <div style="width:45%; float:right; text-align:right;  font-size:13px;">Powered By : <a href="http://vigilantsoft.com/" target = "_blank">Vigilant Software</a></div>
    </div>
​
</div>
​
​
</body>
</html>