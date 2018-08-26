    <div class="row">
 <?php $menuList = $_SESSION["bdd"]->getMenuList($_SESSION["user"]->getRights());
 foreach($menuList as $menuItem) { ?>
      <div class="col-md-6">
        <div class="thumbnail">
          <div class="caption">
            <h3><?php echo $menuItem["title"]; ?></h3>
            <br/>
            <p><?php echo $menuItem["description"]; ?></p>
            <br/>
            <p class="text-right">
              <a href="index.php?page=<?php echo $menuItem["name"]; ?>" class="btn btn-primary" role="button">
                <span class="glyphicon <?php echo $menuItem["icon"]; ?>" aria-hidden="true"></span> <?php echo $menuItem["title"].PHP_EOL; ?>
              </a>
            </p>
          </div>
        </div>
      </div>
<?php } ?>
    </div>
