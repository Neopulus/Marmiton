<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
        $dir = ROOT . "content/img/slider";
        // Get the number of files in the directory
        $nb_pic = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);

        $i = 0;
        while ($i < iterator_count($nb_pic)) : ?>
            <li data-target="#myCarousel" data-slide-to="<?= $i; ?>" class="<?php if($i == 0) { echo "active"; } $i = $i + 1;?>"></li>
        <?php endwhile; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="row carousel-search">
        <form  method="post" action="?p=recipe.search"  id="searchform">
            <input class="search-box" type="text" name="keyword" placeholder="Trouver une recette" autocomplete="off">
        </form>
    </div>
    <div class="carousel-inner" role="listbox">
        <?php $i = 1; while ($i <= iterator_count($nb_pic)) : ?>
            <div class="item <?php if ($i == 1) { echo "active"; } ?>">
                <img src="./content/img/slider/<?= $i; ?>.jpg" alt="slider<?= $i; $i = $i + 1;?>" />
            </div>
        <?php endwhile; ?>
    </div>
</div>
<div class="container home">
    <section id="content">
        <div class="tabs col-lg-12">
            <div class="tabs-nav col-lg-12">
                <ul class="list-group">
                    <li class="list-group-item active"><a href="#tab_1">Dernières recettes</a></li>
                    <li class="list-group-item"><a href="#tab_2">Recettes populaires</a></li>
                </ul>
            </div>
            <div class="col-lg-12 tabs-body text-center">
                <?php for($i = 1; $i <= 2; $i = $i + 1) : ?>
                    <div id="tab_<?= $i; ?>" class="col-lg-12 tab-content" style="display: block;">
                        <?php if($i == 1) : $j = 1; foreach(json_decode($recipes) as $recipe) : ?>
                            <?php if($j <= 6 && $i != 2) : ?>
                                <div class="col-lg-3 col-md-3 col-sm-5 recipe">
                                    <div class="recipe-img" style="background-image: url(<?= $recipe->image_url; ?>);">
                                        <div class="recipe-description" style="display: block">
                                            <div class="col-md-12 note">
                                                <?php
                                                    if (($recipe->note) != NULL)
                                                    {
                                                        echo substr($recipe->note, 0, 100) . '...';
                                                    }
                                                    else
                                                    {
                                                        echo "Cette recette n'as pas de remarque.";
                                                    }
                                                ?>
                                            </div>
                                            <a class="btn btn-sm btn-warning" href="./?p=recipe.show&id=<?= $recipe->id_recipe; ?>">Voir plus</a>
                                        </div>
                                        <h5><?= $recipe->title . '<br/>'; ?></h5>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php $j = $j + 1; endforeach; ?>
                        <a class="btn btn-lg btn-warning" href="?p=recipe.latest">Voir plus</a>
                        <?php endif; ?>
                            <?php if($i == 2) : $j = 1; foreach(json_decode($recipesRating) as $row) : ?>
                                <?php if($row->rating > 3 && $j <= 6 && $i == 2) : ?>
                                    <div class="col-lg-3 col-md-3 col-sm-5 recipe">
                                        <div class="recipe-img" style="background-image: url(<?= $row->image_url; ?>);">
                                            <div class="recipe-description" style="display: block">
                                                <div class="col-md-12 note">
                                                    <?php
                                                    if (($row->note) != NULL)
                                                    {
                                                        echo substr($row->note, 0, 100) . '...';
                                                    }
                                                    else
                                                    {
                                                        echo "Cette recette n'as pas de remarque.";
                                                    }
                                                    ?>
                                                </div>
                                                <a class="btn btn-sm btn-warning" href="./?p=recipe.show&id=<?= $row->id_recipe; ?>">Voir plus</a>
                                            </div>
                                            <h5><?= $row->title . '<br/>'; ?></h5>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php $j = $j + 1; endforeach; ?>
                            <a class="btn btn-lg btn-warning" href="?p=recipe.popular">Voir plus</a>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>
</div>