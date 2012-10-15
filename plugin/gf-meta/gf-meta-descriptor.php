<?php
/*
Plugin Name: Meta descriptores pagina
Plugin URI: http://
Description: Añade meta descriptores de la pagina en la cabecera. Personalizados para cada pagina.
Version: 0.5
Author: Gabriel Franco
Author URI: http://gfranco.webfactional.com
License: GPL v3
*/

// TODO Let posts have their description

	// Accion cabecera
	add_action('wp_head', 'gf_add_cabecera');

	// Metabox con los datos en las paginas
	add_action('add_meta_boxes', 'gf_add_metabox_descriptor');
	add_action( 'save_post', 'gf_save_metabox_descriptor' );

	function gf_add_cabecera() {
 		global $post;
		$desc = get_post_meta($post->ID, '_gf_meta_description', true);
		
		if ( isset( $desc ) && $desc != '') {?>
			<meta name="description" content="<?php echo $desc;  ?>"/>

		<?php	}
	}

	function gf_add_metabox_descriptor() {
		add_meta_box('meta_descriptor', 'Etiqueta &lt;Meta&gt; de descripci&oacute;n', 'gf_show_metabox_descriptor', 'page', 'normal', 'high');
	}

	function gf_show_metabox_descriptor($post) {
		$valor_description = get_post_meta($post->ID, '_gf_meta_description', true);
?>
	<p>Descripcion de la pagina. Introduzca aqu&iacute; una breve descripci&oacute;n del contenido que ser&aacute; utilizada para describir la p&aacute;gina de cara a los buscadores como Google, Bing...</p> <textarea name="valdesc" rows=5 cols=60 style='width:100%;'><?php echo $valor_description; ?></textarea>
<?php
	}

	function gf_save_metabox_descriptor($post_id) {
		
		$valor_viejo = get_post_meta($post_id, '_gf_meta_description', true);
		$valor_nuevo =	$_POST['valdesc'];
		
		if ($valor_nuevo && get_post_type($post_id) == 'page') {
			update_post_meta($post_id, '_gf_meta_description',$valor_nuevo);
		}
	}
?>
