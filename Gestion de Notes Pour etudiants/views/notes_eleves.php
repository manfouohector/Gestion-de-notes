<!-- ===================================onload===================================== -->
<div class="cont" id="onload">
    <div class="div"></div>
    <div class="div"></div>
    <div class="div"></div>
</div>
     

<div class="dashContent">
    <div class="dash">
        <div>
            <form action="dashboard.php?route=note" id="note_form" method="POST">
                <p>
                    <label>Entrer la salle de classe : </label>
                    <select name="id_classe" id="id_classe" required>
                        <?php 
                            foreach ($classe->read() as $cl) { ?>
                                <option value="<?= $cl['id_classe']?>"><?= $cl['nom']?></option>
                         <?php   }
                        ?>
                    </select>
                </p>
                <p>
                    <label>Entrer la matiere : </label>
                    <select name="id_matiere" id="id_matiere" required>
                         <?php 
                            foreach($matiere->read() as $mat) { ?>
                                <option value="<?= $mat['id_matiere']?>"><?= $mat['nom']?></option>
                         <?php }
                        ?>
                    </select>
                </p>
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        </div>

        <div>
            <table>
                <tr>
                    <th>NUMERO</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>NOTES</th>
                    <th>ACTIONS</th>
                </tr>
                     <?php
                     if(isset($_POST['id_matiere'])==true && isset($_POST['id_classe']) == true) { 
                    $i=0;
                    $readnote = $note->read($_POST['id_matiere'],$_POST['id_classe']);
                    foreach($readnote as $not) {
                    $i++;?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $not[1] ?></td>
                        <td><?= $not['prenom']?></td>
                        
                        <td><?= $not['note']?></td>
                        <?php  if($_SESSION['profil']['type'] == 'enseignant' || $_SESSION['profil']['type'] == 'admin') { ?>
                        <td>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#formModal" onclick="update(<?=$not['id_matiere']?>,<?=$not['id_etudiant']?>)">update</button>
                        </td>
                        <?php } ?>
                    </tr>
                <?php
            }} ?>
            </table>
        </div>
    </div>
</div>
  


<div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">NOTES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="form_edit" id="form_edit" method="POST" action="" >
                    <p>
                        <label class="form-label fw-bold">
                            Entrez UNE NOTE :
                        </label>
                        <input type="text" name="note" id="note" required  />
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

    async function update(id_matiere,id_etudiant) {
        const response= await fetch(`controller/suivreController.php?action=read&id_matiere=${id_matiere}&id_etudiant=${id_etudiant}`);
        const data = await response.json();
        document.querySelector("#note").value = data.note
        document.querySelector("#form_edit").setAttribute('action',`controller/suivreController.php?action=update&id_matiere=${id_matiere}&id_etudiant=${id_etudiant}`);
    }
</script>