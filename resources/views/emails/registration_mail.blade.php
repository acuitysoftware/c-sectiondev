<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ config('app.name', 'Future style barbers') }}</title>
</head>
<body>

 <div style="background-color: #f2f2f2; padding-top: 25px; width: 600px; margin:0px auto;">  
  <div style="padding-left: 15px; padding-right: 15px;">  
 <div style="padding-bottom: 20px; background: #272928;"><img style="display: block;margin-left: auto;margin-right: auto;" src="{{asset('storage/app/public/'.@$setting->logo) }}" alt="logo"></div>
  <p style="font-family: arial; font-size: 25px; color: #000; margin-bottom: 30px; text-align: center;"></p>
   
   <p style="font-family: arial; font-size: 14px; color: #000;">Hi {{$user->name}},<p>
   <p style="font-family: arial; font-size: 14px; color: #000; line-height: 1.7;"> 

      You've successfully completed your registration.Your Username & Password :</p>
<p style="font-family: arial; font-size: 14px; color: #000; line-height: 1.7;"> 
  Username : {{$user->username}}<br>
  Password : {{$data['password']}}
</p>
    
      

   

    <p style="font-size: 14px; font-family: arial; color: #000; font-size: 14px; color: #000; margin-top: 30px; text-align: left; line-height: 1.7;">Thanks & Regards,<br>
  {{ config('app.name', 'Future style barbers') }}<br>
       </p>
    </div>   
   
   <div style="background-color: #696969; padding-top: 15px; padding-bottom: 15px; padding-left: 35px; padding-right: 35px;">
    

    <p style="font-size: 14px; font-size: 14px; color: #fff; text-align: center;font-family: arial;">Copyright © <?php echo date('Y'); ?> {{ config('app.name', 'Future style barbers') }}. All Rights Reserved.</p>
   </div>

 </div>   


</body>
</html>