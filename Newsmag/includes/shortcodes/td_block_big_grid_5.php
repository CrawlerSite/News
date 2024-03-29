<?php

/**
 *
 * Class td_block_big_grid_5
 */
class td_block_big_grid_5 extends td_block {

    const POST_LIMIT = 5;

    function render($atts, $content = null){

        // for big grids, extract the td_grid_style
        extract(shortcode_atts(
            array(
                'td_grid_style' => 'td-grid-style-1'
            ), $atts));


        $atts['limit'] = self::POST_LIMIT;

        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)


        $buffy = '';

        $buffy .= '<div class="' . $this->get_block_classes(array($td_grid_style, 'td-hover-1 td-big-grids')) . '" ' . $this->get_block_html_atts() . '>';

		    //get the block css
		    $buffy .= $this->get_block_css();

	        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
	        $buffy .= $this->inner($this->td_query->posts); //inner content of the block
	        $buffy .= '<div class="clearfix"></div>';
	        $buffy .= '</div>';
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts) {

        $buffy = '';

        $td_block_layout = new td_block_layout();

        if (!empty($posts)) {

            $buffy .= '<div class="td-big-grid-wrapper">';

            $post_count = 0;

            foreach ($posts as $post) {

                if ($post_count < 4) {
                    $td_module_mx10 = new td_module_mx10($post);
                    $buffy .= $td_module_mx10->render($post_count);

                    $post_count++;
                    continue;
                }

                $td_module_mx8 = new td_module_mx8($post);
                $buffy .= $td_module_mx8->render($post_count);

                $post_count++;
            }

            if ($post_count < self::POST_LIMIT) {

                for ($i = $post_count; $i < self::POST_LIMIT; $i++) {

                    $td_module_mx_empty = new td_module_mx_empty();
                    $buffy .= $td_module_mx_empty->render($i, $post_count);
                }
            }

            $buffy .= '</div>';
        }

        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }
}