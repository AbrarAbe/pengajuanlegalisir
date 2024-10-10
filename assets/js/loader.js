document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.preload-link');
  const submitBtn = document.getElementById('submitBtn');
  const preloaderLink = document.getElementById('preloaderLink');
  const preloaderSubmit = document.getElementById('preloaderSubmit');

  const showPreloader = (element) => {
    element.classList.add('show-preloader');
    setTimeout(() => {
      element.classList.remove('show-preloader');
    }, 1000); 
  };

  links.forEach(link => {
    link.addEventListener('click', (event) => {
      showPreloader(preloaderLink);
      setTimeout(() => {
                window.location.href = link.href;
      }, 1000); 
            event.preventDefault();
        });
    });

  submitBtn.addEventListener('click', () => {
        preloaderSubmit.style.display = 'flex';
    setTimeout(() => {
      preloaderSubmit.style.display = 'none';
            document.getElementById('loginForm').submit();
    }, 1000);
    });
});