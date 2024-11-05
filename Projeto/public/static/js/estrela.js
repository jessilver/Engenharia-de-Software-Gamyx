document.querySelectorAll('.star').forEach((star, index) => {
    // Efeito ao passar o mouse
    star.addEventListener('mouseover', function() {
        document.querySelectorAll('.star').forEach((s, i) => {
            if (i <= index) {
                s.classList.add('hover'); // Aplica a cor a todas as estrelas até a atual
            } else {
                s.classList.remove('hover'); // Remove a cor das estrelas seguintes
            }
        });
    });

    // Remove o efeito de hover quando o mouse sai
    star.addEventListener('mouseout', function() {
        document.querySelectorAll('.star').forEach(s => {
            s.classList.remove('hover');
        });
    });

    // Ao clicar, define as estrelas como selecionadas
    star.addEventListener('click', function() {
        // Remove seleção anterior
        document.querySelectorAll('.star').forEach(s => {
            s.classList.remove('selected');
        });

        // Marca as estrelas até a clicada como selecionadas
        document.querySelectorAll('.star').forEach((s, i) => {
            if (i <= index) {
                s.classList.add('selected'); // Adiciona a cor às estrelas selecionadas
            }
        });
    });
});
