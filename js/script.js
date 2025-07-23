const sidebar = document.getElementById('sidebar');
const toggler = document.getElementById('togglerButton');

toggler.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
});