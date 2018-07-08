<?php
include './../inc/masterpage-backend/header.php';
include './../inc/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // declaring search terms variables    

    if(isset($_POST['inputSearchUsername'])) {
        $inputSearchUsername = $_POST['inputSearchUsername'];

        if ($inputSearchUsername == "") {
            $inputSearchUsername = '%';
        }
    }
    
    if(isset($_POST['inputSearchEmail'])) {
        $inputSearchEmail = $_POST['inputSearchEmail'];

        if ($inputSearchEmail == "") {
            $inputSearchEmail = '%';
        }
    }

    if(isset($_POST['inputSearchAdmin'])) {
        $inputSearchAdmin = $_POST['inputSearchAdmin'];

        if ($inputSearchAdmin == 'Administrador') {
            $inputSearchAdmin = 1;
        } else {
            $inputSearchAdmin = 0;
        }
    }
   
    if(isset($_POST['inputSearchActive'])) {
        $inputSearchActive = $_POST['inputSearchActive'];

        if ($inputSearchActive == 'Ativo') {
            $inputSearchActive = 1;
        } else {
            $inputSearchActive = 0;
        }
    }
}

// Setting search term for sql query
if (isset($inputSearchUsername)) {
    $username = $inputSearchUsername;
} else {
    $username = '%';
}

if (isset($inputSearchEmail)) {
    $email = $inputSearchEmail;
} else {
    $email = '%';
}

if (isset($inputSearchAdmin)) {
    $admin = $inputSearchAdmin;
} else {
    $admin = 0;
}

if (isset($inputSearchActive)) {
    $active = $inputSearchActive;
} else {
    $active = 1;
}

// Set active to 0 in databse
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    $sqlDeactivateUser = "UPDATE `user` SET `Active` = 0 WHERE `UserId` = $userId";
    $conn->query($sqlDeactivateUser);

    header('Location: ./index.php');
}


// Query to populate table with files
$sqlTable = "SELECT    `user`.`UserId`,
                            `user`.`Username`,
                            `user`.`Email`,
                            `user`.`Admin`,
                            `user`.`Active`
                    FROM    `user`
                    WHERE `user`.`Username` LIKE '%$username%'
                        AND `user`.`Email` LIKE '%$email%'
                        AND `user`.`Admin` = $admin
                        AND `user`.`Active` = $active
                    ORDER BY `UserId` DESC;";
$resultTable = $conn->query($sqlTable);

$conn->close();
?>

<div class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row">

            <!-- Search form -->
            <form class="col-md-12 mb-5" method="POST" action="" id="formSearch">
                <div class="form-row">

                    <!-- Search Username -->
                    <div class="col-md-3">
                        <input class="form-control text-center" type="text" id="inputSearchUsername" name="inputSearchUsername" value="<?php
                                // Setting serchbox to empty if theres no chars in it
                                if (isset($_POST['inputSearchUsername'])) {
                                    if ($inputSearchUsername == '%') {
                                        echo '';
                                    } else {
                                        echo $inputSearchUsername;
                                    }
                                }
                                ?>" placeholder="Procurar por nome de utilizador">
                    </div>

                    <!-- Search Email -->
                    <div class="col-md-3">
                        <input class="form-control text-center" type="text" id="inputSearchEmail" name="inputSearchEmail" value="<?php
                                    // Setting serchbox to empty if theres no chars in it
                                    if (isset($_POST['inputSearchEmail'])) {
                                        if ($inputSearchEmail == '%') {
                                            echo '';
                                        } else {
                                            echo $inputSearchEmail;
                                        }
                                    }
                                    ?>" placeholder="Procurar por Email">
                    </div>

                    <!-- Search Admin -->
                    <div class="col-md-3">
                        <select class="form-control text-center" id="inputSearchAdmin" name="inputSearchAdmin" required>
                                    
                            <option selected>
                                <?php 
                                    if (isset($_POST['inputSearchAdmin'])) {
                                        if ($inputSearchAdmin == '1') {
                                            echo 'Administrador';
                                        } else {
                                            echo 'Utilizador';
                                        }
                                    } else {
                                        echo 'Utilizador';
                                    }
                                ?>
                                </option>

                            <option>
                                <?php 
                                    if (isset($_POST['inputSearchAdmin'])) {
                                        if ($inputSearchAdmin == '1') {
                                            echo 'Utilizador';
                                        } else {
                                            echo 'Administrador';
                                        }
                                    } else {
                                        echo 'Administrador';
                                    }
                                ?>
                            </option>

                        </select>
                    </div>

                    <!-- Search Active -->
                    <div class="col-md-3">
                        <select class="form-control text-center" id="inputSearchActive" name="inputSearchActive" required>
                                        
                            <option selected>
                                <?php 
                                    if (isset($_POST['inputSearchActive'])) {
                                        if ($inputSearchActive == '1') {
                                            echo 'Ativo';
                                        } else {
                                            echo 'Não ativo';
                                        }
                                    } else {
                                        echo 'Ativo';
                                    }
                                ?>
                            </option>

                            <option>
                                <?php 
                                    if (isset($_POST['inputSearchActive'])) {
                                        if ($inputSearchActive == '1') {
                                            echo 'Não ativo';
                                        } else {
                                            echo 'Ativo';
                                        }
                                    } else {
                                        echo 'Ativo';
                                    }
                                ?>
                            </option>

                        </select>
                    </div>
                </div>
            </form>

            <div class="col-md-12">
                <div class="bg-primary border-secondary">

                    <!-- Table -->
                    <table class="table table-responsive table-hover table-dark">
                        <thead class="thead-light">
                            <tr>
                                <th>UserId</th>
                                <th>Nome de utilizador</th>
                                <th>Email</th>
                                <th>Administrador</th>
                                <th>Ativo</th>
                                <th class="text-center" colspan="2">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Populate table with files -->
                            <?php while ($rowTable = $resultTable->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php echo $rowTable['UserId']; ?>
                                </td>
                                <td>
                                    <?php echo $rowTable['Username']; ?>
                                </td>
                                <td>
                                    <?php echo $rowTable['Email']; ?>
                                </td>
                                <td>
                                    <?php
                                        if($rowTable['Admin'] == 1) {
                                            echo 'Sim';
                                        } else {
                                            echo 'Não';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if($rowTable['Active'] == 1) {
                                            echo 'Sim';
                                        } else {
                                            echo 'Não';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <!-- TODO: make edit page -->
                                    <a href="./index-edit.php?userId=<?php echo $rowTable['UserId']; ?>" class="btn btn-warning">Editar</a>
                                </td>
                                <td>
                                    <a href="?userId=<?php echo $rowTable['UserId']; ?>" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // creater timer function
    var delay = (() => {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    // submit form after user finished pressing keys for 1 second
    $(document).ready(() => {
        $("#inputSearchUsername").keyup(() => {
            delay(function () {
                $("#formSearch").submit();
            }, 1000);
        });

        $("#inputSearchEmail").keyup(() => {
            delay(function () {
                $("#formSearch").submit();
            }, 1000);
        });

        $("#inputSearchAdmin").change(() => {
            delay(function () {
                $("#formSearch").submit();
            }, 1000);
        });

        $("#inputSearchActive").change(() => {
            delay(function () {
                $("#formSearch").submit();
            }, 1000);
        });
    });
</script>

<?php include './../inc/masterpage-backend/footer.php';?>