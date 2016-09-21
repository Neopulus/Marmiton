<div class="container recipes-details" xmlns="http://www.w3.org/1999/html">
    <div class="row recipe-details">
        <div class="col-lg-12">
            <?php $row = json_decode($recipe); ?>
            <h1><?= $row->title; ?></h1>
            <div class="col-lg-12">Créateur: <?= $row->username; ?></div>
            <div class="col-lg-12">Email: <?= $row->user_email; ?></div>
            <div class="col-lg-12">Date: <?= date("d/m/Y", strtotime("$row->create_date")); ?></div>
            <div class="col-lg-12 recipe-rating">
                <?php $j = 1; for($i = 1; $i <= 5; $i = $i +1) : ?>
                    <?php if($i <= $row->rating) : ?>
                        <div class="col-lg-1 on"></div>
                    <?php endif; ?>
                    <?php if($i > $row->rating) : ?>
                        <div class="col-lg-1 off"></div>
                    <?php endif; ?>
                    <?php if($j == 5) : ?>
                        <div class="col-lg-1 nb_rating">(<?= $row->nb_raing; ?>)</div>
                    <?php endif; ?>
                <?php $j = $j + 1; endfor; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="recipe-details-img" style="background-image: url(<?= $row->image_url; ?>)"></div>
        </div>
        <div class="col-lg-7 ingredients">
            <h3>Ingrédients :</h3>
            <?php foreach (json_decode($ingredients) as $ingr) : ?>
                <p>- <?= $ingr->quantity; ?> <?= $ingr->name; ?></p>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="row mode-cuisine">
        <div class="col-lg-12 mode-cuisine-button text-center">
            <a href="#mode-cuisine-content" class="btn btn-warning">Afficher le mode-cuisine</a>
        </div>
        <div id="mode-cuisine-content" class="col-lg-12 text-center mode-cuisine-content" style="display: none;">
            <div class="steps-background">
                <div class="tabs col-lg-12 steps-content">
                    <?php $i = 1; foreach(json_decode($steps) as $step):?>
                        <div id="tab_<?= $i; ?>" class="col-lg-12 tab-content">
                            <div class="row">
                                <div class="col-lg-12 step-description">
                                    <div class="col-lg-2">
                                        <h3>Etape <?= $step->step_nb; ?>:</h3>
                                    </div>
                                    <div class="col-lg-10 step-description-text">
                                        <span><?= $step->description; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $i = $i + 1 ; endforeach; ?>
                    <ul class="carousel-indicators carousel-indicators-numbers">
                        <?php $i = 0; foreach(json_decode($steps) as $step) : ?>
                            <li data-target="#myCarousel" data-slide-to="<?= $i; ?>" class="<?php if($i == 0) { echo "active"; } ?>"><a href="#tab_<?= $i + 1; ?>"><?= $i + 1; ?></a></li>
                        <?php $i = $i + 1; endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row recipe-comments">
        <form class="col-lg-12 form-group" action="?p=recipe.addcom" method="post">
            <input type="hidden" name="id" value="<?= $row->id_recipe; ?>">
            <div class="row col-lg-12">
                <label class="col-lg-12" for="title">Nom :</label>
                <input class="form-control" name="user" type="text"  required>
            </div>
            <div class="row col-lg-12">
                <label class="col-lg-12 control-label" for="title">Votre note :</label>
                <div class="col-md-5">
                    <ul class="notes-echelle">
                        <li>
                            <label for="note01" title="Note&nbsp;: 1 sur 5"></label>
                            <input type="radio" name="rating" id="note01" value="1" />
                        </li>
                        <li>
                            <label for="note02" title="Note&nbsp;: 2 sur 5"></label>
                            <input type="radio" name="rating" id="note02" value="2" />
                        </li>
                        <li>
                            <label for="note03" title="Note&nbsp;: 3 sur 5"></label>
                            <input type="radio" name="rating" id="note03" value="3" />
                        </li>
                        <li>
                            <label for="note04" title="Note&nbsp;: 4 sur 5"></label>
                            <input type="radio" name="rating" id="note04" value="4" />
                        </li>
                        <li>
                            <label for="note05" title="Note&nbsp;: 5 sur 5"></label>
                            <input type="radio" name="rating" id="note05" value="5" />
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row col-lg-12">
                <label class="col-lg-12 control-label">Votre Commentaire :</label>
                <textarea class="comment form-control" name="text" placeholder="Laissez un commentaire sur cette recette ..." rows="5" required></textarea>
            </div>
            <div class="row col-lg-12">
                <button name="submit" type="submit" class="btn btn-warning">+ Ajouter un commentaire</button>
            </div>
        </form>
    </div>
    <?php foreach (json_decode($comments) as $com) : ?>
        <div class="row col-lg-12 comments-list">
            <div class="col-lg-1 comment-note">
                <span><?= $com->rating ?>/5</span>
            </div>
            <div class="col-lg-11 comment-content">
                <h4><?= $com->username ?></h4>
                <p><?= $com->description ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
