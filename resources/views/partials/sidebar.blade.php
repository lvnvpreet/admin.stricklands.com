<div data-scroll-to-active="true" class="main-menu menu-fixed  menu-bordered menu-dark menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}">
                    <i class="ft-home"></i>
                    <span data-i18n="" class="menu-title">Dashboard</span>
                </a>
            </li>

           @if(isset($slaes_percent))
                <li class="nav-item">
                    <div class="p-1">
                        <div class="px-1 pb-1" style="background-color: #344054;">
                            <small>Sales Projection for you</small>
                            <div class="progress mb-0">
                                <div class="progress-bar {{ ($slaes_percent < 95) ? (($slaes_percent >= 50) ? 'bg-warning' : 'bg-danger' ) : 'bg-primary' }}" role="progressbar" aria-valuenow="{{ round($slaes_percent,0) }}" aria-valuemin="{{ round($slaes_percent,0) }}" aria-valuemax="100" style="width:{{ round($slaes_percent,0) }}%; max-width: 100%">{{ round($slaes_percent,0) }}%</div>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
            @if(auth()->user()->details && auth()->user()->details->fld_usr_cat == 3)
                <li class="nav-item">
                    <a href="{{ route('sales-tracking-list',auth()->user()->details->fld_usr_location) }}?emp_id={{ auth()->user()->details->id }}">
                        <i class="fa fa-bar-chart"></i>
                        <span data-i18n="" class="menu-title">My Car Sales</span>
                    </a>
                </li>
            @endif
            <li class="nav-item {{ strpos(url()->current(),'guest-tracking') ? 'open' : '' }}">
                <a href="#"><i class="fas fa-link"></i><span data-i18n="" class="menu-title">Guest Tracking</span></a>
                <ul class="menu-content">
                    <li class="{{ strpos(url()->current(),'guest-tracking/5') ? 'active' : '' }}">
                        <a href="{{ route('guest-tracking',['location' => 5])}}" target="new">Stratford Toyota</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'guest-tracking/8') ? 'active' : '' }}">
                        <a href="{{ route('guest-tracking',['location' => 8])}}" target="new">Brantford GM</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'guest-tracking/1') ? 'active' : '' }}">
                        <a href="{{ route('guest-tracking',['location' => 1])}}" target="new">Stratford's Stratford</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'guest-tracking/2') ? 'active' : '' }}">
                        <a href="{{ route('guest-tracking',['location' => 2])}}" target="new">Stratford's Windsor</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'guest-tracking/7') ? 'active' : '' }}">
                        <a href="{{ route('guest-tracking',['location' => 7])}}" target="new">Stratford's Brantford</a>
                    </li>
                    
                    <li class="{{ strpos(url()->current(),'guest-tracking/all') ? 'active' : '' }}">
                        <a href="{{ route('guest-tracking',['location' => 'all'])}}" target="new">All Locations</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ strpos(url()->current(),'inventory') ? 'open' : '' }}">
                <a href="#"><i class="ft-layout"></i><span data-i18n="" class="menu-title">Inventory</span></a>
                <ul class="menu-content">
                    <li class="{{ strpos(url()->current(),'inventory/search') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('inventory.search') }}" class="menu-item">Search</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'inventory/4days') ? 'active' : '' }}">
                        <a href="{{ route('inventory.4days') }}" class="menu-item">4 Days</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'inventory/14days') ? 'active' : '' }}">
                        <a href="{{ route('inventory.14days') }}" class="menu-item">14 Days</a>
                    </li>
                    @permission('inventory.print')
                    <li class="{{ strpos(url()->current(),'inventory/print') ? 'active' : '' }}">
                        <a href="{{ route('inventory.print') }}" class="menu-item">Print</a>
                    </li>
                    @endpermission

                    @permission('inventory.count')
                    <li class="{{ strpos(url()->current(),'inventory/count') ? 'active' : '' }}">
                        <a href="{{ route('inventory.count') }}" class="menu-item">Inventory Count</a>
                    </li>
                    @endpermission

                    @permission('inventory.description')
                    <li class="{{ strpos(url()->current(),'inventory/description') ? 'active' : '' }}">
                        <a href="{{ route('inventory.description') }}" class="menu-item">Inventory Descriptions</a>
                    </li>
                    @endpermission

                    <li class="{{ strpos(url()->current(),'inventory/vehicles-at-auction') ? 'active' : '' }}">
                        <a href="{{ route('.vehicle.auction') }}" class="menu-item">Vehicles at Auction</a>
                    </li>
                    @if(Auth::user()->details->fld_tradein_level == 1 ||Auth::user()->details->fld_auction_level == 1)
                    <li class="{{ strpos(url()->current(),'inventory/tradein-list') ? 'active' : '' }}">
                        <a href="{{ route('.trade-list') }}" class="menu-item">Trade In List</a>
                    </li>

                    <li class="{{ strpos(url()->current(),'inventory/trade-in-list-view') ? 'active' : '' }}">
                        <a href="{{ route('inventory.trade-list-view') }}" class="menu-item">Trade In List View</a>
                    </li>
                    @endif

                    <li class="{{ strpos(url()->current(),'inventory/used-vehicle') ? 'active' : '' }}">
                        <a href="{{ route('inventory.used.vehicle') }}" class="menu-item">Used Vehicle</a>
                    </li>
                    
                    @if(auth()->user()->details && auth()->user()->details->fld_usr_cat == 1)
                    <li class="{{ strpos(url()->current(),'inventory/hidden-vehicle') ? 'active' : '' }}">
                        <a href="{{ route('.hidden.vehicle') }}" class="menu-item">Hidden Vehicles</a>
                    </li>
                        @elseif(auth()->user()->details && auth()->user()->details->fld_usr_cat == 9)
                        <li class="{{ strpos(url()->current(),'inventory/hidden-vehicle') ? 'active' : '' }}">
                            <a href="{{ route('.hidden.vehicle') }}" class="menu-item">Hidden Vehicles</a>
                        </li>
                    @endif
                    <li class="{{ strpos(url()->current(),'inventory/calculator') ? 'active' : '' }}">
                        <a href="{{ route('vehicle.calculator') }}" class="menu-item">Calculator</a>
                    </li>
                </ul>
            </li>

            @permission('sales-tracking')
            <li class="nav-item {{ strpos(url()->current(),'sales-tracking') ? 'open' : '' }}">
                <a href="#"><i class="fa fa-bar-chart"></i><span data-i18n="" class="menu-title">Sales Tracking</span></a>
                <ul class="menu-content">
{{--                    @can('sales-tracking',5)--}}
                        <!--<li class="{{ strpos(url()->current(),'sales-tracking/5') ? 'active' : '' }}">-->
                        <!--    <a target="_self" href="{{ url('sales-tracking') }}/5">Strickland's Stratford</a>-->
                        <!--</li>-->
{{--                    @endcan--}}

