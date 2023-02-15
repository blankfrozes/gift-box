<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $rewards = [
            [
                'name' => 'Saldo RP 10.000',
                'image' => 'reward/1676103859bfxZ8rSSEBqDeXRA.png',
                'is_active' => true,
            ],
            [
                'name' => 'Saldo RP 15.000',
                'image' => 'reward/1676103866B5lvPt4RQV5a2sIX.png',
                'is_active' => true,
            ],
            [
                'name' => 'Saldo RP 20.000',
                'image' => 'reward/16761038733bLvGOx5DjtvhDiK.png',
                'is_active' => true,
            ],
            [
                'name' => 'Saldo RP 50.000',
                'image' => 'reward/1676103880jjz0WBMdwbWp3wZ2.png',
                'is_active' => true,
            ],
            [
                'name' => 'Saldo RP 100.000',
                'image' => 'reward/16761038899nKOvj7Ar9QhP48H.png',
                'is_active' => true,
            ],
            [
                'name' => 'Saldo RP 150.000',
                'image' => 'reward/1676103893Rh0QxmGtandQWJ4D.png',
                'is_active' => true,
            ],
            [
                'name' => 'Saldo RP 250.000',
                'image' => 'reward/1676103899CSN6yEhiQUxkuwCg.png',
                'is_active' => true,
            ],
            [
                'name' => 'Saldo RP 1.000.000',
                'image' => 'reward/1676103907TM8IeRInptcVmzsL.png',
                'is_active' => true,
            ],
        ];

        foreach ($rewards as $reward) {
            Reward::create($reward);
        }
    }
}
