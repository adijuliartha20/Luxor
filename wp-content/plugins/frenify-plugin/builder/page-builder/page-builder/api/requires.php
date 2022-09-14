<?php
/*---------------------------------------------------------------------------------------------------------------------------------------------------------
| Set Directory PATHs
-----------------------------------------------------------------------------------------------------------------------------------------------------------*/

define ('fotofly_fn_BUILDER_PHP_CORE' , dirname( __FILE__ ).'/../');

/*---------------------------------------------------------------------------------------------------------------------------------------------------------
| Include all categories, elements, libs and engine.
-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
include fotofly_fn_BUILDER_PHP_CORE.'includes/engine/class-dd-element-template.php'; // no loop for you.
// font awesome iterator class.
include fotofly_fn_BUILDER_PHP_CORE.'classes/class-fa-iterator.php';

$directories = array ( 
				fotofly_fn_BUILDER_PHP_CORE.'includes/categories/', //categories
				fotofly_fn_BUILDER_PHP_CORE.'includes/elements/builder-elements/', // builder elements
				fotofly_fn_BUILDER_PHP_CORE.'includes/elements/column-options/' // column / grid options
			);
foreach ( $directories as $directory ) {
	
	foreach( glob( $directory . "*.php" ) as $class ) {
		
		include_once $class;
	}
}