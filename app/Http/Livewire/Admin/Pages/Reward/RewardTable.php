<?php

namespace App\Http\Livewire\Admin\Pages\Reward;

use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Reward;

class RewardTable extends LivewireDatatable
{
  public function builder()
  {
      return Reward::query();
  }

  public function columns()
    {
      return [
          Column::index($this),

          Column::name('name')
            ->label('Name')
            ->filterable(),

          Column::callback(['image'], function($image){
            return <<<EOT
              <div class="flex items-center justify-center w-full">
                <img src="$image" alt="" class="h-20"/>
              </div>
EOT;
          })
            ->label('Image'),

          BooleanColumn::name('is_active')
            ->label('Active')
            ->filterable(),

          Column::callback(['id', 'created_at'], function ($id) {
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
