function getStatusClass(status, stsPay) {
    if (status === 'active' && stsPay === 'Valid') {
        return 'active-valid';
    } else if (status === 'cancel' && stsPay === 'expired') {
        return 'cancel-expired';
    } else if (status === 'pass' && stsPay === 'Pending') {
        return 'pass-pending';
    } else {
        return ''; // Return an empty class if none of the conditions match
    }
}