// Colocando icone de sem imagem 
const imagemBanner = document.querySelector('.bannerImage');
const imagemPerfil = document.querySelector('.profileImage');
const linkImagem = 'public/imagens/sem-imagem.png';

if(imagemBanner.getAttribute('src') === ''){
    imagemBanner.setAttribute('src', linkImagem);
    imagemBanner.classList.remove('bannerImage');
    imagemBanner.classList.add('noBanner');
}
if(imagemPerfil.getAttribute('src') === ''){
    imagemPerfil.setAttribute('src', linkImagem);
    imagemPerfil.classList.remove('profileImage');
    imagemPerfil.classList.add('noProfile');
}
// Mudar estilo do coração de gostei
const textoCoracao = document.querySelector('#spanHeartIcon');
const iconeCoracao = document.querySelector('#heartIcon');
let gosteis = 0;

iconeCoracao.addEventListener('click', function(){
    if(!iconeCoracao.classList.contains('apertado')){
        iconeCoracao.classList.add('apertado');
        gosteis++;
        textoCoracao.textContent = ` ${gosteis} Likes`;
    }else{
        iconeCoracao.classList.remove('apertado');
        gosteis--;
        textoCoracao.textContent = ` ${gosteis} Likes`;
    }
});
// Pesquisar usuários no banco
const inputUsuario = document.querySelector('.userSearchInput');

inputUsuario.addEventListener('submit', function(evento){
    evento.preventDefault();
    const searchQuery = document.getElementById('searchQuery').value;

    // Usa a função fetch para enviar os dados do formulário via POST
    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `search_query=${encodeURIComponent(searchQuery)}`
    })
    .then(response => response.text()) // Converte a resposta para texto
    .then(data => {
        // Atualiza o div com o resultado da busca
        document.getElementById('searchResult').innerHTML = data;
    })
    .catch(error => console.error('Erro:', error));
})
