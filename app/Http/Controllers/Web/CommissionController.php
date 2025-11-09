<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Models\Delivery;
use Vanguard\Models\Locations;
use Vanguard\Models\Userdetails;
use Vanguard\Models\Vehicles;
use Vanguard\User;
use Yajra\DataTables\Facades\DataTables;
use Vanguard\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

class CommissionController extends Controller
{
    
    /**
     * @var int All Trie Bonus values
     */
    protected $tier_bonus_13 = 50;
    protected $tier_bonus_14 = 75;
    protected $tier_bonus_17 = 100;
    protected $tier_bonus_19 = 125;
    protected $tier_bonus_22 = 150;
    protected $tier_bonus_25 = 175;
    protected $tier_bonus_29 = 200;
    
    /**
     * Team bonus values
     */
    protected $team_bonus_12 = 1000;
    protected $team_bonus_16 = 3500;
    protected $team_bonus_20 = 5000;
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    private function getTierBonus($total){
        
        if($total >= 13 && $total <=14) return $total*$this->tier_bonus_13;
        if($total > 14 && $total <= 17)  return $total*$this->tier_bonus_14;
        if($total > 17 && $total <= 19)  return $total*$this->tier_bonus_17;
        if($total > 19 && $total <= 22)  return $total*$this->tier_bonus_19;
        if($total > 22 && $total <= 25)  return $total*$this->tier_bonus_22;
        if($total > 25 && $total <= 29)  return $total*$this->tier_bonus_25;
        if($total > 29)  return $total*$this->tier_bonus_29;
        
        return 0;
        
    }
    
    private function getVolBonus($total){
        
        if($total > 19 && $total <= 24) return 400;
        if($total > 24 && $total <= 29) return 800;
        if($total > 29) return 1600;
        
        return 0;
    }
    
    private function getNewCarBonus($new,$total){
        
        if($new > 7 && $total > 12) return 500;
        return 0;
    }
    
    private function getCarAllowance($total){
        
        if($total >= 13) return 400;
        return 0;
    }
    
    
    private function getTeamBonus($total){
        
        if($total >= 12 && $total < 16) return $this->team_bonus_12;
        if($total >= 16 && $total < 20) return $this->team_bonus_16;
        if($total >= 20) return $this->team_bonus_20;
        
        return 0;
    }
    
    private function getTargetBonus($total){
        
        if($total >= 100 && $total < 105) return 5000;
        if($total >= 105 && $total < 110) return 6500;
        if($total >= 110) return 9000;
        
        return 0;
    }
    
