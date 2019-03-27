<?php if(!defined('securityCheck')) { die('Erreur : Accès direct à cette page interdit !'); } ?>
<?php if(!isset($_SESSION["stats"])) { $_SESSION["stats"] = new Stats(); } ?>
    <div class="row mb-5">
      <div class="col-12 col-md-3">
        <div class="card border-0 mb-3" style="background-color:rgb(75,180,230);">
          <div class="card-body text-center">
            <h1 class="card-title"><?php echo $_SESSION["stats"]->getNumberUsers(); ?></h1>
            <p class="card-text">utilisateurs</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="card border-0 mb-3" style="background-color:rgb(255,220,0);">
          <div class="card-body text-center">
            <h1 class="card-title"><?php echo $_SESSION["stats"]->getNumberBricks(); ?></h1>
            <p class="card-text">briques de rédaction</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="card border-0 mb-3" style="background-color:rgb(80,190,135);">
          <div class="card-body text-center">
            <h1 class="card-title"><?php echo $_SESSION["stats"]->getNumberProposals(); ?></h1>
            <p class="card-text">appels d'offre créés</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="card border-0 mb-3" style="background-color:rgb(145,100,205);">
          <div class="card-body text-center">
            <h1 class="card-title"><?php echo $_SESSION["stats"]->getNumberExpress(); ?></h1>
            <p class="card-text">AOexpress générés</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col-12">
        <canvas id="connectionChart" width="1300" height="400"></canvas>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col-12">
        <canvas id="bricksUseChart" width="1300" height="400"></canvas>
      </div>
    </div>

    <script>
      $(function () {
        var minDate = new Date();
        minDate.setMonth(minDate.getMonth()-6);
        var maxDate = new Date();
        var connectionChart = new Chart('connectionChart', {
          type: 'line',
          data: {
            labels: <?php echo $_SESSION["stats"]->getXAxisConnectionStats(); ?>,
            datasets: [{
              data: <?php echo $_SESSION["stats"]->getYAxisConnectionStats(); ?>,
              label: 'Nombre de connexions par semaine sur les 6 derniers mois',
              borderColor: 'rgb(255, 102, 0)',
              fill: false              
            }]
          },
          options: {
            scales: { yAxes: [ { ticks: { beginAtZero:true } } ] }
          }
        });
        var bricksUseChart = new Chart('bricksUseChart', {
          type: 'bar',
          data: {
            labels: <?php echo $_SESSION["stats"]->getXAxisBrickUseStats(); ?>,
            datasets: [{
              data: <?php echo $_SESSION["stats"]->getYAxisBrickUseStats(); ?>,
              label: 'Utilisations des briques'
            }]
          },
          options: {
            scales: { yAxes: [ { ticks: { beginAtZero:true } } ] }
          }
        });
      });
    </script>