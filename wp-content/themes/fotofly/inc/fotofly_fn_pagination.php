<?php
function fotofly_fn_pagination($pages = '', $range = 1, $home = 0)
{  
     $showitems = ($range * 1)+1;

	global $fotofly_fn_paged;
    
	if(get_query_var('paged')) {
		 $fotofly_fn_paged = get_query_var('paged');
	} elseif(get_query_var('page')) {
		 $fotofly_fn_paged = get_query_var('page');
	} else {
		 $fotofly_fn_paged = 1;
	}

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }
	 

     if(1 != $pages)
     {
         echo "<div class='fotofly_fn_pagination'><nav class='fotofly_fn_pagination_simple'><ul>";
         if($fotofly_fn_paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' class='extra' title='first'>&larr; </a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $fotofly_fn_paged+$range+1 || $i <= $fotofly_fn_paged-$range-1) || $pages <= $showitems ))
             { 
				if($home == 1){ echo ($fotofly_fn_paged == $i)? "<li><span class='current'>".esc_html($i)."</span></li>":"<li><a href='".esc_url(add_query_arg( 'page', $i))."' class='inactive' >".esc_html($i)."</a></li>";}else{
					echo ($fotofly_fn_paged == $i)? "<li class='active'><span class='current'>".esc_html($i)."</span></li>":"<li><a href='".esc_url( get_pagenum_link($i))."' class='inactive' >".esc_html($i)."</a></li>";	 
				}
             }
         }

         if ($fotofly_fn_paged < $pages && $showitems < $pages) echo "<li><a href='".esc_url( get_pagenum_link($pages))."' class='extra' title='last'>&rarr;</a></li>";
         echo "</ul></nav></div>\n";
     }
}



?>
