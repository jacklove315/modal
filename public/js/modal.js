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
