// admin dashboard page JS
const toggleButton = document.getElementById("toggle-btn");
const sidebar = document.getElementById("sidebar");

function toggleSidebar() {
  sidebar.classList.toggle("close");
  toggleButton.classList.toggle("rotate");

  closeAllSubMenus();
}

function toggleSubMenu(button) {
  if (!button.nextElementSibling.classList.contains("show")) {
    closeAllSubMenus();
  }

  button.nextElementSibling.classList.toggle("show");
  button.classList.toggle("rotate");

  if (sidebar.classList.contains("close")) {
    sidebar.classList.toggle("close");
    toggleButton.classList.toggle("rotate");
  }
}

function closeAllSubMenus() {
  Array.from(sidebar.getElementsByClassName("show")).forEach((ul) => {
    ul.classList.remove("show");
    ul.previousElementSibling.classList.remove("rotate");
  });
}

// register form
const form = document.querySelector("form");
const fields = form.querySelectorAll("input");

form.addEventListener("submit", (event) => {
  let isValid = true;
  let errorMessage = "";

  fields.forEach((field) => {
    if (field.type !== "file" && field.value.trim() === "") {
      isValid = false;
      errorMessage += `${field.getAttribute("id")} is required.\n`;
    } else if (field.type === "file" && field.files.length === 0) {
      isValid = false;
      errorMessage += `Profile image is required.\n`;
    }
  });

  // Prevent form submission if validation fails
  if (!isValid) {
    event.preventDefault();
    alert(errorMessage);
  }
});
