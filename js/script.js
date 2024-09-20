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
const iconeCoracao = document.querySelector('#heartIcon');

iconeCoracao.addEventListener('click', function(){
    iconeCoracao.classList.toggle('apertado');
});
