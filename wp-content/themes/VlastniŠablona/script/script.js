const hamburger = document.querySelector(".wrapper-hamburger");
const nav = document.querySelector("nav");

let state = false;

hamburger.addEventListener("click", () => {
    if (state == true) {
        hamburger.classList.remove("is-active");
        nav.classList.remove("is-open");
        state = false;
    } else {
        hamburger.classList.add("is-active");
        nav.classList.add("is-open");
        state = true;
    }
});

function ControlWidth() {
    const sirka = window.innerWidth;

    if (sirka > 768) {
        hamburger.classList.remove("is-active");
        nav.classList.remove("is-open");
        state = false;
    }
}

window.addEventListener('resize', ControlWidth);