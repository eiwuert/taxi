<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Sms;
use SoapClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    /**
     * Show all codes.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Sms::with('user')
                    ->orderBy('id', 'desc')
                    ->paginate((int) option('pagination', 15));
        $codes = $this->mutateCodes($codes);
        // $client = new SoapClient('http://ip.sms.ir/ws/SendReceive.asmx?wsdl');
        // $Params= [
        //     'userName'=>'09122641637',
        //     'password'=>'!@#123QWEqwe',
        //     'fromDate'=>Carbon::now()->yesterday()->endOfDay()->toIso8601String(),
        //     'toDate'=>Carbon::now()->endOfDay()->toIso8601String()
        // ];
        // dd( $client->GetVipSentMessages($Params) );
        return view('admin.settings.sms', compact('codes'));
    }

    /**
     * Mutate codes before sending to view.
     *
     * @param  Array $codes
     * @return \Illuminate\Http\Response
     */
    private function mutateCodes($codes)
    {
        foreach ($codes as $code) {
            $user = call_user_func([$code->user, $code->user->role])->first();
            $code->name = $code->user->name();
            if (is_null($user)) {
                $code->picture = asset('img/no-profile.png');
                $code->phone = null;
            } else {
                $code->picture = $user->getPicture();
                $code->phone = $code->user->phone();
            }
        }
        return $codes;
    }
}
