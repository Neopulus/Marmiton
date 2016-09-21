<div class="container-fluid">
    <form action="?p=recipe.add" method="post" class="form-horizontal" enctype="multipart/form-data">
        <fieldset>

            <div class="form-group">
                <h3>Saisie de votre recette</h3>
            </div>

            <!-- titre -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="title">Titre :</label>
                <div class="col-md-4">
                    <input id="title" name="title" placeholder="titre de votre recette" class="form-control input-md" required="" type="text">
                </div>
            </div>

            <!-- nom -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="username">Nom :</label>
                <div class="col-md-4">
                    <input id="username" name="username" placeholder="votre nom de chef ou pseudo" class="form-control input-md" required="" type="text">
                </div>
            </div>

            <!-- mail -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="user_email">Mail :</label>
                <div class="col-md-4">
                    <input id="user_email" name="user_email" placeholder="votre email" class="form-control input-md" required="" type="text">
                </div>
            </div>

            <!-- catégorie -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="category_id">Catégorie :</label>
                <div class="col-md-4">
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="0" disabled selected>Choisissez la catégorie</option>
                        <?php foreach(json_decode($categories) as $category) : ?>
                            <option value="<?= $category->id_category; ?>"><?= $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- difficulté -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="difficulty_id">Difficulté :</label>
                <div class="col-md-4">
                    <select id="difficulty_id" name="difficulty_id" class="form-control">
                        <option value="0" disabled selected>Choisissez la difficulté</option>
                        <?php foreach(json_decode($difficulties) as $difficulty) : ?>
                            <option value="<?= $difficulty->id_difficulty; ?>"><?= $difficulty->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- image presentation -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="image">Image de présentation :</label>
                <div class="col-md-4">
                    <input id="recipe_image" name="image" class="input-file" type="file">
                </div>
            </div>

            <!-- ingredient -->
            <div id="form_ing0" class="form-group">
                <label class="col-md-4 control-label">Ingrédients (quantité et intitulé) :</label>
                <div class="col-md-1">
                    <input name="quan[0]" placeholder="Quantité" class="form-control input-md" type="text">
                </div>
                <div style="padding: 0.5rem; float: left">
                    <p>(de)</p>
                </div>
                <div class="col-md-2">
                    <input name="ingr[0]" placeholder="Ingrédient" class="form-control input-md" type="text" required>
                </div>
                <div id="btn_ing0" style="padding: 0.5rem; float: left">
                    <a onclick="add_ingredient(0)" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-plus" style="padding-bottom: 3px;"></span></a>
                </div>
            </div>

            <!-- step -->
            <div id="form_step0" class="form-group">
                <label class="col-md-4 control-label">Étape 1 :</label>
                <div class="col-md-3 steps">
                    <textarea name="step[0]" placeholder="Entrer l'étape de la recette ..." class="form-control" required></textarea>
                </div>
                <div id="btn_stp0" style="padding: 0.5rem; float: left">
                    <a onclick="add_step(0)" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-plus" style="padding-bottom: 3px;"></span></a>
                </div>
            </div>

            <!-- note -->
            <div class="form-group">
                <label class="col-md-4 control-label">Remarque :</label>
                <div class="col-md-3 steps">
                    <textarea id="note" name="note" placeholder="Ajouter une petite description de la recette ..." class="form-control" required></textarea>
                </div>
            </div>

            <!-- submit -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="btn_sub"></label>
                <div class="col-md-8">
                    <button id="btn_sub" name="btn_sub" class="btn btn-success">Envoyer ma recette</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>