// Função para abrir e fechar a barra lateral
function toggleNav() {
    var sidebar = document.getElementById("sidebar");
    var menuBtn = document.getElementById("menu-btn");
    var overlay = document.getElementById("overlay");
    var body = document.body;

    if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
        menuBtn.innerHTML = "☰"; 
        overlay.style.display = "none";
        body.classList.remove('no-scroll'); 
    } else {
        sidebar.style.width = "250px"; 
        menuBtn.innerHTML = "✕"; 
        overlay.style.display = "block";
        body.classList.add('no-scroll');
    }
}

// Adiciona o evento de clique no botão do menu
document.getElementById("menu-btn").addEventListener("click", toggleNav);

// Adiciona o evento de clique no overlay para fechar o menu ao clicar fora
document.getElementById("overlay").addEventListener("click", toggleNav);
