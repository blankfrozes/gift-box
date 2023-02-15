<?php

namespace Database\Seeders;

use App\Models\Constants\VoucherStatus;
use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $code = null;
            while (true) {
                $code = strtoupper(Str::random(10));
                if (! VOUCHER::where('code', $code)->exists()) {
                    break;
                }
            }

            $voucher = [
                'code' => $code,
                'reward_id' => 1,
                'reward_name' => 'Saldo RP 10.000',
                'reward_image' => 'reward/1676103859bfxZ8rSSEBqDeXRA.png',
                'username' => 'tester',
                'status' => VoucherStatus::AVAILABLE_TO_USE,
            ];

            Voucher::create($voucher);
        }

        for ($i = 0; $i < 5; $i++) {
            $code = null;
            while (true) {
                $code = strtoupper(Str::random(10));
                if (! VOUCHER::where('code', $code)->exists()) {
                    break;
                }
            }

            $voucher = [
                'code' => $code,
                'reward_id' => 4,
                'reward_name' => 'Saldo RP 50.000',
                'reward_image' => 'reward/1676103880jjz0WBMdwbWp3wZ2.png',
                'username' => 'tester2',
                'status' => VoucherStatus::USED,
                'used_at' => Carbon::now(),
            ];

            Voucher::create($voucher);
        }

        for ($i = 0; $i < 5; $i++) {
            $code = null;
            while (true) {
                $code = strtoupper(Str::random(10));
                if (! VOUCHER::where('code', $code)->exists()) {
                    break;
                }
            }

            $voucher = [
                'code' => $code,
                'reward_id' => 5,
                'reward_name' => 'Saldo RP 100.000',
                'reward_image' => 'reward/16761038899nKOvj7Ar9QhP48H.png',
                'username' => 'tester3',
                'status' => VoucherStatus::CLAIMED,
                'used_at' => Carbon::now(),
                'claim_at' => Carbon::now(),
            ];

            Voucher::create($voucher);
        }
    }
}
