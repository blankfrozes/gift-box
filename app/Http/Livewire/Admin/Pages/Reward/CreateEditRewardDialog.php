<?php

namespace App\Http\Livewire\Admin\Pages\Reward;

use App\Models\Constants\VoucherStatus;
use App\Models\REWARD;
use App\Models\Voucher;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEditRewardDialog extends Component
{
    use WithFileUploads;

    public $editMode = false;

    public $initializing = true;

    public $reward = [];

    public $imageReward;

    protected $rules = [
        'reward.name' => 'required',
    ];

    protected $validationAttributes = [
        'reward.name' => 'name',
        'reward.is_active' => 'active',
        'imageReward' => 'image reward',
    ];

    public function init($id)
    {
        if ($id) {
            $this->editMode = true;
            $reward = REWARD::find($id);
            $this->reward = $reward->toArray();
        } else {
            $this->reward['is_active'] = true;
        }
        $this->initializing = false;
    }

    public function submit()
    {
        $this->validate($this->rules, [], $this->validationAttributes);

        if (! $this->editMode) {
            $this->validate([
                'imageReward' => 'required|mimes:jpeg,jpg,png',
            ], [], $this->validationAttributes);
        } else {
            $totalUnusedVoucher = VOUCHER::where('reward_id', $this->reward['id'])->where('status', VoucherStatus::AVAILABLE_TO_USE)->count();

            if ($totalUnusedVoucher > 0) {
                return $this->dispatchBrowserEvent('flash', ['type' => 'error', 'message' => "Can't edit reward because there still unused voucher with this reward!"]);
            }
        }

        $imagePath = '';
        if ($this->imageReward) {
            $imageName = time().Str::random(16).'.'.$this->imageReward->extension();

            $imagePath = $this->imageReward->storeAs('reward', $imageName, 'public');
        }

        try {
            if (! $this->editMode) {
                $newReward = $this->reward;
                $newReward['image'] = $imagePath;
                REWARD::create($newReward);
            } else {
                $updateReward = $this->reward;
                if ($imagePath) {
                    $updateReward['image'] = $imagePath;
                }
                REWARD::find($updateReward['id'])->update($updateReward);
            }
        } catch (\Exception $e) {
            return $this->dispatchBrowserEvent('flash', ['type' => 'error', 'message' => 'Something went wrong!']);
        }

        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('flash', ['type' => 'success', 'message' => 'Reward Saved successfully!']);
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
        return view('livewire.admin.pages.reward.create-edit-reward-dialog');
    }
}
