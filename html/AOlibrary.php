<?php if(!isset($_SESSION["brick"])) { ?>
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
<?php $brickList = $_SESSION["bdd"]->getBrickList(0);
foreach($brickList as $brick) { ?>
        <tr>
          <td><?php echo stripslashes($brick["title"]); ?></td>
          <td><?php echo stripslashes($brick["category"]); ?></td>
          <td><?php echo $brick["firstUser"]; ?></td>
          <td><?php echo $brick["firstCreated"]; ?></td>
          <td><?php echo $brick["lastUser"]; ?></td>
          <td><?php echo $brick["lastModified"]; ?></td>
          <td>
            <form class="form-inline" method="post" action="index.php?action=AOlibrary">
              <input type="hidden" name="action" value="edit" />
              <input type="hidden" name="brick_id" value="<?php echo $brick["id"]; ?>" />
              <button type="submit" class="btn btn-sm btn-primary btn-submit" data-toggle="tooltip" data-placement="bottom" title="Modifier la brique">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
              </button>
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#deleteModal" data-brickid="<?php echo $brick["id"]; ?>">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
              </button>
            </form>
          </td>
        </tr>
<?php } ?>
      </tbody>
    </table>

    <form enctype="multipart/form-data" class="form-inline" method="post" action="index.php?action=AOlibrary">
      <table class="table">
        <tbody>
          <tr>
            <td colspan="2" style="vertical-align:middle;">Nouvelle brique</td>
            <td colspan="2" class="text-right" style="vertical-align:middle;">Télécharge ton fichier .docx (max 10Mo) :</td>
            <td colspan="2">
              <input type="hidden" name="action" value="add" />
              <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
              <input type="file" name="file" accept=".docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required/>
            </td>
            <td>
              <button type="submit" class="btn btn-sm btn-primary btn-submit" data-toggle="tooltip" data-placement="bottom" title="Ajouter une nouvelle brique">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </form>

    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Supprimer la brique</h4>
          </div>
          <div class="modal-body">
            <p>Es-tu sûr de vouloir définitivement supprimer la brique sélectionnée ?</p>
          </div>
          <div class="modal-footer">
            <form class="form-inline" method="post" action="index.php?action=AOlibrary">
              <input type="hidden" name="action" value="delete" />
              <input id="deleteId" type="hidden" name="brick_id" value="" />
              <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Supprimer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php if($_SESSION["user"]->getRights()==2) { 
$brickList = $_SESSION["bdd"]->getBrickList(1);
if(sizeOf($brickList)>0) { ?>
    <h2>Briques supprimées :</h2>
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
<?php foreach($brickList as $brick) { ?>
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
              <button type="submit" class="btn btn-sm btn-primary btn-submit" data-toggle="tooltip" data-placement="bottom" title="Restaurer la brique">
                <span class="glyphicon glyphicon-share" aria-hidden="true"></span>
              </button>
            </form>
          </td>
        </tr>
<?php } ?>
      </tbody>
    </table>
<?php } } ?>

    <script>
      $(function () {
        $(".btn-submit").tooltip();
        $("#deleteModal").on("show.bs.modal", function(event) {
          var brickId = $(event.relatedTarget).data("brickid");
          $("#deleteId").val(brickId);
        });
      });
    </script>
<?php } else { ?>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <h2>Mettre à jour :</h2>
        <form id="updateForm" method="post" action="index.php?action=AOlibrary">
           <div class="form-group">
              <label for="title">Nom de la brique :</label>
              <input type="text" name="title" class="form-control" placeholder="Exemple : Business VPN" value="<?php echo $_SESSION["brick"]->getTitle(); ?>" required/>
            </div>
            <div class="form-group">
              <label for="title">Catégorie :</label>
              <select class="form-control" name="category" required>
                <option value="">...</option>
                <option value="Général" <?php echo $_SESSION["brick"]->hasCategory("Général")?"selected":""; ?>>Général</option>
                <option value="Présentation" <?php echo $_SESSION["brick"]->hasCategory("Présentation")?"selected":""; ?>>Présentation</option>
                <option value="Offres" <?php echo $_SESSION["brick"]->hasCategory("Offres")?"selected":""; ?>>Offres</option>
                <option value="Gestion de projet" <?php echo $_SESSION["brick"]->hasCategory("Gestion de projet")?"selected":""; ?>>Gestion de projet</option>
              </select>
            </div>
            <input type="hidden" name="action" value="update" />
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved" aria-hidden="true"></span> Enregistrer</button>
        </form>
      </div>
    </div>
<?php } ?>
    <br/>
    <a href="index.php?page=accueil" class="btn btn-default" role="button">
      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Retour à l'accueil
    </a>
    <br/><br/>
