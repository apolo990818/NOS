document.addEventListener("DOMContentLoaded", function () {
    var chatToggleButton = document.getElementById("chat-toggle-button");
    var chatWidget = document.getElementById("chat-widget");

    chatToggleButton.addEventListener("click", function () {
        if (chatWidget.style.display === "none" || chatWidget.style.display === "") {
            chatWidget.style.display = "block";
            chatToggleButton.textContent = "Cerrar Chat";
        } else {
            chatWidget.style.display = "none";
            chatToggleButton.textContent = "Abrir Chat";
        }
    });
});
