<?php 

    require 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $uniqueName = $_POST['uniqueName'];
        $about = $_POST['about'];
        $linkPortfolio = $_POST['linkPortfolio'];

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $stmt = $conn->prepare("UPDATE usuario SET about = ?, urlPortfolio = ? WHERE uniqueName = ?");
        $stmt->bind_param("sss",$about, $linkPortfolio,$uniqueName);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            if ($result) {
                    $row = $result->fetch_assoc();
                    $nomeUsuario = $row['nomeUsuario'];
                    
                    session_start();
    
                    $_SESSION=[];
    
                    $_SESSION['userLogado'] = [
                        'nome' => $row['nomeUsuario'],
                        'arroba' => $row['uniqueName'], 
                        'email' => $row['email'],
                        'projects' => [], 
                        'friends' => [], 
                        'urlPortfolio' => $row['urlPortfolio'],
                        'about' => $row['about'] ?? 'Sobre mim não disponível.'
                    ];
            } else {
                echo "Erro na consulta: " . $conn->error;
            }
        } else {
            echo "Erro: " . $stmt->error;
        }

        header("Location: userProfile.php");
        
        $stmt->close();
        $conn->close();
    }

?>