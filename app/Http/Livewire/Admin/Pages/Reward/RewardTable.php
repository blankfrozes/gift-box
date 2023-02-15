<?php

namespace App\Http\Livewire\Admin\Pages\Reward;

use App\Models\REWARD;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RewardTable extends LivewireDatatable
{
    public function builder()
    {
        return REWARD::query();
    }

    public function columns()
    {
        return [
            Column::index($this),

            Column::name('name')
              ->label('Name')
              ->filterable(),

            Column::callback(['image'], function ($image) {
                $imageReward = asset('storage/'.$image);

                return <<<EOT
              <div class="flex items-center justify-center w-full">
                <img src="$imageReward" alt="" class="h-20"/>
              </div>
EOT;
            })
              ->label('Image'),

            BooleanColumn::name('is_active')
              ->label('Active')
              ->filterable(),

            Column::callback(['id'], function ($id) {
                return <<<EOT
              <div class="flex flex-col items-center space-y-2">
                  <button
                      class="px-4 py-1 text-sm text-white bg-blue-700 rounded hover:bg-blue-500"
                      x-data
                      x-on:click="\$dispatch('open-create-edit-dialog', $id)"
                  >
                      Edit
                  </button>
              </div>
EOT;
            }),
        ];
    }
}
