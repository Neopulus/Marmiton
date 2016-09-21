<div class="container recipe-list">
    <?php  foreach(json_decode($recipes) as $recipe) : ?>
        <div class="col-lg-12 recipe">
            <div class="col-lg-2">
                <div class="recipe-list-img" style="background-image: url(<?= $recipe->image_url; ?>);"></div>
            </div>
            <div class="col-lg-10 recipe-list-description text-left">
                <div class="col-lg-12 recipe-title">
                    <h4><a href="./?p=recipe.show&id=<?= $recipe->id_recipe; ?>"><?= $recipe->title; ?></a></h4>
                </div>
                <div class="col-lg-12 recipe-rating">
                    <?php $j = 1; for($i = 1; $i <= 5; $i = $i +1) : ?>
                        <?php if($i <= $recipe->rating) : ?>
                            <div class="col-lg-1 on"></div>
                        <?php endif; ?>
                        <?php if($i > $recipe->rating) : ?>
                            <div class="col-lg-1 off"></div>
                        <?php endif; ?>
                        <?php if($j == 5) : ?>
                            <div class="col-lg-1 nb_rating">(<?= $recipe->nb_raing; ?>)</div>
                        <?php endif; ?>
                    <?php $j = $j + 1; endfor; ?>
                </div>
                <div class="col-lg-12 date">
                    <?= date("d/m/Y", strtotime("$recipe->create_date")); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>