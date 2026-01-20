import "./bootstrap";

// Función para mostrar / ocultar la contraseña en el formulario de Inicio de sesión / Registro
(() => {
	if (
		!window.location.pathname.includes("login") &&
		!window.location.pathname.includes("register") &&
		!window.location.pathname.includes("users") &&
		!window.location.pathname.includes("edit")
	) {
		return;
	}

	document
		.getElementsByClassName("eye-svg")[0]
		.addEventListener("click", () => {
			const passwordInput = document.getElementById("password");
			const eyeSVG = document.getElementsByClassName("eye-svg")[0];
			passwordInput.type =
				passwordInput.type === "password" ? "text" : "password";
			eyeSVG.style.color =
				passwordInput.type === "password"
					? "var(--text-muted)"
					: "var(--accent)";
		});
})();
