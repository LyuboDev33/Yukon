
"use strict";

document.addEventListener("DOMContentLoaded", function () {

    initializeSidebar();
    initializeSidebarDropdowns();
    initializeStickyHeader();
    cookies();
    initCustomOfferBox();

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


function initCustomOfferBox() {
    const modal = document.getElementById('customOfferModal');

    // Stop if the modal doesn't exist on this page.
    if (!modal) return;

    const lengthInput = modal.querySelector('#customLength');
    const widthInput = modal.querySelector('#customWidth');
    const heightInput = modal.querySelector('#customHeight');

    const svg = modal.querySelector('#customBoxSvg');
    const volumeElement = modal.querySelector('#customBoxVolume');

    if (!lengthInput || !widthInput || !heightInput || !svg) return;

    const svgNS = 'http://www.w3.org/2000/svg';

    // Preserve the existing SVG definitions (textures, gradients, arrows).
    const defs = svg.querySelector('defs')?.cloneNode(true);

    function createSvgElement(tag, attributes, text = null) {
        const element = document.createElementNS(svgNS, tag);

        Object.entries(attributes).forEach(([key, value]) => {
            element.setAttribute(key, value);
        });

        if (text !== null) {
            element.textContent = text;
        }

        return element;
    }

    function drawBox() {
        const L = parseFloat(lengthInput.value);
        const W = parseFloat(widthInput.value);
        const H = parseFloat(heightInput.value);

        if (
            !Number.isFinite(L) || L <= 0 ||
            !Number.isFinite(W) || W <= 0 ||
            !Number.isFinite(H) || H <= 0
        ) {
            return;
        }

        // Calculate volume: mm³ to liters.
        const volume = (L * W * H) / 1000000;

        if (volumeElement) {
            volumeElement.textContent =
                volume.toLocaleString('bg-BG', {
                    minimumFractionDigits: 1,
                    maximumFractionDigits: 2
                }) + ' литра';
        }

        // Scale all dimensions proportionally.
        const maxDimension = Math.max(L, W, H);

        const scale = 240 / maxDimension;

        const l = L * scale;
        const w = W * scale;
        const h = H * scale;

        // Isometric projection.
        const depthX = w * 0.65;
        const depthY = w * 0.38;

        const frontDepthX = l * 0.65;
        const frontDepthY = l * 0.38;

        // Starting position.
        const centerX = 330;
        const centerY = 260;

        // Box corners.
        const bottom = {
            x: centerX,
            y: centerY + h / 2
        };

        const left = {
            x: bottom.x - frontDepthX,
            y: bottom.y - frontDepthY
        };

        const right = {
            x: bottom.x + depthX,
            y: bottom.y - depthY
        };

        const back = {
            x: left.x + depthX,
            y: left.y - depthY
        };

        const topBottom = {
            x: bottom.x,
            y: bottom.y - h
        };

        const topLeft = {
            x: left.x,
            y: left.y - h
        };

        const topRight = {
            x: right.x,
            y: right.y - h
        };

        const topBack = {
            x: back.x,
            y: back.y - h
        };

        // Clear previous geometry.
        svg.innerHTML = '';

        if (defs) {
            svg.appendChild(defs.cloneNode(true));
        }

        // Automatically fit the drawing inside the SVG.
        const points = [
            bottom, left, right, back,
            topBottom, topLeft, topRight, topBack
        ];

        const xs = points.map(point => point.x);
        const ys = points.map(point => point.y);

        const minX = Math.min(...xs);
        const maxX = Math.max(...xs);
        const minY = Math.min(...ys);
        const maxY = Math.max(...ys);

        const padding = 85;

        svg.setAttribute(
            'viewBox',
            `${minX - padding} ${minY - padding} ${maxX - minX + padding * 2} ${maxY - minY + padding * 2}`
        );

        function polygon(points, fill, stroke = 'none') {
            return createSvgElement('polygon', {
                points: points.map(p => `${p.x},${p.y}`).join(' '),
                fill,
                stroke,
                'stroke-width': 1.2,
                'stroke-linejoin': 'round'
            });
        }

        function line(x1, y1, x2, y2, options = {}) {
            return createSvgElement('line', {
                x1, y1, x2, y2,
                stroke: options.stroke || '#2D3748',
                'stroke-width': options.width || 1.5,
                'marker-start': options.arrows ? 'url(#customBoxArrow)' : '',
                'marker-end': options.arrows ? 'url(#customBoxArrow)' : ''
            });
        }

        function label(x, y, value, rotation = 0) {
            return createSvgElement('text', {
                x,
                y,
                fill: '#2D3748',
                'font-family': 'Arial, sans-serif',
                'font-size': 15,
                'font-weight': 'bold',
                'text-anchor': 'middle',
                'dominant-baseline': 'middle',
                transform: `rotate(${rotation}, ${x}, ${y})`
            }, `${value} мм`);
        }

        // Ground shadow.
        const shadow = polygon(
            [left, bottom, right, back],
            'rgba(0,0,0,0.08)'
        );

        shadow.setAttribute('transform', 'translate(5, 12)');
        svg.appendChild(shadow);

        // Front wall.
        svg.appendChild(
            polygon(
                [left, bottom, topBottom, topLeft],
                'url(#kraftPattern)',
                '#5c3b17'
            )
        );

        svg.appendChild(
            polygon(
                [left, bottom, topBottom, topLeft],
                'url(#frontShade)'
            )
        );

        // Right wall.
        svg.appendChild(
            polygon(
                [bottom, right, topRight, topBottom],
                'url(#kraftSidePattern)',
                '#4d2f10'
            )
        );

        svg.appendChild(
            polygon(
                [bottom, right, topRight, topBottom],
                'url(#sideShade)'
            )
        );

        // Top surface.
        svg.appendChild(
            polygon(
                [topBottom, topLeft, topBack, topRight],
                'url(#kraftTopPattern)',
                '#5c3b17'
            )
        );

        svg.appendChild(
            polygon(
                [topBottom, topLeft, topBack, topRight],
                'url(#topShade)'
            )
        );

        // Cardboard fold across the top.
        const foldStart = {
            x: (topLeft.x + topBottom.x) / 2,
            y: (topLeft.y + topBottom.y) / 2
        };

        const foldEnd = {
            x: (topBack.x + topRight.x) / 2,
            y: (topBack.y + topRight.y) / 2
        };

        svg.appendChild(
            line(
                foldStart.x,
                foldStart.y,
                foldEnd.x,
                foldEnd.y,
                { stroke: '#4d2f10', width: 2 }
            )
        );

        // Length dimension.
        const lengthOffset = 25;

        const lengthStart = {
            x: left.x,
            y: left.y + lengthOffset
        };

        const lengthEnd = {
            x: bottom.x,
            y: bottom.y + lengthOffset
        };

        svg.appendChild(
            line(
                lengthStart.x,
                lengthStart.y,
                lengthEnd.x,
                lengthEnd.y,
                { arrows: true }
            )
        );

        svg.appendChild(
            label(
                (lengthStart.x + lengthEnd.x) / 2,
                (lengthStart.y + lengthEnd.y) / 2 + 20,
                L,
                30
            )
        );

        // Width dimension.
        const widthStart = {
            x: bottom.x,
            y: bottom.y + 25
        };

        const widthEnd = {
            x: right.x,
            y: right.y + 25
        };

        svg.appendChild(
            line(
                widthStart.x,
                widthStart.y,
                widthEnd.x,
                widthEnd.y,
                { arrows: true }
            )
        );

        svg.appendChild(
            label(
                (widthStart.x + widthEnd.x) / 2 + 15,
                (widthStart.y + widthEnd.y) / 2 + 20,
                W,
                -30
            )
        );

        // Height dimension.
        const heightX = right.x + 30;

        svg.appendChild(
            line(
                heightX,
                right.y,
                heightX,
                topRight.y,
                { arrows: true }
            )
        );

        svg.appendChild(
            label(
                heightX + 40,
                (right.y + topRight.y) / 2,
                H
            )
        );
    }

    // Update geometry whenever an input changes.
    [lengthInput, widthInput, heightInput].forEach(input => {
        input.addEventListener('input', drawBox);
    });

    // Initial drawing.
    drawBox();

    // Redraw when Bootstrap opens the modal.
    modal.addEventListener('shown.bs.modal', drawBox);
}

// Initialize when the DOM is ready.
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCustomOfferBox);
} else {
    initCustomOfferBox();
}
