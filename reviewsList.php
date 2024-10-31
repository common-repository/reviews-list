<?php 
/** 
* Plugin Name: Reviews List
* Plugin URI: https://www.commentchoisir.fr/ 
* Description: List the top reviewed products for a given category / (FR: Liste des produits les plus testés sur une catégorie donnée)
* Version: 1.0
* Author: CommentChoisir.fr 
* Author URI: https://www.CommentChoisir.fr/ 
**/

class reviewsList extends WP_Widget {
 
    function reviewsList()
    {
        // Constructeur
		parent::WP_Widget(false, $name = 'reviewsList', array("description" => "List of the top reviewed products"));
    }
 
    function widget($args, $instance)
    {
        // Contenu du widget à afficher
		extract( $args );
 
		// Récupération de chaque paramètre
		$langue = $instance['langue'];
		$category = $instance['category'];
		$decoupe_cat = explode("_",$category);
		$plusLang = '';
		if($langue == "en"){
			$plusLang = "en/";
			$category = $decoupe_cat[0];
		}else{
			$category = $decoupe_cat[1];
		}
		echo '<iframe src="https://www.commentchoisir.fr/'.$plusLang.'embed_'.$category.'/" frameborder="0" scrolling="no" style="min-height:460px;max-width:320px;width:100%;height:100%;overflow:hidden;"></iframe>';
    }
 
    function update($new_instance, $old_instance)
    {
        // Modification des paramètres du widget
		$instance = $old_instance;
 
		/* Récupération des paramètres envoyés */
		$instance['langue'] = $new_instance['langue'];
		$instance['category'] = $new_instance['category'];
	 
		return $instance;
    }
 
    function form($instance)
    {
        // Affichage des paramètres du widget dans l'admin
		$langue = esc_attr($instance['langue']);
		$category = esc_attr($instance['category']);
		
		?>
			<p>List the reviews of popular products / Lister les tests des produits populaires</p>
			<p>
				<label for="<?php echo $this->get_field_id('langue'); ?>">
					<?php _e('Language :'); ?>
					<select class="widefat" id="<?php echo $this->get_field_id('langue'); ?>" name="<?php echo $this->get_field_name('langue'); ?>">
						<option>Choose a language / Choisissez une langue:</option>
						<option value="en">English</option>
						<option value="fr">Français</option>
					</select>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>">
					<?php _e('Category :'); ?>
					<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
						<option>Choose a category / Choisissez une catégorie :</option>
						<option value="video-games_jeux">Video-Games / Jeux</option>
						<option value="laptops_ordinateurs-portables">Laptops / ordinateurs-portables</option>
						<option value="smartphones_telephones-portables">Smartphones / Téléphones-Portables</option>
						<option value="cameras_appareils-photo">Cameras / Appareils Photo</option>
						<option value="headphones_casques">Headphones / Casques Audio</option>
						<option value="video-projectors_videoprojecteur">Video-Projectors / Videoprojecteur</option>
					</select>
				</label>
			</p>
		<?php
    }
 
}
add_action('widgets_init', create_function('', 'return register_widget("reviewsList");'));
?>