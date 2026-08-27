document.addEventListener('DOMContentLoaded', function () {

  const observer = new MutationObserver(function () {

    const successMessage = document.querySelector(
      '.et-pb-contact-message'
    );

    if (
      successMessage &&
      successMessage.textContent.trim() !== ''
    ) {
      successMessage.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
      });

      observer.disconnect();
    }

  });

  observer.observe(document.body, {
    childList: true,
    subtree: true
  });

});