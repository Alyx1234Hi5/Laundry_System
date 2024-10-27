document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const hamburger = document.querySelector("#toggle-btn");
    hamburger.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("expand");
    });

    // Open update form
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function() {
            const price = this.getAttribute("data-price");
            const categoryOption = this.getAttribute("data-option");
            const serviceId = this.getAttribute("data-id");
            const categoryId = this.getAttribute("data-category-id");

            document.getElementById("price").value = price; // Set the price in the input field
            document.getElementById("laundry_category_option").value = categoryOption;
            document.getElementById("service_id").value = serviceId;
            document.getElementById("category_id").value = categoryId;

            // Show the edit form
            document.getElementById("editForm").style.display = "flex";
            document.body.classList.add('modal-open');
        });
    });

    // Close the form
    const closeFormButton = document.querySelector('.form-popup .close');
    closeFormButton.addEventListener('click', closeForm);
    
    // For cancel button
    const cancelButton = document.getElementById('cancelButton');
    cancelButton.addEventListener('click', closeForm);

    function closeForm() {
        document.getElementById("editForm").style.display = 'none';
        document.body.classList.remove('modal-open'); 
        document.getElementById("editForm").reset();
    }

    // Additional validation for price input
    const submitButton = document.querySelector('.btn-success');
    submitButton.addEventListener('click', function(event) {
        const priceInput = document.getElementById("price").value;
        if (priceInput.trim() === '' ||isNaN(priceInput) || priceInput < 0) {
            event.preventDefault(); // Prevent form submission
            Swal.fire({
                icon: 'error',
                title: 'Invalid price!',
                text: 'Please enter a valid price.',
            });
        }
    });
});