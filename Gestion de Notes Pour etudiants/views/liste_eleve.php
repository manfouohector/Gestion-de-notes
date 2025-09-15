<?php 
    $readetudiant = $etudiant->read();
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
            <h3>LISTES Des élèves : </h3>
            <p><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal" onclick="add()">NOUVEL élève</button></p>
        </div>

        <div>
            <table>
                <tr>
                    <th>NUMERO</th>
                    <th>PHOTO</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>CLASSE</th>
                    <th>ACTIONS</th>
                </tr>
                 <?php 
                    $i=0;
                    foreach ($readetudiant as $etudiant) {
                    $i++;?>
                    <tr>
                        <th><?= $i?></th>
                        <th><img src="<?="image/".$etudiant['photo']?>" style="width:50px;border-radius:50px" alt=""></th>
                        <th><?= $etudiant['nom']?></th>
                        <th><?= $etudiant['prenom']?></th>
                        <th><?= $classe->readone($etudiant['id_classe'])['nom']?></th>
                        <?php  if($_SESSION['profil']['type'] == 'admin') { ?>
                        <th>
                            <button class="btn btn-sm btn-warning btn-update" data-bs-toggle="modal" data-bs-target="#formModal" onclick="update(<?=$etudiant['id_etudiant']?>)">update</button>
                            <button class="btn btn-danger" onclick="del(<?=$etudiant['id_etudiant']?>)">delete</button>
                        </th>
                        <?php } ?>
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
                <h5 class="modal-title">Nouvel ELEVE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="form_edit" id="form_edit" method="POST" enctype="multipart/form-data" action="controller/listeController.php?action=create" >
                    <p>
                        <label class="form-label fw-bold">
                            Entrez une photo :
                        </label>
                        <input type="file" name="photo" id="photo" required  />
                    </p>
                    <p>
                        <label class="form-label fw-bold">
                            Entrez LE nom :
                        </label>
                        <input type="text" name="nom" id="nom" required  />
                    </p>
                    <p>
                        <label class="form-label fw-bold">
                            Entrez le prenom :
                        </label> 
                        <input type="text" name="prenom" id="prenom" required  />
                    </p>
                    <p>
                        <label class="form-label fw-bold">
                            Entrez l'age :
                        </label>
                        <input type="text" name="age" id="age" required  />
                    </p>
                    <p>
                        <label class="form-label fw-bold">
                            Entrez le matricule :
                        </label>
                        <input type="text" name="matricule" id="matricule" required  />
                    </p>
                    <p>
                        <label class="form-label fw-bold">
                            Selectionnez le genre  :
                        </label>
                        <select name="sexe" id="sexe" required> 
                            <option value="M">MASCULIN</option>
                            <option value="F">FEMININ</option>
                        </select>
                    </p>
                    <p>
                        <label class="form-label fw-bold">
                            Selectionner la classe :
                        </label>
                        <select name="id_classe" id="id_classe">
                                 <?php 
                                foreach ($classe->read() as $cl) { ?>
                                    <option value="<?=$cl['id_classe']?>"><?=$cl['nom']?></option>
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
        document.querySelector("#prenom").value = ""
        document.querySelector("#age").value = ""
        document.querySelector("#sexe").value = ""
        document.querySelector("#id_classe").value = ""
        document.querySelector("#matricule").value = ""
        document.querySelector("#photo").value = ""
        document.querySelector("#form_edit").setAttribute('action',`controller/listeController.php?action=create`);
    }

    function del(id) {
        document.location.href=`controller/listeController.php?action=delete&id=${id}`;
    }

    async function update(id) {
        const response= await fetch(`controller/listeController.php?action=read&id=${id}`);
        const data = await response.json();
        document.querySelector("#nom").value = data.nom
        document.querySelector("#id_classe").value = data.id_classe
        document.querySelector("#prenom").value = data.prenom
        document.querySelector("#age").value = data.age
        document.querySelector("#sexe").value = data.sexe
        document.querySelector("#matricule").value = data.matricule
        document.querySelector("#form_edit").setAttribute('action',`controller/listeController.php?action=update&id=${id}`);
    }
</script>