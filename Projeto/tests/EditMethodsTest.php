<?php
error_reporting(E_ALL);

use PHPUnit\Framework\TestCase;
use src\controllers\ViewProfileController;
use src\models\Usuario;
use core\OutputColors;


class EditMethodsTest extends TestCase{

    protected function setUp(): void{
        $_POST['about'] = 'About me';
        $_POST['linkPortfolio'] = 'http://portfolio.com';
    }

    public function testEditProfile(){
        $output = OutputColors::setColors();

        // Criar um mock do ViewProfileController
        $controller = $this->getMockBuilder(ViewProfileController::class)
                           ->onlyMethods(['redirect'])
                           ->getMock();
    
        // Configurar o mock para não fazer nada quando o método redirect for chamado
        $controller->expects($this->once())
                   ->method('redirect')
                   ->with('/perfil');
    
        $id = ['id' => 1];

        $user = Usuario::selectUser($id['id']);
        
        if(count($user) <= 0){
            $output->writeln('<warning> Usuário não encontrado </warning>');
        }

        $encriptedId = Usuario::encryptData($id['id']);
        $this->assertNotEmpty($encriptedId, 'Erro ao criptografar o id');
    
        $decryptedId = Usuario::decryptData($encriptedId);
        $this->assertNotEmpty($decryptedId, 'Erro ao descriptografar o id');
    
        // Garantir que $_POST está setado
        $this->assertEquals('About me', $_POST['about'], 'Erro ao setar o campo about');
        $this->assertEquals('http://portfolio.com', $_POST['linkPortfolio'], 'Erro ao setar o campo linkPortfolio');
        
        // Garantir que o id é o mesmo
        $this->assertEquals($id['id'], $decryptedId, 'Erro ao descriptografar o id');
    
        // Adicionar mensagem de depuração
        $output->write('<info>'."\n".'Calling edit method of ViewProfileController: </info>');
    
        $return = $controller->edit(['id' => $encriptedId]);
        $this->assertEquals(true, $return, 'Erro ao chamar o método edit');
        $output->writeln('<success>Pass successful</success>');
        
    }
}

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    $output = OutputColors::setColors();
    if (!(error_reporting() & $errno)) {
        return;
    }
    $output->writeln('<warning>'."Deprecation warning: $errstr in $errfile on line $errline\n".'</warning>');
    return true;
});
