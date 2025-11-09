<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{{ $locationName }}</title>

<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 {font-size: 12px}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<p align="left" class="style3">
  <a href="{{ route('list-barcode') }}?location=NH" >Strickland's  Not Here</a>   |  
  <a href="{{ route('list-barcode') }}?location=E" >Strickland's Automart Stratford</a>   |  
  <a href="{{ route('list-barcode') }}?location=BG" >Brantford GMC</a>   | 
  <a href="{{ route('list-barcode') }}?location=W" >Strickland's  Windsor </a>   | 
  <a href="{{ route('list-barcode') }}?location=P" >Plated Vehicles</a>
</p>
<div align="left">
  @php $counter = 0; @endphp
  @foreach($vehicles as $vehicle)
    @php
      $name = "/home/adminstrick/images.stricklands.com/vin/";
      $name .= $vehicle->fldStockNo;
      $name .= "-1.jpg";
    @endphp
    @if(!file_exists($name))
    <table width="340" border="1" cellpadding="4" class="greyborder">
      <tr>
            <td width="324" valign="top" nowrap="nowrap" class="contact_text"><table width="328" border="0" cellpadding="4">
              <tr>
                <td width="36" rowspan="3" valign="top" nowrap="nowrap" class="contact_text style1 style2"><img src="/render-barcode?barcode={{ $vehicle->fldStockNo }}&amp;width=300&amp;height=70" class="style1" /></td>
                <td width="270" valign="top" nowrap="nowrap" class="contact_text style1 style2"><strong>{{ $vehicle->fldYear.' '.$vehicle->fldMake.' '.$vehicle->fldModel }}</strong></td>
              </tr>
              <tr>
                <td valign="top" nowrap="nowrap" class="contact_text style1 style2"><strong>{{ $vehicle->fldExteriorColor }}</strong> - <span class="style2 style1 11caps"><strong>${{ $vehicle->fldRetail }}</strong></span></td>
              </tr>
              <tr>
                <td valign="top" nowrap="nowrap" class="contact_text style1 style2"><div align="left"><strong>Stk #: {{ $vehicle->fldStockNo }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VIN#{{ $vehicle->fldShortVINNo }}</strong></div></td>
              </tr>
              <tr>
                <td valign="top" nowrap="nowrap" class="contact_text style1 style2">&nbsp;</td>
                <td valign="top" nowrap="nowrap" class="contact_text style1 style2">
                  <strong>
                    @if($vehicle->fldCode == 'A')
                      As Is
                    @elseif($vehicle->fldCode == "SS")
                      Simply Saftey
                    @endif
                  </strong>
                </td>
              </tr>
              <tr>
                <td valign="top" nowrap="nowrap" class="contact_text style1 style2"></td>
                <td valign="top" nowrap="nowrap" class="contact_text style1 style2"></td>
              </tr>
            </table></td>
        </tr>
      </table>
      @php $counter ++; @endphp
    @endif    
  @endforeach
</div>
</body>
</html>
{{ $counter }} cars without pictures
