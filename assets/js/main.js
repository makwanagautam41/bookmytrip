const navMenu = document.getElementById("nav-menu"),
  navToggle = document.getElementById("nav-toggle"),
  navClose = document.getElementById("nav-close");

if (navToggle) {
  navToggle.addEventListener("click", () => {
    navMenu.classList.add("show-menu");
  });
}

if (navClose) {
  navClose.addEventListener("click", () => {
    navMenu.classList.remove("show-menu");
  });
}

const navLink = document.querySelectorAll(".nav__link");

const linkAction = () => {
  const navMenu = document.getElementById("nav-menu");
  navMenu.classList.remove("show-menu");
};
navLink.forEach((n) => n.addEventListener("click", linkAction));

// ADD BLUR TO HEADER
const blurHeader = () => {
  const header = document.getElementById("header");
  // When the scroll is greater than 50 viewport height, add the blur-header class to the header tag
  this.scrollY >= 50
    ? header.classList.add("blur-header")
    : header.classList.remove("blur-header");
};
window.addEventListener("scroll", blurHeader);

// SHOW SCROLL UP
const scrollUp = () => {
  const scrollUp = document.getElementById("scroll-up");
  // When the scroll is higher than 350 viewport height, add the show-scroll class to the a tag with the scrollup class
  this.scrollY >= 350
    ? scrollUp.classList.add("show-scroll")
    : scrollUp.classList.remove("show-scroll");
};
window.addEventListener("scroll", scrollUp);

// SCROLL REVEAL ANIMATION
const sr = ScrollReveal({
  origin: "top",
  distance: "60px",
  duration: 3000,
  delay: 100,
  reset: true,
});

sr.reveal(`.home__data,.section__title,.video__container`);
sr.reveal(`.home__card,.card-container`, {
  delay: 300,
  distance: "100px",
  interval: 80,
});
sr.reveal(`.join__image`, { origin: "right" });
sr.reveal(`.join__data`, { origin: "left" });

// video
const videoFile = document.getElementById("video-file"),
  videoButton = document.getElementById("video-button"),
  videoIcon = document.getElementById("video-icon");

function playPause() {
  if (videoFile.paused) {
    videoFile.play();
    videoIcon.classList.add("ri-pause-line");
    videoIcon.classList.remove("ri-play-line");
  } else {
    videoFile.pause();
    videoIcon.classList.remove("ri-pause-line");
    videoIcon.classList.add("ri-play-line");
  }
}
videoButton.addEventListener("click", playPause);

function finalVideo() {
  // Video ends, icon change
  videoIcon.classList.remove("ri-pause-line");
  videoIcon.classList.add("ri-play-line");
}
videoFile.addEventListener("ended", finalVideo);

// popup profile
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
  modal.style.display = "block";
};

span.onclick = function () {
  modal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

// popup edit profile
var edtmodal = document.getElementById("myEdtModal");
var btn = document.getElementById("editProf");
var edtclose = document.getElementsByClassName("edtclose")[0];

btn.onclick = function () {
  edtmodal.style.display = "block";
};

edtclose.onclick = function () {
  edtmodal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == edtmodal) {
    edtmodal.style.display = "none";
  }
};
onclick = function (event) {
  if (event.target == edtmodal) {
    edtmodal.style.display = "none";
  }
};

