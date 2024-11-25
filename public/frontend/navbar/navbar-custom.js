document.addEventListener("DOMContentLoaded", function () {

    // Get the navbar with the ID 'mainNav'
    const navbar = document.getElementById('mainNav');

    if (!navbar) return; // Exit if no navbar with the specified ID is found

    /////// Prevent closing from click inside dropdown
    navbar.querySelectorAll('.dropdown-menu').forEach(function (element) {
        element.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });

    // Make it as accordion for smaller screens
    if (window.innerWidth < 992) {

        // Close all inner dropdowns when parent is closed
        navbar.querySelectorAll('.navbar .dropdown').forEach(function (everydropdown) {
            everydropdown.addEventListener('hidden.bs.dropdown', function () {
                // After dropdown is hidden, then find all submenus
                this.querySelectorAll('.submenu').forEach(function (everysubmenu) {
                    // Hide every submenu as well
                    everysubmenu.style.display = 'none';
                });
            });
        });

        // Handle click events for dropdown items
        navbar.querySelectorAll('.dropdown-menu a').forEach(function (element) {
            element.addEventListener('click', function (e) {
                let nextEl = this.nextElementSibling;
                if (nextEl && nextEl.classList.contains('submenu')) {
                    // Prevent opening link if link needs to open dropdown
                    e.preventDefault();
                    // Toggle submenu display
                    if (nextEl.style.display == 'block') {
                        nextEl.style.display = 'none';
                    } else {
                        nextEl.style.display = 'block';
                    }
                }
            });
        });

    }

});


/*---------------------------------
Disable copy Start
-----------------------------------*/
/* $('body').bind('cut copy paste', function (e) {
    e.preventDefault();
});

$("body").on("contextmenu", function (e) {
    return false;
}); */