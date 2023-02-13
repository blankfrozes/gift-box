<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;
use App\Models\Constants\VoucherStatus;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      for ($i=0; $i < 5; $i++) {
        $code = null;
        while (true) {
            $code = strtoupper(Str::random(10));
            if (!VOUCHER::where('code', $code)->exists()) break;
        }

        $voucher = [
          "code" => $code,
          "reward_id" => 1,
          "reward_name" => "Saldo RP 10.000",
          "reward_image" => "reward/1676103859bfxZ8rSSEBqDeXRA.png",
          "username" => "tester",
          "status" => VoucherStatus::AVAILABLE_TO_USE,
        ];

        Voucher::create($voucher);
      }

      for ($i=0; $i < 5; $i++) {
        $code = null;
        while (true) {
            $code = strtoupper(Str::random(10));
            if (!VOUCHER::where('code', $code)->exists()) break;
        }

        $voucher = [
          "code" => $code,
          "reward_id" => 4,
          "reward_name" => "Saldo RP 50.000",
          "reward_image" => "reward/1676103880jjz0WBMdwbWp3wZ2.png",
          "username" => "tester2",
          "status" => VoucherStatus::USED,
          "used_at" => Carbon::now(),
        ];

        Voucher::create($voucher);
      }

      for ($i=0; $i < 5; $i++) {
        $code = null;
        while (true) {
            $code = strtoupper(Str::random(10));
            if (!VOUCHER::where('code', $code)->exists()) break;
        }

        $voucher = [
          "code" => $code,
          "reward_id" => 5,
          "reward_name" => "Saldo RP 100.000",
          "reward_image" => "reward/16761038899nKOvj7Ar9QhP48H.png",
          "username" => "tester3",
          "status" => VoucherStatus::CLAIMED,
          "used_at" => Carbon::now(),
          "claim_at" => Carbon::now(),
        ];

        Voucher::create($voucher);
      }
    }
}