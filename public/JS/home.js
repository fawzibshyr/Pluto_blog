
const menuToggle = document.getElementById('menuToggle');
const navMenu = document.getElementById('navMenu');

if (menuToggle && navMenu) {
  menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('active');
    navMenu.classList.toggle('active');
  });

  document.addEventListener('click', (e) => {
    if (!navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
      menuToggle.classList.remove('active');
      navMenu.classList.remove('active');
    }
  });
}


const navigation = document.querySelector('.navigation');

window.addEventListener('scroll', () => {
  if (!navigation) return;
  if (window.pageYOffset > 100) {
    navigation.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
  } else {
    navigation.style.boxShadow = 'none';
  }
});


const newsletterForm = document.getElementById('newsletterForm');
const emailInput = document.getElementById('emailInput');
const formMessage = document.getElementById('formMessage');

if (newsletterForm && emailInput && formMessage) {
  newsletterForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const email = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email) return showMessage('Please enter your email address.', 'error');
    if (!emailRegex.test(email)) return showMessage('Please enter a valid email address.', 'error');

    showMessage('Thank you for subscribing!', 'success');
    emailInput.value = '';
  });

  function showMessage(message, type) {
    formMessage.textContent = message;
    formMessage.className = `form-message ${type}`;
    setTimeout(() => {
      formMessage.textContent = '';
      formMessage.className = 'form-message';
    }, 5000);
  }
}