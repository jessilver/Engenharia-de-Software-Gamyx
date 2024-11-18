<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/MockUsuario.php';

error_reporting(E_ALL);

use PHPUnit\Framework\TestCase;
use src\controllers\UserController;
use tests\MockUsuario;
use core\OutputColors;

class LoginMethodsTest extends TestCase {

    protected function setUp(): void {
        $_SERVER['REQUEST_METHOD'] = 'POST'; // Definir o método de requisição como POST
        
        // Definir valores no superglobal $_POST
        $_POST['login'] = 'maria@example.com';
        $_POST['password'] = 'senhaSegura123';

    
        // Substituir a instância estática de Usuario pelo mock
        MockUsuario::setMockInstance(new MockUsuario());
    
        // Simular valores capturados pelo filter_input
        $this->simulateFilterInput('login', 'maria@example.com');
        $this->simulateFilterInput('password', 'senhaSegura123');
    }
    
    private function simulateFilterInput($type, $value) {
        putenv("$type=$value");
    }
    
    public function testLogin() {
        $output = OutputColors::setColors();

        // Criar um mock do UserController
        $controller = $this->getMockBuilder(UserController::class)
                           ->onlyMethods(['redirect'])
                           ->getMock();

        // Configurar o mock para não fazer nada quando o método redirect for chamado
        $controller->expects($this->once())
                   ->method('redirect')
                   ->with('/perfil');

        // Chamar o método auth do controlador
        $return = $controller->auth();

        // Verificar se o método auth retornou true
        $this->assertTrue($return, 'Erro ao chamar o método auth');
        $output->writeln('<success>Pass successful</success>');
    }
}
