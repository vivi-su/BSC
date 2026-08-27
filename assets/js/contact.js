document.addEventListener('DOMContentLoaded', function () {

  const observer = new MutationObserver(function () {

    const message = document.querySelector(
      '.bsc-contact-form .et-pb-contact-message'
    );

    if (!message) {
      return;
    }

    const hasContent = message.textContent.trim() !== '';
    const hasErrors = message.querySelector('ul');

    message.classList.remove('is-success', 'is-error');

    if (!hasContent) {
      return;
    }

    if (hasErrors) {
      message.classList.add('is-error');
      return;
    }

    message.classList.add('is-success');

    setTimeout(function () {
      message.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
      });
    }, 150);

    observer.disconnect();
  });

  observer.observe(document.body, {
    childList: true,
    subtree: true
  });

});