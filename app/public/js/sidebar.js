
const profileButton = document.getElementById("profile-button");
const sidebar = document.getElementById("profile-sidebar");
const overlay = document.getElementById("sidebar-overlay");
const closeButton = document.getElementById("close-sidebar");

function abrirSidebar() {
    document.body.classList.add("sidebar-open");

    profileButton.setAttribute("aria-expanded", "true");
    sidebar.setAttribute("aria-hidden", "false");
    sidebar.inert = false;

    closeButton.focus();
}

function cerrarSidebar() {
    document.body.classList.remove("sidebar-open");

    profileButton.setAttribute("aria-expanded", "false");
    sidebar.setAttribute("aria-hidden", "true");
    sidebar.inert = true;

    profileButton.focus();
}

profileButton.addEventListener("click", () => {
    const estaAbierta =
        document.body.classList.contains("sidebar-open");

    if (estaAbierta) {
        cerrarSidebar();
    } else {
        abrirSidebar();
    }
});

closeButton.addEventListener("click", cerrarSidebar);
overlay.addEventListener("click", cerrarSidebar);

document.addEventListener("keydown", (event) => {
    if (
        event.key === "Escape" &&
        document.body.classList.contains("sidebar-open")
    ) {
        cerrarSidebar();
    }
});
