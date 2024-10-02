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