{{--                    @can('sales-tracking',1)--}}
                        <li class="{{ strpos(url()->current(),'sales-tracking/1') ? 'active' : '' }}">
                            <a target="_self" href="{{ url('sales-tracking') }}/1">Strickland's Stratford</a>
                        </li>
{{--                    @endcan--}}

{{--                    @can('sales-tracking',5)--}}
                        <li class="{{ strpos(url()->current(),'sales-tracking/5') ? 'active' : '' }}">
                            <a target="_self" href="{{ url('sales-tracking') }}/5">Strickland's Toyota</a>
                        </li>
{{--                    @endcan--}}

{{--                    @can('sales-tracking',8)--}}
                        <li class="{{ strpos(url()->current(),'sales-tracking/8') ? 'active' : '' }}">
                            <a target="_self" href="{{ url('sales-tracking') }}/8">Brantford GM</a>
                        </li>
{{--                    @endcan--}}

{{--                    @can('sales-tracking',7)--}}
                        <li class="{{ strpos(url()->current(),'sales-tracking/7') ? 'active' : '' }}">
                            <a target="_self" href="{{ url('sales-tracking') }}/7">Strickland's Brantford</a>
                        </li>
{{--                    @endcan--}}

{{--                    @can('sales-tracking',2)--}}
                        <li class="{{ strpos(url()->current(),'sales-tracking/2') ? 'active' : '' }}">
                            <a target="_self" href="{{ url('sales-tracking') }}/2">Strickland's Windsor</a>
                        </li>
{{--                    @endcan--}}

                    <li class="{{ strpos(url()->current(),'sales-summary/funded') ? 'active' : '' }}">
                        <a target="_self" href="{{ url('sales-summary') }}/funded">Strickland's Funded Summary</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'sales-summary/posted') ? 'active' : '' }}">
                        <a target="_self" href="{{ url('sales-summary') }}/posted">Strickland's Posted Summary</a>
                    </li>
                    @if(auth()->user()->hasRole('superadmin'))
                    <li class="">
                        <a target="_self" href="{{ url('sales/tracking/commissions') }}">Commissions</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endpermission
            <li class=" nav-item {{ strpos(url()->current(),'delivery-schedule') ? 'open' : '' }}">
                <a href="#"><i class="fa fa-calendar"></i><span data-i18n="" class="menu-title">Delivery Schedule</span></a>
                <ul class="menu-content">
                @if(auth()->user()->details && auth()->user()->details->fld_usr_cat == 3)
                    <li class="{{ strpos(url()->current(),'delivery-schedule/5') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-schedule',[5]) }}" class="menu-item">Stratford Toyota</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'delivery-schedule/8') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-schedule',[8]) }}" class="menu-item">Brantford GMC</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'delivery-schedule/1') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-schedule',[1]) }}" class="menu-item">Strickland's Automart</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'delivery-schedule/7') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-schedule',[7]) }}" class="menu-item">Strickland's Brantford</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'delivery-schedule/2') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-schedule',[2]) }}" class="menu-item">Strickland's Windsor</a>
                    </li>
                    @else
                        <li class="{{ strpos(url()->current(),'delivery-schedule/5') ? 'active' : '' }}">
                            <a target="_self" href="{{ route('delivery-schedule',[5]) }}" class="menu-item">Stratford Toyota</a>
                        </li>
                        <li class="{{ strpos(url()->current(),'delivery-schedule/8') ? 'active' : '' }}">
                            <a target="_self" href="{{ route('delivery-schedule',[8]) }}" class="menu-item">Brantford GMC</a>
                        </li>
                        <li class="{{ strpos(url()->current(),'delivery-schedule/1') ? 'active' : '' }}">
                            <a target="_self" href="{{ route('delivery-schedule',[1]) }}" class="menu-item">Strickland's Automart</a>
                        </li>
                        <li class="{{ strpos(url()->current(),'delivery-schedule/7') ? 'active' : '' }}">
                            <a target="_self" href="{{ route('delivery-schedule',[7]) }}" class="menu-item">Strickland's Brantford</a>
                        </li>
                        <li class="{{ strpos(url()->current(),'delivery-schedule/2') ? 'active' : '' }}">
                            <a target="_self" href="{{ route('delivery-schedule',[2]) }}" class="menu-item">Strickland's Windsor</a>
                        </li>

                    {{--                    @permission('dlivery.manage')--}}
                    <li class="{{ strpos(url()->current(),'delivery-schedule/add') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-schedule-add') }}" class="menu-item">Add Delivery</a>
                    </li>
                        <li class="{{ strpos(url()->current(),'delivery-schedule/ff-delivery') ? 'active' : '' }}">
                            <a target="_self" href="{{ route('ff-delivery') }}" class="menu-item">FF Delivery</a>
                        </li>
{{--                    @endpermission--}}
                    @endif
                </ul>
            </li>
            @permission('delivery.list')
            <li class=" nav-item {{ (Route::currentRouteName() == 'delivery-history') ? 'open' : '' }}">
                <a href="#"><i class="fa fa-calendar"></i><span class="menu-title">Delivery History</span></a>
                <ul class="menu-content">
                    <li class="{{ strpos(url()->current(),'delivery-history/5') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-history',[5]) }}" class="menu-item">Stratford Toyota</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'delivery-history/8') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-history',[8]) }}" class="menu-item">Brantford GMC</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'delivery-history/1') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-history',[1]) }}" class="menu-item">Strickland's Automart</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'delivery-history/7') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-history',[7]) }}" class="menu-item">Strickland's Brantford</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'delivery-history/2') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('delivery-history',[2]) }}" class="menu-item">Strickland's Windsor</a>
                    </li>
                </ul>
            </li>
            @endpermission

            @php
                $unpostedMenu = Route::currentRouteName()
            @endphp
            @permission('unposted-sale')
            <li class=" nav-item {{ ($unpostedMenu == 'unposted-sale') ? 'open' : '' }}">
                <a href="#"><i class="fa fa-cogs"></i><span class="menu-title">Unposted Sale</span></a>
                <ul class="menu-content">
                    <li class="{{ ($unpostedMenu && strpos(url()->current(),'unposted-sale/5')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('unposted-sale',[5]) }}" class="menu-item">Stratford Toyota</a>
                    </li>
                    <li class="{{ ($unpostedMenu && strpos(url()->current(),'unposted-sale/8')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('unposted-sale',[8]) }}" class="menu-item">Brantford GMC</a>
                    </li>
                    <li class="{{ ($unpostedMenu && strpos(url()->current(),'unposted-sale/1')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('unposted-sale',[1]) }}" class="menu-item">Strickland's Automart</a>
                    </li>
                    <li class="{{ ($unpostedMenu && strpos(url()->current(),'unposted-sale/7')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('unposted-sale',[7]) }}" class="menu-item">Strickland's Brantford</a>
                    </li>
                    <li class="{{ ($unpostedMenu && strpos(url()->current(),'unposted-sale/2')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('unposted-sale',[2]) }}" class="menu-item">Strickland's Windsor</a>
                    </li>
                </ul>
            </li>
            @endpermission
            @permission('posted-sale')
            <li class=" nav-item {{ (Route::currentRouteName() == 'posted-sale') ? 'open' : '' }}">
                <a href="#"><i class="fa fa-cogs"></i><span class="menu-title">Posted Sale</span></a>
                <ul class="menu-content">
                    <li class="{{ (!$unpostedMenu && strpos(url()->current(),'posted-sale/5')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('posted-sale',[5]) }}" class="menu-item">Stratford Toyota</a>
                    </li>
                    <li class="{{ (!$unpostedMenu && strpos(url()->current(),'posted-sale/8')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('posted-sale',[8]) }}" class="menu-item">Brantford GMC</a>
                    </li>
                    <li class="{{ (!$unpostedMenu && strpos(url()->current(),'posted-sale/1')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('posted-sale',[1]) }}" class="menu-item">Strickland's Automart</a>
                    </li>
                    <li class="{{ (!$unpostedMenu && strpos(url()->current(),'posted-sale/7')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('posted-sale',[7]) }}" class="menu-item">Strickland's Brantford</a>
                    </li>
                    <li class="{{ (!$unpostedMenu && strpos(url()->current(),'posted-sale/2')) ? 'active' : '' }}">
                        <a target="_self" href="{{ route('posted-sale',[2]) }}" class="menu-item">Strickland's Windsor</a>
                    </li>
                </ul>
            </li>
            @endpermission

            @permission('vehicle-logistics')
            <li class=" nav-item {{ strpos(url()->current(),'vehicle-logistics') ? 'open' : '' }}">
                <a href="#"><i class="fa fa-random"></i><span data-i18n="" class="menu-title">{{ trans('menu.vehicle-logistics.') }}</span></a>
                <ul class="menu-content">
                    <li class="{{ strpos(url()->current(),'vehicle-logistics/search') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('vehicle-logistics.search') }}" class="menu-item">{{ trans('menu.vehicle-logistics.search-by-stock') }}</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'vehicle-logistics/checkin-vehicles') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('vehicle-logistics.checkin-vehicles') }}" class="menu-item">{{ trans('menu.vehicle-logistics.checkin-vehicles') }}</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'vehicle-logistics/pending-transfer-request') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('vehicle-logistics.pen-transfer') }}" class="menu-item">{{ trans('menu.vehicle-logistics.pen-trf-req') }}</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'vehicle-logistics/completed-transfer-request') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('vehicle-logistics.cmpl-transfer') }}" class="menu-item">{{ trans('menu.vehicle-logistics.cmplt-trf-req') }}</a>
                    </li>
                </ul>
            </li>
            @endpermission


