<?php

namespace Jacklove315\Modal;

use Jacklove315\Modal\Contracts\ModalComponent as Contract;
use Livewire\Component;

abstract class ModalComponent extends Component implements Contract
{
    public static function closeModalOnClickAway(): bool
    {
        return config('jl-modal.component_defaults.close_modal_on_click_away', true);
    }

    public static function closeModalOnEscape(): bool
    {
        return config('jl-modal.component_defaults.close_modal_on_escape', false);
    }

    public static function modalSize(): string
    {
        return config('jl-modal.component_defaults.modal_size', 'md');
    }

    public function closeModal(): void
    {
        $this->dispatch('closeModal');
    }
}
