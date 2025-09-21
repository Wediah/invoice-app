@props([])

<!-- Toast Container -->
<div id="toast-container" class="top-0 p-3 toast-container position-fixed end-0" style="z-index: 9999;">
    <!-- Toast notifications will be dynamically inserted here -->
</div>

<!-- Toast Template (hidden) -->
<div id="toast-template" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <div class="toast-icon me-2">
            <!-- Icon will be inserted here -->
        </div>
        <strong class="me-auto toast-title">Notification</strong>
        <small class="toast-time">now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        <!-- Message will be inserted here -->
    </div>
</div>

<style>
.toast-container {
    max-width: 350px;
}

.toast {
    margin-bottom: 10px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border: none;
    border-radius: 0.5rem;
}

.toast-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    background-color: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

.toast-body {
    background-color: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

.toast-icon {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.toast-success .toast-header {
    background-color: rgba(25, 135, 84, 0.1);
    border-bottom-color: rgba(25, 135, 84, 0.2);
}

.toast-success .toast-body {
    background-color: rgba(25, 135, 84, 0.05);
}

.toast-info .toast-header {
    background-color: rgba(13, 202, 240, 0.1);
    border-bottom-color: rgba(13, 202, 240, 0.2);
}

.toast-info .toast-body {
    background-color: rgba(13, 202, 240, 0.05);
}

.toast-warning .toast-header {
    background-color: rgba(255, 193, 7, 0.1);
    border-bottom-color: rgba(255, 193, 7, 0.2);
}

.toast-warning .toast-body {
    background-color: rgba(255, 193, 7, 0.05);
}

.toast-error .toast-header {
    background-color: rgba(220, 53, 69, 0.1);
    border-bottom-color: rgba(220, 53, 69, 0.2);
}

.toast-error .toast-body {
    background-color: rgba(220, 53, 69, 0.05);
}

/* Animation for toast appearance */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

.toast.show {
    animation: slideInRight 0.3s ease-out;
}

.toast.hide {
    animation: slideOutRight 0.3s ease-in;
}
</style>

<script>
class ToastNotification {
    constructor() {
        this.container = document.getElementById('toast-container');
        this.template = document.getElementById('toast-template');
    }

    show(message, type = 'info', duration = 5000) {
        // Create new toast element
        const toast = this.template.cloneNode(true);
        toast.id = 'toast-' + Date.now();
        toast.classList.remove('hide');
        toast.classList.add('show', `toast-${type}`);

        // Set icon based on type
        const iconElement = toast.querySelector('.toast-icon');
        const icons = {
            success: '<i class="bx bx-check-circle text-success"></i>',
            info: '<i class="bx bx-info-circle text-info"></i>',
            warning: '<i class="bx bx-error-circle text-warning"></i>',
            error: '<i class="bx bx-x-circle text-danger"></i>'
        };
        iconElement.innerHTML = icons[type] || icons.info;

        // Set title based on type
        const titleElement = toast.querySelector('.toast-title');
        const titles = {
            success: 'Success',
            info: 'Information',
            warning: 'Warning',
            error: 'Error'
        };
        titleElement.textContent = titles[type] || titles.info;

        // Set message
        const bodyElement = toast.querySelector('.toast-body');
        bodyElement.textContent = message;

        // Set time
        const timeElement = toast.querySelector('.toast-time');
        timeElement.textContent = 'now';

        // Add to container
        this.container.appendChild(toast);

        // Initialize Bootstrap toast
        const bsToast = new bootstrap.Toast(toast, {
            autohide: true,
            delay: duration
        });

        // Show toast
        bsToast.show();

        // Remove from DOM after hiding
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });

        return toast;
    }

    success(message, duration = 5000) {
        return this.show(message, 'success', duration);
    }

    info(message, duration = 5000) {
        return this.show(message, 'info', duration);
    }

    warning(message, duration = 5000) {
        return this.show(message, 'warning', duration);
    }

    error(message, duration = 5000) {
        return this.show(message, 'error', duration);
    }
}

// Initialize toast notification system
window.Toast = new ToastNotification();

// Auto-show session messages
document.addEventListener('DOMContentLoaded', function() {
    @if (session('success'))
        window.Toast.success('{{ session('success') }}');
    @endif

    @if (session('info'))
        window.Toast.info('{{ session('info') }}');
    @endif

    @if (session('error'))
        window.Toast.error('{{ session('error') }}');
    @endif

    @if (session('warning'))
        window.Toast.warning('{{ session('warning') }}');
    @endif
});
</script>
