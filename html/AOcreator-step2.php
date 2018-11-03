        <form id="form2" method="post" action="index.php?action=AOcreator_step2">
          <div role="tabpanel" class="row">
            <div class="col-12 col-md-2">
              <div class="nav flex-column nav-pills" role="tablist">
                <a class="nav-link active" data-toggle="pill" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                <a class="nav-link" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                <a class="nav-link" data-toggle="pill" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>
                <a class="nav-link" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
              </div>
              <div class="nav flex-column nav-pills" role="tablist">
                <a class="nav-link" data-toggle="pill" role="tab" id="newtab" aria-selected="false"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <div class="tab-content col-12 col-md-10" style="border-top:2px black solid;">
              <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                Lorem ipsum dolor sit
                amet, consectetur adipiscing elit. In iaculis volutpat quam, non
                suscipit arcu accumsan at. Aliquam pellentesque.<a href="#">test focus 4</a>
              </div>
              <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                Sed ut perspiciatis unde omnis iste natus error sit 
                voluptatem accusantium doloremque laudantium, totam rem aperiam, 
                eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, 
                sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. 
                Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, 
                adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore 
                magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem 
                ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? 
                Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil 
                molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
              </div>
              <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                At vero eos et accusamus et iusto odio dignissimos ducimus 
                qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas 
                molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa 
                qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem 
                rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est 
                eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, 
                omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et 
                aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae 
                sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, 
                ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
              </div>
              <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                Lorem ipsum dolor sit
                amet, consectetur adipiscing elit. In iaculis volutpat quam, non
                suscipit arcu accumsan at. Aliquam pellentesque.
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-3">
            <input id="action2" type="hidden" name="action2" value="" />
            <button id="reset2" type="submit" class="btn btn-primary"><i class="fas fa-redo-alt"></i> Réinitialiser</button>
<?php if($_SESSION["proposal"]->getStep()==2) { ?>
            <button id="create2" type="submit" class="btn btn-primary pull-right"><i class="fas fa-long-arrow-alt-right"></i> Passer à l'étape 3</button>
<?php } else { ?>
            <button id="save2" type="submit" class="btn btn-primary pull-right"><i class="fas fa-save"></i> Enregistrer les modifications</button>
<?php } ?>
          </div>
        </form>
