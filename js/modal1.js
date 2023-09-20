const loginModal = document.getElementById('loginModal');
const loginModalTrigger = document.querySelector('[data-target="#loginModal"]');
const loginModalCloseButton = document.querySelector('#loginModal .close');

loginModalTrigger.addEventListener('click', () => {
    loginModal.style.display = 'block';
});

loginModalCloseButton.addEventListener('click', () => {
    loginModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === loginModal) {
        loginModal.style.display = 'none';
    }
});
