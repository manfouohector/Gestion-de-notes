<?php 
    $readenseignant = $donner->read();
    $read = $professeur->read();
    $readMat = $matiere->read();
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
            <h3>LISTES DES ENSEIGNANTS : </h3>
            <p><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal" onclick="add()">NOUVEL ENSEIGNANT</button>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#formModal2">AFFECTATION</button></p>
        </div>

        <div>
            <table>
                <tr>
                    <th>NUMERO</th>
                    <th>PHOTO</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>MATIERE</th>
                    <th>ACTIONS</th>
                </tr>
                    <?php 
                    $i=0;
                    foreach ($readenseignant as $enseignant) {
                    $i++;?>
                    <tr>
                        <th><?= $i?></th>
                        <th><img src="<?="image/".$enseignant['photo']?>" style="width:50px;border-radius:50px" alt=""></th>
                        <th><?= $enseignant[2]?></th>
                        <th><?= $enseignant['prenom']?></th>
                        <th><?= $enseignant["group_concat(matiere.nom,',')"]?></th>
                        <th>
                            <button class="btn btn-sm btn-warning btn-update" data-bs-toggle="modal" data-bs-target="#formModal" onclick="update(<?=$enseignant['id_proffeseur']?>)">update</button>
                            <button class="btn btn-danger" onclick="del(<?=$enseignant['id_proffeseur']?>)">delete</button>
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
                <h5 class="modal-title">Nouvel Enseignant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="form_edit" id="form_edit" method="POST" enctype="multipart/form-data" action="" >
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
                            <option value="MA">MASCULIN</option>
                            <option value="FE">FEMININ</option>
                        </select>
                    </p>
                  
                    <p>
                        <label class="form-label fw-bold">
                            Entrez une photo :
                        </label>
                        <input type="file" name="photo" id="photo" required />
                    </p>
                    <p class="text-right">
                        <input type="submit" class="btn btn-success" value="Enregistrer"/>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- =============================affectation=================== -->
 <div class="modal fade" id="formModal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Affectation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="form_edit" id="" method="POST" action="controller/profController.php?action=affectation" >
                    <p>
                        <label class="form-label fw-bold">
                            Selectionner le/les proffesseurs:
                        </label>
                        <select name="id_proffeseur[]" id="" multiple>
                              <?php 
                                foreach ($read as $pro) { ?>
                                    <option value="<?=$pro['id_proffeseur']?>"><?=$pro['nom']?></option>
                            <?php    }
                            ?>
                        </select>
                    </p>

                    <p>
                        <label class="form-label fw-bold">
                            Selectionner la matiere :
                        </label>
                        <select name="id_matiere[]" id="" multiple>
                              <?php 
                                foreach ($readMat as $mat) { ?>
                                    <option value="<?=$mat['id_matiere']?>"><?=$mat['nom']?></option>
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
        document.querySelector("#matricule").value = ""
        document.querySelector("#photo").value = ""
        document.querySelector("#form_edit").setAttribute('action',`controller/profController.php?action=create`);
    }

    function del(id) {
        document.location.href=`controller/profController.php?action=delete&id=${id}`;
    }

    async function update(id) {
        const response= await fetch(`controller/profController.php?action=read&id=${id}`);
        const data = await response.json();
        document.querySelector("#nom").value = data.nom
        document.querySelector("#prenom").value = data.prenom
        document.querySelector("#age").value = data.age
        document.querySelector("#sexe").value = data.sexe
        document.querySelector("#matricule").value = data.mat
        document.querySelector("#form_edit").setAttribute('action',`controller/profController.php?action=update&id=${id}`);
    }
</script>