const profile = document.getElementById("profile");
const dropdownDialog = document.getElementById("dropdownHover");
const notificationDialog = document.getElementById("notificationDialog");
const bell = document.getElementById("bell");
const sideBarToggle = document.getElementById("sideBarToggle");
const sideBar = document.getElementById("side");
const closeSidebar = document.getElementById("closeSidebar");
const chh = document.querySelector(".dropdownHover");

profile.addEventListener("click", () => {
  toggleDropdown();
});

function toggleDropdown(isClass) {
  if (isClass) {
    chh.classList.toggle("hidden");
  } else {
    dropdownDialog.classList.toggle("hidden");
  }
}

closeSidebar.addEventListener("click", () => {
  toggleside();
});

function toggleNotification() {
  notificationDialog.classList.toggle("hidden");
}

// console.log(sideBarToggle);

sideBarToggle.addEventListener("click", () => {
  toggleside();
});

function toggleside() {
  sideBar.classList.toggle("hidden");
}

bell.addEventListener("click", () => {
  toggleNotification();
});
