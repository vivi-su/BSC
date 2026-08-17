document.addEventListener('DOMContentLoaded', function () {
    const tocLinks = document.querySelectorAll('.toc__list a');

    const sections = Array.from(tocLinks)
        .map(function (link) {
            const target = document.querySelector(link.getAttribute('href'));

            return target
                ? {
                    link: link,
                    section: target
                }
                : null;
        })
        .filter(Boolean);

    function updateActiveSection() {
        let current = null;

        sections.forEach(function (item) {
            const rect = item.section.getBoundingClientRect();

            if (rect.top <= 180) {
                current = item;
            }
        });

        tocLinks.forEach(function (link) {
            link.classList.remove('is-active');
        });

        if (current) {
            current.link.classList.add('is-active');
        }
    }

    window.addEventListener(
        'scroll',
        updateActiveSection,
        { passive: true }
    );

    updateActiveSection();
});