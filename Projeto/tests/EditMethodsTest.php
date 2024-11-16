<?php
error_reporting(E_ALL);

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return;
    }
    echo "Deprecation warning: $errstr in $errfile on line $errline\n";
    return true;
});

use PHPUnit\Framework\TestCase;
use src\controllers\ViewProfileController;
use src\models\Usuario;

class EditMethodsTest extends TestCase
{
    protected function setUp(): void
    {
        // Mock $_POST data
        $_POST['about'] = 'About me';
        $_POST['linkPortfolio'] = 'http://portfolio.com';
    }

    public function testEdit()
    {
        $controller = new ViewProfileController();
        $model = new Usuario();

        $id = 1;
        $encriptedId = Usuario::encryptData($id);
        $decryptedId = Usuario::decryptData($encriptedId);

        $this->assertEquals($id, $decryptedId, 'Erro ao descriptografar o id');
    }
}