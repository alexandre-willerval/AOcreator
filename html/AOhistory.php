    <h2>Mes appels d'offres :</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Client</th>
          <th>Rédacteur</th>
          <th>Date création</th>
          <th>Date dernière modification</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php $proposalList = $_SESSION["bdd"]->getUserProposalList($_SESSION["user"]->getEmail()); if(sizeof($proposalList) == 0) { ?>
        <tr>
          <td colspan="4" style="vertical-align:middle;">Aucun appel d'offre à afficher</td>
          <td class="text-right" style="vertical-align:middle;">En créer un nouveau :</td>
          <td>
            <a href="index.php?page=AOcreator" class="btn btn-sm btn-primary">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
          </td>
        </tr>
<?php } else { foreach($proposalList as $proposal) { ?>
        <tr>
          <td><?php echo stripslashes($proposal["title"]); ?></td>
          <td><?php echo stripslashes($proposal["clientName"]); ?></td>
          <td><?php echo $proposal["user"]; ?></td>
          <td><?php echo $proposal["firstCreated"]; ?></td>
          <td><?php echo $proposal["lastModified"]; ?></td>
          <td>
            <form class="form-inline" method="post" action="index.php?action=AOhistory">
              <input type="hidden" name="proposal_id" value="<?php echo $proposal["id"]; ?>" />
              <button type="submit" class="btn btn-sm btn-primary btn-submit" data-toggle="tooltip" data-placement="bottom" title="Modifier">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
              </button>
            </form>
          </td>
        </tr>
<?php } ?>
        <tr>
          <td>Nouvel appel d'offre</td>
          <td colspan="4"></td>
          <td>
            <a href="index.php?page=AOcreator" class="btn btn-sm btn-primary btn-submit" data-toggle="tooltip" data-placement="bottom" title="Créer">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
          </td>
        </tr>
<?php } ?>
      </tbody>
    </table>
    <h2>Tous les appels d'offres :</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Client</th>
          <th>Rédacteur</th>
          <th>Date création</th>
          <th>Date dernière modification</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php $proposalList = $_SESSION["bdd"]->getProposalList(); if(sizeof($proposalList) == 0) { ?>
        <tr>
          <td colspan="4" style="vertical-align:middle;">Aucun appel d'offre à afficher</td>
          <td class="text-right" style="vertical-align:middle;">En créer un nouveau :</td>
          <td>
            <a href="index.php?page=AOcreator" class="btn btn-sm btn-primary">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
          </td>
        </tr>
<?php } else { foreach($proposalList as $proposal) { ?>      
        <tr>
          <td><?php echo stripslashes($proposal["title"]); ?></td>
          <td><?php echo stripslashes($proposal["clientName"]); ?></td>
          <td><?php echo $proposal["user"]; ?></td>
          <td><?php echo $proposal["firstCreated"]; ?></td>
          <td><?php echo $proposal["lastModified"]; ?></td>
          <td>
            <form class="form-inline" method="post" action="index.php?action=AOhistory">
              <input type="hidden" name="proposal_id" value="<?php echo $proposal["id"]; ?>" />
              <button type="submit" class="btn btn-sm btn-primary btn-submit" data-toggle="tooltip" data-placement="bottom" title="Voir">
                <span class="glyphicon glyphicon-share" aria-hidden="true"></span>
              </button>
            </form>
          </td>
        </tr>
<?php } ?>
        <tr>
          <td>Nouvel appel d'offre</td>
          <td colspan="4"></td>
          <td>
            <a href="index.php?page=AOcreator" class="btn btn-sm btn-primary btn-submit" data-toggle="tooltip" data-placement="bottom" title="Créer">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
          </td>
        </tr>
<?php } ?>
      </tbody>
    </table>
    <a href="index.php?page=accueil" class="btn btn-default" role="button">
      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Retour à l'accueil
    </a>
    <br/><br/>

    <script>
      $(function () {
        $(".btn-submit").tooltip();
      });
    </script>
