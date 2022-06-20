<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use Validator;
use App;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $index = DB::table('supmember')->where('service', 1)->where('code', 'index')->orWhere('id', 1)->first();
        return view('index', compact('index'));
    }

    public function getLang($lang){
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }

    public function account(){
        if (Auth::user()) {
            $silks = DB::connection('sqlsrv1')->table('SK_Silk')->where('JID', Auth::user()->JID)->first();
            $shard = DB::connection('sqlsrv2');
            $charNames = $shard->table('_User')
            ->rightJoin('_Char','_User.CharID', '=', '_Char.CharID')
            ->where('_User.UserJID', Auth::user()->JID)
            ->select('CharName16', 'CurLevel', 'RemainGold')
            ->get();
            return view('pages.login', compact('silks', 'charNames'));
        }
        return view('pages.login');
    }

    public function login(Request $rq)
    {
        if (Auth::user()) {
             return redirect()->back();
        }
        else{
             if ($rq->StrUserID == null || $rq->password == null) {
                return redirect()->back()->with('msg', __('error_login'));
            }
            else{
                $user = User::where(['StrUserID' => $rq->StrUserID, 'password' => md5($rq->password)])->first();
                if ($user) {
                    Auth::login($user);
                    return redirect()->back();
                }
                else{
                    return redirect()->back()->with('msg', __('error_login'));
                }
            }
        }

    }

    public function logout(){
        Auth::logout();
        return redirect()->back();
    }

    public function register(){
        return view('pages.register');
    }
    public function postRegister(Request $rq){
        $rule = [
            'username' => 'required|min:5|max:16|unique:sqlsrv1.TB_User,StrUserID',
            'password' => 'required|min:6|max:50',
            'password_sam' => 'required|same:password',
            'gmail' => 'required|email'
        ];
        // 'secretpassword' => 'required|min:6|max:50|different:password',
        $message = [];
        if(app()->getLocale() == 'vi'){
            $message = [
            'username.required' => 'Tên tài khoản chưa nhập',
            'username.min' => 'Tên người dùng từ 4 đến 20 ký tự',
            'username.max' => 'Tên người dùng từ 4 đến 20 ký tự',
            'username.unique' => "Tên người dùng này đã được sử dụng",
            'password.required' => 'Mật khẩu chưa nhập',
            'password.min' => 'Mật khẩu từ 6 đến 30 ký tự',
            'password.min' => 'Mật khẩu từ 6 đến 30 ký tự',
            'password_sam.required' => 'Xác nhận mật khẩu chưa nhập',
            'password_sam.same' => 'Xác nhận mật khẩu không đúng',
            'gmail.required' => 'Email chưa nhập',
            'gmail.email' => 'Email sai định dạng',
            ];
        }
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            DB::connection('sqlsrv1')->table('TB_User')->insert([
                'StrUserID' => $rq->username,
                'Password' => md5($rq->password),
                'Email' => $rq->gmail,
                'Phone' => $rq->phone,
                'reg_ip' => $_SERVER['REMOTE_ADDR']
            ]);
            return redirect()->back()->with('msg', __('register_success'));
        }
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
        
    }

    public function ranking(){
        //eu 14875->14900
        //asi 1907->1932
        $charRankAsi = DB::connection('sqlsrv2')->table('_Char')->whereBetween('RefObjID', [1906, 1933])
        ->select('CharName16', 'CurLevel', 'Intellect', 'Strength', 'SExpOffset', 'ExpOffset')
        ->orderBy('CurLevel', 'desc')->orderBy('ExpOffset', 'desc')->limit(100)->get();

        $charRankEu = DB::connection('sqlsrv2')->table('_Char')->whereBetween('RefObjID', [14874, 14901])
        ->select('CharName16', 'CurLevel', 'Intellect', 'Strength', 'SExpOffset', 'ExpOffset')
        ->orderBy('CurLevel', 'desc')->orderBy('ExpOffset', 'desc')->limit(100)->get();

        $charGold = DB::connection('sqlsrv2')->table('_Char')
        ->join('_User', '_Char.CharID', '=', '_User.CharID')
        ->join('_AccountJID', '_User.UserJID', '=', '_AccountJID.JID')
        ->select('_Char.CharName16', '_Char.RemainGold','_AccountJID.Gold')->orderBy('RemainGold', 'desc')
        ->limit(100)->get();

        $topguid = DB::connection('sqlsrv2')->table('_Guild')
        ->rightJoin('_GuildMember', '_Guild.ID', '=', '_GuildMember.GuildID')
        ->where('MemberClass', 0)->where('Permission', -1)->where('SiegeAuthority', 1)
        ->orderBy('Lvl', 'desc')->orderBy('GatheredSP', 'desc')
        ->select('ID', 'Name', 'Lvl', 'GatheredSP', 'FoundationDate', 'CharName')
        ->limit(50)->get();

        //trade = 1
        //hunter = 3
        //thief = 2
        $toptrade = DB::connection('sqlsrv2')->table('_CharTrijob')
        ->leftJoin('_Char', '_CharTrijob.CharID', '=', '_Char.CharID')->where('JobType', 1)->where('_Char.NickName16', '!=', '')
        ->select('_CharTrijob.Level', '_CharTrijob.Exp', '_CharTrijob.Contribution', '_Char.CharName16', '_Char.NickName16')
        ->orderBy('Level', 'desc')->orderBy('Exp', 'desc')->orderBy('Contribution', 'desc')
        ->limit(50)->get();

         $topthief = DB::connection('sqlsrv2')->table('_CharTrijob')
        ->leftJoin('_Char', '_CharTrijob.CharID', '=', '_Char.CharID')->where('JobType', 2)->where('_Char.NickName16', '!=', '')
        ->select('_CharTrijob.Level', '_CharTrijob.Exp', '_CharTrijob.Contribution', '_Char.CharName16', '_Char.NickName16')
        ->orderBy('Level', 'desc')->orderBy('Exp', 'desc')->orderBy('Contribution', 'desc')
        ->limit(50)->get();

        $tophunter = DB::connection('sqlsrv2')->table('_CharTrijob')
        ->leftJoin('_Char', '_CharTrijob.CharID', '=', '_Char.CharID')->where('JobType', 3)->where('_Char.NickName16', '!=', '')
        ->select('_CharTrijob.Level', '_CharTrijob.Exp', '_CharTrijob.Contribution', '_Char.CharName16', '_Char.NickName16')
        ->orderBy('Level', 'desc')->orderBy('Exp', 'desc')->orderBy('Contribution', 'desc')
        ->limit(50)->get();

        return view('pages.ranking', compact('charRankAsi', 'charRankEu', 
            'charGold', 'topguid', 'toptrade', 'topthief', 'tophunter'));
    }

    public function changePass(){
        return view('pages.formpass');
    }

    public function postPass(Request $rq){
        $rule = [
            'old_password' => 'required',
            'password' => 'required|min:6|max:50',
            'password_sam' => 'required|same:password'
        ];
        $message = [];
        if(app()->getLocale() == 'vi'){
            $message = [
            'old_password.required' => 'Mật khẩu chưa nhập',
            'password.required' => 'Mật khẩu chưa nhập',
            'password.min' => 'Mật khẩu từ 6 đến 50 ký tự',
            'password.min' => 'Mật khẩu từ 6 đến 50 ký tự',
            'password_sam.required' => 'Xác nhận mật khẩu chưa nhập',
            'password_sam.same' => 'Xác nhận mật khẩu không đúng'
            ];
        }
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            $JID = DB::connection('sqlsrv1')->table('TB_User')->where('StrUserID', Auth::user()->StrUserID)
            ->where('password', md5($rq->old_password))->select('JID')->first();
            if($JID){
                $user = User::find($JID->JID);
                $user->password = md5($rq->password);
                $user->save();
                return redirect()->back()->with('msg', __('change_password_success'));
            }
            else{
               return redirect()->back()->with('msg', __('error_oldpassword'));
            }
            
        }
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }

    public function changeEmail(){
        return view('pages.formemail');
    }

    public function postEmail(Request $rq){
         $rule = [
            'old_gmail' => 'required|email',
            'gmail' => 'required|email',
            'secretpassword' => 'required'
        ];
        $message = [];
        if(app()->getLocale() == 'vi'){
            $message = [
            'secretpassword.required' => 'Mật khẩu cấp 2 chưa nhập',
            'old_gmail.required' => 'Email cũ chưa nhập',
            'old_gmail.email' => 'Email cũ sai định dạng',
            'gmail.required' => 'Email mới chưa nhập',
            'gmail.email' => 'Email mới sai định dạng'
            ];
        }
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            $JID = DB::connection('sqlsrv1')->table('TB_User')->where('StrUserID', Auth::user()->StrUserID)
            ->where('Frst_password', md5($rq->secretpassword))->where('Email', $rq->old_gmail)->select('JID')->first();
            if($JID){
                $user = User::find($JID->JID);
                $user->Email = $rq->gmail;
                $user->save();
                return redirect()->back()->with('msg', __('change_email_success'));
            }
            else{
               return redirect()->back()->withInput()->with('msg', __('error_secret_password'));
            }
            
        }
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }

    public function changePhone(){
        return view('pages.formphone');
    }

    public function postPhone(Request $rq){
        $rule = [
            'phone' => 'required',
            'password' => 'required',
            'gmail' => 'required|email'
        ];
        $message = [];
        if(app()->getLocale() == 'vi'){
            $message = [
            'password.required' => 'Mật khẩu chưa nhập',
            'phone.required' => 'Số điện thoại khẩu chưa nhập',
            'gmail.required' => 'Email chưa nhập',
            'gmail.email' => 'Email sai định dạng'
            ];
        }
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            $JID = DB::connection('sqlsrv1')->table('TB_User')->where('StrUserID', Auth::user()->StrUserID)
            ->where('password', md5($rq->password))->where('Email', $rq->gmail)->select('JID')->first();
            if($JID){
                $user = User::find($JID->JID);
                $user->phone = $rq->phone;
                $user->save();
                return redirect()->back()->with('msg', __('change_phone_success'));
            }
            else{
               return redirect()->back()->withInput()->with('msg', __('error_password'));
            }
            
        }
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }

    public function stuckChar(){
        $shard = DB::connection('sqlsrv2');
        $charNames = $shard->table('_User')
            ->rightJoin('_Char','_User.CharID', '=', '_Char.CharID')
            ->where('_User.UserJID', Auth::user()->JID)
            ->select('CharName16', 'CurLevel')
            ->get();
        return view('pages.formstuck', compact('charNames'));
    }

    public function postStuck(Request $rq){
       DB::connection('sqlsrv2')->table('_Char')
       ->where('CharName16', $rq->name_char)->update([
        'LatestRegion' => 25000,
        'posX' => 982,
        'posY' => -0.421872,
        'posZ' => 140,
        'AppointedTeleport' => 27754,
        'TelRegion' => 0,
        'TelPosX' => 0,
        'TelPosY' => 0,
        'TelPosZ' => 0,
        'DiedRegion' => 0,
        'DiedPosX' => 0,
        'DiedPosY' => 0,
        'DiedPosZ' => 0,
        'WorldID' => 1
       ]);
       return redirect()->back()->with('msg', __('fix_stuck_char') . ' '.$rq->name_char .' ' . __('success'));
    }

    public function card(){
        $file = '../data.json';
        $data = file_get_contents($file);
        $card = json_decode($data, true);
        $rescar = DB::table('cardconfig')->orderBy('typeAmout')->get();
        $day = @$card['daytime'];
        $now = Carbon::now();
        // $now = $now->format('d-m-Y h:i:s');
        $textDate = ''; 
        $start_day = Carbon::create($day['date_start']);
        $end_day = Carbon::create($day['date_end']);
        if($now->lte($start_day) == true || ($now->gte($start_day) == true && $now->lte($end_day) == true)){
            $textDate .= __('from') . ' ' .$start_day->format('d-m-Y') . ' '. __('to')
            .' '.$end_day->format('d-m-Y') . ' X2 ' .__('card');
        }
        // foreach ($card['card'] as $key => $vl){
        //     if ($vl['amount'] == 10000){
        //         $card['card'][$key]['silk'] = 5001000000;
        //     }
        // }
        // file_put_contents ($file, json_encode($card));
        return view('pages.card', compact('rescar', 'textDate'));
    }

    public function postCard (Request $rq){
        $rule = [
            'type_card' => 'required',
            'amount' => 'required',
            'card_code' => 'required',
            'seri_number' => 'required'
        ];
        $message = [];
        if(app()->getLocale() == 'vi'){
            $message = [
            'type_card.required' => 'Loại thẻ chưa chọn',
            'amount.required' => 'Mệnh giá chưa chọn',
            'card_code.required' => 'Mã thẻ chưa nhập',
            'seri_number.required' => 'Sẻi thẻ chưa nhập',
            ];
        }
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            dd($rq->all());
            $data = [
                "telco" => "VIETTEL",
                "amount" => 100000,
                "serial" => "323245729867786",
                "code" => "20000144723884",
                "partner_key" => "603ec1743771f05bad145eeecb2c6f3fde244a3d",
                "transaction_id" => "12345678",
                "sign" => "e67ac82761b46064b0c23346337ad84e"
            ];
            $apiUrl = 'https://doithecaoonline.com/api/partner/check-card';
            $response = Http::post($apiUrl, $data);
            // $response = Http::post($apiUrl, [
            //                         "telco" => "VIETTEL",
            //                         "amount" => 100000,
            //                         "serial" => "323245729867786",
            //                         "partner_key" => "06d2a9f32deee387e73cde83570beeb15a82704a",
            //                         "code" => "20000144723884",
            //                         "transaction_id" => "12345678",
            //                         "sign" => "e67ac82761b46064b0c23346337ad84e"
            //                     ]);

            dd($response->status(), $response->body(), json_decode($response->body()));
            // $JID = DB::connection('sqlsrv1')->table('TB_User')->where('StrUserID', Auth::user()->StrUserID)
            // ->where('Frst_password', md5($rq->secretpassword))->where('Email', $rq->old_gmail)->select('JID')->first();
            // if($JID){
            //     $user = User::find($JID->JID);
            //     $user->Email = $rq->gmail;
            //     $user->save();
            //     return redirect()->back()->with('msg', __('change_email_success'));
            // }
            // else{
            //    return redirect()->back()->withInput()->with('msg', __('error_secret_password'));
            // }
            
        }
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }

    public function supMember($id){
        $supmem = DB::table('supmember')->where('code', $id)->where('service', 1)->first();
        return view('pages.suppmember', compact('supmem'));
    }

    public function download(){
        $download = DB::table('download')->where('service', 1)->get();
        return view('pages.download', compact('download'));
    }

    public function fogetPass(){
        return view('pages.forgetpass');
    }

    public function postForgetEmail(Request $rq){
        $rule = [
            'username' => 'required',
            'email' => 'required|email'
        ];
        $message = [];
        if(app()->getLocale() == 'vi'){
            $message = [
            'username.required' => 'Tên tài khoản chưa nhập',
            'email.required' => 'Email chưa nhập',
            'email.email' => 'Email sai định dạng'
            ];
        }
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            $user = DB::connection('sqlsrv1')->table('TB_User')->where('Email', $rq->email)->where('StrUserID', $rq->username)->first();
            if (!$user) {
                return redirect()->back()->withInput()->with('msg', __('successfully Email'));
            }
            DB::table('password_resets')->where('email', $rq->email)->delete();
            $token = sha1(Str::random(40) . uniqid());
            $now = Carbon::now();
            DB::table('password_resets')->insert([
                'email' => $rq->email,
                'token' => $token,
                'created_at' => $now
            ]);
            $url = url('/pwd-reset/'.$user->StrUserID.'/'.$token);
            Mail::send('pages.email.sendmail', compact('url', 'user'), function($message) use ($user){
                $message->to($user->Email, $user->StrUserID);
                $message->subject(__('forget-mess'));
            });
            return redirect()->back()->withInput()->with('msg', __('successfully Email'));
        }
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }

    public function pwdReset($name, $token){
        $password = DB::table('password_resets')->where('token', $token)->first();
        if (!$password) {
            return __('token_error');
        }
        else{
            $day = $password->created_at;
            $now = Carbon::now();
            $dif = $now->diffInHours($day);
            // dd($dif);
            if($dif > 24){
                DB::table('password_resets')->where('token', $token)->delete();
                return "token_expren";
            }
            else{
                return view('pages.email.resetpwd', compact('token', 'name'));
            }
        }
    }

    public function forGotpass(Request $rq){
        $password = DB::table('password_resets')->where('token', $rq->token)->first();
        if (!$password) {
            return __('token_error');
        }
        else{
            $day = $password->created_at;
            $now = Carbon::now();
            $dif = $now->diffInHours($day);
            if($dif > 24){
                DB::table('password_resets')->where('token', $rq->token)->delete();
                return "token_expren";
            }
             $rule = [
            'password' => 'required|min:6|max:30',
            'password_sam' => 'required|same:password'
            ];
            $message = [];
            if(app()->getLocale() == 'vi'){
                $message = [
                    'password.required' => 'Bạn chưa nhập mật khẩu',
                    'password.min' => 'Mật khẩu từ 6 đến 30 ký tự',
                    'password.max' => 'Mật khẩu từ 6 đến 30 ký tự',
                    'password_sam.required' => 'Bạn chưa nhập lại mật khẩu',
                    'password_sam.same' => 'Mật khẩu phải trùng nhau'
                ];
            }
            $check = Validator::make($rq->all(), $rule, $message);
            if ($check->passes()) {
                $user = DB::connection('sqlsrv1')->table('TB_User')
                ->where('email', $password->email)
                ->where('StrUserID', $rq->name)
                ->update([
                    'password' => md5($rq->password)
                ]);
                DB::table('password_resets')->where('token', $rq->token)->delete();
                return redirect()->route('login')->with('msg', __('change_password_success'));
            }
            else{
                $textError = '';
                foreach ($check->errors()->toArray() as $key => $value) {
                    $textError .= $value[0] . "<br>";
                }
                return redirect()->back()->withInput()->with('msg', $textError);
            }
        }
    }

}
