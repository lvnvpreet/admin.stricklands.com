<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\Events\Settings\Updated as SettingsUpdated;
use Illuminate\Http\Request;
use Settings;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\LocationRequest;
use Vanguard\Models\Locations;
use Vanguard\Http\Requests\PaymentRequest;
use Vanguard\Models\Payment;

/**
 * Class SettingsController
 * @package Vanguard\Http\Controllers
 */
class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display general settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function general()
    {
        return view('settings.general');
    }

    /**
     * Display Authentication & Registration settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auth()
    {
        return view('settings.auth');
    }

    /**
     * Handle application settings update.
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $this->updateSettings($request->except("_token"));

        return back()->withSuccess(trans('app.settings_updated'));
    }

    /**
     * Update settings and fire appropriate event.
     *
     * @param $input
     */
    private function updateSettings($input)
    {
        foreach ($input as $key => $value) {
            Settings::set($key, $value);
        }

        Settings::save();

        event(new SettingsUpdated);
    }

    /**
     * Enable system 2FA.
     *
     * @return mixed
     */
    public function enableTwoFactor()
    {
        $this->updateSettings(['2fa.enabled' => true]);

        return back()->withSuccess(trans('app.2fa_enabled'));
    }

    /**
     * Disable system 2FA.
     *
     * @return mixed
     */
    public function disableTwoFactor()
    {
        $this->updateSettings(['2fa.enabled' => false]);

        return back()->withSuccess(trans('app.2fa_disabled'));
    }

    /**
     * Enable registration captcha.
     *
     * @return mixed
     */
    public function enableCaptcha()
    {
        $this->updateSettings(['registration.captcha.enabled' => true]);

        return back()->withSuccess(trans('app.recaptcha_enabled'));
    }

    /**
     * Disable registration captcha.
     *
     * @return mixed
     */
    public function disableCaptcha()
    {
        $this->updateSettings(['registration.captcha.enabled' => false]);

        return back()->withSuccess(trans('app.recaptcha_disabled'));
    }

    /**
     * Display notification settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notifications()
    {
        return view('settings.notifications');
    }


    public function listLocations(){

        $locations  =   Locations::all();

        return view('settings.list-locations',compact('locations'));

    }

    public function editLocation($id){

        $location  =   Locations::findorFail($id);

        return view('settings.edit-locations',compact('location'));

    }

    public function updateLocation($id, LocationRequest $request){

        $location  =   Locations::findorFail($id);

        $location->update($request->only((new Locations())->getFillable()));

        return redirect()->route('locations.list')->withSuccess('Location updated successfully');
    }

    public function listPayments(){

        $payments  =   Payment::orderBy('city','desc')->get();

        return view('settings.list-payments',compact('payments'));

    }

    public function showPayment($id=null){
        $stores = Locations::pluck('fldLocationName','fldLocation')->all();
        return view('settings.add-payment',compact('stores'));
    }

    public function storePayment(PaymentRequest  $request){
        Payment::create([
            'product' => $request->product,
            'code'=> $request->code,
            'address'=> $request->address,
            'phone'=> $request->phone,
            'city'=> $request->city,
            'store_id'=> $request->store_id,
            'prov'=> $request->prov,
            'postal'=> $request->postal,
        ]);
        return redirect()->route('payments.list')->withSuccess('Your payment successfully created.');
    }

    public function editPayment($id){
        $payment = Payment::findorFail($id);

        $stores = Locations::pluck('fldLocationName','fldLocation')->all();
        return view('settings.edit-payment',compact('payment','stores'));
    }

    public function updatePayment(PaymentRequest  $request,$id){
        $payment = Payment::findorFail($id);
        $payment->product  = $request->product;
        $payment->code = $request->code;
        $payment->address = $request->address;
        $payment->phone = $request->phone;
        $payment->city = $request->city;
        $payment->store_id = $request->store_id;
        $payment->prov = $request->prov;
        $payment->postal = $request->postal;
        $payment->update();

        return redirect()->route('payments.list')->withSuccess('Your payment successfully updated.');
    }

    public function deletePayment($id){
        $payment = Payment::find($id)->delete();
        if(is_null($payment)){
            return redirect()->route('payments.list')->withError('Please try again.');
        }
        return redirect()->route('payments.list')->withSuccess('Your payment successfully deleted.');

    }
}
