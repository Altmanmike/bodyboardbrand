document.addEventListener('scroll', () => {
    const parallax = document.querySelector('.parallax-container::before');
    const scrollPosition = window.scrollY;
  
    // Applique un décalage en fonction du défilement
    parallax.style.backgroundPositionY = `${scrollPosition * 0.5}px`;
  });
  