<h1>{{ settings('app_name') }}</h1>
<p>Trade Updated</p>

<p>Trade is updated by the {{ $user->first_name}} {{ $user->last_name }} </p>

<p><a href="{{ route('inventory.trade-list-view-detail',$stock) }}">Views Detail - {{ route('inventory.trade-list-view-detail',$stock) }}</a></p>

<p>Stock Number is : {{ $stock }}</p>
<p>{{$tradeUpdated}} </p>

@lang('app.many_thanks'), <br/>
{{ settings('app_name') }}
