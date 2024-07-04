const navItems = document.querySelectorAll('.nav-link');

navItems.forEach(item => {
  item.addEventListener('click', () => {
    navItems.forEach(item => {
      item.classList.remove('active');
    });
    item.classList.add('active');
  })
});