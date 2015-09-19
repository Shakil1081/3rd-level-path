<?php get_header(); 
/**
 * Template Name: ctp Page
 *
 */
?>

<div class="row">
	


<?php
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}


$get_parent_cats = array(
'parent' => '0' //get top level categories only
);

$all_categories = get_categories( $get_parent_cats );//get parent categories

foreach( $all_categories as $single_category ){
//for each category, get the ID
$catID = $single_category->cat_ID;
echo '<div class="col-md-2 col-sm-4 col-xs-6" style="margin: 5px;background-color: #'.random_color().';">';
echo '<div style="margin-top: 100%;"></div>';
echo '<a style="border: 0px !important;background-color: transparent !important;position: absolute;top: 15px;bottom: 0;left: 15px;right: 0;text-align:center;padding-top:calc(50% - 30px);"><button class="btn btn-info" type="button"  data-toggle="modal" data-target="#' . $catID. '">' . $single_category->name . '</button></a>';
//echo '<li><a href=" ' . get_category_link( $catID ) . ' ">' . $single_category->name . '</a>'; //category name & link
$get_children_cats = array(
'child_of' => $catID //get children of this parent using the catID variable from earlier
);

$child_cats = get_categories( $get_children_cats );//get children of parent category
//echo '<ul class="children">';
echo '<div class="modal fade" id="' . $catID . '" role="dialog"><div class="modal-dialog">';
echo '<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">' . $single_category->name . '</h4>
        </div><div class="modal-body">';
foreach( $child_cats as $child_cat ){







//for each child category, get the ID
$childID = $child_cat->cat_ID;

//for each child category, give us the link and name
//echo '<li><a href=" ' . get_category_link( $childID ) . ' ">' . $child_cat->name . '</a>';
//echo '<ul>';
echo '<div class="panel-group" id="accordion">
		<div class="panel panel-default">
                    <div class="panel-heading">
                         <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#' . $childID . '" class="">
                                ' . $child_cat->name . '
                              </a>
                            </h4>

                    </div>
                    <div id="' . $childID . '" class="panel-collapse collapse">';						






						foreach (get_posts('cat='.$childID) as $post) {



						setup_postdata( $post );

						echo '<div class="panel-body">';

						echo '<li><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></li>';
						echo '</div>';





						}
						echo '</div>
                </div>

                



            </div>';
						//echo '</ul>';
						//echo '</li>';









}

//echo '</ul>';
echo '</div><div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>';
echo '</div></div>';
//echo '</li>';




echo '</div>';
}


//echo '</div>';
?>

	</div>

	

</div>




<?php get_footer(); ?>