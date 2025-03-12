const transportButtons = document.querySelectorAll('.transport-options button');

transportButtons.forEach(button => {
    button.addEventListener('click', () => {
        transportButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    });
});