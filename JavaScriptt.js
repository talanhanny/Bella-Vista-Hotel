
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
    // 3. WELCOME MESSAGE
    // =====================================

    console.log("Welcome to Modern Kubo!");

});
