<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reward;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $rewards = [
        [
            'name' => '10rb saldo',
            'image' => 'https://daevhricapzoujxzjpbs.supabase.co/storage/v1/object/public/testing/reward_1.png',
            'is_active' => true,
        ],
        [
            'name' => '15rb saldo',
            'image' => 'https://daevhricapzoujxzjpbs.supabase.co/storage/v1/object/public/testing/reward_2.png',
            'is_active' => true,
        ],
        [
            'name' => '20rb saldo',
            'image' => 'https://daevhricapzoujxzjpbs.supabase.co/storage/v1/object/public/testing/reward_3.png',
            'is_active' => true,
        ],
        [
            'name' => '50rb saldo',
            'image' => 'https://daevhricapzoujxzjpbs.supabase.co/storage/v1/object/public/testing/reward_4.png',
            'is_active' => true,
        ],
        [
            'name' => '100rb saldo',
            'image' => 'https://daevhricapzoujxzjpbs.supabase.co/storage/v1/object/public/testing/reward_5.png',
            'is_active' => true,
        ],
        [
            'name' => '150rb saldo',
            'image' => 'https://daevhricapzoujxzjpbs.supabase.co/storage/v1/object/public/testing/reward_6.png',
            'is_active' => true,
        ],
        [
            'name' => '250rb saldo',
            'image' => 'https://daevhricapzoujxzjpbs.supabase.co/storage/v1/object/public/testing/reward_7.png',
            'is_active' => true,
        ],
        [
            'name' => '1jt saldo',
            'image' => 'https://daevhricapzoujxzjpbs.supabase.co/storage/v1/object/public/testing/reward_8.png',
            'is_active' => true,
        ],
      ];

      foreach ($rewards as $reward) {
          Reward::create($reward);
      }
    }
}
