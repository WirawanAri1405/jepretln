document.addEventListener('DOMContentLoaded', function () {
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                // The content panel is the next element sibling
                const accordionContent = header.nextElementSibling;
                // The SVG icon within the header
                const accordionIcon = header.querySelector('.accordion-icon');

                // Toggle the 'hidden' class to show/hide content
                accordionContent.classList.toggle('hidden');

                // Rotate the icon
                if (accordionContent.classList.contains('hidden')) {
                    accordionIcon.style.transform = 'rotate(0deg)';
                } else {
                    accordionIcon.style.transform = 'rotate(180deg)';
                }
            });
        });
    });