        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form id="form1" method="post" action="index.php?action=AOcreator_step1">
              <div class="form-group">
                <label for="title">Quel titre veux-tu donner à ton mémoire technique ?</label>
                <input type="text" name="title" class="form-control" placeholder="Exemple : Lot 4 : Accès internet haut débit" value="<?php echo $_SESSION["proposal"]->getTitle(); ?>" required/>
              </div>
              <div class="form-group">
                <label for="clientName">Pour quel client ?</label>
                <input type="text" name="clientName" class="form-control" placeholder="Exemple : Mairie de Lille" value="<?php echo $_SESSION["proposal"]->getClientName(); ?>" required/>
              </div>
              <div class="form-group">
                <label for="consultantName">Quel est le cabinet conseil ? (s'il y en a un)</label>
                <input type="text" name="consultantName" class="form-control" placeholder="Exemple : SDCT" value="<?php echo $_SESSION["proposal"]->getConsultantName(); ?>" />
              </div>
              <div class="form-group">
                <label for="products">Quelle offre Orange est proposée ?</label>
                <input type="text" name="products" class="form-control" placeholder="Exemple : BVPN" value="<?php echo $_SESSION["proposal"]->getProducts(); ?>" />
              </div>
              <div class="d-flex justify-content-between">
                <input id="action1" type="hidden" name="action1" value="" />
                <button id="reset1" type="submit" class="btn btn-primary"><i class="fas fa-redo-alt"></i> Réinitialiser</button>
<?php if($_SESSION["proposal"]->getStep()==1) { ?>
                <button id="create1" type="submit" class="btn btn-primary pull-right"><i class="fas fa-long-arrow-alt-right"></i> Passer à l'étape 2</button>
<?php } else { ?>
                <button id="save1" type="submit" class="btn btn-primary pull-right"><i class="fas fa-save"></i> Enregistrer les modifications</button>
<?php } ?>
              </div>
            </form>
          </div>
        </div>