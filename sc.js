document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("content");

    // Function to load content based on menu item
    function loadContent(pageId) {
        // You can use a switch statement or other logic to load content here
        switch (pageId) {
            case "page1":
                content.innerHTML = "<?php require './login.php";
                break;
            case "page2":
                content.innerHTML = "<h2>Page 2 Content</h2><p>This is the content for Page 2.</p>";
                break;
            case "page3":
                content.innerHTML = "<h2>Page 3 Content</h2><p>This is the content for Page 3.</p>";
                break;
        }
    }

    // Add click event listeners to menu items
    const menuItems = document.querySelectorAll(".sidebar ul li a");
    menuItems.forEach((menuItem) => {
        menuItem.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent the default link behavior
            const pageId = this.getAttribute("id");
            loadContent(pageId);
        });
    });
});
