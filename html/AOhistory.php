<?php if(!isset($_SESSION["history"])) { $_SESSION["history"] = new History(); } ?>    
    <div>
      <em>TODO: search form</em>  
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Client</th>
          <th>Cabinet conseil</th>
          <th>Offres</th>
          <th>Rédacteur</th>
          <th>Date création</th>
          <th>Date dernière modification</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php $proposalList = $_SESSION["history"]->getProposalList(); if(sizeof($proposalList) == 0) { ?>
        <tr>
          <td colspan="6">Aucun appel d'offre à afficher</td>
          <td class="text-right">En créer un nouveau :</td>
          <td>
            <a href="index.php?page=AOcreator" class="btn btn-sm btn-primary">
              <i class="fas fa-plus"></i>
            </a>
          </td>
        </tr>
<?php } else { foreach($proposalList as $proposal) { ?>      
        <tr>
          <td><?php echo stripslashes($proposal["title"]); ?></td>
          <td><?php echo stripslashes($proposal["clientName"]); ?></td>
          <td><?php echo stripslashes($proposal["consultantName"]); ?></td>
          <td><?php echo stripslashes($proposal["products"]); ?></td>
          <td><a href="mailto:<?php echo $proposal['user']; ?>"><?php echo $proposal['user']; ?></a></td>
          <td><?php echo $proposal["firstCreated"]; ?></td>
          <td><?php echo $proposal["lastModified"]; ?></td>
          <td>
            <form class="form-inline" method="post" action="index.php?action=AOhistory">
              <input type="hidden" name="proposal_id" value="<?php echo $proposal["id"]; ?>" />
              <button type="submit" class="btn btn-sm btn-primary" title="Voir l'AO">
                <i class="fas fa-folder-open"></i>
              </button>
            </form>
          </td>
        </tr>
<?php } ?>
        <tr>
          <td colspan="6">Nouvel appel d'offre</td>
          <td>En créer un nouveau :</td>
          <td>
            <a href="index.php?page=AOcreator" class="btn btn-sm btn-primary" title="Créer">
              <i class="fas fa-plus"></i>
            </a>
          </td>
        </tr>
<?php } ?>
      </tbody>
    </table>
