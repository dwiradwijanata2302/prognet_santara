import "./bootstrap";

// Navbar hover effect with primary background
document.addEventListener("DOMContentLoaded", function () {
    // Klik judul card-title untuk masuk ke detail cerita
    document
        .querySelectorAll(".card-title[data-url]")
        .forEach(function (title) {
            title.style.cursor = "pointer";
            title.addEventListener("click", function () {
                window.location.href = title.getAttribute("data-url");
            });
        });
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach((link) => {
        link.addEventListener("mouseenter", function () {
            this.style.backgroundColor = "rgba(110, 65, 48, 0.85)";
            this.style.transform = "translateY(-2px)";
            this.style.boxShadow = "0 4px 8px rgba(110, 65, 48, 0.3)";
        });

        link.addEventListener("mouseleave", function () {
            this.style.backgroundColor = "transparent";
            this.style.transform = "translateY(0)";
            this.style.boxShadow = "none";
        });
    });

    // Hamburger Menu Toggle
    const hamburgerToggle = document.getElementById("hamburgerToggle");
    const hamburgerDropdown = document.getElementById("hamburgerDropdown");

    if (hamburgerToggle && hamburgerDropdown) {
        hamburgerToggle.addEventListener("click", function (e) {
            e.stopPropagation();
            hamburgerDropdown.classList.toggle("active");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function (e) {
            if (
                !hamburgerToggle.contains(e.target) &&
                !hamburgerDropdown.contains(e.target)
            ) {
                hamburgerDropdown.classList.remove("active");
            }
        });
    }

    // Filter Kategori Toggle
    const filterToggle = document.getElementById("filterToggle");
    const regionList = document.getElementById("regionList");

    if (filterToggle && regionList) {
        filterToggle.addEventListener("click", function (e) {
            e.stopPropagation();
            const isHidden = regionList.style.display === "none";
            regionList.style.display = isHidden ? "block" : "none";
            filterToggle.classList.toggle("active");
        });
    }

    // Search Suggestions
    const searchInput = document.getElementById("searchInput");
    const suggestionsBox = document.getElementById("suggestionsBox");

    if (searchInput && suggestionsBox) {
        let debounceTimer;

        searchInput.addEventListener("input", function () {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            if (query.length < 2) {
                suggestionsBox.classList.add("hidden");
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`/search/suggestions?q=${encodeURIComponent(query)}`)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.length > 0) {
                            suggestionsBox.innerHTML = data
                                .map(
                                    (item) =>
                                        `<div class="px-4 py-2 hover:bg-gray-100 cursor-pointer suggestion-item">${item}</div>`
                                )
                                .join("");
                            suggestionsBox.classList.remove("hidden");

                            // Add click event to suggestions
                            document
                                .querySelectorAll(".suggestion-item")
                                .forEach((item) => {
                                    item.addEventListener("click", function () {
                                        searchInput.value = this.textContent;
                                        suggestionsBox.classList.add("hidden");
                                        searchInput.closest("form").submit();
                                    });
                                });
                        } else {
                            suggestionsBox.classList.add("hidden");
                        }
                    });
            }, 300);
        });

        // Close suggestions when clicking outside
        document.addEventListener("click", function (e) {
            if (
                !searchInput.contains(e.target) &&
                !suggestionsBox.contains(e.target)
            ) {
                suggestionsBox.classList.add("hidden");
            }
        });
    }

    // Like button AJAX
    const likeButtons = document.querySelectorAll(".like-button");
    likeButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const url = this.dataset.url;
            const icon = this.querySelector(".like-icon");
            const count = this.querySelector(".like-count");
            const text = this.querySelector("span:last-child");

            fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                    Accept: "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Update icon SVG
                        if (data.liked) {
                            icon.innerHTML =
                                '<img src="/images/basil--heart-solid.svg" alt="Like" width="22" height="22"/>';
                        } else {
                            icon.innerHTML =
                                '<img src="/images/basil--heart-outline.svg" alt="Belum Like" width="22" height="22"/>';
                        }

                        // Update count dengan animasi
                        count.textContent = data.likes_count;
                        count.style.transform = "scale(1.3)";
                        setTimeout(() => {
                            count.style.transform = "scale(1)";
                        }, 200);

                        // Update text
                        text.textContent = data.liked ? "Disukai" : "Sukai";

                        // Toggle class
                        if (data.liked) {
                            button.classList.add("liked");
                        } else {
                            button.classList.remove("liked");
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    });
});
