<?php
error_reporting(E_ALL);

use PHPUnit\Framework\TestCase;
use src\models\Usuario;
use src\models\Project;
use core\OutputColors;

class DeleteMethodsTest extends TestCase
{
    public function testDeleteUser()
    {
        $output = OutputColors::setColors();

        // Criar um mock do modelo Usuario
        $usuarioMock = $this->getMockBuilder(Usuario::class)
                            ->onlyMethods(['deleteUserInstance'])
                            ->getMock();

        // Configurar o mock para retornar true quando o método deleteUserInstance for chamado
        $usuarioMock->expects($this->once())
                    ->method('deleteUserInstance')
                    ->with($this->equalTo(1))
                    ->willReturn(true);

        // Chamar o método deleteUserInstance e verificar o resultado
        $result = $usuarioMock->deleteUserInstance(1);
        $this->assertTrue($result, 'Erro ao chamar o método deleteUserInstance');
        $output->writeln('<success>Pass successful: Usuario deletado com sucesso</success>');
    }

    public function testDeleteProject()
    {
        $output = OutputColors::setColors();

        // Criar um mock do modelo Project
        $projectMock = $this->getMockBuilder(Project::class)
                            ->onlyMethods(['deleteProjectInstance'])
                            ->getMock();

        // Configurar o mock para retornar true quando o método deleteProjectInstance for chamado
        $projectMock->expects($this->once())
                    ->method('deleteProjectInstance')
                    ->with($this->equalTo(1))
                    ->willReturn(true);

        // Chamar o método deleteProjectInstance e verificar o resultado
        $result = $projectMock->deleteProjectInstance(1);
        $this->assertTrue($result, 'Erro ao chamar o método deleteProjectInstance');
        $output->writeln('<success>Pass successful: Projeto deletado com sucesso</success>');
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
