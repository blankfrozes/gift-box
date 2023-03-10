<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Voucher;
use App\Models\Constants\VoucherStatus;
use Carbon\Carbon;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
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

    public function getReward(Request $request)
    {
        // $this->validate($request, [
        //   'voucher_code' => 'required|exists:vouchers,code',
        // ]);
        $validator = Validator::make($request->all(), [
            'voucher_code' => 'required|exists:vouchers,code',
        ]);

        if($validator->fails())
        {
          return response()->json($validator->errors(), 422);
        }

        $voucher = Voucher::select(['id', 'code', 'username', 'reward_id', 'reward_name', 'reward_image', 'status'])->where('code', $request->voucher_code)->where('status', VoucherStatus::AVAILABLE_TO_USE)->first();

        if(!$voucher){
          return response()->json(["error" => "Voucher can't be used!"], 422);
        }

        $voucher = $voucher->toArray();

        $voucher['reward_image'] = asset("storage/". $voucher['reward_image']);

        return response()->json($voucher);
    }

    public function use(Request $request){

        $voucher = Voucher::where('id', $request->id)->where('status', VoucherStatus::AVAILABLE_TO_USE)->first();

        if(!$voucher){
          return response()->json(["error" => "Voucher can't be used!"], 422);
        }

        $SlackMessage = [
            'username' => $voucher->username,
            'reward' => $voucher->reward_name,
            'ip_address' => $request->ip(),
            'created_at' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s'),
        ];


        $updateVoucher = $voucher->toArray();
        $updateVoucher['status'] = VoucherStatus::USED;
        $updateVoucher['used_at'] = Carbon::now();
        Voucher::find($updateVoucher['id'])->update($updateVoucher);

        // $this->sendSlackNotification($SlackMessage);

        return response()->json(["message" => "Success!"], 200);
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

    protected function sendSlackNotification($SlackMessage)
    {
        $user = \App\Models\User::find(1);
        $user->notify(new \App\Notifications\SlackNotification($SlackMessage));
    }

}