<div id="content" class="mob-max">
    <div class="rightContainer">
        <h1>Ajouter un nouveau site</h1>
        <form role="form">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="form-group">
                        <label>Nom du site</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label>Adresse <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                <input class="form-control" type="text" id="address" placeholder="Entrer une adresse" autocomplete="off">
                <div id="autocomplete-results"></div>
                <div id="autocomplete-error"></div>
                <p class="help-block">Vous pouvez déplacer le marqueur sur la carte</p>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Bedrooms</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Bathrooms</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Superficie</label>
                        <div class="input-group">
                            <input class="form-control" type="text">
                            <div class="input-group-addon">m²</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="btn-group">
                        <label>Parking</label>
                        <div class="clearfix"></div>
                        <a href="#" data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                            <span class="dropdown-label">Privatif</span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-select">
                            <li class="active"><input type="radio" name="ptype" checked="checked"><a href="#">Privatif</a></li>
                            <li><input type="radio" name="ptype"><a href="#">Public - Gratuit</a></li>
                            <li><input type="radio" name="ptype"><a href="#">Public - Payant</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>Galerie d'images</label>
                        <input type="file" class="file" multiple data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-o btn-default" data-browse-label="Images">
                        <p class="help-block">Vous pouvez selectionner plusieurs images à la fois</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label>Amenities</label>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Garage</label></div>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Security System</label></div>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Air Conditioning</label></div>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Balcony</label></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Outdoor Pool</label></div>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Internet</label></div>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Heating</label></div>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> TV Cable</label></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Garden</label></div>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Telephone</label></div>
                        <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Fireplace</label></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <a href="#" class="btn btn-green btn-lg">Ajouter le site</a>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div>