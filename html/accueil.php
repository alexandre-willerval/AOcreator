    <div class="row">
 <?php $menuList = $_SESSION["bdd"]->getMenuList($_SESSION["user"]->getRights());
 foreach($menuList as $menuItem) { ?>
      <div class="col-12 col-md-6">
        <div class="card mb-3">
          <div class="card-header">
            <?php echo $menuItem["title"]; ?>
          </div>
          <div class="card-body">
            <p class="card-text"><?php echo $menuItem["description"]; ?></p>
            <p class="text-right mb-0">
              <a href="index.php?page=<?php echo $menuItem["name"]; ?>" class="btn btn-primary" role="button">
                <i class="<?php echo $menuItem["icon"]; ?>"></i> <?php echo $menuItem["title"].PHP_EOL; ?>
              </a>
            </p>
          </div>
        </div>
      </div>
<?php } ?>
    </div>
