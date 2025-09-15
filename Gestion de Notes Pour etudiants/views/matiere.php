<?php 
    $readMatiere = $matiere->read();
?>

<!-- ===================================onload===================================== -->
<div class="cont" id="onload">
    <div class="div"></div>
    <div class="div"></div>
    <div class="div"></div>
</div>
     

<div class="dashContent">
    <div class="dash">
        <div>
            <h3>LISTES DE TOUTES LES MATIERES : </h3>
            <p><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal" onclick="add()">
                NOUVELLE MATIERE
            </button>
            </p>
        </div>

        <div>
            <table>
                <tr>
                    <th>NUMERO</th>
                    <th>MATIERES</th>
                    <th>COEFFICIENT</th>
                    <th>ACTIONS</th>
                </tr>
                <?php 
                    $i=0;
                    foreach ($readMatiere as $mat) {
                    $i++;?>
                    <tr>
                        <th><?= $i ?></th>
                        <th><?= $mat['nom'] ?></th>
                        <th><?= $mat['cofficient'] ?></th>
                        <th>
                            <button class="btn btn-sm btn-warning btn-update" data-bs-toggle="modal" data-bs-target="#formModal" onclick="update(<?= $mat['id_matiere'] ?>)">update</button>
                            <button class="btn btn-danger" onclick="del(<?= $mat['id_matiere'] ?>)">delete</button>
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
                <h5 class="modal-title">Nouvelle matiere</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="form_edit" id="form_edit" method="POST" action="controller/matiereController.php?action=create" >
                    <p>
                        <label class="form-label fw-bold">
                            Entrez LE nom de la matiere :
                        </label>
                        <input type="text" name="nom" id="nom" required  />
                    </p>
                    <p>
                        <label class="form-label fw-bold">
                            Entrez LE coefficient :
                        </label>
                        <input type="text" name="coef" id="coef" required  />
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
        document.querySelector("#coef").value = ""
        document.querySelector("#form_edit").setAttribute('action',`controller/matiereController.php?action=create`);
    }

    function del(id) {
        document.location.href=`controller/matiereController.php?action=delete&id=${id}`;
    }

    async function update(id) {
        const response= await fetch(`controller/matiereController.php?action=read&id=${id}`);
        const data = await response.json();
        document.querySelector("#nom").value = data.nom
        document.querySelector("#coef").value = data.cofficient
        document.querySelector("#form_edit").setAttribute('action',`controller/matiereController.php?action=update&id=${id}`);
    }
</script>