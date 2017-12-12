<?php

    /* Template Name: Right Sidebar */

    get_header();

?>

    <div id="template-container">
<!-- 
        <div class="sidebar">
            <?php dynamic_sidebar("right_sidebar"); ?>
        </div> -->

        <div class="content">
            <?php while(have_posts()){
                    the_post();
                    the_title("<h1>", "</h1>");
                    the_content();
                    }
            ?>
        </div>

        <div class="sidebar">
            <?php dynamic_sidebar("right_sidebar"); ?>
        </div>

    </div>


<?php

get_footer();