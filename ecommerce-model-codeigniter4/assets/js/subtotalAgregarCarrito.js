

document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('.modal');

    modals.forEach(function(modal) {
        const selectQty = modal.querySelector('[id^="ID-Cantidad"]');
        
        if (selectQty) {  // Verificar si selectQty existe
            const productId = selectQty.id.replace('ID-Cantidad', '');
            const priceElement = modal.querySelector(`#productPrice${productId}`);
            const subtotalElement = modal.querySelector(`#subtotal${productId}`);

            if (priceElement && subtotalElement) {  // Verificar si priceElement y subtotalElement existen
                const price = parseFloat(priceElement.value);

                function updateSubtotal() {
                    const qty = parseInt(selectQty.value);
                    subtotalElement.textContent = (qty * price).toFixed(2);
                }

                selectQty.addEventListener('change', updateSubtotal);
                updateSubtotal();  // Inicializar el subtotal
            }
        }
    });
});