    public function index(Request $request)
    {
        $usersdata      =   [];
        $teamsdata      =   [];
        $salesman       =   null;
        $targetbonus    =   [];
        
        if($request->filled('month') && $request->filled('rep') && $request->filled('team')){
            
            $year       =   date('Y');
            $month      =   $request->get('month');
            $date       =   Carbon::createFromDate($year,$month);
            $start_date =   $date->firstOfMonth()->format('Y-m-d');
            $end_date   =   $date->lastOfMonth()->format('Y-m-d');
            
            $rep        =   $request->get('rep');
            $bonus      =   $request->get('bonus')? $request->get('bonus') : 0;
            $repuser    =   Userdetails::findOrFail($rep);
            //$userData = User::with('details')->findOrFail($request->team);
            //fld_usr_level
            //$team       =   $userData->details->fld_usr_level;
            
            $team = $request->team;
            
            $TotalDeliveryOfLocation = Delivery::where('fld_date','>=',$start_date)
                ->where('fld_date','<=',$end_date)
                ->where('s_spare','No')
                ->where('fld_funded','<>','No')
                ->get();
            
            $TotalDeliveryOfLocation = $TotalDeliveryOfLocation->map(function($delivery) use (&$usersdata){
                
                $status = ($delivery->fld_new_used == 1) ? "new_funded" : "used_funded";
                
                if(!isset($usersdata[$delivery->fld_sperson][$status])){
                    $usersdata[$delivery->fld_sperson][$status] = 0;
                }
                
                if($delivery->fld_sperson2){
                    if(!isset($usersdata[$delivery->fld_sperson2][$status])){
                        $usersdata[$delivery->fld_sperson2][$status] = 0;
                    }
                    
                    $usersdata[$delivery->fld_sperson2][$status] += 0.5;
                    $usersdata[$delivery->fld_sperson][$status] += 0.5;
                }else{
                    $usersdata[$delivery->fld_sperson][$status] += 1;
                }
            });
            
            ksort($usersdata);
            
            $users = Userdetails::whereNotNull('fld_team_role')
                ->where('fld_team_role','<>',0)
                ->where('fld_usr_cat',3)
                ->orderBy('fld_usr_target','DESC')
                ->get();
            
            foreach ($users as $user){
                if(!isset($usersdata[$user->id]['new_funded'])){
                    $usersdata[$user->id]['new_funded'] =   0;
                }
                
                if(!isset($usersdata[$user->id]['new'])){
                    $usersdata[$user->id]['new'] =   0;
                }
                
                if(!isset($usersdata[$user->id]['used_funded'])){
                    $usersdata[$user->id]['used_funded'] =   0;
                }
                
                $usersdata[$user->id]['name']            =   $user->fld_usr_fname.' '.$user->fld_usr_lastname;
                $usersdata[$user->id]['extra_bonus']     =   $bonus;
                $usersdata[$user->id]['new_target']      =   $user->fld_new_target;
                $usersdata[$user->id]['used_target']     =   $user->fld_usr_target;
                $usersdata[$user->id]['total_funded']    =   $usersdata[$user->id]['new_funded']+$usersdata[$user->id]['used_funded'];
                $usersdata[$user->id]['tier_bonus']      =   $this->getTierBonus($usersdata[$user->id]['total_funded']);
                $usersdata[$user->id]['vol_bonus']       =   $this->getVolBonus($usersdata[$user->id]['total_funded']);
                $usersdata[$user->id]['car_allowance']   =   $this->getCarAllowance($usersdata[$user->id]['total_funded']);
                $usersdata[$user->id]['new_car_bonus']   =   $this->getNewCarBonus($usersdata[$user->id]['new'],$usersdata[$user->id]['total_funded']);
                $usersdata[$user->id]['indv_total']      =   $usersdata[$user->id]['car_allowance']+$usersdata[$user->id]['vol_bonus']+$usersdata[$user->id]['new_car_bonus']+$usersdata[$user->id]['tier_bonus'];
                $usersdata[$user->id]['grand_total']     =   $usersdata[$user->id]['indv_total']+$bonus;
                
                
                $teamsdata[$user->fld_team_role]['users'][$user->id]    =   $usersdata[$user->id];
                if(!isset($teamsdata[$user->fld_team_role]['total_funded']))
                    $teamsdata[$user->fld_team_role]['total_funded'] = 0;
                
                $teamsdata[$user->fld_team_role]['total_funded']   +=  $usersdata[$user->id]['total_funded'];
                
                if(!isset($targetbonus['team_target']))
                    $targetbonus['team_target'] = 0;
                
                if(!isset($targetbonus['team_funded']))
                    $targetbonus['team_funded'] = 0;
                
                $targetbonus['team_target']  += $user->fld_new_target+$user->fld_usr_target;
                $targetbonus['team_funded']  += $usersdata[$user->id]['total_funded'];
                
            }
            
            foreach($teamsdata as $id => $teamsdatum){
                if($teamsdatum['total_funded']>0){
                    $teamsdata[$id]['avg_sale']     = round($teamsdatum['total_funded']/count($teamsdatum['users']),2);
                    $teamsdata[$id]['team_bonus']   = round($this->getTeamBonus($teamsdata[$id]['avg_sale']),2);
                    
                    if($teamsdata[$id]['team_bonus']>0){
                        foreach ($teamsdatum['users'] as $uid => $user){
                            $teamsdata[$id]['users'][$uid]['rep_team_bonus']    =    round(($user['total_funded']/$teamsdatum['total_funded'])*$teamsdata[$id]['team_bonus'],2);
                            $teamsdata[$id]['users'][$uid]['grand_total']       +=   round($teamsdata[$id]['users'][$uid]['rep_team_bonus'],2);
                        }
                    }
                }
            }
            $targetbonus['rep_bonus'] = 0;
            if(count($teamsdata)){
                if(isset($teamsdata[$team]['users'][$repuser->id])){
                    $targetbonus['rep_funded']          =   $teamsdata[$team]['users'][$repuser->id]['total_funded'];
                }else{
                    $targetbonus['rep_funded']          =   0;
                }
                
                $targetbonus['target_percent']      =   round(($targetbonus['team_funded']/$targetbonus['team_target'])*100,2);
                $targetbonus['target_bonus']        =   $this->getTargetBonus($targetbonus['target_percent']);
                
                if($targetbonus['team_funded']>0)
                    $targetbonus['rep_bonus']           =   round(($targetbonus['rep_funded']/$targetbonus['team_funded'])*$targetbonus['target_bonus'],2);
                
                if(isset($teamsdata[$team]['users'][$repuser->id])){
                    $teamsdata[$team]['users'][$repuser->id]['grand_total'] += $targetbonus['rep_bonus'];
                    $salesman   =   $teamsdata[$team]['users'][$repuser->id];
                }
                
            }
        }
        if($salesman==null){
            $salesman['grand_total'] = 0.0;
        }
        
        $users = Userdetails::where('fld_usr_cat',3)
            //->orderByRaw('fld_usr_fname ASC','fld_usr_lastname ASC')
            ->orderBy('fld_usr_fname','ASC')
            ->get();
        $teams = getAllTeams();
        
        return view('commission.index',compact('users','teams','usersdata','teamsdata','salesman','targetbonus'));
    }
    
}
