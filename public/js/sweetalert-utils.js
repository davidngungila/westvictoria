// SweetAlert Utilities for CRUD Operations
class SweetAlertUtils {
    // Success notification
    static success(title, message = '') {
        return Swal.fire({
            icon: 'success',
            title: title,
            text: message,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            position: 'top-end',
            toast: true,
            showClass: {
                popup: 'animate__animated animate__fadeInRight'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutRight'
            }
        });
    }

    // Error notification
    static error(title, message = '') {
        return Swal.fire({
            icon: 'error',
            title: title,
            text: message,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }

    // Warning notification
    static warning(title, message = '') {
        return Swal.fire({
            icon: 'warning',
            title: title,
            text: message,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }

    // Info notification
    static info(title, message = '') {
        return Swal.fire({
            icon: 'info',
            title: title,
            text: message,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }

    // Confirm deletion
    static confirmDelete(title = 'Are you sure?', message = 'This action cannot be undone!') {
        return Swal.fire({
            title: title,
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        });
    }

    // Confirm action
    static confirmAction(title, message, confirmText = 'Yes', confirmColor = '#3085d6') {
        return Swal.fire({
            title: title,
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: confirmColor,
            cancelButtonColor: '#6c757d',
            confirmButtonText: confirmText,
            cancelButtonText: 'Cancel'
        });
    }

    // Loading state
    static loading(title = 'Loading...') {
        return Swal.fire({
            title: title,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    // Form submission success
    static formSuccess(title, message, redirectUrl = null) {
        return Swal.fire({
            icon: 'success',
            title: title,
            text: message,
            confirmButtonColor: '#3085d6',
            confirmButtonText: redirectUrl ? 'Continue' : 'OK'
        }).then((result) => {
            if (result.isConfirmed && redirectUrl) {
                window.location.href = redirectUrl;
            }
        });
    }

    // CRUD specific methods
    static createSuccess(entityName) {
        return this.success(`${entityName} Created`, `${entityName} has been created successfully!`);
    }

    static updateSuccess(entityName) {
        return this.success(`${entityName} Updated`, `${entityName} has been updated successfully!`);
    }

    static deleteSuccess(entityName) {
        return this.success(`${entityName} Deleted`, `${entityName} has been deleted successfully!`);
    }

    static createError(entityName, error = '') {
        return this.error('Creation Failed', `Failed to create ${entityName}. ${error}`);
    }

    static updateError(entityName, error = '') {
        return this.error('Update Failed', `Failed to update ${entityName}. ${error}`);
    }

    static deleteError(entityName, error = '') {
        return this.error('Deletion Failed', `Failed to delete ${entityName}. ${error}`);
    }

    // Validation errors
    static validationError(errors) {
        let errorMessage = 'Please fix the following errors:\n\n';
        if (typeof errors === 'object') {
            Object.keys(errors).forEach(key => {
                errorMessage += `-${errors[key][0]}\n`;
            });
        } else {
            errorMessage = errors;
        }
        
        return this.error('Validation Error', errorMessage);
    }

    // Network error
    static networkError() {
        return this.error('Network Error', 'A network error occurred. Please check your connection and try again.');
    }

    // Auto-dismiss notification
    static autoDismiss(title, message, type = 'success', duration = 3000) {
        return Swal.fire({
            icon: type,
            title: title,
            text: message,
            timer: duration,
            timerProgressBar: true,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    }
}

// Auto-initialize flash messages
document.addEventListener('DOMContentLoaded', function() {
    // Check for session flash messages
    const flashMessages = {
        success: document.querySelector('[data-flash-success]'),
        error: document.querySelector('[data-flash-error]'),
        warning: document.querySelector('[data-flash-warning]'),
        info: document.querySelector('[data-flash-info]')
    };

    // Display flash messages with SweetAlert
    if (flashMessages.success) {
        SweetAlertUtils.success('Success', flashMessages.success.textContent);
    }
    if (flashMessages.error) {
        SweetAlertUtils.error('Error', flashMessages.error.textContent);
    }
    if (flashMessages.warning) {
        SweetAlertUtils.warning('Warning', flashMessages.warning.textContent);
    }
    if (flashMessages.info) {
        SweetAlertUtils.info('Info', flashMessages.info.textContent);
    }
});

// Make SweetAlertUtils available globally
window.SweetAlertUtils = SweetAlertUtils;
