let balance = localStorage.getItem("balance") ? parseInt(localStorage.getItem("balance")) : 0;
document.getElementById("balance").innerText = balance;

document.getElementById("getCoin").addEventListener("click", function() {
    balance++;
    document.getElementById("balance").innerText = balance;
    localStorage.setItem("balance", balance);
});

// Автоматическая тема Telegram
const tg = window.Telegram.WebApp;
tg.expand(); // Разворачивает WebApp на весь экран
