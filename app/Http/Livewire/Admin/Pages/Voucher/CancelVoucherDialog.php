<?php

namespace App\Http\Livewire\Admin\Pages\Voucher;

use App\Models\Constants\VoucherStatus;
use App\Models\Voucher;
use Livewire\Component;

class CancelVoucherDialog extends Component
{
    public $voucher;

    public $code;

    public $initializing = true;

    public function init($id)
    {
        $voucher = Voucher::find($id);
        $this->voucher = $voucher->toArray();
        $this->code = $voucher->code;
        $this->initializing = false;
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function submit()
    {
        $updateVoucher = $this->voucher;

        try {
            if ($updateVoucher['status'] === VoucherStatus::ABORTED || $updateVoucher['status'] === VoucherStatus::CLAIMED) {
                return $this->dispatchBrowserEvent('flash', ['type' => 'error', 'message' => 'Failed to cancel voucher!']);
            }
            $updateVoucher['status'] = VoucherStatus::ABORTED;

            Voucher::find($updateVoucher['id'])->update($updateVoucher);
        } catch (\Exception $e) {
            return $this->dispatchBrowserEvent('flash', ['type' => 'error', 'message' => 'Something went wrong!']);
        }

        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('flash', ['type' => 'success', 'message' => 'Cancel successfully!']);
        $this->dispatchBrowserEvent('close-cancel-dialog');
        $this->dispatchBrowserEvent('close-detail-dialog');
    }

    public function render()
    {
        return view('livewire.admin.pages.voucher.cancel-voucher-dialog');
    }
}
