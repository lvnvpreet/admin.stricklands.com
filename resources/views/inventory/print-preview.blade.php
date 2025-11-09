<!doctype html>
<html lang="en">
<head>
{!! HTML::style("assets/css/printable_tables.css") !!}
</head>
<body class="body">
<div align="center">
    <table width="750" border="0" cellpadding="2" cellspacing="0" class="table">
        <tr>
            <td  colspan="8"></td>
        </tr>
        <tr class="trclassbar">
            <td width="281" nowrap="nowrap" class="trclassbar"><div align="left"><span>
             <a href="{{ route('inventory.print') }}">&nbsp;Year/Make/Model - Back to List- {{ $vehicles->count() }} Vehicles</a></div></td>
            <td width="36" nowrap="nowrap" class="trclassbar"><div align="center">Trader</div></td>
            <td width="47" nowrap="nowrap" class="trclassbar"><div align="center">
                    STK</td>

            <td width="36" nowrap="nowrap" class="trclassbar"><div align="center">Loc</div></td>
            <td width="36" nowrap="nowrap" class="trclassbar"><div align="center">Code</div></td>
            <td width="33" nowrap="nowrap" class="trclassbar"><div align="center">VIN</div></td>
            <td width="57" nowrap="nowrap" class="trclassbar"><div align="left">Color</div></td>
            <td width="66" nowrap="nowrap" class="trclassbar"><div align="center">KM</div></td>
            <td width="62" nowrap="nowrap" class="trclassbar"><div align="center">Price</div></td>
        </tr>
        @if(isset($vehicles) && count($vehicles))
            @foreach($vehicles as $vehicle)
            <tr bgcolor="{{  ($loop->iteration % 2 == 0) ? '#f5f5f5' : '#e3e3e3' }}" >
                <td nowrap="nowrap" class="trclassbar"><div align="left">{{ $vehicle->fldYear }} {{ $vehicle->fldMake }} {{ $vehicle->fldModel }} {{ $vehicle->fldModelNo }} 
                    @if($vehicle->fldKey1!= "")> - {{ $vehicle->fldKey1 }}  @endif
                        @if(strpos($vehicle->fldCode, 'P') !== false) - P @endif
                    </div>
                </td>
                <td align="left" valign="top" nowrap="nowrap" class="trclassbar">&nbsp;</td>
                <td align="left" valign="top" nowrap="nowrap" class="trclassbar"><div align="center">{{ $vehicle->fldStockNo }}</div></td>
                <td align="center" valign="top" nowrap="nowrap" class="trclassbar"><div align="center" >
                        <div align="center">{{ $vehicle->fldLocationCode }}</div>
                    </div>
                </td>
                <td align="center" valign="top" nowrap="nowrap" class="trclassbar"><div align="center">{{ $vehicle->fldCode }}</div></td>
                <td align="center" valign="top" nowrap="nowrap" class="trclassbar"><div align="center">{{ $vehicle->fldShortVINNo }}</div></td>
                <td align="center" valign="top" nowrap="nowrap" class="trclassbar"><div align="left" class="capitalize">{{ strtolower($vehicle->fldExteriorColor) }}</div></td>
                <td align="center" valign="top" nowrap="nowrap" class="trclassbar"><div align="center">{{ $vehicle->fldOdometer }}</div></td>
                <td align="center" valign="top" nowrap="nowrap" class="trclassbar"><div align="left">${{ number_format($vehicle->fldRetail,0,'.',',') }} - {{$vehicle->fldCode }}</div></td>
            </tr>
            @endforeach
        @endif
    </table>

</div>
</body>
</html>
