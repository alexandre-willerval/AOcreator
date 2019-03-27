<?php if(!defined('securityCheck')) { die('Erreur : Accès direct à cette page interdit !'); } ?>
<?php if(!isset($_SESSION["library"])) { $_SESSION["library"] = new Library(); } ?>    
    <table class="table table-striped" style="margin-bottom:0px;">
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
<?php $brickList = $_SESSION["library"]->getBrickList(); foreach($brickList as $brick) { ?>
        <tr>
          <td><?php echo stripslashes($brick["title"]); ?></td>
          <td><?php echo stripslashes($brick["category"]); ?></td>
          <td><a href="mailto:<?php echo $brick["firstUser"]; ?>"><?php echo $brick["firstUser"]; ?></a></td>
          <td><?php echo $brick["firstCreated"]; ?></td>
          <td><a href="mailto:<?php echo $brick["lastUser"]; ?>"><?php echo $brick["lastUser"]; ?></a></td>
          <td><?php echo $brick["lastModified"]; ?></td>
          <td>
            <form class="form-inline" method="post" action="index.php?action=AOlibrary">
              <input type="hidden" name="action" value="edit" />
              <input type="hidden" name="brick_id" value="<?php echo $brick["id"]; ?>" />
              <button type="submit" class="btn btn-sm btn-primary" title="Modifier la brique">
                <i class="fas fa-edit"></i>
              </button>
              <button type="button" class="btn btn-sm btn-primary ml-2" title="Supprimer la brique" data-toggle="modal" data-target="#deleteModal" data-brickid="<?php echo $brick["id"]; ?>">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
<?php } ?>
      </tbody>
    </table>

    <form enctype="multipart/form-data" class="form-inline" method="post" action="index.php?action=AOlibrary">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td colspan="2">Nouvelle brique</td>
            <td colspan="2" class="text-right">Télécharge ton fichier .docx (max 10Mo) :</td>
            <td colspan="2">
              <input type="hidden" name="action" value="add" />
              <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file" accept=".docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                <label class="custom-file-label" for="file">Sélectionner un fichier</label>
              </div>
            </td>
            <td>
              <button type="submit" class="btn btn-sm btn-primary" title="Ajouter une nouvelle brique">
                <i class="fas fa-plus"></i>
              </button>
            </td>
          </tr>
<?php if($_SESSION["user"]->getRights()==2) { ?>
          <tr>
            <td colspan="3">Anciennes briques</td>
            <td colspan="3">Voir les briques supprimées</td>
            <td><a class="btn btn-sm btn-primary" href="index.php?page=AOlibrary-deleted"><i class="fas fa-long-arrow-alt-right"></i></a></td>
          </tr>
<?php } ?>
        </tbody>
      </table>
    </form>

    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Supprimer la brique</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Es-tu sûr de vouloir définitivement supprimer la brique sélectionnée ?</p>
          </div>
          <div class="modal-footer">
            <form class="form-inline" method="post" action="index.php?action=AOlibrary">
              <input type="hidden" name="action" value="delete" />
              <input id="deleteId" type="hidden" name="brick_id" value="" />
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-trash"></i> Supprimer</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(function () {
        $("#deleteModal").on("show.bs.modal", function(event) {
          var brickId = $(event.relatedTarget).data("brickid");
          $("#deleteId").val(brickId);
        });
      });
    </script>
