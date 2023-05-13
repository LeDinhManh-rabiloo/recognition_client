<?php

namespace App\Http\Controllers;

use App\Models\AppInfor;
use App\Models\PremaxSeting;
use App\Models\ProfitSetting;
use App\Services\Yahoo\ApiYahooService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('code')) {
            $appinfor = AppInfor::findOrFail(1);
            $appinfor->update(['code' => $request->code]);
            $response = json_decode(
                ApiYahooService::getAccessToken($appinfor->app_id, $appinfor->secret, $request->code)
            );
            $appinfor->update(['access_token' => $response->access_token, 'refresh_token' => $response->refresh_token]);
            return redirect()->route('settings.index');
        } else {
            $appinfors = AppInfor::all();
            $premaxInfor = PremaxSeting::all();
            $profitInfor = ProfitSetting::findOrFail(1);
            return view('pages.settings.index', compact(['appinfors', 'premaxInfor', 'profitInfor']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'app_id' => 'required',
            'secret' => 'required'
        ]);
        $app = AppInfor::create($data);
        $url_authen = 'https://auth.login.yahoo.co.jp/yconnect/v1/authorization?response_type=code&client_id=' .
            $request->app_id .
            '&redirect_uri=' .
            'http://localhost/settings';
        return redirect($url_authen);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
