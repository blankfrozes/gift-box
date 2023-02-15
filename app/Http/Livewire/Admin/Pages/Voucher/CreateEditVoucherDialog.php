<?php

namespace App\Http\Livewire\Admin\Pages\Voucher;

use App\Models\Constants\VoucherStatus;
use App\Models\Reward;
use App\Models\Voucher;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateEditVoucherDialog extends Component
{
    public $editMode = false;

    public $initializing = true;

    public $voucher = [];

    protected $rules = [
        'voucher.username' => 'required',
    ];

    protected $validationAttributes = [
        'voucher.code' => 'code',
        'voucher.reward_id' => 'reward_id',
        'voucher.username' => 'username',
        'voucher.status' => 'status',
    ];

    public function init($id)
    {
        if ($id) {
            $this->editMode = true;
            $voucher = VOUCHER::find($id);
            $this->voucher = $voucher->toArray();
        }
        $this->initializing = false;
    }

    public function submit()
    {
        $this->validate($this->rules, [], $this->validationAttributes);

        $reward = Reward::find($this->voucher['reward_id']);

        try {
            if (! $this->editMode) {
                $code = null;
                while (true) {
                    $code = strtoupper(Str::random(10));
                    if (! VOUCHER::where('code', $code)->exists()) {
                        break;
                    }
                }
                $this->voucher['code'] = $code;
                $this->voucher['status'] = VoucherStatus::AVAILABLE_TO_USE;
                $this->voucher['reward_name'] = $reward->name;
                $this->voucher['reward_image'] = $reward->image;
                $newVoucher = $this->voucher;
                VOUCHER::create($newVoucher);
            } else {
                $this->voucher['reward_name'] = $reward->name;
                $this->voucher['reward_image'] = $reward->image;
                $updateVoucher = $this->voucher;
                VOUCHER::find($updateVoucher['id'])->update($updateVoucher);
            }
        } catch (\Exception $e) {
            return $this->dispatchBrowserEvent('flash', ['type' => 'error', 'message' => 'Something went wrong!']);
        }

        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('flash', ['type' => 'success', 'message' => 'Voucher Create successfully!']);
        $this->dispatchBrowserEvent('close-create-edit-dialog');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        $rewards = REWARD::all()->map(
            function ($e) {
                return [
                    'label' => $e->name,
                    'value' => $e->id,
                ];
            }
        );

        return view('livewire.admin.pages.voucher.create-edit-voucher-dialog', [
            'rewardLists' => $rewards,
        ]);
    }
}
