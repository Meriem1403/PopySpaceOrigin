// assets/controllers/modal_controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['dialog', 'dynamicContent', 'loadingContent'];

    // We'll hold our MutationObserver here
    observer = null;

    connect() {
        if (this.hasDynamicContentTarget) {
            // Observe changes in the dynamicContentTarget to open/close the dialog
            this.observer = new MutationObserver(() => {
                const hasContent = this.dynamicContentTarget.innerHTML.trim().length > 0;
                if (hasContent && !this.dialogTarget.open) {
                    this.open();
                } else if (!hasContent && this.dialogTarget.open) {
                    this.close();
                }
            });
            this.observer.observe(this.dynamicContentTarget, {
                childList: true,
                characterData: true,
                subtree: true
            });
        }
    }

    disconnect() {
        if (this.observer) {
            this.observer.disconnect();
        }
        if (this.hasDialogTarget && this.dialogTarget.open) {
            this.close();
        }
    }

    open() {
        this.dialogTarget.showModal();
        document.body.classList.add('overflow-hidden', 'blur-sm');
    }

    close() {
        this.dialogTarget.close();
        document.body.classList.remove('overflow-hidden', 'blur-sm');
    }

    clickOutside(event) {
        // Close the dialog if the user clicks the backdrop (<dialog> element itself)
        if (this.hasDialogTarget && event.target === this.dialogTarget) {
            this.close();
        }
    }

    showLoading() {
        // If not already open, show the loading template while fetching
        if (this.hasDialogTarget && !this.dialogTarget.open && this.hasLoadingContentTarget) {
            this.dynamicContentTarget.innerHTML = this.loadingContentTarget.innerHTML;
        }
    }
}
