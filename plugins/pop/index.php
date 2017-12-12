<?php
/*
    Plugin Name: Plugin Pop
    Description: Un plugin permettant d'afficher des Pops-up
    Version: 0.0.1
    Author: Jeremy Alsina
    license: free
*/

// Actions hooks


add_action("admin_menu", "generate_pop_menu");
add_action("admin_init", "add_option_pop");

function add_option_pop(){
	add_option("custom_pop", []);
}

function generate_pop_menu(){
	add_menu_page(
		"Pop-Up",
		"Pop-Up",
		"administrator",
		"jeremy_pop_menu",
        "generate_pop",
        "dashicons-format-quote",
		50
	);
} 
$pop = [
    "page" => 0,
    "categorie" => 0,
    "article" => 0
];
function generate_pop(){

    

    if(isset($_POST["pop-page"])){
        $pop["page"] = 1;
    }

    if(isset($_POST["pop-cat"])){
        $pop["categorie"] = 1;
    }

    if(isset($_POST["pop-art"])){
        $pop["article"] = 1;
    }

    update_option("custom_pop", $pop);
    
	if(get_option("custom_pop")){
        var_dump($pop);
        $pop = get_option("custom_pop");
	}
	?>
	
	<h1> Ajout des Pop-Up</h1><br><br>

	<form method="post">
		<label>
			<span> Choix des Pop-Up à afficher :</span><br><br>


            <label>
                <input type="checkbox" name="pop-page">
                <span>Afficher pop-up dans Pages</span>
            </label><br><br>

            <label>
                <input type="checkbox" name="pop-cat">
                <span>Afficher pop-up dans Catégories</span>
            </label><br><br>

            <label>
                <input type="checkbox" name="pop-art">
                <span>Afficher pop-up dans Articles</span>
            </label><br><br>
				
		</label>
		<input type="submit" value="Valider"><br><br>
    </form>

    <h2>Choix Pop-up :</h2>
    <p>Ajouter ce shortcode : [pop1] pour afficher : "POP-UP DE SHORTCODE" </p>
    <p>Ajouter ce shortcode : [pop2] pour afficher : "BIENVENUE !" </p>
    <p>Ajouter ce shortcode : [pop3] pour afficher : "JOYEUX NOEL !" </p>
    <p>Ajouter ce shortcode : [pop4] pour afficher : "BONNE ANNEE !" </p>
    
	<?php	
}


add_shortcode("pop1", "display_pop1");

function display_pop1($atts){
    echo "<script>alert(\"POP-UP DE SHORTCODE\")</script>";
}

add_shortcode("pop2", "display_pop2");

function display_pop2($atts){
    echo "<script>alert(\"BIENVENUE !\")</script>";
}


add_shortcode("pop3", "display_pop3");

function display_pop3($atts){
    echo "<script>alert(\"JOYEUX NOEL !\")</script>";
}


add_shortcode("pop4", "display_pop4");

function display_pop4($atts){
    echo "<script>alert(\"BONNE ANNEE !\")</script>";
}








