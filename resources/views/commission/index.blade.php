@extends('layouts.app')

@section('page-title', 'Sales Commission')

@section('content')
    <div class="content-body">
        <div class="basic-elements">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" id="step-1">
                        <div class="card-header">
                            <div class="card-title">Commission Calculator</div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form">
                                    <div class="form-body">
                                        <h4 class="form-section">
                                            Filter
                                        </h4>
                                        <div class="row">
                                            <div class="col-xs-2 mb-1">
                                                <fieldset class="form-group position-relative">
                                                   <label for="month">Select Month <span style="color:red;">*</span></label>
                                                    <select class="form-control" id="month" name="month" required>
                                                        <option value="">Select Month</option>
                                                        @foreach(getMonths() as $key => $month)
                                                            <option @if(request()->has('month') && request()->get('month')==$key) selected @endif value="{{ $key }}" >{{ $month }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-xs-2 mb-1">
                                                <fieldset class="form-group position-relative">
                                                    <label for="sales">Enter Sales Rep <span style="color:red;">*</span></label>
                                                    <select class="form-control" name="rep" required>
                                                        <option value=""> Select</option>
                                                      @foreach($users as $user)
                                                      <option @if(request()->has('rep') && request()->get('rep')==$user->id) selected @endif value="{{$user->id}}" >{{ $user->fld_usr_fname ." ". $user->fld_usr_lastname }}</option>
                                                      @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-xs-2 mb-1">
                                                <fieldset class="form-group position-relative">
                                                    <label for="team">Select Team <span style="color:red;">*</span></label>
                                                    <select class="form-control" id="team" name="team" required>
                                                      @foreach($teams as $key => $team)
                                                        <option @if(request()->has('team') && request()->get('team')==$key) selected @endif value="{{ $key }}">{{$team}}</option>
                                                      @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-2 mb-1">
                                                <fieldset class="form-group position-relative">
                                                    <label for="">Add stiff/bonus</label>
                                                    <input type="number" value="{{ request()->get('bonus') }}" name="bonus" class="form-control" id="bonus">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1 pt-2">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check-square-o"></i> Submit
                                                </button>
                                            </div>
                                        </div>

                                        @if(isset($salesman) && count($salesman))
                                            <h4 class="form-section">
                                                INDIVIDUAL BONUS CALCULATION - <strong>{{ $salesman['name'] ?? '' }}</strong>
                                                <strong style="float: right;color: darkgreen;">Grand Total:- ${{ $salesman['grand_total'] ?? '' }}</strong>
                                            </h4>
                                            <div class="row">
                                                <div class="col-xs-12 text-center">
                                                    <table class="table table-bordered" style="width: 100%">
                                                        <tr>
                                                            <th>Used Funded</th>
                                                            <th>New Funded</th>
                                                            <th>Total Funded</th>
                                                            <th>Car Allow.</th>
                                                            <th>New Car Bonus</th>
                                                            <th>Tier Bonus</th>
                                                            <th>Vol. Bonus</th>
                                                            <th width="20%">TOTAL</th>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $salesman['used_funded'] ?? 0 }}</td>
                                                            <td>{{ $salesman['new_funded'] ?? 0 }}</td>
                                                            <td>{{ $salesman['total_funded'] ?? 0 }}</td>
                                                            <td>${{ $salesman['car_allowance'] ?? 0 }}</td>
                                                            <td>${{ $salesman['new_car_bonus'] ?? 0 }}</td>
                                                            <td>${{ $salesman['tier_bonus'] ?? 0 }}</td>
                                                            <td>${{ $salesman['vol_bonus'] ?? 0 }}</td>
                                                            <td>${{ $salesman['indv_total'] ?? 0 }}</td>
                                                        </tr>

                                                    </table>

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6 text-center">
                                                    <h4 class="form-section text-left">INNER TEAM BONUS CALCULATION</h4>
                                                    <table class="table table-bordered" style="width: 100%">
                                                        <tr>
                                                            <th>Rep Name</th>
                                                            <th>Funded</th>
                                                            <th>Rep Bonus</th>
                                                        </tr>
                                                        @if(isset($teamsdata[request()->get('team')]))
                                                        @foreach($teamsdata[request()->get('team')]['users'] as $user)
                                                            <tr>
                                                                <td>{{ $user['name'] }}</td>
                                                                <td>{{ $user['total_funded'] ?? 0 }}</td>
                                                                <td>${{ $user['rep_team_bonus'] ?? 0 }}</td>
                                                            </tr>
                                                        @endforeach
                                                            <tr>
                                                                <td>Total</td>
                                                                <td>{{ $teamsdata[request()->get('team')]['total_funded'] ?? 0 }}</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Team Avg.</td>
                                                                <td>{{ $teamsdata[request()->get('team')]['avg_sale'] ?? 0 }}</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Team Bonus</td>
                                                                <td>${{ $teamsdata[request()->get('team')]['team_bonus'] ?? 0 }}</td>
                                                                <td></td>
                                                            </tr>
                                                        @endif
                                                    </table>

                                                </div>
                                                <div class="col-xs-6 text-center">
                                                    <h4 class="form-section text-left">TARGET BONUS CALCULATION</h4>
                                                    <table class="table table-bordered" style="width: 100%">
                                                        <tr>
                                                            <th>Rep Funded</th>
                                                            <th>Team Funded</th>
                                                            <th>Team Target</th>
                                                            <th>% of Target Fund</th>
                                                            <th>Target Bonus</th>
                                                            <th>Rep Bonus</th>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $targetbonus['rep_funded'] ?? 0 }}</td>
                                                            <td>{{ $targetbonus['team_funded'] ?? 0 }}</td>
                                                            <td>{{ $targetbonus['team_target'] ?? 0 }}</td>
                                                            <td>{{ $targetbonus['target_percent'] ?? 0 }}%</td>
                                                            <td>${{ $targetbonus['target_bonus'] ?? 0 }}</td>
                                                            <td>${{ $targetbonus['rep_bonus'] ?? 0 }}</td>
                                                        </tr>

                                                    </table>

                                                </div>

                                            </div>

                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
