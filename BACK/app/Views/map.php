<div id="map" style="height: 500px; width: 100%;" data-sites='<?= json_encode($sites) ?>'></div>
<button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addSiteModal">Ajouter un site</button>

<script src="<?= $base_url ?>js/map.js"></script>