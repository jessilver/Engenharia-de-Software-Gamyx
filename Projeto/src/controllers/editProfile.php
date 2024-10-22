<?php 
    session_start();
    require '../config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $uniqueName = $_POST['uniqueName'];
        $about = $_POST['about'];
        $linkPortfolio = $_POST['linkPortfolio'];

        echo $about.'<br>';

        //$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $stmt = $conn->prepare("UPDATE usuario SET about = ?, urlPortfolio = ? WHERE uniqueName = ?");
        $stmt->bind_param("sss",$about, $linkPortfolio,$uniqueName);

        if ($stmt->execute()) {
            
            $stmt2 = $conn->prepare("SELECT * FROM usuario WHERE uniqueName = ?");
    
            $stmt2->bind_param("s", $uniqueName);
        
            $stmt2->execute();
            $result = $stmt2->get_result();
        
            print_r( $result);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                print_r( $user);
                session_unset(); 
                
                $_SESSION['userLogado'] = [
                    'nome' => $user['nomeUsuario'],
                    'arroba' => $user['uniqueName'], 
                    'email' => $user['email'],
                    'projects' => [], 
                    'friends' => [], 
                    'urlPortfolio' => $user['urlPortfolio'],
                    'about' => $user['about'] ?? 'Sobre mim não disponível.'
                ];
            }
        } else {
            echo "Erro: " . $stmt->error;
        }

        header("Location: ../templates/userProfile.php");
        
        $stmt->close();
        $conn->close();
    }

?>