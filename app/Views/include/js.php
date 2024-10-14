<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!-- Custom JS -->
<script src="scripts.js"></script>


<script>
        jQuery.noConflict();
        jQuery(document).ready(function ($) {
                // Your jQuery code here
                $.get('/categories/getAll', function (categories) {
                        console.log('Fetched Categories:', categories);
                        renderCategories(categories);
                }).fail(function (jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching categories:', textStatus,
                                errorThrown);
                });

                function renderCategories(categories) {
                        const dropdownMenu = $('#categoriesDropdown');
                        dropdownMenu.empty(); // Clear existing items

                        if (categories.length === 0) {
                                dropdownMenu.append(
                                        '<div class="dropdown-item">No categories found</div>');
                                return;
                        }

                        categories.forEach(category => {
                                dropdownMenu.append(`
        <a class="dropdown-item" href="/category/${category.slug}">${category.category_name}</a>
    `);
                        });
                }

        });


        document.querySelectorAll('.scroll-btn').forEach(button => {
                button.addEventListener('click', function () {
                        const scrollSection = document.querySelector('.' + this
                                .getAttribute(
                                        'data-scroll-target'));
                        const scrollAmount =
                                300; // Adjust the amount of scroll per button press

                        if (this.classList.contains('left-scroll')) {
                                scrollSection.scrollBy({
                                        left: -scrollAmount,
                                        behavior: 'smooth'
                                });
                        } else {
                                scrollSection.scrollBy({
                                        left: scrollAmount,
                                        behavior: 'smooth'
                                });
                        }
                });
        });


        // Select all scrollable sections on the page
        const scrollableSections = document.querySelectorAll('.scrollable-section-container');

        scrollableSections.forEach((section) => {
                const scrollable = section.querySelector('.scrollable-section');
                const leftScrollBtn = section.querySelector('.left-scroll');
                const rightScrollBtn = section.querySelector('.right-scroll');

                // Function to check scroll position and toggle buttons
                const checkScroll = () => {
                        // Hide left button if at the start of scroll
                        if (scrollable.scrollLeft <= 0) {
                                leftScrollBtn.style.display = 'none';
                        } else {
                                leftScrollBtn.style.display = 'flex';
                        }

                        // Hide right button if at the end of scroll
                        if (scrollable.scrollLeft + scrollable.clientWidth >= scrollable
                                .scrollWidth) {
                                rightScrollBtn.style.display = 'none';
                        } else {
                                rightScrollBtn.style.display = 'flex';
                        }
                };

                // Initial check for scroll position when the page loads
                checkScroll();

                // Add event listener for scrolling (this will check the position as the user scrolls)
                scrollable.addEventListener('scroll', checkScroll);

                // Scroll right button
                rightScrollBtn.addEventListener('click', () => {
                        scrollable.scrollBy({
                                left: 300, // Adjust scroll amount
                                behavior: 'smooth'
                        });
                });

                // Scroll left button
                leftScrollBtn.addEventListener('click', () => {
                        scrollable.scrollBy({
                                left: -300, // Adjust scroll amount
                                behavior: 'smooth'
                        });
                });

                // Check scroll position again after clicking (to update buttons visibility)
                rightScrollBtn.addEventListener('click', checkScroll);
                leftScrollBtn.addEventListener('click', checkScroll);
        });
</script>