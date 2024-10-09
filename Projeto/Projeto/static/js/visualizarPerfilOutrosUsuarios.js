// Colocando icone de sem imagem 
const imagemBanner = document.querySelector('.bannerImage');
const imagemPerfil = document.querySelector('.profileImage');
const linkImagem = './static/img/sem-imagem.png';

if(imagemBanner.getAttribute('src') === "semImagem"){
    imagemBanner.setAttribute('src', linkImagem);
    imagemBanner.classList.remove('bannerImage');
    imagemBanner.classList.add('noBanner');
}
if(imagemPerfil.getAttribute('src') === "semImagem"){
    imagemPerfil.setAttribute('src', linkImagem);
    imagemPerfil.classList.remove('profileImage');
    imagemPerfil.classList.add('noProfile');
}
