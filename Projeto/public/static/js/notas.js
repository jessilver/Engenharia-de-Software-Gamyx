document.addEventListener('DOMContentLoaded', function() {
    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('projectsModal');
    const closeModalBtn = document.querySelector('.close');
    const projectsContainer = document.getElementById('projectsContainer');

    // Função para abrir o modal e consumir a API
    openModalBtn.addEventListener('click', function() {
        fetchProjectsAndReviews();
        modal.style.display = 'block';
    });

    // Fecha o modal ao clicar no botão de fechar
    closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Fecha o modal ao clicar fora dele
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    // Função para consumir a API e exibir os projetos e notas
    function fetchProjectsAndReviews() {
        fetch('/Engenharia-de-Software-Gamyx/Projeto/public/api/all-projects-reviews')
            .then(response => response.json())
            .then(data => {
                projectsContainer.innerHTML = ''; // Limpa o conteúdo antes de adicionar
                data.forEach(item => {
                    const projectElement = document.createElement('div');
                    projectElement.classList.add('project-item');
                    projectElement.innerHTML = `
                        <h3>${item.nomeProjeto}</h3>
                        <p>Nota: ${item.nota}</p>
                        <p>Usuário: ${item.uniqueName}</p>
                    `;
                    projectsContainer.appendChild(projectElement);
                });
            })
            .catch(error => console.error('Erro ao buscar projetos e avaliações:', error));
    }
});
