/* 
 * CREATION OF DATABASE
 */
 
DROP DATABASE IF EXISTS db_marmiton;
CREATE DATABASE IF NOT EXISTS db_marmiton;
USE db_marmiton;

/*
 * START OF TABLES CREATION 
 */

--
-- Table structure `difficulties`
--

DROP TABLE IF EXISTS categories ;
CREATE TABLE IF NOT EXISTS categories (
	id_category TINYINT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	PRIMARY KEY (id_category)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table content `categories`
--

INSERT IGNORE INTO categories (id_category, name) VALUES
  (1, 'Entrée'),
  (2, 'Accompagnement'),
  (3, 'Boisson'),
  (4, 'Sauce'),
  (5, 'Plat principal'),
  (6, 'Amuse-gueule'),
  (7, 'Confiserie'),
  (8, 'Dessert');

-- --------------------------------------------------------

--
-- Table structure `difficulties`
--

DROP TABLE IF EXISTS difficulties ;
CREATE TABLE IF NOT EXISTS difficulties (
	id_difficulty TINYINT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	PRIMARY KEY (id_difficulty)
) ENGINE=InnoDB;

--
-- Table content `difficulties`
--

INSERT IGNORE INTO difficulties (id_difficulty, name) VALUES
  (1, 'Trés facile'),
  (2, 'Facile'),
  (3, 'Moyenne'),
  (4, 'Diffcile');

-- --------------------------------------------------------

--
-- Table structure `recipes`
--

DROP TABLE IF EXISTS recipes ;
CREATE TABLE IF NOT EXISTS recipes (
	id_recipe INT(11) NOT NULL AUTO_INCREMENT,
	title VARCHAR(255),
	username VARCHAR(255),
	user_email VARCHAR(255),
	create_date DATETIME,
	category_id TINYINT,
	difficulty_id TINYINT,
	note TEXT,
	image_url TEXT,
	PRIMARY KEY (id_recipe),
	FOREIGN KEY (category_id) REFERENCES categories(id_category),
	FOREIGN KEY (difficulty_id) REFERENCES difficulties(id_difficulty)
) ENGINE=InnoDB;

INSERT IGNORE INTO recipes (id_recipe, title, username, user_email, create_date, category_id, difficulty_id, note, image_url) VALUES
  (1, 'Hachis Camarguais', 'jankov_d', 'jankov_d@etna-alternance.net', '2016-01-13 14:25:10', 5, 1, NULL, './content/img/recipes/hachis_camarguais.jpg'),
  (2, 'Gâteau au banania rapide', 'balssa_v', 'balssa_v@etna-alternance.net', '2016-01-19 10:25:10', 8, 1, NULL, './content/img/recipes/gâteau_au_banania_rapide.jpg'),
  (3, 'Tarte thon et tomate', 'balssa_v', 'balssa_v@etna-alternance.net', '2016-01-20 09:25:10', 1, 1, 'Hyper rapide, pour ceux qui aiment bien cuisiner sans y passer beaucoup de temps. Vous pouvez remplacer la pâte brisée par de la pâte feuilletée.', './content/img/recipes/tarte_thon_et_tomate.jpg'),
  (4, 'Gratin dauphinois', 'balssa_v', 'balssa_v@etna-alternance.net', '2016-01-20 21:25:10', 2, 1, NULL, './content/img/recipes/gratin_dauphinois.jpg'),
  (5, 'Vin chaud aux épices', 'balssa_v', 'balssa_v@etna-alternance.net', '2016-01-20 16:25:10', 3, 1, NULL, './content/img/recipes/vin_chaud_aux_épices.jpg'),
  (6, 'Béchamel rapide et facile', 'jankov_d', 'jankov_d@etna-alternance.net', '2016-01-20 14:25:10', 4, 1, NULL, './content/img/recipes/béchamel_rapide_et_facile.jpg'),
  (7, 'Petits croissants au saumon fumé', 'jankov_d', 'balssa_v@etna-alternance.net', '2016-01-20 18:25:10', 6, 1, NULL, './content/img/recipes/petits_croissants_au_saumon_fumé.jpg'),
  (8, 'Original American Cookies de Mike', 'jankov_d', 'jankov_d@etna-alternance.net', '2016-01-20 13:25:10', 7, 1, NULL, './content/img/recipes/original_american_cookies_de_mike.jpg'),
  (9, 'Les Timbales de Jeanne', 'jankov_d', 'jankov_d@etna-alternance.net', '2016-01-20 10:25:10', 1, 1, NULL, './content/img/recipes/les_timbales_de_jeanne.jpg');
-- --------------------------------------------------------

--
-- Table structure `ingredients`
--

DROP TABLE IF EXISTS ingredients ;
CREATE TABLE IF NOT EXISTS ingredients (
	id_ingredient INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	quantity VARCHAR(255),
	recipe_id INT(11),
	PRIMARY KEY (id_ingredient),
	FOREIGN KEY (recipe_id) REFERENCES recipes(id_recipe)
) ENGINE=InnoDB;

--
-- Table content `ingredients`
--

INSERT IGNORE INTO ingredients (id_ingredient, name, quantity, recipe_id) VALUES
  (1, 'de riz (blanc ou riz rond complet)', '150 g ', 1),
  (2, 'courgettes de taille moyenne', '3', 1),
  (3, 'grosse aubergine', '1', 1),
  (4, 'de chair à saucisse', '300 g', 1),
  (5, 'de sauce tomate/basilic', '200 g', 1),
  (6, 'sel et poivre', NULL, 1),
  (7, 'huile d''olive', NULL, 1),
  (8, 'pommes de terre', '1 kg', 4),
  (9, 'crème liquide', '1 litre', 4),
  (10, 'gousses d''ail', '2', 4),
  (11, 'sel, poivre', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure `steps`
--

DROP TABLE IF EXISTS steps ;
CREATE TABLE IF NOT EXISTS steps (
	id_step INT(11) NOT NULL AUTO_INCREMENT,
	step_nb TINYINT,
	description TEXT,
	recipe_id INT(11),
	PRIMARY KEY (id_step),
	FOREIGN KEY (recipe_id) REFERENCES recipes(id_recipe)
) ENGINE=InnoDB;

INSERT IGNORE INTO steps (id_step, step_nb, description, recipe_id) VALUES
  (1, 1, 'Ceci est la 1er etape', 4),
  (2, 2, 'Ceci est la 2eme etape', 4),
  (3, 3, 'Ceci est la 3eme etape', 4),
  (4, 4, 'Ceci est la 4eme etape', 4);

-- --------------------------------------------------------

--
-- Table structure `comments`
--

DROP TABLE IF EXISTS comments ;
CREATE TABLE IF NOT EXISTS comments (
	id_comment INT(11) NOT NULL AUTO_INCREMENT,
	username VARCHAR(255),
  rating TINYINT,
	description TEXT,
  create_date DATETIME,
	recipe_id INT(11),
	PRIMARY KEY (id_comment),
	FOREIGN KEY (recipe_id) REFERENCES recipes(id_recipe)
) ENGINE=InnoDB;

INSERT IGNORE INTO comments (id_comment, username, rating, description, recipe_id, create_date) VALUES
  (1, 'chupsdu13', 3, 'Beaucoup trop liquide malgré le fait que j''ai remplacé le litre de crème liquide par la moitié de crème épaisse ... déçue mais le goût est bon.', 4, '2016-01-28 14:25:10'),
  (2, 'fabtres', 1, 'Peut-être très bonne recette, à condition de modifier beaucoup de paramètres. Avant de la réaliser je n''ai pas regardé les avis, ne me fiant qu''à la note générale. Résultat un gratin très liquide, gras et écoeurant, des pommes de terre pas cuites... par conséquent je ne comprends pas les appréciations positives de cette recette. Personnellement je ne recommande pas.', 4, '2016-01-10 14:25:10'),
  (3, 'Myloups', 4, 'Très bon au goût, par contre ma texture était trop liquide, j''ai mis 1/2 litre de crème semi-épaisse et 1/2 litre de lait pour 1 kg de pommes de terre, donc je pense qu''il y avait trop de liquide finalement... Je la referai car j''ai bien aimé le goût, mais en changeant un peu mes doses.', 4, '2016-01-06 14:25:10'),
  (4, 'mariekovalevski', 5, 'Très bon', 4, '2015-12-28 14:25:10'),
  (5, 'user3', 5, 'Test5', 1, '2016-01-13 14:25:10'),
  (6, 'user4', 2, 'Test6', 1, '2016-01-13 14:25:10'),
  (7, 'user5', 4, 'Test7', 3, '2016-01-13 14:25:10'),
  (8, 'user6', 4, 'Test8', 3, '2016-01-13 14:25:10'),
  (9, 'user7', 5, 'Test9', 3, '2016-01-13 14:25:10'),
  (10, 'user8', 5, 'Test10', 6, '2016-01-13 14:25:10'),
  (11, 'user9', 4, 'Test11', 6, '2016-01-13 14:25:10'),
  (12, 'user10', 2, 'Test12', 6, '2016-01-13 14:25:10'),
  (13, 'user11', 3, 'Test13', 2, '2016-01-13 14:25:10'),
  (14, 'user12', 5, 'Test14', 2, '2016-01-13 14:25:10'),
  (15, 'user13', 5, 'Test15', 2, '2016-01-13 14:25:10'),
  (16, 'user14', 4, 'Test16', 7, '2016-01-13 14:25:10'),
  (17, 'user15', 2, 'Test17', 7, '2016-01-13 14:25:10'),
  (18, 'user16', 3, 'Test18', 7, '2016-01-13 14:25:10'),
  (19, 'user17', 5, 'Test19', 9, '2016-01-13 14:25:10'),
  (20, 'user18', 5, 'Test20', 9, '2016-01-13 14:25:10'),
  (21, 'user19', 5, 'Test21', 9, '2016-01-13 14:25:10'),
  (22, 'user20', 5, 'Test19', 5, '2016-01-13 14:25:10'),
  (23, 'user21', 5, 'Test20', 5, '2016-01-13 14:25:10'),
  (24, 'user22', 5, 'Test21', 5, '2016-01-13 14:25:10');

-- --------------------------------------------------------