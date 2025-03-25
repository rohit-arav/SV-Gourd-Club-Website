document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('a.nav-link');
  
    navLinks.forEach(link => {
      link.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
  
        // Check if the link is an internal anchor link (starts with #)
        if (href.startsWith('#')) {
          e.preventDefault();
          const targetSection = document.getElementById(href.substring(1));
          if (targetSection) {
            targetSection.scrollIntoView({
              behavior: 'smooth'
            });
          }
        }
      });
    });
  });
  