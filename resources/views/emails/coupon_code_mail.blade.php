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
    $setting = \App\Models\Setting::first();
@endphp
<div style="width:625px; margin:0 auto; display:table; border:1px solid #999;  ">
    <div style="width:100%; padding:20px 0; float:left; text-align:center;background: #e4e4e4;">
        <a href="#"><img src="{{asset('storage/app/public/'.@$setting->logo) }}"></a>
    </div>
    
    <div style=" padding:10px; float:left; width:100%;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="padding:8px 5px; font-size:13px;" width="26%"><b>Special Discount Coupon Code is Genrated for you</b></td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:13px;" width="26%"><b>Name : {{$coupon->name}}</b></td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:13px;" width="26%"><b>Email : {{$coupon->email}}</b></td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:13px;" width="26%"><b>Phone : {{$coupon->phone}}</b></td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:13px;" width="26%"><b>{{$setting->discount_text}}</b></td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:13px;" width="26%"><b>Coupon Code : {{$setting->discount_code}}</b></td>
          </tr>
        </table>           
    </div>
    
    
     <div style=" padding:10px; float:left; width:100%; margin-top:-1px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <td><img src="{{asset('public/assets/images/list.png')}}" style="float:left; margin:3px 10px 0 0; opacity:.5;">{{ config('app.name', 'Wild Spice Indian Restaurant') }}</td>
          </tr>
          <tr>
          <td><img src="{{asset('public/assets/images/email.png')}}" style="float:left; margin:3px 10px 0 0; opacity:.5;"><a href="mailto:{{$setting->email}}" target="_blank">{{$setting->email}}</a></td>
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