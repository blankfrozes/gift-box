<?php

namespace App\Http\Livewire\Admin\Pages\Voucher;

use App\Models\Constants\VoucherStatus;
use App\Models\Voucher;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\TimeColumn;

class VoucherTable extends LivewireDatatable
{
    public function builder()
    {
        return Voucher::query();
    }

    public function columns()
    {
        return [
            Column::index($this),

            DateColumn::name('created_at')
                ->label('Created At')
                ->filterable(),

            TimeColumn::name('created_at as created_time')
                ->label('Created Time'),

            Column::name('status')
                ->label('Status')
                ->filterable(VoucherStatus::values()),

            Column::name('code')
                ->label('Voucher Code')
                ->filterable(),

            Column::name('username')
                ->label('Username')
                ->filterable(),

            Column::name('reward_name')
                ->label('Reward Name'),

            Column::callback(['id', 'status'], function ($id, $status) {
                $detail = <<<EOT
                  <button
                      class="px-4 py-1 text-sm text-white bg-blue-700 rounded hover:bg-blue-500"
                      x-data
                      x-on:click="\$dispatch('open-detail-dialog', $id)"
                  >
                      Detail
                  </button>
EOT;

                $edit = <<<EOT
                  <button
                      class="px-4 py-1 text-sm text-white bg-green-700 rounded hover:bg-green-500"
                      x-data
                      x-on:click="\$dispatch('open-create-edit-dialog', $id)"
                  >
                      Edit
                  </button>
EOT;

                if ($status == VoucherStatus::AVAILABLE_TO_USE) {
                    $detail = $detail.$edit;
                }

                return <<<EOT
                  <div class="flex flex-col items-start space-y-2">
                      $detail
                  </div>
EOT;
            }),
        ];
    }
}
