  const navLinks = document.querySelectorAll('.navbar .nav-link');
  const currentPath = window.location.pathname;

  navLinks.forEach(link => {
    if (link.getAttribute('href') === currentPath || 
        (currentPath === '/' && link.getAttribute('href') === '/index.html')) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });