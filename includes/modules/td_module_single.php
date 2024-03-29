<?php

/**
 * Class td_module_single
 */

class td_module_single extends td_module_single_base {
    function get_social_sharing_top() {
        if (!$this->is_single) {
            return;
        }

        if (td_util::get_option('tds_top_social_show') == 'hide' and td_util::get_option('tds_top_like_tweet_show') != 'show') {
            return;
        }

        // used to style the sharing icon to be big on tablet
        $td_no_like = '';
        if (td_util::get_option('tds_top_like_tweet_show') == 'show') {
            $td_no_like = 'td-with-like';
        }

        $buffy = '';

        // @todo single-post-thumbnail appears to not be in used! please check
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $this->post->ID ), 'single-post-thumbnail' );

        $twitter_user = td_util::get_option('tds_tweeter_username');


        $buffy .= '<div class="td-post-sharing td-post-sharing-top td-pb-padding-side"><span class="td-post-share-title">' . __td('SHARE', TD_THEME_NAME) . '</span>';

        if (td_util::get_option('tds_top_social_show') != 'hide') {
            $buffy .= '
				<div class="td-default-sharing ' . $td_no_like . '">
		            <a class="td-social-sharing-buttons td-social-facebook" href="http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( get_permalink() ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-facebook"></div><div class="td-social-but-text">Facebook</div></a>
		            <a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($this->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( get_permalink() ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . '"  ><div class="td-sp td-sp-twitter"></div><div class="td-social-but-text">Twitter</div></a>
		            <a class="td-social-sharing-buttons td-social-google" href="http://plus.google.com/share?url=' . esc_url( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-googleplus"></div></a>
		            <a class="td-social-sharing-buttons td-social-pinterest" href="http://pinterest.com/pin/create/button/?url=' . esc_url( get_permalink() ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-pinterest"></div></a>
	                <a class="td-social-sharing-buttons td-social-whatsapp" href="whatsapp://send?text=' . htmlspecialchars(urlencode(html_entity_decode($this->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '%20-%20' . urlencode( esc_url( get_permalink() ) ) . '" ><div class="td-sp td-sp-whatsapp"></div></a>
	                <div class="clearfix"></div>
	            </div>';
        }


        if (td_util::get_option('tds_top_like_tweet_show') == 'show') {
            //classic share buttons
            $buffy .= '<div class="td-classic-sharing">';
            $buffy .= '<ul>';

            $buffy .= '<li class="td-classic-facebook">';
            $buffy .= '<iframe frameBorder="0" src="' . td_global::$http_or_https . '://www.facebook.com/plugins/like.php?href=' . $this->href . '&amp;layout=button_count&amp;show_faces=false&amp;width=105&amp;action=like&amp;colorscheme=light&amp;height=21" style="border:none; overflow:hidden; width:105px; height:21px; background-color:transparent;"></iframe>';
            $buffy .= '</li>';

            $buffy .= '<li class="td-classic-twitter">';
            $buffy .= '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . esc_attr($this->href) . '" data-text="' . $this->title . '" data-via="' . td_util::get_option('tds_' . 'social_twitter') . '" data-lang="en">tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
            $buffy .= '</li>';

            $buffy .= '</ul>';
            $buffy .= '</div>';
        }

        $buffy .= '</div>';

        return $buffy;
    }


    function get_social_sharing_bottom() {
        if (!$this->is_single) {
            return;
        }

        if (td_util::get_option('tds_bottom_social_show') == 'hide' and td_util::get_option('tds_bottom_like_tweet_show') == 'hide') {
            return;
        }

        // used to style the sharing icon to be big on tablet
        $td_no_like = '';
        if (td_util::get_option('tds_bottom_like_tweet_show') != 'hide') {
            $td_no_like = 'td-with-like';
        }

        $buffy = '';
        // @todo single-post-thumbnail appears to not be in used! please check
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $this->post->ID ), 'single-post-thumbnail' );
        $buffy .= '<div class="td-post-sharing td-post-sharing-bottom td-pb-padding-side"><span class="td-post-share-title">' . __td('SHARE', TD_THEME_NAME) . '</span>';


        if (td_util::get_option('tds_bottom_social_show') != 'hide') {
            $twitter_user = td_util::get_option( 'tds_tweeter_username' );

            //default share buttons
            $buffy .= '
            <div class="td-default-sharing ' . $td_no_like . '">
	            <a class="td-social-sharing-buttons td-social-facebook" href="http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( get_permalink() ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-facebook"></div><div class="td-social-but-text">Facebook</div></a>
	            <a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($this->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( get_permalink() ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . '"><div class="td-sp td-sp-twitter"></div><div class="td-social-but-text">Twitter</div></a>
	            <a class="td-social-sharing-buttons td-social-google" href="http://plus.google.com/share?url=' . esc_url( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-googleplus"></div></a>
	            <a class="td-social-sharing-buttons td-social-pinterest" href="http://pinterest.com/pin/create/button/?url=' . esc_url( get_permalink() ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-pinterest"></div></a>
                <a class="td-social-sharing-buttons td-social-whatsapp" href="whatsapp://send?text=' . htmlspecialchars(urlencode(html_entity_decode($this->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '%20-%20' . urlencode( esc_url( get_permalink() ) ) . '" ><div class="td-sp td-sp-whatsapp"></div></a>
                <div class="clearfix"></div>
            </div>';
        }


        if (td_util::get_option('tds_bottom_like_tweet_show') != 'hide') {
            //classic share buttons
            $buffy .= '<div class="td-classic-sharing">';
            $buffy .= '<ul>';

            $buffy .= '<li class="td-classic-facebook">';
            $buffy .= '<iframe frameBorder="0" src="' . td_global::$http_or_https . '://www.facebook.com/plugins/like.php?href=' . $this->href . '&amp;layout=button_count&amp;show_faces=false&amp;width=105&amp;action=like&amp;colorscheme=light&amp;height=21" style="border:none; overflow:hidden; width:105px; height:21px; background-color:transparent;"></iframe>';
            $buffy .= '</li>';

            $buffy .= '<li class="td-classic-twitter">';
            $buffy .= '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . esc_attr($this->href) . '" data-text="' . $this->title . '" data-via="' . td_util::get_option('tds_' . 'social_twitter') . '" data-lang="en">tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
            $buffy .= '</li>';

            $buffy .= '</ul>';
            $buffy .= '</div>';
        }





        $buffy .= '</div>';

        return $buffy;
    }

}
