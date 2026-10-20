
"use strict";

document.addEventListener("DOMContentLoaded", function () {

    initializeSidebar();
    initializeSidebarDropdowns();
    initializeStickyHeader();
    cookies();

});


/**
 * 1. MOBILE SIDEBAR
 */
function initializeSidebar() {

    const sidebar = document.querySelector(".mobile-sidebar");
    const overlay = document.querySelector(".main-overlay");
    const openButton = document.querySelector(".offcanvas-nav-btn");
    const closeButton = document.querySelector(".mobile-sidebar-close");

    if (!sidebar || !overlay || !openButton || !closeButton) {
        return;
    }

    let previousFocus = null;

    function openSidebar() {

        previousFocus = document.activeElement;

        sidebar.removeAttribute("inert");
        sidebar.classList.add("open");
        overlay.classList.add("active");

        document.body.classList.add("sidebar-open");

        sidebar.setAttribute("aria-hidden", "false");
        openButton.setAttribute("aria-expanded", "true");

        closeButton.focus();

    }

    function closeSidebar() {

        sidebar.classList.remove("open");
        overlay.classList.remove("active");

        document.body.classList.remove("sidebar-open");

        openButton.setAttribute("aria-expanded", "false");

        // Restore focus before hiding the sidebar.
        if (previousFocus && previousFocus.isConnected) {
            previousFocus.focus();
        } else {
            openButton.focus();
        }

        sidebar.setAttribute("aria-hidden", "true");
        sidebar.setAttribute("inert", "");

    }

    openButton.addEventListener("click", function () {

        if (sidebar.classList.contains("open")) {
            closeSidebar();
        } else {
            openSidebar();
        }

    });

    closeButton.addEventListener("click", closeSidebar);

    overlay.addEventListener("click", closeSidebar);

    document.addEventListener("keydown", function (event) {

        if (!sidebar.classList.contains("open")) {
            return;
        }

        if (event.key === "Escape") {
            closeSidebar();
            return;
        }

        // Keep keyboard focus inside the open sidebar.
        if (event.key === "Tab") {

            const focusable = Array.from(
                sidebar.querySelectorAll(
                    'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])'
                )
            ).filter(function (element) {
                return element.getClientRects().length > 0;
            });

            if (focusable.length === 0) {
                return;
            }

            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }

        }

    });

    // Close sidebar when switching to desktop.
    const desktopBreakpoint = window.matchMedia("(min-width: 1200px)");

    desktopBreakpoint.addEventListener("change", function (event) {

        if (event.matches && sidebar.classList.contains("open")) {
            closeSidebar();
        }

    });

}


/**
 * 2. SIDEBAR DROPDOWNS
 */
function initializeSidebarDropdowns() {

    const sidebar = document.querySelector(".mobile-sidebar");

    if (!sidebar) {
        return;
    }

    const dropdownLinks = sidebar.querySelectorAll(
        ".dropdown-toggle"
    );

    dropdownLinks.forEach(function (link) {

        const submenu = link.nextElementSibling;

        if (!submenu || !submenu.classList.contains("dropdown-menu")) {
            return;
        }

        link.setAttribute("aria-expanded", "false");

        link.addEventListener("click", function (event) {

            event.preventDefault();

            const parentItem = link.parentElement;
            const isOpen = submenu.classList.contains("show");

            // Close sibling dropdowns at the same level.
            Array.from(parentItem.parentElement.children).forEach(function (item) {

                if (item === parentItem) {
                    return;
                }

                const otherMenu = Array.from(item.children).find(function (child) {
                    return child.classList.contains("dropdown-menu");
                });

                const otherToggle = Array.from(item.children).find(function (child) {
                    return child.classList.contains("dropdown-toggle");
                });

                if (otherMenu) {
                    otherMenu.classList.remove("show");

                    // Also close nested menus.
                    otherMenu.querySelectorAll(".dropdown-menu.show").forEach(function (nested) {
                        nested.classList.remove("show");
                    });

                    otherMenu.querySelectorAll('[aria-expanded="true"]').forEach(function (toggle) {
                        toggle.setAttribute("aria-expanded", "false");
                    });
                }

                if (otherToggle) {
                    otherToggle.setAttribute("aria-expanded", "false");
                }

            });

            submenu.classList.toggle("show", !isOpen);
            link.setAttribute("aria-expanded", String(!isOpen));

        });

    });

}


/**
 * 3. STICKY HEADER
 */
function initializeStickyHeader() {

    const header = document.querySelector(".header-nav-wrapper");
    const placeholder = document.querySelector(".sticky-height");
    const headerTop = document.querySelector(".header-top");

    if (!header) {
        return;
    }

    function updateHeader() {

        const topHeight = headerTop ? headerTop.offsetHeight : 0;

        const threshold = topHeight + 200;

        const shouldStick = window.scrollY > threshold;

        header.classList.toggle("scroll-on", shouldStick);

        if (placeholder) {

            placeholder.style.height = shouldStick
                ? header.offsetHeight + "px"
                : "0px";

        }

    }

    updateHeader();

    window.addEventListener("scroll", updateHeader, {
        passive: true
    });

    window.addEventListener("resize", updateHeader);

}

function cookies() {
    const cookieBox = document.querySelector(".cookies__modal");
    const acceptButton = document.querySelector("#acceptBtn");
    // const declineButton = document.querySelector("#declineBtn");

    if (document.cookie.includes("cookieBy=Weebix") ||
        document.cookie.includes("cookieDeclined=true")) {
        return;
    }

    cookieBox.classList.add("show");

    acceptButton.addEventListener("click", () => {
        cookieBox.classList.remove("show");
        document.cookie = "cookieBy=Weebix; max-age=" + 60 * 60 * 24 * 30 + "; path=/";
        window.location.reload();
    });

    // declineButton.addEventListener("click", () => {
    //     cookieBox.classList.remove("show");
    //     document.cookie = "cookieDeclined=true; max-age=" + 60 * 60 * 24 * 30 + "; path=/";
    //     window.location.reload();
    // });
}
