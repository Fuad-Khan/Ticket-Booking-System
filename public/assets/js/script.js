document.addEventListener('DOMContentLoaded', function() {
    // Autocomplete for source and destination inputs
    const sourceInput = document.getElementById('source');
    const destinationInput = document.getElementById('destination');
    
    if (sourceInput && destinationInput) {
        // In a real app, you would fetch these from the server
        const places = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix'];
        
        sourceInput.addEventListener('input', function() {
            // Implement autocomplete logic here
        });
        
        destinationInput.addEventListener('input', function() {
            // Implement autocomplete logic here
        });
    }
    
    // Seat selection
    const seats = document.querySelectorAll('.seat.available');
    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            const checkbox = this.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            this.classList.toggle('selected', checkbox.checked);
        });
    });
});