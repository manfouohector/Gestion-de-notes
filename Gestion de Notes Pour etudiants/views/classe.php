<?php 
    $readclasse = $enseigner->read();
    $read = $classe->read();
    $readMat = $matiere->read();
?>

<!-- ===================================onload===================================== -->
<div class="cont" id="onload">
    <div class="div"></div>
    <div class="div"></div>
    <div class="div"></div>
</div>
     

<div class="dashContent">
    <section>
        <div class="bloc">
            <span>
                <i class="fa-solid fa-person-chalkboard"></i>
                NOMBRE D'ENSEIGNANTS
            </span>
            <br>
            <span><?= $enseigner->countenseignant()['ens'] ?></span>
        </div>

        <div class="bloc">
            <span>
                <i class="fa-solid fa-landmark"></i>
                NOMBRE DE CLASSE
            </span>
            <br>
            <span><?= $enseigner->countclasse()['cla'] ?></span>
        </div>

        <div class="bloc">
            <span>
                <i class="fa-solid fa-user"></i>
                NOMBRE D'élèves
            </span>
            <br>
            <span><?= $enseigner->counteleve()['el'] ?></span>
        </div>
    </section> <br>
    <div class="dash">
        <div>
            <h3>LISTES DE TOUTES LES SALLES DE CLASSE : </h3>
            <p><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal" onclick="add()">NOUVELLE CLASSE</button>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#formModal2">AFFECTATION</button></p>

        </div>

        <div>
            <table>
                <tr>
                    <th>NUMERO</th>
                    <th>CLASSES</th>
                    <th>MATIERES</th>
                    <th>ACTIONS</th>
                </tr>
                    <?php 
                    $i=0;
                    foreach ($readclasse as $classe) {
                    $i++;?>
                    <tr>
                        <th><?= $i ?></th>
                        <th><?= $classe[1] ?></th>
                        <th><?= $classe["group_concat(matiere.nom,',')"]?></th>
                        <th>
                            <button class="btn btn-sm btn-warning btn-update" data-bs-toggle="modal" data-bs-target="#formModal" onclick="update(<?= $classe['id_classe'] ?>)">update</button>
                            <button class="btn btn-danger" onclick="del(<?=$classe['id_classe']?>)">delete</button>
                        </th>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nouvelle Classe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="form_edit" id="form_edit" method="POST" action="controller/classController.php?action=create" >
                    <p>
                        <label class="form-label fw-bold">
                            Entrez LE nom de la classe :
                        </label>
                        <input type="text" name="nom" id="nom" required  />
                    </p>
                    <p class="text-right">
                        <input type="submit" class="btn btn-success" value="Enregistrer"/>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- ===============AFFECTATION================== -->
<div class="modal fade" id="formModal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nouvelle Classe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="form_edit" id="form_edit" method="POST" action="controller/classController.php?action=affectation" >
                    <p>
                        <label class="form-label fw-bold">
                            Selectionner la/les classes  :
                        </label>
                        <select name="id_classe[]" id="" multiple>
                            <?php 
                                foreach ($read as $cl) { ?>
                                    <option value="<?=$cl['id_classe']?>"><?=$cl['nom']?></option>
                            <?php    }
                            ?>
                           
                        </select>
                    </p>
                    <p>
                        <label class="form-label fw-bold">
                            Selectionner les Matieres  :
                        </label>
                        <select name="id_matiere[]" id="" multiple>
                            <?php 
                                foreach ($readMat as $Mat) { ?>
                                    <option value="<?= $Mat['id_matiere']?>"><?= $Mat['nom'] ?></option>
                            <?php    }
                            ?>
                        </select>
                    </p>
                    <p class="text-right">
                        <input type="submit" class="btn btn-success" value="Enregistrer"/>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const onload = document.getElementById("onload");
    document.addEventListener("DOMContentLoaded",()=>{
       setTimeout(() => {
            onload.style.display = "none";
       }, 500);
    })

    function add() {
        document.querySelector("#nom").value = ""
        document.querySelector("#form_edit").setAttribute('action',`controller/classController.php?action=create`);
    }

    function del(id) {
        document.location.href=`controller/classController.php?action=delete&id=${id}`;
    }

    async function update(id) {
        const response= await fetch(`controller/classController.php?action=read&id=${id}`);
        const data = await response.json();
        document.querySelector("#nom").value = data.nom
        document.querySelector("#form_edit").setAttribute('action',`controller/classController.php?action=update&id=${id}`);
    }
</script>