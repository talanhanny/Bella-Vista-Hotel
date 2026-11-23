document.addEventListener("DOMContentLoaded", function () {

    // =====================================
    // 1. BOOKING DATE VALIDATION
    // =====================================

    const checkIn = document.getElementById("check_in");
    const checkOut = document.getElementById("check_out");

    // Set minimum check-in date to today

    if (checkIn && checkOut) {

        const today = new Date();

        const localToday = new Date(
            today.getTime() - today.getTimezoneOffset() * 60000
        ).toISOString().split("T")[0];

        checkIn.min = localToday;
        checkOut.min = localToday;

        checkIn.addEventListener("change", function () {

            checkOut.min = checkIn.value;

            if (checkOut.value && checkOut.value <= checkIn.value) {
                checkOut.value = "";
            }

        });

        // Pre-fill the booking form with dates sent from the homepage bar
        // (only on pages that have the full booking form)

        const params = new URLSearchParams(window.location.search);
        const guestsField = document.querySelector('form[action="booking_process.php"] input[name="guests"]');

        if (guestsField && params.has("check_in")) {
            checkIn.value = params.get("check_in");
            checkOut.min = checkIn.value;
            checkOut.value = params.get("check_out") || "";
            guestsField.value = params.get("guests") || "";
        }

    }


    // =====================================
    // 2. BACKGROUND MUSIC CONTROL
    // =====================================

    const music = document.getElementById("backgroundMusic");
    const musicButton = document.getElementById("musicButton");
    const musicIcon = document.getElementById("musicIcon");

    if (music && musicButton && musicIcon) {

        musicButton.addEventListener("click", function () {

            if (music.paused) {

                music.play()
                    .then(function () {

                        musicButton.classList.add("playing");

                        musicIcon.textContent = "♫";
                        musicButton.title = "Pause Music";

                        musicButton.setAttribute(
                            "aria-label",
                            "Pause background music"
                        );

                    })
                    .catch(function (error) {

                        console.error("Music playback error:", error);

                    });

            } else {

                music.pause();

                musicButton.classList.remove("playing");

                musicIcon.textContent = "♪";
                musicButton.title = "Play Music";

                musicButton.setAttribute(
                    "aria-label",
                    "Play background music"
                );

            }

        });

    }


    // =====================================
    // 3. GALLERY: DESCRIPTION ON HOVER
    // =====================================

    const galleryDescriptions = {
        "hotel exterior": "Our Filipino-inspired building, set among gardens at the foothills of the mountains.",
        "reception area": "Check in with a warm welcome from our front desk team.",
        "lounge area": "A comfortable indoor space to relax, read, or catch up with family and friends.",
        "buffet area": "An open, airy dining space with a buffet spread for guests and groups.",
        "function area": "A flexible space for celebrations, family gatherings, and company events.",
        "swimming pool area": "Cool off in the pool, surrounded by greenery and mountain views.",
        "swimming pool": "Cool off in the pool, surrounded by greenery and mountain views.",
        "gym": "Keep up your routine with cardio equipment in a bright, open room.",
        "parking area": "Convenient on-site parking for hotel guests and event visitors.",
        "comfortable rooms": "Warm, well-kept rooms with everything you need to rest properly.",
        "restaurant": "Hearty meals served in a relaxed setting, right on the property."
    };

    document.querySelectorAll(".gallery-item").forEach(function (item) {

        const title = item.querySelector("h3");
        if (!title) return;

        const text = galleryDescriptions[title.textContent.trim().toLowerCase()];
        if (!text) return;

        const desc = document.createElement("p");
        desc.className = "gallery-desc";
        desc.textContent = text;

        item.appendChild(desc);
        item.setAttribute("tabindex", "0");   // lets keyboard users see it too

    });


    // =====================================
    // 4. WELCOME MESSAGE
    // =====================================

    console.log("Welcome to Bella Vista!");

});