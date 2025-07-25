// assets/controllers/closeable_controller.js
import { Controller } from '@hotwired/stimulus';
import { useTransition } from 'stimulus-use';

export default class extends Controller {
    static values = {
        autoClose: Number,        // data-closeable-auto-close-value
    };

    static targets = ['timerbar']; // data-closeable-target="timerbar"

    connect() {
        // configure le fade‑out
        useTransition(this, {
            leaveActive:  'transition ease-in duration-200',
            leaveFrom:    'opacity-100',
            leaveTo:      'opacity-0',
            transitioned: true,
        });

        // si un délai est fourni, on ferme après
        if (this.autoCloseValue) {
            setTimeout(() => this.close(), this.autoCloseValue);

            // si la barre existe, on la fait se réduire
            if (this.hasTimerbarTarget) {
                setTimeout(() => {
                    this.timerbarTarget.style.width = 0;
                }, 10);
            }
        }
    }

    close() {
        this.leave();
    }
}
