<?php
    require "dbBroker.php";
    require "model/prijava.php";

    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
        exit();
    }

    $rezultat=Prijava::getAll($conn);                            //$conn iz dbBroker.php-a

    if(!$rezultat){
        echo "Nastala greska prilikom izvrsavanja upita <br>";
        die();                                                         // kao exit() prekida sesiju i nista nakon te linije se ne izvrsava
    }

    if($rezultat->num_rows===0){
        echo "Nema prijavljenih kolokvijuma";
        die();  
    }

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FON: Prijava kolokvijuma</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>

<body>
    <div class="container">
        <div class="row md-1">
            <form action="#" method="post">
                <button type="submit" name="submit" value="log_out" class="btn btn-warning btn-block">Log out</button>
            </form>
        </div>
        <!-- Header section -->
        <div class="jumbotron text-center">
            <h1>Prijava Kolokvijuma</h1>
            <p>Fakultet organizacionih nauka</p>
        </div>


        <div class="row mb-4 text-center">
            <div class="col-md-4 col-md-offset-4">
                <button id="btn-dodaj" type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">Zakazi kolokvijum</button>
            </div>
        </div>

        <!-- Table section -->
        <div id="pregled" class="panel panel-success">
            <div class="panel-body">
                <form id="prijavaForm" action="#" method="post">
                    <table id="myTable" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Predmet</th>
                                <th>Katedra</th>
                                <th>Sala</th>
                                <th>Datum</th>
                                <th>Selektuj</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                            if($rezultat->num_rows>0):
                             while ($red = $rezultat->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $red["predmet"] ?></td>
                                    <td><?php echo $red["katedra"] ?></td>
                                    <td><?php echo $red["sala"] ?></td>
                                    <td><?php echo $red["datum"] ?></td>
                                    <td>
                                        <label class="custom-radio-btn">
                                            <input type="radio" name="id_predmeta" value="<?php echo $red['id']; ?>">
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                </tr>
                            <?php } else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Nema unetih kolokvijuma</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Dugmad za akcije na dnu -->
                    <div class="row">
                        <div class="col-md-6">
                            <button id="btn-izmeni" type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#izmeniModal" disabled>Izmeni</button>
                        </div>
                        <div class="col-md-6">
                            <button id="btn-obrisi" type="submit" name="submit" value="Obrisi" class="btn btn-danger btn-block" disabled>Obrisi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Zakazi Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title text-center">Zakazi kolokvijum</h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" id="dodajForm">
                            <div class="form-group">
                                <label>Predmet</label>
                                <input type="text" name="predmet" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Katedra</label>
                                <input type="text" name="katedra" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Sala</label>
                                <input type="text" name="sala" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Datum</label>
                                <input type="date" name="datum" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" value="zakazi" class="btn btn-success btn-block">Zakazi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Izmeni Modal -->
        <div class="modal fade" id="izmeniModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title text-center">Izmeni kolokvijum</h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" id="izmeniForm">
                            <input id="id_predmeta" type="hidden" name="id_predmeta" readonly>
                            <div class="form-group">
                                <label>Predmet</label>
                                <input id="predmet" type="text" name="predmet" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Katedra</label>
                                <input id="katedra" type="text" name="katedra" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Sala</label>
                                <input id="sala" type="text" name="sala" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Datum</label>
                                <input id="datum" type="date" name="datum" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" value="izmeni" id="btnIzmeniModal" class="btn btn-success btn-block">Izmeni</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and jQuery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    
    <script>
    document.querySelectorAll('input[name="id_predmeta"]').forEach(radio => {     //prolazi se kroz svako input polje koje ima naziv=id_predmeta a to su radio dugmici

        radio.addEventListener('change', function () {

            // Omogući dugmad
            document.getElementById('btn-izmeni').disabled = false;
            document.getElementById('btn-obrisi').disabled = false;

            // Pronađi <tr> (closest)
            let selectedRow = this.closest('tr');

            // Uzmi vrednosti iz ćelija
            let predmet = selectedRow.querySelector('td:nth-child(1)').textContent;
            let katedra = selectedRow.querySelector('td:nth-child(2)').textContent;
            let sala = selectedRow.querySelector('td:nth-child(3)').textContent;
            let datum = selectedRow.querySelector('td:nth-child(4)').textContent;

            // ID iz radio dugmeta
            let id = this.value;

            // Upis podataka u modal
            document.getElementById('id_predmeta').value = id;
            document.getElementById('predmet').value = predmet;
            document.getElementById('katedra').value = katedra;
            document.getElementById('sala').value = sala;
            document.getElementById('datum').value = datum;
        });

    });
    </script>

</body>

</html>
