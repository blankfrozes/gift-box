<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Constants\VoucherStatus;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function show(int $id)
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
    public function update(Request $request, int $id)
    {
        //
    }

    public function getReward(Request $request): Response
    {
        // $this->validate($request, [
        //   'voucher_code' => 'required|exists:vouchers,code',
        // ]);
        $validator = Validator::make($request->all(), [
            'voucher_code' => 'required|exists:vouchers,code',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $voucher = Voucher::select(['id', 'code', 'reward_id', 'reward_name', 'reward_image', 'status'])->where('code', $request->voucher_code)->where('status', VoucherStatus::AVAILABLE_TO_USE)->first();

        if (! $voucher) {
            return response()->json(['error' => "Voucher can't be used!"], 422);
        }

        $voucher = $voucher->toArray();

        $voucher['reward_image'] = asset('storage/'.$voucher['reward_image']);

        return response()->json($voucher);
    }

    public function use(Request $request): Response
    {
        $voucher = Voucher::where('id', $request->id)->where('status', VoucherStatus::AVAILABLE_TO_USE)->first();

        if (! $voucher) {
            return response()->json(['error' => "Voucher can't be used!"], 422);
        }

        $updateVoucher = $voucher->toArray();
        $updateVoucher['status'] = VoucherStatus::USED;
        $updateVoucher['used_at'] = Carbon::now();
        Voucher::find($updateVoucher['id'])->update($updateVoucher);

        return response()->json(['message' => 'Success!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
