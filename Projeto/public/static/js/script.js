// function validaDadosCadastroUsuario(){
//     let inputsForm = document.querySelectorAll("#formCadastroUsuario input");

//     inputsForm.forEach(inputAtual => {
//         // console.log(input.id)
//         if(inputAtual.value == ''){
//             console.log('Erro: '+inputAtual.id)
//             inputAtual.setCustomValidity('Preencha o campo!');
//             inputAtual.reportValidity();
//             // return;
//         }
//     });

//     // Swal.fire({
//     //     text: "Selecione o sexo!",
//     //     icon: "warning",
//     //   });
//     // return;
// }

const formularioCadastro = document.getElementById('formCadastroUsuario');

formularioCadastro.addEventListener('change', (event) => {
    const senha1 = document.getElementById('password1');
    const senha2 = document.getElementById('password2');

    if (senha1.value !== senha2.value){
        senha2.setCustomValidity('As senhas não coincidem!');
        senha2.reportValidity();
        event.preventDefault();
    } else {
        senha2.setCustomValidity('');
    }
});

function previewImagemSelecionada(){
    const inputImagem = document.getElementById('formFile');
    const campoImagemPreview = document.getElementById('imagemFotoCapa');
    const file = inputImagem.files[0]; // Acessa o primeiro arquivo selecionado

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            campoImagemPreview.src = e.target.result; // Define a URL da imagem
        }

        reader.readAsDataURL(file); // Lê o arquivo como uma URL base64
    }
}

// function verificaCheckboxCadastrarProjeto(){
//     // document.getElementById('meuFormulario').addEventListener('submit', function(event) {
//     const form = document.getElementById('formCadastrarProjeto');
//     const checkbox = document.getElementById('termos');
//     if (!checkbox.checked) {
//         form.preventDefault(); // Impede o envio do formulário
//         alert('Você deve selecionar ao menos um.');
//     }
//     // });
// }

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

function realyDeleteAccount(formID){
    form = document.getElementById(formID);

    Swal.fire({
        title: 'Tem certeza que deseja deletar sua conta?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, deletar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

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

