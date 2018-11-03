    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-4">
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
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
        </form>
      </div>
    </div>