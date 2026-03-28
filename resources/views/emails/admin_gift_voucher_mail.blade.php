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
        <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
        <tbody>
          <tr style="vertical-align: top">
            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top; ">
  
              <div style="margin: 0 auto;width: 100%; display: flex;">
  
                <div class="colL" style=" float: left; width: 50%;  align-items: center; justify-content: space-between; background-image: url({{asset('public/assets/images/Lbg.png')}});background-size: contain;">
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td class="v-text-align" style="padding: 25px;" align="center">
                          <a href="{{asset('')}}" target="_blank">
                          <img align="center" border="0" src="{{asset('storage/app/public/'.@$setting->logo) }}"  alt="Logo" title="Logo" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important; border: none; height: auto; float: none;width: 100%;">
                          </a>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                  
  
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0" style="margin-top: 70px;">
                    <tbody>
                      <tr>
                        <td class="v-text-align" style="font-size: 16px;  padding: 0 25px; color: #fff; font-weight: 600;" align="center">
                          {{$setting->address}}
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
  
  
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0" style="margin-top: 70px;">
                    <tbody>
                      <tr>
                        <td class="v-text-align" style="font-size: 14px;  padding: 0 25px; color: #000;" align="center">
                          <p>Redeemable once. Not redeemable for cash. No Change given. Valid only at Wild Spice Indian Restaurant</p>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
  
                
                </div>
  
                <div class="colR" style=" float: left;Margin: 0 auto;width: 50%; position: relative;   background-image: url({{asset('public/assets/images/Rbg.png')}});background-size: cover;">
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td class="v-text-align" style="padding: 25px ;" align="center">
                          <a href="{{asset('')}}" target="_blank">
                          <img align="center" border="0" src="{{asset('public/assets/images/logo2.png')}}" alt="Logo" title="Logo" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important; border: none; height: auto; float: none;width: 100%;">
                          </a>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>                            
  
                     @if($voucher->send_to == 'Me')
  
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td style="color: #fff; font-size: 14px; padding: 10px 15px;"  align="center" >
                          <div style="width: 100%; display: flex; justify-content: end; align-items: center;">
                            <div style="float: left;width: 119px;text-align: right;line-height: 35px;"><label style="margin-right: 10px;"> Name :</label></div>
                            <div style="width: 150px; height: 25px; color: #000; background-color: #fff; float: left;padding: 5px;text-align: left;">{{ $voucher->name }}</div>
                          </div>
                        </td>                                            
                      </tr>                                        
                    </tbody>
                  </table>
                  
             @else
            
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td style="color: #fff; font-size: 14px; padding: 10px 15px;"  align="center" >
                          <div style="width: 100%; display: flex; justify-content: end; align-items: center;">
                            <div style="float: left;width: 119px;text-align: right;line-height: 35px;"><label style="margin-right: 10px;"> Name :</label></div>
                            <div style="width: 150px; height: 25px; color: #000; background-color: #fff; float: left;padding: 5px;text-align: left;">{{ $voucher->recipient_name }}</div>
                          </div>
                        </td>                                            
                      </tr>                                        
                    </tbody>
                  </table>
                  
           @endif
  
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td style="color: #fff; font-size: 14px; padding: 10px 15px;"  align="center" >
                          <div style="width: 100%; display: flex; justify-content: end; align-items: center;">
                            <div style="float: left;width: 119px;text-align: right;line-height: 35px;"><label style="margin-right: 10px;"> Expiry Date :</label></div>
                            <div style="width: 150px; height: 25px; color: #000; background-color: #fff; float: left;padding: 5px;text-align: left;">{{ date("d/m/Y",strtotime($voucher->expiry_date)) }}</div>
                          </div>
                        </td>                                            
                      </tr>                                        
                    </tbody>
                  </table>
  
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td style="color: #fff; font-size: 14px; padding: 10px 15px;"  align="center" >
                          <div style="width: 100%; display: flex; justify-content: end; align-items: center;">
                            <div style="float: left;width: 119px;text-align: right;line-height: 35px;"><label style="margin-right: 10px;"> Voucher Code :</label></div>
                            <div style="width: 150px; height: 25px; color: #000; background-color: #fff; float: left;padding: 5px;text-align: left;">{{ $voucher->voucher_code }}</div>
                          </div>
                        </td>                                            
                      </tr>                                        
                    </tbody>
                  </table>
  
  
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td style="color: #fff; font-size: 14px; padding: 10px 15px;"  align="center" >
                          <div style="width: 100%; display: flex; justify-content: end; align-items: center;">
                            <div style="width: 100%; height: 70px; color: #000; background-color: #fff;text-align: left;padding: 10px;"> {{ $voucher->description}} </div>
                          </div>
                        </td>                                            
                      </tr>                                        
                    </tbody>
                  </table>
  
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td style="color: #fff; font-size: 14px; padding: 10px 15px;"  align="center" >
                          <div style="width: 100%; display: flex; justify-content: end; align-items: center;">
                            <div style="float: left;width: 119px;text-align: right;line-height: 35px;"><label style="margin-right: 10px;"> Amount :</label></div>
                            <div style="width: 150px; height: 25px; color: #000; background-color: #fff; float: left;padding: 5px;text-align: left;">&euro; {{ $voucher->amount }}</div>
                          </div>
                        </td>                                            
                      </tr>                                        
                    </tbody>
                  </table>
  
                
                  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tbody>
                      <tr>
                        <td class="v-text-align" style="font-size: 14px;  padding: 25px 25px; color: #fff; " align="center">
                          <p>{{ $setting->discount_text }}</p>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </td>
          </tr>
        </tbody>
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