document.addEventListener("DOMContentLoaded", function () {
    const dropdown = document.querySelector(".dropdown");

    dropdown.addEventListener("click", function (event) {
        if (event.target.closest('.dropdown-content')) return; // Prevent closing when clicking on dropdown content

        this.classList.toggle("active");
        const dropdownContent = this.querySelector(".dropdown-content");
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });

    // Close the dropdown when clicking outside of it
    window.addEventListener("click", function (event) {
        if (!event.target.matches('.dropdown') && !event.target.closest('.dropdown')) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(function (dropdown) {
                dropdown.classList.remove('active');
                dropdown.querySelector('.dropdown-content').style.display = 'none';
            });
        }
    });
});
