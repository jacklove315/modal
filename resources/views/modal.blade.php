<div>
    <script>{!! file_get_contents(public_path() . '/vendor/jacklove315/modal/js/modal.js') !!}</script>

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
                class="fixed inset-0 bg-black/50 z-10 flex justify-center items-center">

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
