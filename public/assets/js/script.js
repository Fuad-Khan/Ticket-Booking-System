document.addEventListener('DOMContentLoaded', function() {
    // Seat selection logic
    const seats = document.querySelectorAll('.seat');
    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            this.classList.toggle('selected');
            updateTotalPrice();
        });
    });

    function updateTotalPrice() {
        const selectedSeats = document.querySelectorAll('.seat.selected');
        const pricePerSeat = 800; // Fetch from PHP if dynamic
        document.getElementById('total-price').textContent = selectedSeats.length * pricePerSeat;
    }
});