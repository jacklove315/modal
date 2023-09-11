<?php

namespace Jacklove315\Modal;

use Exception;
use Livewire\Component;
use ReflectionClass;

class Modal extends Component
{
    public array $activeComponent = [];
    public bool $showModal = false;
    public array $options = [];

    public function getListeners(): array
    {
        return [
            'openModal',
        ];
    }

    public function openModal($componentName, array $componentAttributes = []): void
    {
        $requiredInterface = \Jlove\Modal\Contracts\ModalComponent::class;
        $componentClass = app('livewire')->getClass($componentName);
        $reflect = new ReflectionClass($componentClass);

        if ($reflect->implementsInterface($requiredInterface) === false) {
            throw new Exception("[{$componentClass}] does not implement [{$requiredInterface}] interface.");
        }

        $this->activeComponent = [
            'id'         => md5($componentClass),
            'name'       => $componentName,
            'attributes' => array_merge([
                'closeModalOnClickAway' => $componentClass::closeModalOnClickAway(),
                'closeModalOnEscape'    => $componentClass::closeModalOnEscape(),
                'modalSize'             => $componentClass::modalSize(),
            ], $componentAttributes),
        ];

        $this->dispatchBrowserEvent('modal-mounted');

        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;

        $this->activeComponent = [];
    }

    public function render()
    {
        return view('jlove::modal');
    }
}
