<div>
    <script>
        window.LivewireModal = () => {
            return {
                getActiveComponentModalAttribute(key) {
                    return this.$wire.activeComponent['attributes'][key];
                },
                closeModalOnClickAway() {
                    if (this.getActiveComponentModalAttribute('closeModalOnClickAway') === false) {
                        return;
                    }

                    this.closeModal();
                },
                closeModalOnEscape() {
                    if (this.getActiveComponentModalAttribute('closeModalOnEscape') === false) {
                        return;
                    }

                    this.closeModal();
                },
                closeModal() {
                    //closing immediately instead of waiting for livewire
                    this.$dispatch('close-modal-on-client')
                    this.$wire.call('closeModal');
                },
                modalMounted() {
                    let modalContainer = document.getElementById('jlove-modal-container')
                    let modalSize = this.getActiveComponentModalAttribute('modalSize')

                    switch (modalSize) {
                        case 'sm':
                            modalContainer.style.width = '600px';
                            break;
                        case 'lg':
                            modalContainer.style.width = '1000px';
                            break;
                        default:
                            //md
                            modalContainer.style.width = '850px';
                    }
                },
                init() {
                    //listening for modal close buttons (smoother than emitting straight to parent
                    Livewire.on('closeModal', (data) => {
                        this.closeModal()
                    });
                }
            };
        }
    </script>

    <div
        x-data="LivewireModal()"
        @modal-mounted.window="modalMounted()"
        id="jlove-modal-backdrop"
    >
        <div
            style="display: none"
            x-data="{show: @entangle('showModal'), tetete: 'ssss'}"
            x-on:keydown.escape.window="closeModalOnEscape()"
            x-show="show"
        >
            <!-- backdrop-->
            <div
                x-on:click="closeModalOnClickAway()"
                class="fixed inset-0 bg-black/50 z-30 flex justify-center items-center">

                <!-- container -->
                <div
                    id="jlove-modal-container"
                    x-on:click.stop
                    x-transition:enter.duration.250ms
                    x-transition:leave.duration.250ms
                    x-data="{hasComponent: @entangle('activeComponent')}"
                    x-show="show && hasComponent"
                    class="bg-white rounded-xl fixed z-20"
                    @close-modal-on-client.window="show = false"
                >
                    <div class="py-2 relative">
                        @if(count($activeComponent) > 0)
                            @livewire($activeComponent['name'], [$activeComponent['attributes']])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
