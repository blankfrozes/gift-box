<?php

namespace App\Http\Livewire\Admin\Pages\Voucher;

use App\Models\Constants\VoucherStatus;
use App\Models\Voucher;
use Carbon\Carbon;
use Livewire\Component;

class DetailVoucherDialog extends Component
{
    public $voucherId;

    public $initializing = true;

    public $voucher;

    protected $listeners = ['refreshState' => 'refreshState'];

    public function refreshState()
    {
        $voucher = Voucher::find($this->voucherId);
        $this->voucher = $voucher;
        $this->emit('refreshLivewireDatatable');
    }

    public function init($id)
    {
        $this->voucherId = $id;

        $this->refreshState();
        $this->initializing = false;
    }

    public function claim()
    {
        try {
            $updateVoucher = $this->voucher->toArray();
            if ($updateVoucher['status'] != VoucherStatus::USED) {
                return $this->dispatchBrowserEvent('flash', ['type' => 'error', 'message' => 'Voucher still not use by user!']);
            }
            $updateVoucher['status'] = VoucherStatus::CLAIMED;
            $updateVoucher['claim_at'] = Carbon::now();
            Voucher::find($updateVoucher['id'])->update($updateVoucher);
        } catch (\Exception $e) {
            return $this->dispatchBrowserEvent('flash', ['type' => 'error', 'message' => 'Something went wrong!']);
        }

        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('flash', ['type' => 'success', 'message' => 'Saved successfully!']);
        $this->dispatchBrowserEvent('close-detail-dialog');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.pages.voucher.detail-voucher-dialog');
    }
}
