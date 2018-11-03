<?php if(!isset($_SESSION["library"])) { $_SESSION["library"] = new Library(); } ?>  
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Catégorie</th>
          <th>Créée par</th>
          <th>Date création</th>
          <th>Modifiée par</th>
          <th>Date dernière modification</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php $brickList = $_SESSION["bdd"]->getDeletedList(); if(sizeOf($brickList)>0) { foreach($brickList as $brick) { ?>
        <tr>
          <td><?php echo stripslashes($brick["title"]); ?></td>
          <td><?php echo stripslashes($brick["category"]); ?></td>
          <td><?php echo $brick["firstUser"]; ?></td>
          <td><?php echo $brick["firstCreated"]; ?></td>
          <td><?php echo $brick["lastUser"]; ?></td>
          <td><?php echo $brick["lastModified"]; ?></td>
          <td>
            <form class="form-inline" method="post" action="index.php?action=AOlibrary">
              <input type="hidden" name="action" value="restore" />
              <input type="hidden" name="brick_id" value="<?php echo $brick["id"]; ?>" />
              <button type="submit" class="btn btn-sm btn-primary" title="Restaurer la brique">
                <i class="fas fa-share"></i>
              </button>
            </form>
          </td>
        </tr>
<?php } } else { ?>
        <tr>
          <td colspan="7">Aucune brique supprimée jusqu'à présent...</td>
        </tr>
<?php } ?>
      </tbody>
    </table>