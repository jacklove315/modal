# Modal

<p align="center">
<a href="https://packagist.org/packages/jacklove315/modal"><img src="https://img.shields.io/packagist/dt/jacklove315/modal" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/jacklove315/modal"><img src="https://img.shields.io/packagist/v/jacklove315/modal" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/jacklove315/modal"><img src="https://img.shields.io/packagist/l/jacklove315/modal" alt="License"></a>
</p>

## Introduction

Modal is a basic livewire modal package for livewire/filament apps. The package is based off wire-elements-modal.

## Installation

```shell
composer require jacklove315/modal
```

## Publishing config
If you need to change modal default functionality, you can do so by publishing the config and making the necessary changes

```shell
php artisan vendor:publish
```

Then in the console prompt select:

```shell
 › ● Provider: Jacklove315\Modal\ServiceProvider   
```
The config is published to `config/jl-modal.php`

```php
/*
|--------------------------------------------------------------------------
| Modal Component Defaults
|--------------------------------------------------------------------------
|
| Configure the default properties for a modal component.
|
| Supported modal_size;
| 'sm', 'md', 'lg'
*/
return [
    'component_defaults' => [
        'close_modal_on_click_away' => true,
        'close_modal_on_escape'     => false,
        'modal_size'                => 'md'
    ]
];
```


## Usage
### Include the package in your application
In your app root file such as `app.blade.php` you can register the component so that its globally available across your app
```php
@livewire('jl-modal')
```

### Register a livewire component as a modal
You need to extend `ModalComponent` in any livewire component you wish to make a modal.
```php
<?php

namespace App\Http\Livewire;

use Jacklove315\Modal\ModalComponent;

class DeleteOrganisationModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.delete-organisation');
    }
}
```
#### Configuring individual modal components
If you look inside `ModalComponent` you'll notice that there are 3 functions you can overwrite. These options can be configured per modal or globally by publishing the config:
```php
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
```
**Make sure this compnent (DeleteOrganisationModal.php) lives inside the Livewire directory in your app so that it gets automatically registered and binded to the Laravel service container. You also have the option of registering the component manually inside a service provider:**
```php
Livewire::component('delete-organisation-modal', DeleteOrganisationModal::class);
```

### Opening a modal
You can open the modal by emitting an `open-modal` event from anywhere in your app (as long at the package component is registered at the root of your app)

`$data` must be a json array of key value pairs
```php
<button wire:click="$emit('open-modal', 'delete-organisation-modal', $data)">
    Open modal
</button>
```

### Closing a modal
You can call `$this->closeModal` from inside your modal component:
```php
<?php

namespace App\Http\Livewire;

use Jacklove315\Modal\ModalComponent;

class DeleteOrganisationModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.delete-organisation-modal');
    }

    public function submitForm()
    {
        $this->closeModal();
    }
}
```

## License
Modal is an open-sourced software licensed under the [MIT license](LICENSE).