/**
 * CSRF Token Handler
 * Provides utilities for handling CSRF tokens and 419 errors
 */

class CSRFHandler {
    constructor() {
        this.token = this.getToken();
        this.setupAxiosInterceptors();
    }

    /**
     * Get CSRF token from meta tag
     */
    getToken() {
        const token = document.head.querySelector('meta[name="csrf-token"]');
        return token ? token.content : null;
    }

    /**
     * Refresh CSRF token
     */
    async refreshToken() {
        try {
            const response = await fetch('/csrf-token', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();
                this.token = data.csrf_token;
                
                // Update meta tag
                const metaTag = document.head.querySelector('meta[name="csrf-token"]');
                if (metaTag) {
                    metaTag.content = data.csrf_token;
                }
                
                // Update axios default header
                if (window.axios) {
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = data.csrf_token;
                }
                
                return data.csrf_token;
            }
        } catch (error) {
            // Silently handle CSRF token refresh failure
        }
        return null;
    }

    /**
     * Setup axios interceptors for handling 419 errors
     */
    setupAxiosInterceptors() {
        if (!window.axios) return;

        // Request interceptor to ensure token is always fresh
        window.axios.interceptors.request.use(
            (config) => {
                if (this.token) {
                    config.headers['X-CSRF-TOKEN'] = this.token;
                }
                return config;
            },
            (error) => Promise.reject(error)
        );

        // Response interceptor to handle 419 errors
        window.axios.interceptors.response.use(
            (response) => response,
            async (error) => {
                if (error.response && error.response.status === 419) {
                    // CSRF token mismatch detected, attempting to refresh
                    
                    // Try to refresh the token
                    const newToken = await this.refreshToken();
                    
                    if (newToken) {
                        // Retry the original request with new token
                        error.config.headers['X-CSRF-TOKEN'] = newToken;
                        return window.axios.request(error.config);
                    } else {
                        // If refresh fails, show user-friendly message
                        this.showErrorMessage('Your session has expired. Please refresh the page and try again.');
                    }
                }
                
                return Promise.reject(error);
            }
        );
    }

    /**
     * Show error message to user
     */
    showErrorMessage(message) {
        // You can customize this to match your UI framework
        if (typeof Swal !== 'undefined') {
            // SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Session Expired',
                text: message,
                confirmButtonText: 'Refresh Page'
            }).then(() => {
                window.location.reload();
            });
        } else if (typeof toastr !== 'undefined') {
            // Toastr
            toastr.error(message);
        } else {
            // Fallback to alert
            alert(message);
        }
    }

    /**
     * Get current CSRF token
     */
    getCurrentToken() {
        return this.token;
    }

    /**
     * Manually set CSRF token
     */
    setToken(token) {
        this.token = token;
        if (window.axios) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
        }
    }
}

// Initialize CSRF handler when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.csrfHandler = new CSRFHandler();
});

// Export for use in other modules
export default CSRFHandler;


