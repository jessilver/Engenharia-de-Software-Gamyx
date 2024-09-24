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