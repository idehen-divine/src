import "./bootstrap";
import "boxicons/css/boxicons.min.css";
import { themeChange } from "theme-change";
import lottie from "lottie-web";

document.addEventListener("DOMContentLoaded", () => {
    themeChange(false); // Initialize theme-change without auto-save

    const themeSwitcher = document.querySelector("[data-choose-theme]");
    const userPrefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const theme = localStorage.getItem("theme");

    // Set default to system and apply system preference
    if (!theme || theme === "system") {
        themeSwitcher ? (themeSwitcher.value = "system") : null;
        document.documentElement.setAttribute(
            "data-theme",
            userPrefersDark ? "dark" : "light"
        );
    }

    if (themeSwitcher && theme) {
        themeSwitcher.addEventListener("change", () => {
            if (themeSwitcher.value === "system") {
                document.documentElement.setAttribute(
                    "data-theme",
                    userPrefersDark ? "dark" : "light"
                );
            } else {
                document.documentElement.setAttribute(
                    "data-theme",
                    themeSwitcher.value
                );
            }
        });
    }

    window
        .matchMedia("(prefers-color-scheme: dark)")
        .addEventListener("change", (e) => {
            if (themeSwitcher.value === "system") {
                document.documentElement.setAttribute(
                    "data-theme",
                    e.matches ? "dark" : "light"
                );
            }
        });
});