{{--            @permission('image-statistics')--}}
            <li class=" nav-item ">
                <a href="{{ route('image-statistics') }}"><i class="fa fa-pie-chart"></i><span data-i18n="" class="menu-title">Image Statistics</span></a>
            </li>
{{--            @endpermission--}}
            {{--@endif--}}
            <li class=" nav-item {{ strpos(url()->current(),'contacts') ? 'open' : '' }}">
                <a href="#"><i class="fas fa-users"></i><span data-i18n="" class="menu-title">Contacts</span></a>
                <ul class="menu-content">
                    @permission('user.list')
                    <li class="{{ strpos(url()->current(),'contacts/locations/5') ? 'active' : '' }}">
                        <a target="_self" href="{{ route('user.list-by-location',5) }}" class="menu-item">Stratford Toyota</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'contacts/locations/8') ? 'active' : '' }}">
                        <a href="{{ route('user.list-by-location',8) }}" class="menu-item">Brantford GMC</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'contacts/locations/1') ? 'active' : '' }}">
                        <a href="{{ route('user.list-by-location',1) }}" class="menu-item">Strickland's Automart</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'contacts/locations/7') ? 'active' : '' }}">
                        <a href="{{ route('user.list-by-location',7) }}" class="menu-item">Strickland's Brantford</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'contacts/locations/2') ? 'active' : '' }}">
                        <a href="{{ route('user.list-by-location',2) }}" class="menu-item">Strickland's Windsor</a>
                    </li>
                    @endpermission

                    @permission('user.add')
                    <li class="{{ strpos(url()->current(),'contacts/user/create') ? 'active' : '' }}">
                        <a href="{{ route('user.create') }}" class="menu-item">Add Employee</a>
                    </li>
                    @endpermission

                    @permission('user.full_list')
                    <li class="{{ strpos(url()->current(),'contacts/list') ? 'active' : '' }}">
                        <a href="{{ route('user.list') }}" class="menu-item">Employee List</a>
                    </li>
                    @endpermission
                </ul>
            </li>
            {{--@if(auth()->user()->hasRole('superadmin'))--}}
            @permission('boardroom-listing')
            <li class="nav-item {{ strpos(url()->current(),'boardroom-schedule/stratford') ? 'open' : '' }}">
                <a href="#" class="menu-item"><i class="fa fa-clock"></i><span data-i18n="" class="menu-title">Stratford Boardroom</span></a>
                <ul class="menu-content">
                    <li class="{{ strpos(url()->current(),'boardroom-schedule/stratford/calendar-view') ? 'active' : '' }}">
                        <a href="{{ route('boardroom.calendar-view','stratford') }}" class="menu-item">Calendar View</a>
                    </li>
                    @permission('boardroom.manage-bookings')
                    <li class="{{ strpos(url()->current(),'boardroom-schedule/stratford/add') ? 'active' : '' }}">
                        <a href="{{ route('boardroom.add','stratford') }}" class="menu-item">Add Booking</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'boardroom-schedule/stratford/list') ? 'active' : '' }}">
                        <a href="{{ route('boardroom.list','stratford') }}" class="menu-item">Manage Bookings</a>
                    </li>
                    @endpermission
                </ul>
            </li>
            <li class="nav-item {{ strpos(url()->current(),'boardroom-schedule/brantford') ? 'open' : '' }}">
                <a href="#" class="menu-item"><i class="fa fa-clock"></i><span data-i18n="" class="menu-title">Brantford Boardroom</span></a>
                <ul class="menu-content">
                    <li class="{{ strpos(url()->current(),'boardroom-schedule/brantford/calendar-view') ? 'active' : '' }}">
                        <a href="{{ route('boardroom.calendar-view','brantford') }}" class="menu-item">Calendar View</a>
                    </li>
                    @permission('boardroom.manage-bookings')
                    <li class="{{ strpos(url()->current(),'boardroom-schedule/brantford/add') ? 'active' : '' }}">
                        <a href="{{ route('boardroom.add','brantford') }}" class="menu-item">Add Booking</a>
                    </li>
                    <li class="{{ strpos(url()->current(),'boardroom-schedule/brantford/list') ? 'active' : '' }}">
                        <a href="{{ route('boardroom.list','brantford') }}" class="menu-item">Manage Schedule</a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            <li class="nav-item {{ (request()->routeIs('support-ticket.*') || request()->routeIs('support-ticket')) ? 'open' : '' }}">
                <a href="#" class="menu-item"><i class="fa fa-clock"></i><span data-i18n="" class="menu-title">Support</span></a>
                <ul class="menu-content">
                    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('superadmin'))
                        <li class="{{ request()->routeIs('support-ticket.add') ? 'active' : '' }}">
                            <a href="{{ route('support-ticket.add') }}" class="menu-item">Add Support Ticket </a>
                        </li>
                        <li class="{{ request()->routeIs('support-ticket') ? 'active' : '' }}">
                            <a href="{{ route('support-ticket') }}" class="menu-item">Support Ticket </a>
                        </li>
                        <li class="{{ request()->routeIs('support-ticket.closed') ? 'active' : '' }}">
                            <a href="{{ route('support-ticket.closed') }}" class="menu-item">Closed Ticket</a>
                        </li>
                        @if(auth()->user()->hasRole('superadmin'))
                            <li class="{{ request()->routeIs('support-ticket.categories.*') ? 'active' : '' }}">
                                <a href="{{ route('support-ticket.categories.index') }}" class="menu-item">Support Categories</a>
                            </li>
                        @endif
                    @else
                        <li class="{{ request()->routeIs('support-ticket.add') ? 'active' : '' }}">
                            <a href="{{ route('support-ticket.add') }}" class="menu-item">Add Support Ticket </a>
                        </li>
                        <li class="{{ request()->routeIs('support-ticket') ? 'active' : '' }}">
                            <a href="{{ route('support-ticket') }}" class="menu-item">Support Ticket </a>
                        </li>
                        <li class="{{ request()->routeIs('support-ticket.open') ? 'active' : '' }}">
                            <a href="{{ route('support-ticket.open') }}" class="menu-item">Open Tickets</a>
                        </li>
                    @endif
                </ul>
            </li>
            @if(auth()->user()->hasRole('superadmin'))
                <li class=" nav-item {{ strpos(url()->current(),'settings') ? 'open' : '' }}">
                    <a href="#"><i class="ft-layout"></i><span data-i18n="" class="menu-title">Settings</span></a>
                    <ul class="menu-content">
                        <li class="{{ strpos(url()->current(),'#') ? 'active' : '' }}">
                            <a target="_self" href="{{ route('locations.list') }}" class="menu-item">Locations</a>
                        </li>
                        <li class="{{ strpos(url()->current(),'#') ? 'active' : '' }}">
                            <a target="_self" href="{{ route('payments.list') }}" class="menu-item">Payments</a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class=" nav-item {{ (request()->routeIs('hr-form.*') || request()->routeIs('hr-form')) ? 'open' : '' }}">
                <a href="#" class="menu-item"><i class="fa fa-pencil"></i>HR Form</a>
                <ul class="menu-content">
                    <li><a href="https://hr.humi.ca/login" target="_blank">Humi HRM</a></li>
                    <li class="{{ request()->routeIs('hr-form.policies-procedures') ? "active" : "" }}">
                        <a href="https://drive.google.com/file/d/1MgfrdW9R_x8gJHrDdVMgWir_wg8ZkYDJ/view?usp=sharing" target="_blank" class="menu-item">Policies & Procedures</a>
                    </li>
                    @permission('contract_request')
                    <li class="{{ request()->routeIs('hr-form.contract-request.create') ? "active" : "" }}">
                        <a href="{{ route('hr-form.contract-request.create') }}" class="menu-item">Contract Request Form</a>
                    </li>
                    <li class="{{ request()->routeIs('hr-form.contract-request-form') ? "active" : "" }}">
                        <a href="{{ route('hr-form.contract-request-form') }}" class="menu-item">Contract Request List</a>
                    </li>
                    <li class="{{ request()->routeIs('hr-form.contract') ? "active" : "" }}">
                        <a href="{{ route('hr-form.contract') }}" class="menu-item">Contract List</a>
                    </li>
                    @endpermission
                </ul>
            </li>
            {{--@endif--}}
            <li class=" nav-item ">
                <a href="https://stricklands.com:2096/" target="_blank"><i class="fas fa-envelope"></i><span data-i18n="" class="menu-title">Webmail</span></a>
            </li>
            <li class=" nav-item ">
                <a href="https://www.missionsales.ca/showroom/198790" target="_blank"><i class="fas fa-external-link-square-alt"></i><span data-i18n="" class="menu-title">Uniform eStore</span></a>
            </li>

            <li class=" nav-item ">
                <a href="#"><i class="fas fa-link"></i><span data-i18n="" class="menu-title">Links</span></a>
                <ul class="menu-content">
                    <li>
                        <a href="https://apps.vinmanager.com/CarDashboard/vslogin.aspx" target="new">Vin Solutions</a>
                    </li>
                    <li>
                        <a href="https://pts.lightspeedvt.com/" target="_blank">RAM Training</a>
                    </li>
                    <li>
                        <a href="http://www.ucdasearches.com/" target="_blank">UCDA Login</a>
                    </li>
                    <li>
                        <a href="http://www.autotrader.ca/" target="_blank">Auto Trader</a>
                    </li>
                    <li>
                        <a href="http://adesa.ca/home" target="_blank">Adesa Login</a>
                    </li>
                    <li>
                        <a href="https://fcr-ccc.nrcan-rncan.gc.ca/en" target="_blank">Fuel Economy</a>
                    </li>
                    <li>
                        <a href="http://www.stratfordtoyota.com/" target="_blank">Stratford Toyota</a>
                    </li>
                    <li>
                        <a href="http://www.stricklandsgmc.com/" target="_blank">Brantford GMC</a>
                    </li>
                    <li>
                        <a href="http://www.stricklandautosales.com/" target="_blank">Strickland's Automart</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
