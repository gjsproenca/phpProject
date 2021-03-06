<?php
session_start();

include './../inc/masterpage-public/header.php';
include '../inc/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        echo '<div class="alert alert-danger mb-0 rounded-0 text-center" role="alert">
            Falha na ligação à base de dados, por favor tente mais tarde</div>';
    } else {
        // Get post data
        $postUsername = $_POST['inputUsername'];
        $postPassword = $_POST['inputPassword'];

        $hashPassword = hash('sha512', $postPassword);

        // Get user data
        $sql = "SELECT `UserId` ,`Username`, `Password`, `Admin`, `Active` FROM `user` WHERE `Username` LIKE '$postUsername'";
        @$query = $conn->query($sql);

        $result = $query->fetch_assoc();

        $resultUserId = $result['UserId'];
        $resultUsername = $result['Username'];
        $resultPassword = $result['Password'];
        $resultAdmin = $result['Admin'];
        $resultActive = $result['Active'];

        if (!isset($query)) {
            echo '<div class="alert alert-danger mb-0 rounded-0 text-center" role="alert">
                Falha ao obter a lista de utilizadores, por favor tente mais tarde</div>';
        } else if (!isset($result)) {
            echo '<div class="alert alert-danger mb-0 rounded-0 text-center" role="alert">
                Não existe este utilizador</div>';
        } else if ($hashPassword != $resultPassword) {
            echo '<div class="alert alert-danger mb-0 rounded-0 text-center" role="alert">
                Senha errada</div>';
        } else if ($resultAdmin == 1) {
            if ($resultActive == 1) {
                $_SESSION['adminId'] = $resultUserId;
                header('Location: ./../backend/index.php?index');
            } else {
                echo '<div class="alert alert-danger mb-0 rounded-0 text-center" role="alert">
                    Conta de administrador não ativa</div>';
            }
        } else {
            if ($resultActive == 1) {
                $_SESSION['userId'] = $resultUserId;
                header('Location: ./../frontend/index.php?index');
            } else {
                echo '<div class="alert alert-danger mb-0 rounded-0 text-center" role="alert">
                    Conta de utilizador não ativa</div>';
            }
        }
    }
}
?>

<div class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>

            <!-- Form -->
            <div class="col-md-6">
                <div class="p-5 card text-white bg-primary border-secondary">
                    <div class="card-body">
                        <h1 class="mb-4 text-center text-white">Entrar</h1>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label>Nome de utilizador</label>
                                <input class="form-control" name="inputUsername" placeholder="Mínimo 8 carateres" type="text" 
                                    pattern="^\w{8,}$" value="<?php if (isset($postUsername)) {echo $postUsername;}?>" required>
                                <small class="form-text text-muted">
                                    O nome tem de conter no mínimo 3 carateres
                                </small>
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input class="form-control" name="inputPassword" placeholder="Mínimo 8 carateres" type="password" 
                                    pattern="^[^\s].{6,}[^\s]$" required>
                                <small class="form-text text-muted">
                                    A senha tem de conter no mínimo 8 carateres
                                </small>
                            </div>
                            <button class="btn btn-dark text-white col-12" name="signin">Submeter</button>
                            <br />
                            <br />
                            <button class="btn btn-dark text-white col-md-12" name="reset" id="reset" type="reset">Limpar</button>
                            <br />
                            <br />
                            <a class="btn btn-dark text-white col-md-12" name="forgotPassword" href="./forgot-password.php">Recuperar senha</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './../inc/masterpage-public/footer.php';?>