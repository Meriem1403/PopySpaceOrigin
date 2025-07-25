// assets/controllers/popover_controller.js
import Popover from 'stimulus-popover';

export default class extends Popover {
    static targets = ['card'];

    async show(event) {
        if (this.hasCardTarget) {
            // If we have a custom <template data-popover-target="card">, just reveal it
            this.cardTarget.classList.remove('hidden');
            return;
        }

        // Otherwise fallback to the default Popover behavior
        super.show(event);
    }

    hide() {
        if (this.hasCardTarget) {
            // Hide our custom popover card
            this.cardTarget.classList.add('hidden');
            return;
        }

        // Otherwise fallback
        super.hide();
    }
}
