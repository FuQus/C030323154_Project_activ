document. addEventListener('DOMContentLoaded', () =>{document.addEventListener('DOMContentLoaded', () => {
    const decrementButton = document.querySelector('#decrement');
    const incrementButton = document.querySelector('#increment');
    const countDisplay = document.querySelector('#quantity');
    const hiddenInput = document.querySelector('#quantity_input');

    // Payment details elements
    const displayQuantity = document.getElementById('display_quantity');
    const priceDisplay = document.getElementById('sub_total');
    const taxDisplay = document.getElementById('tax');
    const totalPriceDisplay = document.getElementById('total_amount');
    const workshopPrice = document.getElementById('workshopPrice');

    const participantsSection = document.getElementById('Attendants-Section');

    // Constants
    const unitPrice = workshopPrice.value; // Price per item
    const ppnRate = 0.11; // PPN rate (11%)

    function updatePaymentDetails(count) {
        const price = unitPrice * count;
        const ppn = Math.round(price * ppnRate);
        const totalPrice = price + ppn;

        displayQuantity.textContent = count;
        priceDisplay.textContent = `Rp${price.toLocaleString('id-ID')}`;
        taxDisplay.textContent = `Rp${ppn.toLocaleString('id-ID')}`;
        totalPriceDisplay.textContent = `Rp${totalPrice.toLocaleString('id-ID')}`;
    }

    // Add a new participant form group
    function addParticipant() {
        const participantCount = participantsSection.querySelectorAll('.attendant-wrapper').length;
        // Functionality for adding participants can be implemented here
    }

    // Event listeners for increment/decrement buttons
    incrementButton.addEventListener('click', () => {
        let count = parseInt(hiddenInput.value, 10) || 0;
        count++;
        hiddenInput.value = count;
        countDisplay.textContent = count;
        updatePaymentDetails(count);
    });

    decrementButton.addEventListener('click', () => {
        let count = parseInt(hiddenInput.value, 10) || 0;
        if (count > 0) {
            count--;
            hiddenInput.value = count;
            countDisplay.textContent = count;
            updatePaymentDetails(count);
        }
    });
});

})