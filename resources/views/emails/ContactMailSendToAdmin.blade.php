<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Taj Corporation') }}</title>
    <style type="text/css">
      body{
        font-size: 17px;
        width: 100%; 
        background-color: #ffffff; 
        margin:0; 
        padding:0; 
        -webkit-font-smoothing: antialiased;
        font-family: 'Archivo', sans-serif;
        color: #000B2D;
      }
      table {border-collapse: collapse; font-family: 'Archivo', sans-serif; font-size: 17x; color: #000B2D;}
      @media only screen and (max-width: 640px)  {
      .deviceWidth {width:440px!important; padding:0;}
      .center {text-align: center!important;}
      }
      @media only screen and (max-width: 479px) {
      .deviceWidth {width:280px!important; padding:0;}
      .center {text-align: center!important;}
      }
    </style>
        <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  </head>
  <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <!-- Wrapper -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td width="100%" valign="top" bgcolor="#ffffff">


          <!-- Start Header-->
          <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
            <tr>
              <td width="100%" bgcolor="#fff">
                <!-- Logo -->
                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                  <tr>
                    @php
                        $logo = \App\Models\Setting::first();
                    @endphp
                    <td style="padding:10px 20px" class="center">
                      <a href="#" style="width: 100%; display: inline-block; text-align: center;">
                                                <img src="{{asset('storage/app/public/'.@$logo->logo) }}" alt="" border="0" />
                                            </a>
                    </td>
                  </tr>
                </table>
                <!-- End Logo -->
              </td>
            </tr>
          </table>
          <!-- End Header -->

        <!-- center text-->
        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
          <tr>
            <td width="100%" bgcolor="#fff" style="padding:20px 20px 30px; text-align: center;" class="center">
              <p>You have received a mail from {{@$data['email']}}</p>

            </td>
          </tr>
        </table>
        <!-- End Header -->

          <!-- 2 Column Images & Text Side by SIde -->
          <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
            <tr>
              <td style="padding:50px 25px 0">
                <table align="left" width="50%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                  <tr>
                    <td valign="top" align="left" class="left" style="border: 1px solid #E3E3E3; padding: 10px;">
                      <p style="mso-table-lspace:0; mso-table-rspace:0; margin:0">
                        Name
                      </p>
                    </td>
                  </tr>
                </table>

                <table align="right" width="50%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                  <tr>
                    <td valign="top" align="left" class="left"  style="border: 1px solid #E3E3E3; padding: 10px;">
                      <p style="mso-table-lspace:0; mso-table-rspace:0; margin:0">
                        {{@$data['name']}}
                      </p>
                    </td>
                  </tr>
                </table>
              </td>                            
            </tr>
          </table>
          <!-- End 2 Column Images & Text Side by SIde -->

          <!-- 2 Column Images & Text Side by SIde -->
          <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:-1px auto 0;">
            <tr>
              <td style="padding:0 25px 0">
                <table align="left" width="50%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                  <tr>
                    <td valign="top" align="left" class="left" style="border: 1px solid #E3E3E3; padding: 10px;">
                      <p style="mso-table-lspace:0; mso-table-rspace:0; margin:0">
                        Email
                      </p>
                    </td>
                  </tr>
                </table>

                <table align="right" width="50%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                  <tr>
                    <td valign="top" align="left" class="left"  style="border: 1px solid #E3E3E3; padding: 10px;">
                      <p style="mso-table-lspace:0; mso-table-rspace:0; margin:0">
                        {{@@$data['email']}}
                      </p>
                    </td>
                  </tr>
                </table>
              </td>                            
            </tr>
          </table>
          <!-- End 2 Column Images & Text Side by SIde -->

          <!-- 2 Column Images & Text Side by SIde -->
          <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:-1px auto 0;">
            <tr>
              <td style="padding:0 25px 0">
                <table align="left" width="50%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                  <tr>
                    <td valign="top" align="left" class="left" style="border: 1px solid #E3E3E3; padding: 10px;">
                      <p style="mso-table-lspace:0; mso-table-rspace:0; margin:0">
                        Phone
                      </p>
                    </td>
                  </tr>
                </table>

                <table align="right" width="50%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                  <tr>
                    <td valign="top" align="left" class="left"  style="border: 1px solid #E3E3E3; padding: 10px;">
                      <p style="mso-table-lspace:0; mso-table-rspace:0; margin:0">
                        {{@@$data['phone']}}
                      </p>
                    </td>
                  </tr>
                </table>
              </td>                            
            </tr>
          </table>
          <!-- End 2 Column Images & Text Side by SIde -->

          

          <!-- 2 Column Images & Text Side by SIde -->
          <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:-1px auto 0;">
            <tr>
              <td style="padding:0 25px 0">
                <table align="left" width="50%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                  <tr>
                    <td valign="top" align="left" class="left" style="border: 1px solid #E3E3E3; padding: 10px;">
                      <p style="mso-table-lspace:0; mso-table-rspace:0; margin:0">
                        Message 
                      </p>
                    </td>
                  </tr>
                </table>

                <table align="right" width="50%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                  <tr>
                    <td valign="top" align="left" class="left"  style="border: 1px solid #E3E3E3; padding: 10px;">
                      <p style="mso-table-lspace:0; mso-table-rspace:0; margin:0">
                        {{@$data['message']}}
                      </p>
                    </td>
                  </tr>
                </table>
              </td>                            
            </tr>
          </table>
          <!-- End 2 Column Images & Text Side by SIde -->



          




          






          <!-- 4 Columns -->
          <!-- <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
              <td bgcolor="#001F73" style="padding:10px 0">
                <table width="600" border="0" cellpadding="10" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
                                    <tr>
                                        <td valign="top" style=" vertical-align: top; text-align:center" class="center">
                                            <a href="{{@$data['facebook_link']}}" style="margin: 0 10px;"><img src="{{asset('public/assets/images/facebook.png')}}" alt="Facebook" title="Facebook" border="0" /></a>
                                            <a href="{{@$data['twitter_link']}}" style="margin: 0 10px;"><img src="{{asset('public/assets/images/twitter.png')}}"  alt="Twitter" title="Twitter" border="0" /></a>
                                            <a href="{{@$data['instagram_link']}}" style="margin: 0 10px;"><img src="{{asset('public/assets/images/Instagram.png')}}" alt="Instagram" title="Instagram" border="0" /></a>
                                        </td>
                                    </tr>
                </table>
              </td>
            </tr>
          </table> -->
          <!-- End 4 Columns -->


                    
        </td>
      </tr>
    </table>
    <!-- End Wrapper -->
  </body>
</html>