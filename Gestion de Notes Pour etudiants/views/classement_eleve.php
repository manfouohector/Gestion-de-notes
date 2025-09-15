<!-- ===================================onload===================================== -->
<div class="cont" id="onload">
    <div class="div"></div>
    <div class="div"></div>
    <div class="div"></div>
</div>
                                                                                                       

<div class="dashContent">
    <div class="dash">
        <div>
            <form action="dashboard.php?route=classement" method="POST" id="note_form">
                <p>
                    <label>Entrer la salle de classe : </label>
                    <select name="sale" id="" required>
                          <?php 
                                foreach ($classe->read() as $cl) { 
                                ?>
                                    <option value="<?=$cl['id_classe']?>"><?=$cl['nom']?></option>
                            <?php    }
                            ?>
                    </select>
                </p>
                <button type="submit" class="btn btn-success">Soumettre</button>
            </form>
        </div>
        <div>
            <table>
                <tr>
                    <th>RANG</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>MOYENNE</th>
                </tr>
                <?php 
                if(isset($_POST['sale']) == true) {
                    
                    $readclasse = $etudiant->readuser($_POST['sale']);
                    $i=0;
                    foreach ($readclasse as $classe) {
                    $i++;?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $classe['nom'] ?></td>
                        <td><?=$classe['prenom'] ?></td>
                        <td><?= $classe['AVG(note)'] ?></td>
                    </tr>
                <?php }} ?>
            </table>
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
</script>
