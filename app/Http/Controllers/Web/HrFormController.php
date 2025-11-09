<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\ContractCreateRequest;
use Vanguard\Models\Employee;

class HrFormController extends Controller
{
    /**
     * HrFormController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:contract_request');
    }

    public function createForm(Employee $empReq)
    {
        return view('hr-forms.create-request',compact('empReq'));
    }

    public function saveForm(ContractCreateRequest $request,Employee $employee)
    {
        $data = $request->only($employee->getFillable());

        if($employee->exists){

            $employee->update($data);
            return redirect()->route('hr-form.contract-request-form')->withSuccess("Employe Request was successfully updated.");

        }else{

            $employee->fill($data);
            $employee->contract_made = 0;
            $employee->save();
            return redirect()->route('hr-form.contract-request-form')->withSuccess("Employe Request was successfully created.");
        }

    }

    public function contractRequest()
    {
        $employeeRequests = Employee::where('contract_made','<>',1)->get();
        return view('hr-forms.employee-request',compact('employeeRequests'));
    }

    public function contracts()
    {
        $employeeRequests = Employee::where('contract_made','=',1)->get();
        return view('hr-forms.employee-request',compact('employeeRequests'));
    }
//    public function policyProcedure()
//    {
//        return view('hr-forms.policies-procedures');
//    }

    public function chagneStatus(Employee $empReq)
    {
        $empReq->contract_made = 1;
        $empReq->save();

        return response()->json(['msg'=>'Record was successfully updated.']);
    }

    public function delete(Request $request){
        $emp = Employee::findOrFail($request->id);
        $emp->delete();
        return response()->json(['msg'=>'Selected record deleted successfully.']);
    }
}
