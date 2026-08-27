document.addEventListener('DOMContentLoaded', function () {

  const observer = new MutationObserver(function () {

    const message = document.querySelector(
      '.bsc-contact-form .et-pb-contact-message'
    );

    if (!message) {
      return;
    }

    /* Ignore validation/error messages */
    if (message.querySelector('ul')) {
      return;
    }

    /* Only scroll when there is actual success text */
    if (message.textContent.trim() === '') {
      return;
    }

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