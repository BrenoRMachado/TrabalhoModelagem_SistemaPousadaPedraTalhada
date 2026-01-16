<?php
namespace App\Controllers;
use App\Core\App;
use Exception;

class LoginController 
{

      public function index()
    {
       if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }   

        if (isset($_SESSION['id'])) {
            header('Location: /quartos');
            exit;
        }

        return view('site/login');
    }

    public function exibirLogin(): mixed
    {
    
   if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $name = $_POST['name'] ?? null;
        $senha = $_POST['senha'] ?? null;

        $user = App::get('database')->verificaLogin($email, $senha);

        if ($user) {
            $_SESSION['id'] = $user->id;
            $_SESSION['user'] = $user;
            header('Location: /quartos');
            exit;
        }
              $_SESSION['mensagem-erro'] = "Usuário e/ou senha incorretos";
        header('Location: /login');
        exit;
 }
    

    public function exibirQuartos(): mixed
    {
        return view(name: 'admin/quartos');
    }
    
  public function efetuaLogin()
    {
      
        if (!isset($_POST['email']) || !isset($_POST['senha'])) {
            return redirect('reservas');
        }

        $email = $_POST['email'];
        $senha = $_POST['senha'];

  
        $user = App::get('database')->verificaLogin($email, $senha);

        if ($user) {
           
        
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['usuario'] = $user;

          
            return redirect('admin/quartos'); 

        } else {
    
            return redirect('login');
        }
    }

    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();
        header(header: 'Location: /login');
    }
}
?>