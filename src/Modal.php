<?php

namespace Jacklove315\Modal;

use Exception;
use Livewire\Component;
use ReflectionClass;
use Livewire\Mechanisms\ComponentRegistry;

class Modal extends Component
{
    public array $activeComponent = [];
    public bool  $showModal       = false;
    public array $options         = [];

    public function getListeners(): array
    {
        return [
            'openModal',
        ];
    }

    public function openModal($componentName, string|array $componentAttributes = []): void
    {
        if (is_string($componentAttributes)) {
            $componentAttributes = (array)json_decode($componentAttributes);
        }

        $requiredInterface = \Jacklove315\Modal\Contracts\ModalComponent::class;
        $componentClass = app(ComponentRegistry::class)->getClass($componentName);
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
        return view('jacklove315::modal');
    }
}
