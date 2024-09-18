function validaDadosCadastroUsuario(){
    let inputsForm = document.querySelectorAll("#formCadastroUsuario input");

    inputsForm.forEach(inputAtual => {
        // console.log(input.id)
        if(inputAtual.value == ''){
            console.log('Erro: '+inputAtual.id)
            inputAtual.setCustomValidity('Preencha o campo!');
            inputAtual.reportValidity();
            // return;
        }
    });

    // Swal.fire({
    //     text: "Selecione o sexo!",
    //     icon: "warning",
    //   });
    // return;
}