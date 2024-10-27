document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const hamburger = document.querySelector("#toggle-btn");
    hamburger.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("expand");
    });
    
    const form = document.querySelector('.form-container');

    form.addEventListener('submit', function(event) {
        let valid = true; // Flag to track validity

        // Get input values
        const minKilos = document.getElementById('min_kilos').value;
        const maxKilos = document.getElementById('min_kilos').value;
        const deliveryDate = document.getElementById('delivery_date').value;
        const deliveryCharge = document.getElementById('delivery_charge').value;
        const pickupCharge = document.getElementById('pickup_charge').value;

        // Validate Minimum Kilos
        if (minKilos.trim() === '' || isNaN(minKilos) || minKilos < 0) {
            valid = false;
            Swal.fire({
                icon: 'error',
                title: 'Invalid Minimum Kilos',
                text: 'Please enter a valid number for minimum kilos.',
            });
        }

        // Validate Maxnimum Kilos
        if (maxKilos.trim() === '' || isNaN(maxKilos) || maxKilos < 0) {
            valid = false;
            Swal.fire({
                icon: 'error',
                title: 'Invalid Minimum Kilos',
                text: 'Please enter a valid number for minimum kilos.',
            });
        }

        // Validate Delivery Date
       /* if (deliveryDate.trim() === '') {
            valid = false;
            Swal.fire({
                icon: 'error',
                title: 'Invalid Delivery Date',
                text: 'Please select a delivery date.',
            });
        }*/

        // Validate Delivery Charge
        if (deliveryCharge.trim() === '' || isNaN(deliveryCharge) || deliveryCharge < 0) {
            valid = false;
            Swal.fire({
                icon: 'error',
                title: 'Invalid Delivery Charge',
                text: 'Please enter a valid number for delivery charge.',
            });
        }

        // Validate Pickup Charge
        if (pickupCharge.trim() === '' || isNaN(pickupCharge) || pickupCharge < 0) {
            valid = false;
            Swal.fire({
                icon: 'error',
                title: 'Invalid Pickup Charge',
                text: 'Please enter a valid number for pickup charge.',
            });
        }

        // Prevent form submission if any validation fails
        if (!valid) {
            event.preventDefault();
        }
    });
});