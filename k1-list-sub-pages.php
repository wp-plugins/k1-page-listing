<?php
/*
  Plugin Name: Klan1 WP List Subpages
  Plugin URI: http://www.klan1.com
  Description: This one will help you to list all the subpages in a list with links, this one is intented to help WP to be used as CMS
  Version: 0.3
  Author: Alejandro Trujillo J. - J0hnD03
  Author URI: http://www.facebook.com/j0hnd03
 */

/*
  Klan1 WP List Subpages (Wordpress Plugin)
  Copyright (C) 2011 Alejandro Trujillo J.
  Contact me at http://www.klan1.com

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

// Requisites 
if (!defined("K1_FUNCTIONS") && (K1_FUNCTIONS_VER >= 0.2)) {
    return new WP_Error('Klan1 WP List Subpages', __("The plugin 'Klan1 Common WP Functions' ver > 0.3.3 is needed, please install it first."));
}

define("K1LSP_URL", plugin_dir_url(__FILE__));
define("K1LSP_DIR", plugin_dir_path(__FILE__));

$k1lsp_css_url = K1LSP_URL . '/style.css';
$k1lsp_css_file = K1LSP_DIR . '/style.css';

$k1lsp_custom_css_url = get_template_directory_uri() . '/css/k1-list-pages.css';
$k1lsp_custom_css_file = get_template_directory() . '/css/k1-list-pages.css';

if (file_exists($k1lsp_custom_css_file)) {
    wp_register_style('k1_list_page_custom', $k1lsp_custom_css_url);
    wp_enqueue_style('k1_list_page_custom');
} elseif (file_exists($k1lsp_css_file)) {
    wp_register_style('k1_list_page', $k1lsp_css_url);
    wp_enqueue_style('k1_list_page');
}else{
    return new WP_Error('Klan1 WP List Subpages', __("There is not CSS style to load."));
}

function k1_list_pages_func($attribs) {
    //get the actual post from global post var
    global $post;
    ob_start();
    $attribs = shortcode_atts(array(
        'postid' => null,
        'exclude' => null,
        'class' => null,
        'mode' => "table",
        'orderby' => "title",
        'order' => "ASC",
        'title' => null,
        'depth' => 1,
        'thumbs' => 1,
        'thumbw' => 80,
        'thumbh' => 50,
        'thumbzc' => 1,
        'thumba' => "c",
            ), $attribs);

    //general
    $post_id = $attribs['postid'];

    $mode = $attribs['mode'];
    $list_order_by = $attribs['orderby'];
    $list_order = $attribs['order'];
    $exclude = $attribs['exclude'];
    $class = $attribs['class'];

    //list mode
    $list_title = $attribs['title'];

    // Thumb specific 
    $list_depth = $attribs['depth'];
    $thumbs = $attribs['thumbs'];
    $thumbw = $attribs['thumbw'];
    $thumbh = $attribs['thumbh'];
    $thumbzc = $attribs['thumbzc'];
    $thumba = $attribs['thumba'];

//    if ($list_title != 0) {
    $list_tile = (!empty($list_title)) ? $list_title : $post->post_title;
//    }

    echo "\n<!-- Begin Klan1 WP List Subpages -->\n<div id='k1-list-pages' style='clear:both'>\n";

    // set the POST ID on the different situations
    if (empty($post_id)) {
        global $post;
        if (!empty($post->ID)) {
            $post_id = $post->ID;
        } else {
            return new WP_Error('no $post_id', __("\$post_id is unknow on " . __FUNCTION__ . "()"));
        }
    }
//    } elseif ($post_id != $post->ID) {
//        
//    }
//    $post = get_post($post_id);
//    if (is_null($post_id)) {
//        $post_id = $post->ID;
//    } elseif ($post_id != $post->ID) {
//        $post = get_post($post_id);
//    }

    if ($class == null) {
        $class = "{$post_id}-list";
    } else {
        $class = "{$post_id}-list {$class}-list";
    }

    $args_table = array(
        'post_type' => 'page',
        'post_parent' => $post_id,
        'numberposts' => -1,
        'orderby' => $list_order_by,
        'order' => $list_order,
        'exclude' => $exclude,
    );
    $args_ul = "child_of={$post_id}" .
            "&post_type=page" .
            "&exclude={$exclude}" .
            "&sort_column={$list_order_by}" .
            "&sort_order={$list_order}" .
            "&depth={$list_depth}" .
            "&title_li='{$list_tile}'"
    ;

    $i = 0;
    $pages = get_posts($args_table);
    ?>
    <?php if ($pages) : ?>
        <?php if ($mode == "table") : ?>
            <?php if ($list_title != 0) : ?>
                <h2><?php echo $list_title ?></h2>
            <?php endif ?>
            <?php foreach ($pages as $page) : $i++; ?>
                <table class="<?php echo $class ?>">
                    <tbody>
                        <tr class="<?php echo ($i % 2) ? 'odd' : 'even' ?>">
                            <?php if ($thumbs) : ?>
                                <?php
                                $thumb = k1_get_post_timthumb_img_url($page->ID, $thumbw, $thumbh, $thumbzc, $thumba);
                                if (empty($thumb)) {
                                    $thumb = K1LSP_URL . "/no-pic.png";
                                }
                                ?>
                                <td class="thumb">
                                    <a href="<?php echo get_permalink($page->ID); ?>">
                                        <img
                                            src="<?php echo $thumb; ?>"
                                            alt="<?php the_title(); ?>"
                                            height="<?php echo $thumbh; ?>"
                                            width="<?php echo $thumbw; ?>"
                                            />
                                    </a>
                                </td>
                            <?php endif ?>
                            <td class="link"><a href="<?php echo $_SERVER['REQUEST_URI'] . "" . $page->post_name; ?>"><?php echo $page->post_title; ?></a></td>
                        </tr>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php else: ?>
            <ul class="<?php echo $class ?>">
                <?php
                wp_list_pages($args_ul);
                ?>
            </ul>
        <?php endif; ?>
        <div style="clear:both"></div>
    <?php else : ?>
        <div><i><?php echo __("The page ID called has no sub pages.") ?></i></div>
    <?php endif; ?>
    <?php
    echo "\n</div>\n<!-- END HELPER -->";

    $buffer = ob_get_contents();
    ob_clean();
    return $buffer;
}

add_shortcode('k1-list-pages', 'k1_list_pages_func');
?>