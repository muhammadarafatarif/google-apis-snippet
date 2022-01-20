// for amp url cache clear

https://www-edarabia-com.cdn.ampproject.org/c/s/www.edarabia.com/ar/6-آيات-قرآنية-عن-توحيد-الألوهية/amp/?amp_action=flush

---------------------------------------------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Assign To</th>
            <th>Premium</th>
        </tr>

<?php 

// send listing renewal notice to sales team
$after_month  = date('Ymd', strtotime('+1 month', strtotime(date('Ymd'))));

$search_query = "SELECT p.ID, p.post_title, p.post_type FROM wp_posts p WHERE p.post_type IN ('abroad-study','advertisement','art-gallery','blogs','course','education-supplier','educator','employer','event','fees_links','government-agencies','holiday_pages','job','language-institute','map-pages','news-posts','nursery','online-universities','owl-carousel','page','performing-art','recruite-agency','scholarship','school','school-activity','special_needs','sports-fitness-club','training-tutoring','tutor','university','updates','video') AND (p.post_status = 'publish' OR p.post_status = 'private')";

$search_results = $wpdb->get_results($search_query);

if( !empty($search_results) ){

    foreach ($search_results as $result) {

        $assign_to = get_listing_meta($result->ID, "assign_to", $result->post_type);

        if( $assign_to ) {

            /*if( $assign_to == 'adil-adil@grafdom.com' || $assign_to == 'fazreen-fazreen@edarabia.com' ){

                update_listing_meta($result->ID, "assign_to", "kristine-kristine@edarabia.com", $result->post_type);
            }*/


            /*if( $assign_to == 'kristine@edarabia.com' ){

                update_listing_meta($result->ID, "assign_to", "kristine-kristine@edarabia.com", $result->post_type);
            }*/

            $member = get_listing_meta($result->ID, "membership", $result->post_type); ?>

            <tr>
                <td><a href="<?php echo get_the_permalink($result->ID); ?>"><?php echo $result->post_title; ?></a></td>
                <td><?php echo $result->post_type; ?></td>
                <td><?php echo $assign_to; ?></td>
                <td><?php echo $member; ?></td>
            </tr>
            <?php
        }
    }
}

?>

</table>
</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Name</th>
            <th>URL</th>
            <th>Emails</th>
            <th>Phone</th>
            <th>Website</th>
            <th>Number of reviews</th>
            <th>Address</th>
        </tr>

        <?php global $wpdb;

        $rel_news = $wpdb->get_results("SELECT DISTINCT p.ID, p.post_title, p.comment_count, m.foundation_year, m.minimum_fees, m.maximum_fees, m.fees_currency, m.address, m.membership, m.report_title, m.report_link, m.government_rating, img_meta.meta_value AS post_images FROM wp_posts AS p LEFT JOIN `wp_postmeta_university` AS m ON ( p.ID = m.post_id ) LEFT JOIN wp_postmeta img ON img.post_id = p.ID AND img.meta_key = '_thumbnail_id' LEFT JOIN wp_postmeta img_meta ON img_meta.post_id = img.meta_value AND img_meta.meta_key = '_wp_attachment_metadata' LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = 'university' AND ( t.term_taxonomy_id IN (10974)) AND (p.post_status = 'publish') GROUP BY p.ID ORDER BY ( CASE WHEN (m.membership = 'Plus' OR m.membership = 'Premium') THEN 1 WHEN (m.membership = 'Job') THEN 2 WHEN (m.membership = 'Press') THEN 3 WHEN (m.membership = 'EP') THEN 4 ELSE 5 END ), p.comment_count DESC, p.post_title ASC");

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) { ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><?php echo get_the_permalink($news->ID); ?></td>
                    <td>
                        <?php $emails = array();

                        $email = get_listing_meta($news->ID, 'email', 'university');

                        $email = explode(",", $email);

                        for ($i=0; $i < count($email); $i++) { 

                            array_push($emails, trim($email[$i]));
                        }

                        $job_email = trim(get_listing_meta($news->ID, 'job_email', 'university'));

                        $job_email = explode(",", $job_email);

                        for ($i=0; $i < count($job_email); $i++) { 

                            array_push($emails, trim($job_email[$i]));
                        }

                        $event_email = trim(get_listing_meta($news->ID, 'job_email', 'university'));

                        $event_email = explode(",", $event_email);

                        for ($i=0; $i < count($event_email); $i++) { 

                            array_push($emails, trim($event_email[$i]));
                        }

                        array_push($emails, trim(get_listing_meta($news->ID, 'contact_person_email_1', 'university')));
                        array_push($emails, trim(get_listing_meta($news->ID, 'contact_person_email_2', 'university')));

                        $emails = array_filter($emails);
                        $emails = array_values($emails);

                        echo implode(', ', $emails); ?>
                    </td>
                    <td><?php echo get_listing_meta($news->ID, 'phone', 'university'); ?></td>
                    <td><?php echo get_listing_meta($news->ID, 'website', 'university'); ?></td>
                    <td><?php echo $news->comment_count; ?></td>
                    <td><?php echo get_listing_meta($news->ID, 'address', 'university'); ?></td>
                </tr>
            <?php }
        } ?>

    </table>

</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Publish Date</th>
            <th>Title</th>
            <th>Link</th>
            <th>Listing</th>
            <th>Premium</th>
        </tr>

        <?php $query = new WP_Query(
                                array(
                                    'post_type' => 'blogs',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'tax_query' => array(
                                                          array(
                                                              'taxonomy' => 'blog-category',
                                                              'field'    => 'slug',
                                                              'terms'    =>  array('announcement')
                                                          )
                                                      )
                                )
                            );
        $rel_news = $query->posts;
        
        foreach( $rel_news as $val ){

            $link = get_the_permalink( $val->ID );

            $company_listing = get_listing_meta($val->ID, 'company_listing', 'blogs');

            $company_listing_title = '';
            $company_listing_member = '';

            if( $company_listing ) {

                $company_listing_title = get_the_title($company_listing);
                $company_listing_member = get_listing_meta($company_listing, 'membership', get_post_type($company_listing));
            }

             ?>

            <tr>
                <td><?php echo get_the_date('d/m/Y', $val->ID); ?></td>
                <td><?php echo $val->post_title; ?></td>
                <td><?php echo $link; ?></td>
                <td><?php echo $company_listing_title; ?></td>
                <td><?php echo $company_listing_member; ?></td>
            </tr>

        <?php } ?>

    </table>

</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <thead>
            <tr>
                <th>Name</th>
                <th>URL</th>
                <th>Type</th>
                <th>Word Count</th>
                <th>Category</th>
            </tr>
        </thead>

        <tbody>

            <?php $classified_groups = array('university_categories','school_categories','nursery_categories','language_institute_categories','training_and_tutoring_categories');

            $all_taxs = ['blog-category','university_categories','university_subject','scholarship_categories','school_categories','school_curriculum','special_needs_categories','nursery_categories','activity_category','art_gallery_categories','education_supplier_categories','language_institute_categories','performing_art_categories','recruit_categories','sports_fitness_club_categories','abroad_study_categories','training_and_tutoring_categories','tutor-location','tutor-category','event_categories','event-category','job_category','job_types'];

            for ($i=0; $i < count($all_taxs); $i++) { 

                $terms = get_terms( $all_taxs[$i], array(
                                    'hide_empty' => false,
                                ) );

                foreach ($terms as $key => $value) {

                    if( in_array($all_taxs[$i], $classified_groups) ) {

                        $cntr_term = get_term_by('slug', 'countries', $all_taxs[$i]);

                        $mdl_term = get_term_by('slug', 'middle-east', $all_taxs[$i]);

                        if( $value->parent == $cntr_term->term_id || $value->parent == $mdl_term->term_id ){

                            $type_lable = "Country";

                        }else{

                            $type_lable = "City";
                        }

                    }else{

                        if( $value->parent == 0 ){

                            $type_lable = "Country";

                        }else{

                            $type_lable = "City";
                        }
                    }

                    if($value->description && strpos($value->description, 'comprehensive list') !== false){ ?>

                        <tr>
                            <td><?php echo $value->name; ?></td>
                            <td><?php echo get_term_link($value); ?></td>
                            <td><?php echo str_word_count($value->description); ?></td>
                            <td><?php echo $type_lable; ?></td>
                            <td><?php echo $all_taxs[$i]; ?></td>
                        </tr>

                    <?php }
                }

            } ?>
        </tbody>
    </table>

</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <thead>
            <tr>
                <th>Name</th>
                <th>URL</th>
                <!-- <th>Listing</th> -->
            </tr>
        </thead>

        <?php global $wpdb;

        /*$event_query = "SELECT DISTINCT p.ID, p.post_title, m.company_listing FROM wp_posts AS p 
        LEFT JOIN `wp_postmeta_news-posts` AS m ON ( p.ID = m.post_id ) 
        WHERE p.post_type = 'news-posts' 
        AND (m.tags LIKE '%GEMS%') OR m.company_listing IN (581,128992,21614,134747,21633,128996,113942,113870,134752,134755) 
        AND (p.post_status = 'publish')";*/

        /*$event_query = "SELECT DISTINCT p.ID, p.post_title FROM wp_posts AS p 
        WHERE p.post_type = 'news-posts' 
        AND (p.post_content LIKE '%/gems-%' AND p.post_content LIKE '%href=%') 
        AND (p.post_status = 'publish')";*/

        /*$event_query = "SELECT DISTINCT p.ID, p.post_title, m.company_listing FROM wp_posts AS p 
        LEFT JOIN `wp_postmeta_blogs` AS m ON ( p.ID = m.post_id ) 
        WHERE p.post_type = 'blogs' 
        AND (m.tags LIKE '%GEMS%') OR m.company_listing IN (581,128992,21614,134747,21633,128996,113942,113870,134752,134755)
        AND (p.post_status = 'publish')";*/

        /*$event_query = "SELECT DISTINCT p.ID, p.post_title FROM wp_posts AS p 
        WHERE p.post_type = 'blogs' 
        AND (p.post_content LIKE '%/gems-%' AND p.post_content LIKE '%href=%') 
        AND (p.post_status = 'publish')";*/


        $results =  $wpdb->get_results($event_query, ARRAY_A);

        foreach ($results as $key => $value) { ?>
            
            <tr>
                <td><?php echo $value['post_title']; ?></td>
                <td><?php echo get_the_permalink($value['ID']); ?></td>
                <!-- <td><?php //echo get_the_title($value['company_listing']); ?></td> -->
            </tr>

        <?php } ?>
    </table>
</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Parent</th>
            <th>Child</th>
            <th>Count</th>
            <th>Word Count</th>
            <th>URL</th>            
            <th>Reviews</th>
        </tr>

        <?php $query = new WP_Query(
                                array(
                                    //'post_type' => array('fees_links','holiday_pages','map-pages'),
                                    'post_type' => array('map-pages'),
                                    'posts_per_page' => -1

                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            $count = 1;

            foreach ($rel_news as $news) { ?>

                <tr>
                    
                    <td><?php echo $news->post_title; ?></td>
                    
                    <td></td>

                    <td></td>

                    <td><?php 

                    $total_word_count = count(preg_split('/\s+/',  wp_strip_all_tags($news->post_content)));
                    echo $total_word_count > 1 ? $total_word_count : 0; ?></td>

                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                    
                    <td><?php $comments_count = wp_count_comments($news->ID);
                    echo $comments_count->approved; ?></td>

                </tr>

                <?php

                $count++;
            }
        } ?>

    </table>
</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Name</th>
            <th></th>
            <th>Count</th>
            <th>Word Count</th>
            <th>URL</th>
            <th>Reviews</th>
        </tr>

        <?php

        $school_locs = get_terms( 'school_curriculum', array(
                        'hide_empty' => false,
                    ) );

        $school_cats = get_terms( 'school_categories', array(
                        'hide_empty' => false,
                        'number' => '100',
                        'offset' => $_GET['number']
                    ) );

        foreach ($school_locs as $value) { 

            foreach ($school_cats as $cat) {

                $query = "SELECT DISTINCT p.ID FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) LEFT JOIN wp_term_relationships AS t1 ON (p.ID = t1.object_id) WHERE p.post_type = 'school' AND ( t.term_taxonomy_id IN ($value->term_taxonomy_id) AND t1.term_taxonomy_id IN ($cat->term_taxonomy_id)) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                $query_all_ids = $wpdb->get_results($query);

                if( !empty($query_all_ids) ){ ?>

                <tr>
                    <td><?php echo $value->name.' School in '.$cat->name; ?></td>
                    <td></td>
                    <td>
                        <?php echo count($query_all_ids); ?>
                    </td>
                    <td>
                        <?php $term_meta = get_listing_termmeta($cat->term_id, $cat->taxonomy);

                        $description = stripcslashes($term_meta[$value->slug]);

                        echo str_word_count($description); ?>
                    </td>

                    <td><?php echo get_site_url().'/schools/curr/'.$value->slug.'/in/'.$cat->slug.'/'; ?></td>

                    <td>

                        <?php $comments_count = 0; foreach($query_all_ids as $query_id) {

                            $comments_count += wp_count_comments($query_id->ID)->approved;

                        }

                        echo $comments_count; ?>

                    </td>

                </tr>

                <?php }
            } 
        } ?>

    </table>
</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Date</th>
            <th>Meta Title</th>
            <th>Title</th>
            <th>URL</th>
            <th>Word Count</th>
            <th>Reviews</th>
            <th>Categories</th>
        </tr>

        <?php $query = new WP_Query(
                                array(
                                    'post_type' => 'blogs',
                                    'posts_per_page' => -1

                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            $count = 1;

            foreach ($rel_news as $news) {
 
                $term_list = wp_get_post_terms( $news->ID, 'blog-category', array('fields' => 'names' ));  ?>

                <tr>

                    <td><?php echo get_the_date('d/m/Y', $news->ID); ?></td>

                    <td>
                        <?php
                        
                        $yoast_title = get_post_meta($news->ID, '_yoast_wpseo_title', true);

                        $title = str_replace('%%currentyear%%','2020', $yoast_title);

                        $title = str_replace('%%title%%',$news->post_title, $title);
                        
                        if ( empty($title) ) {

                            if( strpos($news->post_title, 'Prayer Times') !== false ){

                                $title = 'Islamic '.$news->post_title.' - Salah / Azan (Today)';

                            }else if( strpos($news->post_title, '(Template)') !== false ){

                                $title = str_replace('(Template)', 'Template (CV Example '.date("o").')', $news->post_title);

                            }else{

                                $title = $news->post_title;
                            }
                        }

                        echo $title;
                        ?>
                    </td>
                    
                    <td><?php echo $news->post_title; ?></td>
                    
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                    
                    <td><?php echo count(preg_split('/\s+/',  wp_strip_all_tags($news->post_content))); ?></td>

                    <td><?php $comments_count = wp_count_comments($news->ID);
                    echo $comments_count->approved; ?></td>

                    <td><?php echo implode(", ", $term_list); ?></td>

                </tr>

                <?php

                $count++;
            }
        } ?>

    </table>
</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Date</th>
            <th>Meta Title</th>
            <th>Title</th>
            <th>URL</th>
            <th>Word Count</th>
            <th>Reviews</th>
            <th>Parent Category</th>
            <th>Child Category</th>
        </tr>

        <?php $query = new WP_Query(
                                array(
                                    'post_type' => 'blogs',
                                    'posts_per_page' => -1

                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            $count = 1;

            foreach ($rel_news as $news) {
 
                $term_list = wp_get_post_terms( $news->ID, 'blog-category' );  ?>

                <tr>

                    <td><?php echo get_the_date('d/m/Y', $news->ID); ?></td>

                    <td>
                        <?php
                        
                        $yoast_title = get_post_meta($news->ID, '_yoast_wpseo_title', true);

                        $title = str_replace('%%currentyear%%','2020', $yoast_title);
                        
                        if ( empty($title) ) {

                            if( strpos($news->post_title, 'Prayer Times') !== false ){

                                $title = 'Islamic '.$news->post_title.' - Salah / Azan (Today)';

                            }else if( strpos($news->post_title, '(Template)') !== false ){

                                $title = str_replace('(Template)', 'Template (CV Example '.date("o").')', $news->post_title);

                            }else{

                                $title = $news->post_title;
                            }
                        }

                        echo $title;
                        ?>
                    </td>
                    
                    <td><?php echo $news->post_title; ?></td>
                    
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                    
                    <td><?php echo count(preg_split('/\s+/',  wp_strip_all_tags($news->post_content))); ?></td>

                    <td><?php $comments_count = wp_count_comments($news->ID);
                    echo $comments_count->approved; ?></td>

                    <td>
                        <?php foreach ($term_list as $value) {

                            if( $value->parent == 0 ) {

                                echo $value->name.', ';
                            }
                            
                        } ?>
                    </td>
                    <td>
                        <?php foreach ($term_list as $value) {

                            if( $value->parent != 0 ) {

                                echo $value->name.', ';
                            }
                            
                        } ?>
                    </td>

                </tr>

                <?php

                $count++;
            }
        } ?>

    </table>
</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr><th>Emails</th></tr>

        <?php 

        $query = new WP_Query(
                                array(
                                    'post_type' => 'school',
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                                          array(
                                                              'taxonomy' => 'school_categories',
                                                              'field'    => 'slug',
                                                              'terms'    =>  array('abu-dhabi')
                                                          )
                                                      )
                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) {

                $emails = array();

                $email = get_listing_meta($news->ID, 'email', 'school');

                $email = explode(",", $email);

                for ($i=0; $i < count($email); $i++) { 

                    array_push($emails, trim($email[$i]));
                }



                $job_email = trim(get_listing_meta($news->ID, 'job_email', 'school'));

                $job_email = explode(",", $job_email);

                for ($i=0; $i < count($job_email); $i++) { 

                    array_push($emails, trim($job_email[$i]));
                }


                $event_email = trim(get_listing_meta($news->ID, 'job_email', 'school'));

                $event_email = explode(",", $event_email);

                for ($i=0; $i < count($event_email); $i++) { 

                    array_push($emails, trim($event_email[$i]));
                }


                array_push($emails, trim(get_listing_meta($news->ID, 'contact_person_email_1', 'school')));
                array_push($emails, trim(get_listing_meta($news->ID, 'contact_person_email_2', 'school')));

                $emails = array_filter($emails);
                $emails = array_values($emails);

                for ($v=0; $v < count($emails); $v++) { ?>

                    <tr><td><?php echo $emails[$v]; ?></td></tr>

                    <?php 
                }
            }
        } ?>

    </table>

</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Sr.</th>
            <th>Post Title</th>
            <th>New Title</th>
            <th>Post Link</th>
            <!-- <th>Category</th> -->
        </tr>

        <?php $rel_news = $wpdb->get_results("SELECT wp_posts.* FROM wp_posts WHERE wp_posts.post_title LIKE '%(Template)%' AND wp_posts.post_type = 'blogs' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_title DESC");

        $counter = 1;
        
        foreach( $rel_news as $val ){

            $link = get_the_permalink( $val->ID );

            $terms = wp_get_post_terms($val->ID, 'blog-category', array('fields' => 'names'));

            $terms = implode(', ', $terms);

            // echo "<pre>";
            // print_r($terms);
            // echo "</pre>"; ?>

            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $val->post_title; ?></td>
                <td>
                    <?php 

                    if (strpos($val->post_title, '(Template)') !== false) {
                        
                        echo $new_title = str_replace('(Template)', 'Template (CV Example)', $val->post_title);

                    } ?>
                </td>
                <td><?php echo $link; ?></td>
                <!-- <td><?php //echo $terms;  ?></td> -->
            </tr>

        <?php $counter++; } ?>

    </table>

</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Title</th>
            <th>URL</th>
            <th>Min. Fees</th>
            <th>Max. Fees</th>
        </tr>

        <?php 

        $main_term = get_term_by('slug', 'dubai', 'school_categories');

        $rel_news = $wpdb->get_results("SELECT p.ID, p.post_title, m.fs1, m.kg1_fs2, m.kg2_y1, m.g1_y2, m.g2_y3, m.g3_y4, m.g4_y5, m.g5_y6, m.g6_y7, m.g7_y8, m.g8_y9, m.g9_y10, m.g10_y11, m.g11_y12, m.g12_y13,  m.minimum_fees,  m.maximum_fees, m.fees_currency FROM wp_posts AS p LEFT JOIN `wp_postmeta_school` AS m ON ( p.ID = m.post_id ) LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE ( t.term_taxonomy_id IN ($main_term->term_taxonomy_id) ) AND p.post_type = 'school' AND (p.post_status = 'publish' OR p.post_status = 'private') GROUP BY p.ID ORDER BY p.post_title ASC", ARRAY_A);


        foreach($rel_news as $news) {

            $fs1 = $news['fs1'];
            $kg1_fs2 = $news['kg1_fs2'];
            $kg2_y1 = $news['kg2_y1'];
            $g1_y2 = $news['g1_y2'];
            $g2_y3 = $news["g2_y3"];
            $g3_y4 = $news["g3_y4"];
            $g4_y5 = $news["g4_y5"];
            $g5_y6 = $news["g5_y6"];
            $g6_y7 = $news["g6_y7"];
            $g7_y8 = $news["g7_y8"];
            $g8_y9 = $news["g8_y9"];
            $g9_y10 = $news["g9_y10"];
            $g10_y11 = $news["g10_y11"];
            $g11_y12 = $news["g11_y12"];
            $g12_y13 = $news["g12_y13"];

            if( $fs1 || $kg1_fs2 || $kg2_y1 ||$g1_y2 || $g2_y3 || $g3_y4 || $g4_y5 || $g4_y5 || $g5_y6 || $g6_y7 || $g7_y8 || $g8_y9 || $g9_y10 || $g10_y11 || $g11_y12 || $g12_y13 ){}else{

                $post_link = get_the_permalink( $news['ID'] ); ?>

                <tr>

                    <td><?php echo $news['post_title']; ?></td>

                    <td><a href="<?php echo $post_link; ?>" title="<?php echo $news['post_title']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $post_link; ?></a></td>

                    <td><?php echo $news['minimum_fees']; ?></td>

                    <td><?php echo $news['maximum_fees']; ?></td>
                    
                </tr>

                <?php 

            }

        } ?>

    </table>
</div>

-----------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Title</th>
            <th>Tags</th>
        </tr>

        <?php $query = new WP_Query(
                                array(
                                    'post_type' => 'news-posts',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title'
                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) {

                $tag_label = get_listing_meta($news->ID, 'tags', 'news-posts');

                if( $tag_label ){ ?>

                <tr>                    
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo $news->post_title; ?></a></td>

                    <td><?php echo $tag_label; ?></td>
                </tr>

                <?php }
            }
        } ?>

    </table>
</div>

-----------------------------------------------------------------------------------------

<table>

<?php global $wpdb;

$search_results = $wpdb->get_results("SELECT DISTINCT wp_posts.ID, wp_posts.post_title, m.company_listing FROM wp_posts LEFT JOIN wp_postmeta_job m ON ( wp_posts.ID = m.post_id ) WHERE m.company_listing != '' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID");

foreach ($search_results as $key => $result) {

    $member = get_listing_meta($result->company_listing, 'member', get_post_type($result->company_listing));

    if( $member == 'Yes' ) {

        /*echo "<pre>";
        echo $key;
        print_r($result);
        //print_r(array_values($search_results));
        echo "</pre>";*/
        ?>

        <tr>
            
            <td><?php echo $result->ID; ?></td>
            <td><?php echo $result->post_title; ?></td>
            <td><?php echo $result->company_listing; ?></td>
        </tr>

        <?php 

    }
}

?>

</table>

-----------------------------------------------------------------------------------------

<?php

// global $wp_taxonomies;

// echo "<pre>";
// print_r(array_keys($wp_taxonomies));
// echo "</pre>";

$all_taxs = ['blog-category','university_categories','scholarship_categories','school_categories','school_curriculum','special_needs_categories','nursery_categories','activity_category','art_gallery_categories','education_supplier_categories','language_institute_categories','performing_art_categories','recruit_categories','sports_fitness_club_categories','abroad_study_categories','training_and_tutoring_categories','tutor-location','tutor-category','event_categories','event-category','job_category','type'];

$meta = get_option( 'wpseo_taxonomy_meta' );

for ($i=0; $i < count($all_taxs); $i++) { 
    
    $taxonomy = $all_taxs[$i];

    $all_terms = get_terms($taxonomy);

    foreach ($all_terms as $term) {
        
        $title = '';

        $title  = $meta[$taxonomy][$term->term_id]['wpseo_title'];

        if( !empty($title) ) {

            echo $taxonomy.' | '.$term->name.' --------- '.$title;
            echo "<br><br>";
        }

    }

}

?>

-----------------------------------------------------------------------------------------

<?php global $wpdb;

$rel_news = 'SELECT wp_posts.ID, wp_posts.post_title, wp_posts.post_type, wp_postmeta_blogs.author_log FROM `wp_posts` 
LEFT JOIN `wp_postmeta_blogs` ON (wp_posts.ID = wp_postmeta_blogs.post_id ) 
WHERE `post_title` LIKE "%2019%" AND post_type = "blogs" 
ORDER BY `wp_posts`.`post_modified` DESC';

$rel_news = $wpdb->get_results($rel_news);

// echo "<pre>";
// print_r($rel_news);
// echo "</pre>"; ?>

<table border="1">
    <?php foreach ($rel_news as $key => $value) {

    $log = '';

    $log = unserialize($value->author_log);
    $log = end($log);

    // echo "<pre>";
    // print_r($log);
    // echo "</pre>"; ?>

        <tr>
            <td><?php echo $value->ID; ?></td>
            <td><?php echo $value->post_title; ?></td>
            <td><?php echo $log['User email']; ?></td>
            <td><?php echo explode(' ', $log['Updated Date'])[0]; ?></td>
        </tr>

    <?php } ?>
</table>

-----------------------------------------------------------------------------------------

UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, '%%currentyear%%', '2020') WHERE `meta_key` = '_yoast_wpseo_title' AND meta_value LIKE "%currentyear%"

UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, '2020', '%%currentyear%%') WHERE `meta_key` = '_yoast_wpseo_title'

-----------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Post Title</th>
            <th>Post Link</th>
            <th>Title Check</th>
            <th>Content Check</th>
            <th>URL Check</th>
        </tr>

        <?php $query = new WP_Query(
                                array(
                                    'post_type' => 'blogs',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'tax_query' => array(
                                                          array(
                                                              'taxonomy' => 'blog-category',
                                                              'field'    => 'slug',
                                                              'terms'    =>  array('prayer-times')
                                                          )
                                                      )
                                )
                            );
        $rel_news = $query->posts;
        
        foreach( $rel_news as $val ){

            $link = get_the_permalink( $val->ID ); ?>

            <tr>
                <td><?php echo $val->post_title.' ('.date("o").')'; ?></td>
                <td><?php echo $link; ?></td>
                <td>Yes</td>
                <td>Yes</td>
                <td>No</td>
            </tr>

        <?php } ?>

    </table>

</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Sr #</th>
            <th>Post Title</th>
            <th>Post Link</th>
            <th>Title Check</th>
            <th>Content Check</th>
            <th>URL Check</th>
        </tr>

        <?php $res = $wpdb->get_results("SELECT DISTINCT p.ID, p.post_title, p.post_content FROM wp_posts p LEFT JOIN wp_postmeta m ON (m.post_id = p.ID) WHERE p.post_type = 'blogs' AND p.post_status = 'publish' AND (p.post_content LIKE '%2019%' OR p.post_title LIKE '%2019%' OR (m.meta_key = 'custom_permalink' AND m.meta_value LIKE '%2019%'))", ARRAY_A);

        $count = 0;
        
        foreach( $res as $val ){

            $count++;

            $link = get_the_permalink( $val['ID'] ); ?>

            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $val['post_title']; ?></td>
                <td><?php echo $link; ?></td>
                <td><?php echo strpos($val['post_title'], '2019') ? 'Yes' : 'No'; ?></td>
                <td><?php echo strpos($val['post_content'], '2019') ? 'Yes' : 'No'; ?></td>
                <td><?php echo strpos($link, '2019') ? 'Yes' : 'No'; ?></td>
            </tr>

        <?php } ?>

    </table>

</div>

--------------------------------------------------------------------------------------------------

<?php $rel_news = $wpdb->get_results("SELECT p.ID, p.post_title, p.post_content, m.type, pm.meta_value AS custom_permalink FROM wp_posts AS p LEFT JOIN wp_postmeta_holiday_pages AS m ON (p.ID = m.post_id) LEFT JOIN wp_postmeta AS pm ON (p.ID = pm.post_id AND pm.meta_key = 'custom_permalink' ) WHERE p.post_type = 'holiday_pages' AND (m.previous_year = 0) AND (p.post_status = 'publish' OR p.post_status = 'private') GROUP BY p.ID ORDER BY p.post_date DESC, p.post_title ASC");

if( !empty( $rel_news ) ){

    $previous_year = 2019;

    foreach ( $rel_news as $news ) {

        // echo "<pre>";
        // print_r($news);
        // echo "</pre>";

        preg_match_all('/<table.*?>(.*?)<\/table>/si', $news->post_content, $matches);

        //preg_match('/<table [^>]*>(.*?)<\/table>/is', $news->post_content, $matches);

        echo "<pre>";
        echo $news->ID.'---------------'.count($matches);

        //print_r($matches);

        echo "</pre>";

        //$table_markup = '<div class="table-responsive">'.$matches[0].'</div>';
        /*$post_name = sanitize_title($news->post_title);

        //add pending post
        $data = array(
                'post_author' => 18,
                'post_content' => $table_markup,
                'post_content_filtered' => '',
                'post_title' => $news->post_title,
                'post_excerpt' => '',
                'post_status' => 'draft',
                'post_type' => 'holiday_pages',
                'comment_status' => '',
                'post_name' => $post_name,
                'ping_status' => '',
                'post_password' => '',
                'to_ping' =>  '',
                'pinged' => '',
                'post_parent' => 0,
                'menu_order' => 0,
                'guid' => '',
                'import_id' => 0,
                'context' => ''
            );

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $post_id = wp_insert_post( $data );

        update_listing_meta($post_id, 'type', $news->type, 'holiday_pages');

        update_listing_meta($post_id, 'previous_year', $previous_year, 'holiday_pages');

        add_post_meta($post_id, 'custom_permalink', $news->custom_permalink.$previous_year.'/');*/
    }

} ?>

--------------------------------------------------------------------------------------------------

<?php

/*---------------------------------------------*/
/*          Jobs Sub Pages Content Query
/*---------------------------------------------*/
global $wpdb;

$job_types = get_terms( 'location', array(
    'hide_empty' => false,
) );


$job_locs = get_terms( 'type', array(
    'hide_empty' => false,
) ); ?>

<section>

    <div class="row">

        <div class="content-box news-post">

            <table border=1>

              <tr>
                <th>Country City</th>

                <?php foreach ( $job_types as $job_type ) { ?>
                <th><?php echo $job_type->name; ?></th>
                <?php } ?>
              </tr>



              <?php foreach ( $job_locs as $job_loc ) { ?>
              <tr>
                <td><?php echo $job_loc->name; ?></td>

                <?php foreach ( $job_types as $job_type ) { ?>
                <td>
                
                  <?php $get_total_rows = "SELECT COUNT(ID) AS total FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_relationships AS tt1 ON (wp_posts.ID = tt1.object_id) WHERE wp_posts.post_type = 'course' AND ( wp_term_relationships.term_taxonomy_id IN ($job_type->term_taxonomy_id) AND tt1.term_taxonomy_id IN ($job_loc->term_taxonomy_id) ) AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private')";

                  $get_total_rows = $wpdb->get_results($get_total_rows);

                  echo $get_total_rows[0]->total;

                  ?>
                
                </td>
                <?php } ?>
              </tr>
              <?php } ?>
            </table>

        </div>

    </div>

</section>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Parent</th>
            <th>2nd Child</th>
            <th>3rd Child</th>
            <th>4th Child</th>
            <th>Count</th>
            <th>Word Count</th>
            <th>URL</th>
            <th>Reviews</th>
            <th>Post Type</th>
        </tr>

        <?php 

        //"blog-category","scholarship_categories","special_needs_categories","activity_category","art_gallery_categories","education_supplier_categories","language_institute_categories","government_agency_categories","performing_art_categories","recruit_categories","sports_fitness_club_categories","abroad_study_categories","training_and_tutoring_categories","tutor-location","tutor-category","employer_categories","event_categories","event-category","activities_categories","job_category","job_types","type","location"

        $taxonomyName = array("activity_category","art_gallery_categories","education_supplier_categories","event-category","language_institute_categories","government_agency_categories","performing_art_categories","recruit_categories","scholarship_categories","special_needs_categories","sports_fitness_club_categories","abroad_study_categories","training_and_tutoring_categories","tutor-location","tutor-category");

        for ($i=0; $i < count($taxonomyName); $i++) { 
            

            $parent_terms = get_terms( $taxonomyName[$i], array( 'parent' => 0, 'orderby' => 'term_group', 'hide_empty' => false ) );

            foreach ( $parent_terms as $pterm ) { ?>
                
                <tr>
                    <td><?php echo $pterm->name;?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $pterm->count; ?></td>
                    <td><?php echo str_word_count($pterm->description); ?></td>
                    <td><?php echo get_term_link($pterm); ?></td>
                    <td>
                        <?php $tax_obj = $wp_taxonomies[$pterm->taxonomy];

                        $pappu = $tax_obj->object_type[0];

                        $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($pterm->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                        $query_all_ids = $wpdb->get_results($query);

                        echo $query_all_ids[0]->total_reviews; ?>
                    </td>
                    <td><?php echo $pappu; ?></td>
                    
                </tr>

                <?php   

                $first_childs = get_terms( $taxonomyName[$i], array( 'parent' => $pterm->term_id, 'orderby' => 'term_group', 'hide_empty' => false ) );
                
                foreach ( $first_childs as $fr_child ) { ?>
                    <tr>
                        <td><?php echo $pterm->name;?></td>
                        <td><?php echo $fr_child->name;?></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $fr_child->count; ?></td>
                        <td><?php echo str_word_count($fr_child->description); ?></td>
                        <td><?php echo get_term_link($fr_child); ?></td>
                        <td>
                            <?php $tax_obj = $wp_taxonomies[$fr_child->taxonomy];

                            $pappu = $tax_obj->object_type[0];

                            $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($fr_child->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                            $query_all_ids = $wpdb->get_results($query);

                            echo $query_all_ids[0]->total_reviews; ?>
                        </td>
                        <td><?php echo $pappu; ?></td>
                        
                    </tr>
                    <?php $secnd_terms = get_terms( $taxonomyName[$i], array( 'parent' => $fr_child->term_id, 'orderby' => 'term_group', 'hide_empty' => false ) );
                    
                    foreach ( $secnd_terms as $secnd_term ) { ?>

                        <tr>
                            <td><?php echo $pterm->name;?></td>
                            <td><?php echo $fr_child->name;?></td>
                            <td><?php echo $secnd_term->name;?></td>
                            <td></td>
                            <td><?php echo $secnd_term->count; ?></td>
                            <td><?php echo str_word_count($secnd_term->description); ?></td>
                            <td><?php echo get_term_link($secnd_term); ?></td>
                            <td>
                                <?php $tax_obj = $wp_taxonomies[$secnd_term->taxonomy];

                                $pappu = $tax_obj->object_type[0];

                                $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($secnd_term->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                                $query_all_ids = $wpdb->get_results($query);

                                echo $query_all_ids[0]->total_reviews; ?>
                            </td>
                            <td><?php echo $pappu; ?></td>
                            
                        </tr>

                        <?php $third_childs = get_terms( $taxonomyName[$i], array( 'parent' => $secnd_term->term_id, 'orderby' => 'term_group', 'hide_empty' => false ) );
                    
                        foreach ( $third_childs as $third_child ) { ?>

                            <tr>
                                <td><?php echo $pterm->name;?></td>
                                <td><?php echo $fr_child->name;?></td>
                                <td><?php echo $secnd_term->name;?></td>
                                <td><?php echo $third_child->name;?></td>
                                <td><?php echo $third_child->count; ?></td>
                                <td><?php echo str_word_count($third_child->description); ?></td>
                                <td><?php echo get_term_link($third_child); ?></td>
                                <td>
                                    <?php $tax_obj = $wp_taxonomies[$third_child->taxonomy];

                                    $pappu = $tax_obj->object_type[0];

                                    $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($third_child->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                                    $query_all_ids = $wpdb->get_results($query);

                                    echo $query_all_ids[0]->total_reviews; ?>
                                </td>
                                <td><?php echo $pappu; ?></td>
                                
                            </tr>

                            <?php
                        }
                    }
                }
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<table class="table">

    <tr>
        <th>Title</th>
        <th>URL</th>
    </tr>

    <?php 

    global $wpdb;

    $previous = get_term_by('slug', 'previous-events', 'event_categories');

    $previous = '('.$previous->term_taxonomy_id.')';

    $prev_events = $wpdb->get_results("SELECT p.ID, p.post_title FROM wp_posts AS p LEFT JOIN wp_postmeta_event AS m ON ( p.ID = m.post_id ) LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = 'event' AND m.activity = 1 AND ( t.term_taxonomy_id IN $previous) AND (p.post_status = 'publish' OR p.post_status = 'private') GROUP BY p.ID ORDER BY m.start_date DESC");

    if( !empty( $prev_events ) ){

        foreach ($prev_events as $news) { ?>

            <tr>
                <td><?php echo $news->post_title; ?></td>
                <td><a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo get_the_permalink($news->ID); ?></a></td>
            </tr>
            <?php
        }
    } ?>

</table>

--------------------------------------------------------------------------------------------------

<?php 

$terms = get_terms( 'employer_categories', array('hide_empty' => false ) );

foreach ($terms as $key => $value) {
    
    echo get_site_url().'/employers/'.$value->slug.'/';
    echo "<br>";
} ?>

--------------------------------------------------------------------------------------------------

<?php 

$previous = get_term_by('slug', 'previous-events', $category);
$previous = '('.$previous->term_taxonomy_id.')';
$meta_table_name = '`wp_postmeta_'.$post_type.'`';

$search_results = "SELECT p.ID FROM wp_posts AS p WHERE p.post_type = 'event' AND (p.post_status = 'publish' OR p.post_status = 'private') ORDER BY p.post_title ASC";

$results = $wpdb->get_results($search_results, ARRAY_A); 

echo "<pre>";

foreach ($results as $key => $value) {

    $location = wp_get_post_terms($value['ID'], 'activities_categories', array('fields'=>'ids'));

    if( !empty($location) ){

        // $event_locs = [];

        /*foreach ($location as $loc) {

            if( $loc->slug == 'previous-activity' ) {

                $event_locs[] = 11745;
            }else{

                $term_id = term_exists( $loc->slug, 'event_categories' );
                $event_locs[] = $term_id['term_id'];
            }
        }*/

        wp_remove_object_terms($value['ID'], $location, 'activities_categories');

        print_r($location);

        echo "===================================";     

    }
}
echo "</pre>"; ?>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Parent</th>
            <th>2nd Child</th>
            <th>3rd Child</th>
            <th>4th Child</th>
            <th>Count</th>
            <th>Word Count</th>
            <th>URL</th>
            <th>Reviews</th>
        </tr>

        <?php 

        //$taxonomyName = array("blog-category","university_categories","university_subject","scholarship_categories","school_categories","school_curriculum","special_needs_categories","nursery_categories","activity_category","art_gallery_categories","education_supplier_categories","language_institute_categories","government_agency_categories","performing_art_categories","recruit_categories","sports_fitness_club_categories","abroad_study_categories","training_and_tutoring_categories","tutor-location","tutor-category","employer_categories","event_categories","event-category","activities_categories","job_category","job_types","type","location");

        $taxonomyName = array("event-category");
        //This gets top layer terms only.  This is done by setting parent to 0.  
        $parent_terms = get_terms( $taxonomyName, array( 'parent' => 0, 'orderby' => 'term_group', 'hide_empty' => false ) );   

        foreach ( $parent_terms as $pterm ) { ?>
            
            <tr>
                <td><?php echo $pterm->name;?></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo $pterm->count; ?></td>
                <td><?php echo str_word_count($pterm->description); ?></td>
                <td><?php echo get_term_link($pterm); ?></td>
                <td>
                    <?php $tax_obj = $wp_taxonomies[$pterm->taxonomy];

                    $pappu = $tax_obj->object_type[0];

                    $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($pterm->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                    $query_all_ids = $wpdb->get_results($query);

                    echo $query_all_ids[0]->total_reviews; ?>
                </td>
                
            </tr>

            <?php   

            $first_childs = get_terms( $taxonomyName, array( 'parent' => $pterm->term_id, 'orderby' => 'term_group', 'hide_empty' => false ) );
            
            foreach ( $first_childs as $fr_child ) { ?>
                <tr>
                    <td><?php echo $pterm->name;?></td>
                    <td><?php echo $fr_child->name;?></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $fr_child->count; ?></td>
                    <td><?php echo str_word_count($fr_child->description); ?></td>
                    <td><?php echo get_term_link($fr_child); ?></td>
                    <td>
                        <?php $tax_obj = $wp_taxonomies[$fr_child->taxonomy];

                        $pappu = $tax_obj->object_type[0];

                        $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($fr_child->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                        $query_all_ids = $wpdb->get_results($query);

                        echo $query_all_ids[0]->total_reviews; ?>
                    </td>
                    
                </tr>
                <?php $secnd_terms = get_terms( $taxonomyName, array( 'parent' => $fr_child->term_id, 'orderby' => 'term_group', 'hide_empty' => false ) );
                
                foreach ( $secnd_terms as $secnd_term ) { ?>

                    <tr>
                        <td><?php echo $pterm->name;?></td>
                        <td><?php echo $fr_child->name;?></td>
                        <td><?php echo $secnd_term->name;?></td>
                        <td></td>
                        <td><?php echo $secnd_term->count; ?></td>
                        <td><?php echo str_word_count($secnd_term->description); ?></td>
                        <td><?php echo get_term_link($secnd_term); ?></td>
                        <td>
                            <?php $tax_obj = $wp_taxonomies[$secnd_term->taxonomy];

                            $pappu = $tax_obj->object_type[0];

                            $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($secnd_term->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                            $query_all_ids = $wpdb->get_results($query);

                            echo $query_all_ids[0]->total_reviews; ?>
                        </td>
                        
                    </tr>

                    <?php $third_childs = get_terms( $taxonomyName, array( 'parent' => $secnd_term->term_id, 'orderby' => 'term_group', 'hide_empty' => false ) );
                
                    foreach ( $third_childs as $third_child ) { ?>

                        <tr>
                            <td><?php echo $pterm->name;?></td>
                            <td><?php echo $fr_child->name;?></td>
                            <td><?php echo $secnd_term->name;?></td>
                            <td><?php echo $third_child->name;?></td>
                            <td><?php echo $third_child->count; ?></td>
                            <td><?php echo str_word_count($third_child->description); ?></td>
                            <td><?php echo get_term_link($third_child); ?></td>
                            <td>
                                <?php $tax_obj = $wp_taxonomies[$third_child->taxonomy];

                                $pappu = $tax_obj->object_type[0];

                                $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($third_child->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                                $query_all_ids = $wpdb->get_results($query);

                                echo $query_all_ids[0]->total_reviews; ?>
                            </td>
                            
                        </tr>

                        <?php
                    }
                }
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Name</th>
            <th></th>
            <th>Count</th>
            <th>Word Count</th>
            <th>URL</th>
            <th>Reviews</th>
        </tr>

        <?php

        $school_locs = get_terms( 'school_curriculum', array(
                        'hide_empty' => false,
                    ) );

        $school_cats = get_terms( 'school_categories', array(
                        'hide_empty' => false,
                    ) );

        foreach ($school_locs as $value) { 

            foreach ($school_cats as $cat) { ?>

                <tr>
                    <td><?php echo $value->name.' Schools in '.$cat->name; ?></td>
                    <td></td>
                    <td>
                        <?php $query = "SELECT DISTINCT p.ID FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) LEFT JOIN wp_term_relationships AS t1 ON (p.ID = t1.object_id) WHERE p.post_type = 'school' AND ( t.term_taxonomy_id IN ($value->term_taxonomy_id) AND t1.term_taxonomy_id IN ($cat->term_taxonomy_id)) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                        $query_all_ids = $wpdb->get_results($query);

                        echo count($query_all_ids); ?>
                    </td>
                    <td>
                        <?php $term_meta = get_listing_termmeta($cat->term_id, $cat->taxonomy);

                        $description = stripcslashes($term_meta[$value->slug]);

                        echo str_word_count($description); ?>
                    </td>
                    <td><?php echo get_site_url().'/schools/curr/'.$value->slug.'/in/'.$cat->slug.'/'; ?></td>
                    <td>
                        <?php $pappu = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) LEFT JOIN wp_term_relationships AS t1 ON (p.ID = t1.object_id) WHERE p.post_type = 'school' AND ( t.term_taxonomy_id IN ($value->term_taxonomy_id) AND t1.term_taxonomy_id IN ($cat->term_taxonomy_id)) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                        $pappu_all_ids = $wpdb->get_results($pappu);

                        echo $pappu_all_ids[0]->total_reviews; ?>
                    </td>
                </tr>

                <?php
            } 
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php include_once("simple_html_dom.php"); ?>

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Post Title</th>
            <th>Post Link</th>
            <th>Total Internal Link</th>
            <th>Keyword</th>
        </tr>

        <?php //$res = $wpdb->get_results("select * from wp_posts where post_status='publish' AND post_content LIKE '%http://%'",ARRAY_A);

        $res = $wpdb->get_results("SELECT * FROM `wp_termmeta_university_categories` WHERE `meta_data` LIKE '%http://%'",ARRAY_A);

        foreach( $res as $val ){

            $html = new simple_html_dom();
            $html->load($val['meta_data']);
            $all_a_tags = $html->find('a');

            $total_str  =   '';
            $total_str2 =   '';
            $total_link =   0;

            foreach($all_a_tags as $val2) {

                $temp = explode("http://",$val2->href);

                if( count($temp) > 1 ){

                    $total_str  .=  "<b>".$val2->innertext."</b>; ".stripslashes($val2->href);
                    $total_link++;
                }
            }

            $total_str = trim($total_str,", ");
            $link = get_term_by('term_id', $val['term_id'], 'university_categories');
            $link = get_term_link($link); ?>



            <tr>
                <td><?php echo $val['term_id']; ?></td>
                <td><?php echo $link; ?></td>
                <td><?php echo $total_link; ?></td>
                <td><?php echo $total_str; ?></td>
            </tr>

        <?php } ?>

    </table>

</div>

--------------------------------------------------------------------------------------------------

<?php include_once("simple_html_dom.php"); ?>

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Post Title</th>
            <th>Post Link</th>
            <th>Total Internal Link</th>
            <th>Keyword</th>
        </tr>

        <?php $res = $wpdb->get_results("select * from wp_posts where post_status='publish' AND post_content LIKE '%http://%'",ARRAY_A);

        //$res = $wpdb->get_results("SELECT * FROM `wp_termmeta_school_categories` WHERE `meta_data` LIKE '%http://%'",ARRAY_A);

        foreach( $res as $val ){

            $html = new simple_html_dom();
            $html->load($val['post_content']);
            $all_a_tags = $html->find('a');

            $total_str  =   '';
            $total_str2 =   '';
            $total_link =   0;

            foreach($all_a_tags as $val2) {

                $temp = explode("http://",$val2->href);

                if( count($temp) > 1 ){

                    $total_str  .=  "<b>".$val2->innertext."</b>; ".stripslashes($val2->href);
                    $total_link++;
                }
            }

            $total_str = trim($total_str,", ");
            $link = get_the_permalink($val['ID']); ?>



            <tr>
                <td><?php echo $val['post_title']; ?></td>
                <td><?php echo $link; ?></td>
                <td><?php echo $total_link; ?></td>
                <td><?php echo $total_str; ?></td>
            </tr>

        <?php } ?>

    </table>

</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Title</th>
            <th>URL</th>
            <th>Post Count</th>
        </tr>

        <?php 

        $query = new WP_Query(
                                array(
                                    'post_type' => 'map-pages',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title'
                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) { ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                    <td>
                        <?php $map_url = get_the_permalink($news->ID);

                        $curr_url = explode('/',$map_url);

                        //print_r($curr_url);

                        if( $curr_url[4] == "universities" ){

                            $listing_type = "university";
                            $taxonomy = "university_categories";

                        }else if( $curr_url[4] == "schools" ) {

                            $listing_type = "school";
                            $taxonomy = "school_categories";

                        }else{

                            $listing_type = "nursery";
                            $taxonomy = "nursery_categories";
                        }

                        $meta_table_name = '`wp_postmeta_'.$listing_type.'`';

                        $city = $curr_url[5];

                        $term = get_term_by('slug',$city, $taxonomy);

                        $term_taxonomy = $term->term_taxonomy_id;

                        $all_records = $wpdb->get_results("SELECT DISTINCT p.ID FROM wp_posts AS p LEFT JOIN $meta_table_name AS m ON ( p.ID = m.post_id ) LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$listing_type' AND ( t.term_taxonomy_id IN ($term_taxonomy)) AND (p.post_status = 'publish' OR p.post_status = 'private') GROUP BY p.ID");

                        echo count($all_records);

                        ?>
                    </td>
                </tr>

                <?php 
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="table">

        <tr>
            <th>Parent</th>
            <th>2nd Child</th>
            <th>3rd Child</th>
            <th>Count</th>
            <th>Word Count</th>
            <th>URL</th>
            <th>Reviews</th>
        </tr>

        <?php 

        //$taxonomyName = array("blog-category","university_categories","university_subject","scholarship_categories","school_categories","school_curriculum","special_needs_categories","nursery_categories","activity_category","art_gallery_categories","education_supplier_categories","language_institute_categories","government_agency_categories","performing_art_categories","recruit_categories","sports_fitness_club_categories","abroad_study_categories","training_and_tutoring_categories","tutor-location","tutor-category","employer_categories","event_categories","event-category","activities_categories","job_category","job_types","type","location");

        $taxonomyName = array("job_category","job_types");
        //This gets top layer terms only.  This is done by setting parent to 0.  
        $parent_terms = get_terms( $taxonomyName, array( 'parent' => 0, 'orderby' => 'term_group', 'hide_empty' => false ) );   

        foreach ( $parent_terms as $pterm ) {
        ?>
            
            <tr>
                <td><?php echo $pterm->name;?></td>
                <td></td>
                <td></td>
                <td><?php echo $pterm->count; ?></td>
                <td><?php echo str_word_count($pterm->description); ?></td>
                <td><?php echo get_term_link($pterm); ?></td>
                <td>
                    <?php $tax_obj = $wp_taxonomies[$pterm->taxonomy];

                    $pappu = $tax_obj->object_type[0];

                    $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($pterm->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                    $query_all_ids = $wpdb->get_results($query);

                    echo $query_all_ids[0]->total_reviews; ?>
                </td>
                
            </tr>

            <?php   

            $terms = get_terms( $taxonomyName, array( 'parent' => $pterm->term_id, 'orderby' => 'term_group', 'hide_empty' => false ) );
            
            foreach ( $terms as $term ) {
                ?>
                <tr>
                    <td><?php echo $pterm->name;?></td>
                    <td><?php echo $term->name;?></td>
                    <td></td>
                    <td><?php echo $term->count; ?></td>
                    <td><?php echo str_word_count($term->description); ?></td>
                    <td><?php echo get_term_link($term); ?></td>
                    <td>
                        <?php $tax_obj = $wp_taxonomies[$term->taxonomy];

                        $pappu = $tax_obj->object_type[0];

                        $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($term->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                        $query_all_ids = $wpdb->get_results($query);

                        echo $query_all_ids[0]->total_reviews; ?>
                    </td>
                    
                </tr>
                <?php
                $child_terms = get_terms( $taxonomyName, array( 'parent' => $term->term_id, 'orderby' => 'term_group', 'hide_empty' => false ) );

                
                foreach ( $child_terms as $ch_term ) {
                    ?>

                    <tr>
                        <td></td>
                        <td><?php echo $term->name;?></td>
                        <td><?php echo $ch_term->name;?></td>
                        <td><?php echo $ch_term->count; ?></td>
                        <td><?php echo str_word_count($ch_term->description); ?></td>
                        <td><?php echo get_term_link($ch_term); ?></td>
                        <td>
                            <?php $tax_obj = $wp_taxonomies[$ch_term->taxonomy];

                            $pappu = $tax_obj->object_type[0];

                            $query = "SELECT SUM(comment_count) AS total_reviews FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) WHERE p.post_type = '$pappu' AND ( t.term_taxonomy_id IN ($ch_term->term_taxonomy_id) ) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                            $query_all_ids = $wpdb->get_results($query);

                            echo $query_all_ids[0]->total_reviews; ?>
                        </td>
                        
                    </tr>

                    <?php

                }

            }
        }
        ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php include_once("simple_html_dom.php");

echo '<table border="1" cellspacing="0" >';
echo '<tr><th>Post Title</th><th>Post Link</th><th>Total Internal Link</th><th>Keyword</th></tr>';
$res    =   $wpdb->get_results("select * from wp_posts where post_type='blogs' and post_status='publish' ",ARRAY_A);
foreach($res as $val)
{
    $html = new simple_html_dom();
    $html->load($val['post_content']);
    $all_a_tags =   $html->find('a');
    
    $total_str  =   '';
    $total_str2 =   '';
    $total_link =   0;
    foreach($all_a_tags as $val2)
    {
        $temp   =   explode("edarabia.com",$val2->href);
        
        if(count($temp)>1)
        {
            if(!count($val2->find('img'))>0)
            {
                $total_str  .=  "<b>".$val2->innertext."</b>; ".$val2->href."
                ";
                
                $total_link++;
            }
            
        }
    }
    $total_str  =   trim($total_str,", ");
    $link   =   get_post_permalink($val['ID']);
    echo '<tr><td>'.$val['post_title'].'</td><td>'.$link.'</td><td>'.$total_link.'</td><td nowrap="nowrap">'.$total_str.'</td></tr>';
}
echo '</table>'; ?>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Name</th>
            <th></th>
            <th>Count</th>
            <th>Word Count</th>
            <th>URL</th>
            <th>Category</th>
        </tr>

        <?php

        $school_locs = get_terms( 'university_subject', array(
                        'hide_empty' => false,
                    ) );

        $school_cats = get_terms( 'university_categories', array(
                        'hide_empty' => false,
                        'number' => '100',
                        'offset' => $_GET['number']
                    ) );

        foreach ($school_locs as $value) { 

            foreach ($school_cats as $cat) { ?>

                <tr>
                    <td><?php echo $value->name.' Universities in '.$cat->name; ?></td>
                    <td></td>
                    <td>
                        <?php $query = "SELECT DISTINCT p.ID FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) LEFT JOIN wp_term_relationships AS t1 ON (p.ID = t1.object_id) WHERE p.post_type = 'university' AND ( t.term_taxonomy_id IN ($value->term_taxonomy_id) AND t1.term_taxonomy_id IN ($cat->term_taxonomy_id)) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                        $query_all_ids = $wpdb->get_results($query);

                        echo count($query_all_ids); ?>
                    </td>
                    <td>
                        <?php $term_meta = get_listing_termmeta($cat->term_id, $cat->taxonomy);

                        $description = stripcslashes($term_meta[$value->slug]);

                        echo str_word_count($description); ?>
                    </td>

                    <td><?php echo get_site_url().'/universities/new/'.$value->slug.'/in/'.$cat->slug.'/'; ?></td>
                    <td>University</td>
                </tr>

                <?php
            } 
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>URL</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Country/City</th>
            <th>Package</th>
            <th>Tutor Type</th>
        </tr>

        <?php 

        $search_results = "SELECT DISTINCT p.ID, p.post_title, m.phone, m.address, m.address_2, m.email, m.tutor_type, u.user_email, u.user_role, pro.package_id FROM wp_posts p 
        LEFT JOIN `wp_postmeta_tutor` m ON ( p.ID = m.post_id ) 
        LEFT JOIN wp_users_front u ON (u.ID = p.front_user_id) 
        LEFT JOIN paypal_pro pro ON (pro.listing_id = p.ID) 
        WHERE p.post_type = 'tutor' 
        AND (p.post_status = 'publish' OR p.post_status = 'private') 
        ORDER BY m.tutor_type DESC";

        $results = $wpdb->get_results($search_results, ARRAY_A);

        foreach ($results as $value) { 

            $post_id = $value['ID'];
            $package_id = $value['package_id'];
            
            $package = '';              
            if($package_id > 1){

                $package = 'Premium';
            }

            $listing_locations = wp_get_post_terms($post_id, 'tutor-location', array("fields" => "names"));
            if(isset($listing_locations[1]) && $listing_locations[1] != ''){

                $city_country = $listing_locations[0] . '/' .$listing_locations[1];
            }else{
                $city_country = $listing_locations[0];
            }

            if($value['user_role'] == 2){

                $tutor_type = 'Company';
            }else{

                $tutor_type = 'Individual';
            } ?>

            <tr>
                <td><?php echo $value['post_title'];?></td>
                <td><?php echo $value['email'].' | '.$value['user_email']; ?></td>
                <td><?php echo get_the_permalink($post_id); ?></td>
                <td><?php echo $value['phone'];?></td>
                <td><?php echo $value['address'].' | '.$value['address_2'];?></td>
                <td><?php echo $city_country;?></td>
                <td><?php echo $package;?></td>
                <td><?php echo $tutor_type;?></td>
            </tr>

            <?php
            
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>URL</th>
            <th>City</th>
            <th>Country</th>
            <th>Reviews</th>
            <th>Rating</th>
            <th>Address</th>
        </tr>

        <?php 

        $query = new WP_Query(
                                array(
                                    'post_type' => 'nursery',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'tax_query' => array(
                                                          array(
                                                              'taxonomy' => 'nursery_categories',
                                                              'field'    => 'slug',
                                                              'terms'    =>  array('dubai','abu-dhabi','sharjah')
                                                          )
                                                      )
                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            $countries_term = get_term_by('slug','countries','nursery_categories');
            $middle_east_term = get_term_by('slug','middle-east','nursery_categories');

            foreach ($rel_news as $news) {

                $terms = wp_get_post_terms($news->ID, 'nursery_categories');

                $city_name = '';
                $country_name = '';

                foreach ($terms as $location) {

                    if( $location->parent == $countries_term->term_id || $location->parent == $middle_east_term->term_id ){

                        $country_term = $location;
                        $country_name =  $location->name;
                    }
                }

                foreach ($terms as $city) {

                    if( $city->parent == $country_term->term_id ) {

                        $city_name =  $city->name;
                    }
                }

                $rating = get_post_rating($news->post_type, $news->ID); ?>

                <tr>
                    <td><?php echo get_the_post_thumbnail_url($news->ID) ? "Yes" : "No"; ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo $news->post_title; ?></a></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                    <td><?php echo $city_name; ?></td>
                    <td><?php echo $country_name; ?></td>
                    <td><?php echo wp_count_comments($news->ID)->approved; ?></td>
                    <td><?php echo $rating['avg_rating']; ?></td>
                    <td><?php echo get_listing_meta($news->ID, 'address', 'nursery'); ?></td>
                </tr>

                <?php 
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Name</th>
            <th>Count</th>
            <th>URL</th>
            <th>Category</th>
        </tr>

        <?php $terms = get_terms( 'school_curriculum', array('hide_empty' => false) );

        foreach ($terms as $key => $value) { ?>

            <tr>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->count; ?></td>
                <td><?php echo get_term_link($value); ?></td>
                <td>School</td>
            </tr>
        <?php } ?>

    </table>

</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Name</th>
            <th>Count</th>
            <th>URL</th>
            <th>Category</th>
        </tr>

        <?php

        $school_locs = get_terms( 'school_curriculum', array(
                        'hide_empty' => false,
                    ) );

        $school_cats = get_terms( 'school_categories', array(
                        'hide_empty' => false,
                        'number' => '200',
                        'offset' => 800
                    ) );

        foreach ($school_locs as $value) { 

            foreach ($school_cats as $cat) { ?>

                <tr>
                    <td><?php echo $value->name.' Schools in '.$cat->name; ?></td>

                    <td>
                        <?php $query = "SELECT DISTINCT p.ID FROM wp_posts AS p LEFT JOIN wp_term_relationships AS t ON (p.ID = t.object_id) LEFT JOIN wp_term_relationships AS t1 ON (p.ID = t1.object_id) WHERE p.post_type = 'school' AND ( t.term_taxonomy_id IN ($value->term_taxonomy_id) AND t1.term_taxonomy_id IN ($cat->term_taxonomy_id)) AND (p.post_status = 'publish' OR p.post_status = 'private')";

                        $query_all_ids = $wpdb->get_results($query);

                        echo count($query_all_ids); ?>
                    </td>

                    <td><?php echo get_site_url().'/schools/curr/'.$value->slug.'/in/'.$cat->slug.'/'; ?></td>
                    <td>School</td>
                </tr>

                <?php
            } 
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Date</th>
            <th>Title</th>
            <th>URL</th>
            <th>Word Count</th>
            <th>Category</th>
            <th>Main Tag</th>
            <th>Tags</th>
        </tr>

        <?php 

        $query = new WP_Query(
                                array(
                                    'post_type' => 'blogs',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title'
                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) {

                $term_list = wp_get_post_terms( $news->ID, 'blog-category', array('fields' => 'names') ); ?>

                <tr>
                    <td><?php echo get_the_date('d/m/Y', $news->ID); ?></td>
                    <td><?php echo $news->post_title; ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                    <td><?php echo str_word_count($news->post_content); ?></td>
                    <td><?php echo implode(", ", $term_list); ?></td>
                    <td><?php echo get_listing_meta($news->ID, 'company_listing', 'blogs'); ?></td>
                    <td><?php $tags = '';echo $tags = get_listing_meta($news->ID, 'tags', 'blogs'); ?></td>
                </tr>

                <?php 
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php global $wpdb;

global $listing_arr;

$post_types = "'".implode("','", $listing_arr)."'";

$search_query = "SELECT wp_posts.ID FROM wp_posts LEFT JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE ( wp_postmeta.meta_key = 'expiry_date' AND wp_postmeta.meta_value != '' ) AND wp_posts.post_type IN ($post_types) AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_postmeta.meta_value+0 DESC";

$search_results = $wpdb->get_results($search_query);

$count = 0;

$job_count = 0;

$course_count = 0;        

foreach ($search_results as $result) {

    $post_ID = $result->ID;

    $post_group = get_post_type($post_ID);

    $member = get_listing_meta($post_ID, "member", $post_group );

    if( $member == "Yes" ){

        $count++;

        $member_value = 'Yes';

        // Updates Course Membership        

        $get_meta_course = "SELECT post_id, member FROM wp_postmeta_course WHERE company_listing = $post_ID AND (member = 'No' OR member = '')";

        $get_meta_course =  $wpdb->get_results($get_meta_course);

        if( !empty($get_meta_course) ){

            echo "<pre>";

            echo $post_ID;

            echo "<br>";

            foreach ($get_meta_course as $course) {

                print_r($course);


                /*$course_count++;

                update_listing_meta($course->post_id, "member", $member_value, 'course');*/
            }

            echo "</pre>";
        }
    
    }
}

echo $count.'------------------'.$course_count; ?>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Date</th>
            <th>Title</th>
            <th>URL</th>
            <th>Word Count</th>
            <th>Category</th>
        </tr>

        <?php 

        $query = new WP_Query(
                                array(
                                    'post_type' => 'blogs',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title'
                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) {

                $term_list = wp_get_post_terms( $news->ID, 'blog-category', array('fields' => 'names') ); ?>

                <tr>
                    <td><?php echo get_the_date('d/m/Y', $news->ID); ?></td>
                    <td><?php echo $news->post_title; ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                    <td><?php echo str_word_count($news->post_content); ?></td>
                    <td><?php echo implode(", ", $term_list); ?></td>
                </tr>

                <?php 
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Category</th>
            <th>No. of Posts</th>
        </tr>

        <?php 

        $taxonomyName = "blog-category";
        //This gets top layer terms only.  This is done by setting parent to 0.  
        $parent_terms = get_terms( $taxonomyName, array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );   

        foreach ( $parent_terms as $pterm ) {
        ?>
            
            <tr>
                <td><?php echo $pterm->name;?></td>
                <td><?php echo $pterm->count; ?></td>
            </tr>

            <?php   

            $terms = get_terms( $taxonomyName, array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
            
            foreach ( $terms as $term ) {
                ?>
                <tr>
                    <td> &nbsp;&nbsp;- <?php echo $term->name;?></td>
                    <td><?php echo $term->count; ?></td>
                </tr>
                <?php
                $child_terms = get_terms( $taxonomyName, array( 'parent' => $term->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );

                
                foreach ( $child_terms as $ch_term ) {
                    ?>

                    <tr>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?php echo $ch_term->name;?></td>
                        <td><?php echo $ch_term->count; ?></td>
                    </tr>

                    <?php

                }

            }
        }
        ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<table>

    <?php 

    $terms = get_terms( 'post_tag', array('hide_empty' => false) );

    global $wpdb;

    global $listing_arr;

    foreach ($terms as $term) {

        $post_title = $term->name;

        $results = $wpdb->get_results( "SELECT ID, post_type FROM wp_posts WHERE post_title = '".$post_title."'" );

        if( !empty($results) ){

            foreach ($results as $value) {

                if( in_array($value->post_type, $listing_arr) ){ ?>

                    <?php 

                    $args = array(
                    'post_type' => 'any',
                    'orderby' => 'title',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_tag',
                            'field' => 'slug',
                            'terms' => array($term->slug)
                        )
                    ));

                    $tag_query = new WP_Query( $args );

                    if($tag_query->have_posts()):

                        //Display tag title
                        echo '<h2> Tag :'.esc_html($term->name).' ('.$term->count.')</h2>';

                        //Loop through posts and display
                        while($tag_query->have_posts()):$tag_query->the_post();

                            wp_remove_object_terms( get_the_ID(), $term->term_id, 'post_tag' );
                        endwhile;

                    endif; //End if $tag_query->have_posts
                    wp_reset_postdata();
                }
            }
        }
    }

    ?>
    
</table>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Title</th>
            <th>URL</th>
            <th>Category</th>
        </tr>

        <?php 

        $query = new WP_Query(
                                array(
                                    'post_type' => 'blogs',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title'
                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) {

                $term_list = wp_get_post_terms( $news->ID, 'blog-category', array('fields' => 'names') ); ?>

                <tr>
                    
                    <td><?php echo $news->post_title; ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                    <td><?php echo implode(", ", $term_list); ?></td>
                </tr>

                <?php 
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Image</th>
            <th>School Name</th>
            <th>URL</th>
            <th>City</th>
            <th>Country</th>
        </tr>

        <?php 

        $query = new WP_Query(
                                array(
                                    'post_type' => 'school',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'tax_query' => array(
                                                          array(
                                                              'taxonomy' => 'school_categories',
                                                              'field'    => 'slug',
                                                              'terms'    =>  array('australia')
                                                          )
                                                      )
                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            $countries_term = get_term_by('slug','countries','school_categories');
            $middle_east_term = get_term_by('slug','middle-east','school_categories');


            foreach ($rel_news as $news) {

                $terms = wp_get_post_terms($news->ID, 'school_categories');

                $city_name = '';
                $country_name = '';

                foreach ($terms as $location) {

                    if( $location->parent == $countries_term->term_id || $location->parent == $middle_east_term->term_id ){

                        $country_term = $location;
                        $country_name =  $location->name;
                    }
                }

                foreach ($terms as $city) {

                    if( $city->parent == $country_term->term_id ) {

                        $city_name =  $city->name;
                    }
                } ?>

                <tr>
                    <td><?php echo get_the_post_thumbnail_url($news->ID) ? "Yes" : "No"; ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo $news->post_title; ?></a></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>

                    <td><?php echo $city_name; ?></td>
                    <td><?php echo $country_name; ?></td>
                </tr>

                <?php 
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">

    <table>

        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>


        <?php 

        global $wpdb;

        global $post_types_arr;

        $post_types = "('".implode("','", $post_types_arr)."')";

        $rel_news = "SELECT DISTINCT ID FROM wp_posts WHERE wp_posts.post_type IN $post_types AND wp_posts.post_status = 'publish' LIMIT 50000, 10000"; //43193

        $rel_news = $wpdb->get_results($rel_news);

        if( !empty( $rel_news ) ){

            $count = 0;

            foreach ($rel_news as $news) {

                $email =  '';

                $id = $news->ID;

                $post_type = get_post_type($id);

                $taxonomy = get_object_taxonomies($post_type);

                $terms = wp_get_post_terms($id, $taxonomy);

                $terms = wp_list_pluck( $terms, 'name' );

                $pappu = in_array_r('Qatar', $terms) ? true : false;

                if( $pappu == 1 ) {

                    $email = get_listing_meta($id, 'email', $post_type);

                    if( $email ){ ?>

                        <tr>
                            <td><?php echo get_the_title($id); ?></td>
                            <td><?php echo $email; ?></td>
                        </tr>

                        <?php
                    }
                }
            }
        } ?>

    </table>

</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">

    <table>

        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>URL</th>
            <th>Email</th>
            <th>Name</th>
            <th>City, Country</th>
        </tr>

        <?php 

        $rel_news = 'SELECT * FROM wp_inquiries WHERE inquiry_type = "" GROUP BY email ORDER BY inquiry_date';

        $rel_news = $wpdb->get_results($rel_news);

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) {

                $id = $news->post_id;

                $post_group = get_post_type($id);

                if( $post_group ){

                    $taxonomies = get_object_taxonomies($post_group);

                    $terms = wp_get_post_terms($id, $taxonomies[0]);

                    $terms = wp_list_pluck( $terms, 'name' );

                    $pappu = in_array_r('Japan', $terms) ? true : false;

                    if( $pappu == 1 ) { ?>

                        <tr>
                            <td><?php echo $news->inquiry_date; ?></td>
                            <td><?php echo get_post_type($id); ?></td>
                            <td><?php echo get_the_permalink($id); ?></td>
                            <td><?php echo $news->email; ?></td>
                            <td><?php echo $news->name; ?></td>
                            <td><?php foreach ($terms as $value) { echo $value.', ';} ?></td>
                        </tr>

                        <?php
                    }
                }
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php

global $wpdb;

$user_data = $wpdb->get_results( "SELECT ID, user_email, user_firstname FROM wp_users_front WHERE user_role = 2", ARRAY_A);

foreach ($user_data as $key => $value) {

    global $listing_arr;

    $post_types = "'".implode("','", $listing_arr)."'";
    
    $listing_data = $wpdb->get_results( "SELECT p.ID FROM wp_posts p WHERE p.front_user_id = ". $value['ID']." AND p.post_type IN (".$post_types.") AND ( p.post_status = 'publish' OR p.post_status = 'pending')", ARRAY_A);

    if($listing_data){


        echo $value['user_email'];
        echo "<br>";

        echo '<ol>';
        foreach ($listing_data as $val) {

            echo '<li><a href="'.get_the_permalink($val['ID']).'">' . get_the_permalink($val['ID']) . '</a> (' . $val['ID'] . ')</li>';

            $rel_news = "SELECT wp_posts.ID FROM wp_posts LEFT JOIN wp_postmeta_course ON ( wp_posts.ID = wp_postmeta_course.post_id ) WHERE wp_posts.post_type = 'course' AND wp_posts.front_user_id = 0 AND ( wp_postmeta_course.meta_key = 'company_listing' AND wp_postmeta_course.meta_value = ".$val['ID']." ) AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC";

            $rel_courses = $wpdb->get_results($rel_news, ARRAY_A);

            foreach ($rel_courses as $pappu) {

                $wpdb->query("UPDATE wp_posts SET front_user_id = ".$value['ID']." WHERE ID = ".$pappu['ID']);
            }
        }
        echo '</ol>';
    }
} ?>

--------------------------------------------------------------------------------------------------

<?php 

//SELECT `post_id`, `total_shares` FROM `wp_postmeta_blogs` WHERE `total_shares` != 0 ORDER BY `wp_postmeta_blogs`.`total_shares` DESC

/*$results = $wpdb->get_results("SELECT ID FROM `wp_posts` where post_type in('blogs') and post_status='publish' limit ".$_GET['number'].", 1000");

foreach($results as $val){

    $link = get_the_permalink($val->ID);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"http://count-server.sharethis.com/v2.0/get_counts?url=".$link);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);
    curl_close($ch);

    $json_data = json_decode($server_output);
    $share_1 = serialize($json_data);
    $total_share = trim($json_data->total);

    if( $total_share != '0' ){

        $query = "UPDATE `wp_postmeta_blogs` SET `total_shares` = ". $total_share ." WHERE post_id = ".$val->ID;
        $wpdb->get_results($query);
    }
}*/ ?>

--------------------------------------------------------------------------------------------------

<?php 

$job_types = get_terms( 'school_curriculum', array(
    'hide_empty' => true,
) );


$job_locs = get_terms( 'school_categories', array(
    'hide_empty' => true,
) ); ?>

<section>

    <div class="row">

      <div class="content-box news-post">

        <div class="table-responsive">

                <table class="table font-12">

              <tr>
                <th>Country City</th>

                <?php foreach ( $job_types as $job_type ) { ?>
                <th><?php echo $job_type->name; ?></th>
                <?php } ?>
              </tr>



              <?php foreach ( $job_locs as $job_loc ) { ?>
              <tr>
                <td><?php echo $job_loc->name; ?></td>

                <?php foreach ( $job_types as $job_type ) {

                    $custom_name = str_replace("-", "_", $job_type->slug);

                    $term_meta = get_listing_termmeta($job_loc->term_id,$job_loc->taxonomy);
                    
                    $check_con = $term_meta[$custom_name];  ?>
                <td>
                
                  <?php 

                  echo $check_con ? "C:".strlen(wp_strip_all_tags($check_con)). ' | '  : "No | ";

                  global $wpdb;

                  $get_total_rows = "SELECT COUNT(ID) AS total FROM wp_posts INNER JOIN wp_postmeta_school ON ( wp_posts.ID = wp_postmeta_school.post_id ) INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) INNER JOIN wp_term_relationships AS tt1 ON (wp_posts.ID = tt1.object_id) WHERE wp_posts.post_type = 'school' AND wp_postmeta_school.meta_key = 'member' AND ( wp_term_relationships.term_taxonomy_id IN ($job_type->term_taxonomy_id) AND tt1.term_taxonomy_id IN ($job_loc->term_taxonomy_id) ) AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID";

                  $get_total_rows = $wpdb->get_results($get_total_rows);

                  echo " (".count($get_total_rows).")";

                  ?>
                
                </td>
                <?php } ?>
              </tr>
              <?php } ?>
            </table>
        </div>

      </div>

    </div>

</section>

--------------------------------------------------------------------------------------------------

<?php if( is_user_logged_in() ){

    $dir = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/normal-users/2019/04';

    $files1 = scandir($dir);

    $count = 0;

    global $wpdb;

    for ($i=0; $i < count($files1); $i++) {

        $db_url = "'".'uploads/normal-users/2019/04/'.$files1[$i]."'";

        $check_file = $wpdb->get_row("SELECT ID FROM wp_users_front u WHERE profile_picture = $db_url");

        if( ! $check_file ) {

            unlink($dir.'/'.$files1[$i]);
            $count++;
        }
    }

    echo $count;
} ?>

--------------------------------------------------------------------------------------------------

<table class="table-bordered" border="1">
        <tr>
            
            <th>year</th>
            <th>Title</th>
            <th>Link</th>
            <th>Seached At</th>
        </tr>
        <?php if(is_user_logged_in()){ ?>

        <?php
        
        
        for($k=1990;$k<=2019; $k++)
        {
            $array_years[]  =   $k;
        }
        
        $cond           =   "";
        foreach($array_years as $val)
        {
            $cond           .=  " post_content LIKE '%".$val."%' or ";
        }
        $cond   =   trim($cond,"or ");  
        
        $rel_news = "SELECT * FROM `wp_posts` where post_type='job' and (".$cond.")";

        $rel_news = $wpdb->get_results($rel_news, ARRAY_A);
        $total  =   1; 
        if( !empty( $rel_news ) )
        { 
            $count = 0;
            foreach ($rel_news as $news) 
            {
            
                foreach($array_years as $val)
                {
                    
                    $temp   =   explode($val,$news['post_content']);
                    if(count($temp)>1)
                    {
                        
                        for($k=0; $k < (count($temp)-1); $k++)
                        {
                            ?>
                            <tr>
                                
                            
                                <td><?php echo $val;?></td>
                                <td><?php echo $news['post_title']?></td>
                                <td><?php echo get_post_permalink($news['ID'])?></td>
                                <td><?php echo substr(strip_tags($temp[$k]),-20)."<span style='background:yellow'>".$val."</span> ".substr(strip_tags($temp[$k+1]),0,20);?></td>
                            </tr>
                            <?php
                            $total++;
                        }
                        
                    }
                }           
            }
        }
        ?>
</table>

--------------------------------------------------------------------------------------------------

<table>

    <tr>
        <th>Title</th>
        <th>URL</th>
        <th>Salary</th>
    </tr>

    <?php

    $query = new WP_Query(
                            array(
                                'post_type' => 'job',
                                'posts_per_page' => -1,
                            )
                        );
    $rel_news = $query->posts;


    if( !empty( $rel_news ) ){

        foreach ($rel_news as $news) { 

            $salary = get_listing_meta($news->ID, 'salary', 'job');

            if( $salary ){ ?>
                <tr>
                    <td><?php echo get_the_title($news->ID); ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                    <td><?php echo $salary; ?> </td>
                </tr>
                <?php
            }
        }
    } ?>

</table>

--------------------------------------------------------------------------------------------------

<table>

    <tr><th>Emails</th></tr>

    <?php 

    $query = new WP_Query(
                            array(
                                'post_type' => 'school',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                                      array(
                                                          'taxonomy' => 'school_categories',
                                                          'field'    => 'slug',
                                                          'terms'    =>  array('uae')
                                                      )
                                                  )
                            )
                        );
    $rel_news = $query->posts;

    if( !empty( $rel_news ) ){

        foreach ($rel_news as $news) {

            $emails = array();

            $email = get_listing_meta($news->ID, 'email', 'school');

            $email = explode(",", $email);

            for ($i=0; $i < count($email); $i++) { 

                array_push($emails, trim($email[$i]));
            }

            array_push($emails, trim(get_listing_meta($news->ID, 'job_email', 'school')));
            array_push($emails, trim(get_listing_meta($news->ID, 'event_email', 'school')));
            array_push($emails, trim(get_listing_meta($news->ID, 'contact_person_email_1', 'school')));
            array_push($emails, trim(get_listing_meta($news->ID, 'contact_person_email_2', 'school')));

            $emails = array_filter($emails);
            $emails = array_values($emails);

            for ($v=0; $v < count($emails); $v++) { ?>

                <tr><td><?php echo $emails[$v]; ?></td></tr>

                <?php 
            }
        }
    } ?>

</table>

--------------------------------------------------------------------------------------------------

<table>

    <tr>
        <th>School Name</th>
        <th>City</th>
        <th>Country</th>
        <th>Emails</th>
    </tr>

    <?php 

    $query = new WP_Query(
                            array(
                                'post_type' => 'school',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                                      array(
                                                          'taxonomy' => 'school_categories',
                                                          'field'    => 'slug',
                                                          'terms'    =>  array('japan','hong-kong','vietnam','indonesia','malaysia','singapore','taiwan')
                                                      )
                                                  )
                            )
                        );
    $rel_news = $query->posts;

    if( !empty( $rel_news ) ){

        $countries_term = get_term_by('slug','countries','school_categories');
        $middle_east_term = get_term_by('slug','middle-east','school_categories');


        foreach ($rel_news as $news) {

            $terms = wp_get_post_terms($news->ID, 'school_categories');

            $city_name = '';
            $country_name = '';

            foreach ($terms as $location) {

                if( $location->parent == $countries_term->term_id || $location->parent == $middle_east_term->term_id ){

                    $country_term = $location;
                    $country_name =  $location->name;
                }
            }

            foreach ($terms as $city) {

                if( $city->parent == $country_term->term_id ) {

                    $city_name =  $city->name;
                }
            }

            $email = trim(get_listing_meta($news->ID, 'email', 'school'));

            $emails = array();
            $emails[] = trim(get_listing_meta($news->ID, 'job_email', 'school'));
            $emails[] = trim(get_listing_meta($news->ID, 'event_email', 'school'));
            $emails[] = trim(get_listing_meta($news->ID, 'contact_person_email_1', 'school'));
            $emails[] = trim(get_listing_meta($news->ID, 'contact_person_email_2', 'school'));

            $emails = array_filter($emails);
            $emails = array_values($emails); ?>

            <tr>
                <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo $news->post_title; ?></a></td>

                <td><?php echo $city_name; ?></td>
                <td><?php echo $country_name; ?></td>

                <?php if( !empty($emails) ){ ?>
                <td><?php echo $email.', '.implode(", ", $emails); ?></td>
                <?php }else{ ?>
                <td><?php echo $email; ?></td>
                <?php } ?>
            </tr>

            <?php 
        }
    } ?>

</table>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">

    <table class="school-fees display table table-striped table-hover dataTable no-footer" style="width: 100%;" width="100%" cellspacing="0" role="grid">

        <tr>
            <th>Title</th>
            <th>URL</th>
            <th>Website</th>
            <th>Embed PDF</th>
            <th>Government Rating</th>
            <th>Report Link</th>
            <th>Report Title</th>
            <th>Previous Year Rating</th>
        </tr>

        <?php 

        $query = new WP_Query(
                                array(
                                    'post_type' => 'school',
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'school_categories',
                                                            'field'    => 'slug',
                                                            'terms'    =>  array("dubai")
                                                        )
                                                    )
                                )
                            );
        $rel_news = $query->posts;

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) { ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo get_the_permalink($news->ID); ?></a></td>
                    <td><?php echo get_listing_meta($news->ID, 'website', 'school'); ?></td>
                    <td><?php echo get_listing_meta($news->ID, 'embedd_pdf', 'school') ? "Yes" : "No"; ?></td>
                    <td><?php echo get_listing_meta($news->ID, 'government_rating', 'school'); ?></td>
                    <td><?php echo get_listing_meta($news->ID, 'report_link', 'school'); ?></td>
                    <td><?php echo get_listing_meta($news->ID, 'report_title', 'school'); ?></td>
                    <td><?php echo get_listing_meta($news->ID, 'previous_year_rating', 'school') ? "Yes" : "No"; ?></td>

                    <?php $previous_year_rating = get_listing_meta($news->ID,'previous_year_rating','school');

                    if( $previous_year_rating ){
                        
                        $previous_year_ratings = json_decode(stripcslashes($previous_year_rating), true);

                        foreach($previous_year_ratings as $previous_year_rating){ ?>

                            <td>
                                <strong>Year: </strong> <a href="<?php echo $previous_year_rating['rating_file_link']; ?>"><?php echo $previous_year_rating['year']; ?></a>
                                <br>
                                <strong>Rating: </strong><?php echo str_replace("u00a0"," ", $previous_year_rating['rating']); ?>
                            </td>


                        <?php }

                    } ?>

                </tr>
                <?php
            }

        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php if(is_user_logged_in()){

    if ( !function_exists( 'w3tc_pgcache_flush_post' ) ) { 
        require_once '/w3-total-cache-api.php'; 
    } 
    
    global $wpdb;

    $rel_news = "SELECT DISTINCT wp_posts.ID FROM wp_posts WHERE wp_posts.post_type = 'job' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') ORDER BY wp_posts.post_date ASC";
    
    $rel_news = $wpdb->get_results($rel_news, ARRAY_A);

    if( !empty( $rel_news ) ){

        $count = 0;

        print_r($rel_news);

        foreach ($rel_news as $news) {

            $post_id = $news['ID'];

            if (function_exists('w3tc_pgcache_flush_post')){

                $result = w3tc_pgcache_flush_post($post_id);
                var_dump($result);

                $count++;
            }
        }
    }
    echo $count;
} ?>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Category</th>
            <th>Title</th>
            <th>URL</th>
        </tr>

        <?php

        global $wpdb;

        $rel_news = 'SELECT ID, post_title, post_status FROM `wp_posts` WHERE `post_title` LIKE "%adec%" OR `post_content` LIKE "%adec%"';
        
        $rel_news = $wpdb->get_results($rel_news);

        foreach ($rel_news as $value) {

            $link = get_the_permalink($value->ID); ?>

        <tr>
            <td><?php echo $value->post_title; ?></td>
            <td><a href="<?php echo $link; ?>" target="_blank"><?php echo $link; ?></a></td>
            <td><?php echo $value->post_status; ?></td>
        </tr>

        <?php } ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Category</th>
            <th>Title</th>
            <th>URL</th>
        </tr>

        <?php

        global $wpdb;

        $rel_news = 'SELECT term_id, taxonomy FROM `wp_term_taxonomy` WHERE `description` LIKE \'%href="https://www.edarabia.com/"%\' OR `description` LIKE \'%href="https://www.edarabia.com"%\' OR `description` LIKE \'%href="www.edarabia.com"%\' OR `description` LIKE \'%href="https://edarabia.com"%\' OR `description` LIKE \'%href="edarabia.com"%\'';
        
        $rel_news = $wpdb->get_results($rel_news);

        foreach ($rel_news as $value) {

            $term = get_term_by('term_id', $value->term_id, $value->taxonomy); ?>

        <tr>
            <td><?php echo $value->taxonomy; ?></td>
            <td><?php echo $term->name; ?></td>
            <td><a href="<?php echo get_term_link($term); ?>" target="_blank"><?php echo get_term_link($term); ?></a></td>
        </tr>

        <?php } ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Category</th>
            <th>Title</th>
            <th>URL</th>
        </tr>

        <?php

        global $wpdb;

        $rel_news = 'SELECT ID, post_title, post_type FROM wp_posts WHERE post_content LIKE \'%href="https://www.edarabia.com/"%\' OR post_content LIKE \'%href="https://www.edarabia.com"%\' OR post_content LIKE \'%href="www.edarabia.com"%\' OR post_content LIKE \'%href="https://edarabia.com"%\' OR post_content LIKE \'%href="edarabia.com"%\'';
        
        $rel_news = $wpdb->get_results($rel_news);

        foreach ($rel_news as $value) { ?>

        <tr>
            <td><?php echo $value->post_type; ?></td>
            <td><?php echo $value->post_title; ?></td>
            <td><a href="<?php echo get_the_permalink($value->ID); ?>" target="_blank"><?php echo get_the_permalink($value->ID); ?></a></td>
        </tr>

        <?php } ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php 

global $wpdb;

$users = $wpdb->get_results("SELECT u.ID, u.user_firstname, u.profile_picture FROM wp_users_front u WHERE u.user_status= 1 AND u.profile_picture IS NOT NULL LIMIT 7000, 3000" );

$counter = 0;

foreach ($users as $user) {

    $old_file_path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/'.$user->profile_picture;

    if (file_exists($old_file_path)) {

        $dir_path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/normal-users/';
        $year_folder = $dir_path.date("Y", filemtime($old_file_path));
        $month_folder = $year_folder . '/' . date("m", filemtime($old_file_path));
        !file_exists($year_folder) && mkdir($year_folder , 0777);
        !file_exists($month_folder) && mkdir($month_folder, 0777);

        $pappu = explode('normal-users/', $user->profile_picture);

        $file_name = $pappu[1];

        $newFilePath = $month_folder.'/'.$file_name;

        $fileMoved = rename($old_file_path, $newFilePath);

        if($fileMoved){

            $savepicpath = explode("wp-content/", $newFilePath);

            $savepicpath = $savepicpath[1]; 
            
            $data = array('profile_picture' => $savepicpath);

            $where_clause = array(
                    'ID' => $user->ID
                );
            $update_meta = $wpdb->update('wp_users_front', $data, $where_clause);

            if( $update_meta ){
                $counter++;
            }
        }
    }
    
}

echo $counter; ?>

--------------------------------------------------------------------------------------------------


<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Date</th>
            <th>Image Width</th>
            <th>Title</th>
            <th>URL</th>
        </tr>

        <?php

        global $wpdb;

        $search_query = 'SELECT ID, post_date FROM `wp_posts` WHERE `post_type` = "blogs" AND (wp_posts.post_status = "publish" OR wp_posts.post_status = "private")';
        
        $search_results = $wpdb->get_results($search_query);

        foreach ($search_results as $value) {

            $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ), "full" );

            $image_width = $image_data[1]; ?>

            <tr>
                <td><?php echo $value->post_date; ?></td>
                <td><?php echo $image_width; ?></td>
                <td><?php echo get_the_title($value->ID); ?></td>
                <td><a href="<?php echo get_the_permalink($value->ID); ?>" target="_blank"><?php echo get_the_permalink($value->ID); ?></a></td>
            </tr>                    

        <?php } ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php

$job_types = get_terms( 'job_types', array(
    'hide_empty' => false,
) );

$job_locs = get_terms( 'job_category', array(
    'hide_empty' => false,
) ); ?>

<section>

    <div class="row">

        <div class="content-box news-post">

            <table border="1">

                <tr>
                    <th>Country City</th>

                    <?php foreach ( $job_types as $job_type ) { ?>
                    <th><?php echo $job_type->name; ?></th>
                    <?php } ?>
                </tr>

                <?php foreach ( $job_locs as $job_loc ) {

                $pappu = $job_loc->term_taxonomy_id; ?>

                <tr>
                    <td><?php echo $job_loc->name; ?></td>

                    <?php foreach ( $job_types as $job_type ) {

                        $gama = $job_type->term_taxonomy_id;

                        $get_total_rows = $wpdb->get_results("SELECT COUNT(ID) AS total FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_relationships AS tt1 ON (wp_posts.ID = tt1.object_id) WHERE wp_posts.post_type = 'job' AND ( wp_term_relationships.term_taxonomy_id IN ($pappu) AND tt1.term_taxonomy_id IN ($gama) ) AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID"); ?>
                        
                        <td><?php echo count($get_total_rows); ?></td>

                    <?php } ?>
                </tr>
                <?php } ?>
            </table>

        </div>

    </div>

</section>

--------------------------------------------------------------------------------------------------

<?php 

global $wpdb;

$rel_news = "SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts WHERE wp_posts.post_type IN ('language-institute','performing-art','training-tutoring','special_needs','university','school','nursery','sports-fitness-club','recruite-agency','school-activity','online-universities','education-supplier') AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') LIMIT 21500, 1000";

$rel_news = $wpdb->get_results($rel_news);

if( !empty( $rel_news ) ){

    foreach ($rel_news as $news) {

        $id = $news->ID;

        $check_rating = $wpdb->get_results("SELECT * FROM `wp_yasr_log` WHERE `post_id` = $id");

        print_r($check_rating);
    }
} ?>

--------------------------------------------------------------------------------------------------

<?php 

function rrmdir($src) {

    $dir = opendir($src);
    
    while(false !== ( $file = readdir($dir)) ) {
    
        if (( $file != '.' ) && ( $file != '..' )) {
    
            $full = $src . '/' . $file;
    
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }

    closedir($dir);
    rmdir($src);
}

global $wpdb;

$users = $wpdb->get_results("SELECT u.ID, u.user_firstname, u.profile_picture FROM wp_users_front u WHERE u.user_status= 1 AND u.profile_picture IS NOT NULL LIMIT 6100, 4000" );

//echo count($users);

foreach ($users as $user) {

    $name = explode("/", $user->profile_picture);

    $new_name = explode("_", $name[2]);

    $ext = end(explode(".", end($name)));

    $final_name = $user->ID.'_'.$new_name[1].'.'.$ext;

    $folder_path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/normal-users/'.$name[2];

    $file_path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/'.$user->profile_picture;

    $des_path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/normal-users/'.$final_name;

    // echo $file_path."<br>";
    // echo $des_path."<br>";

    if (copy($file_path, $des_path)) {

        rrmdir($folder_path);

        $data = array('profile_picture' => 'uploads/normal-users/'.$final_name);
        $where_clause = array( 'ID' => $user->ID );

        if( $wpdb->update( 'wp_users_front', $data, $where_clause) ) {

            echo "True...\n";                    
        }
    }
} ?>

--------------------------------------------------------------------------------------------------

<table class="table">

    <tr>
        <th>Title</th>
        <th>URL</th>
    </tr>

    <?php 

    $query = new WP_Query(
                            array(
                                'post_type' => 'page',
                                'posts_per_page' => -1
                            )
                        );
    $rel_news = $query->posts;

    if( !empty( $rel_news ) ){

        foreach ($rel_news as $news) {

            $tag = strtolower(get_the_title());
            $tag = str_replace(" ","-",$tag);

            $terms = get_terms( 'post_tag', array(
                                        'slug' => $tag,
                                        'hide_empty' => false,
                                    ) );


            if ( empty( $terms ) || is_wp_error( $terms ) ){ ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo get_the_permalink($news->ID); ?></a></td>
                </tr>
                <?php
            }
        }
    } ?>

</table>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Country/City</th>
            <th>URL</th>
        </tr>

        <?php

        $post_type_obj = get_post_type_object("employer");

        $post_type_label = strtolower($post_type_obj->label);

        $school_locs = get_terms( 'employer_categories', array(
                        'hide_empty' => true,
                    ) );

        foreach ($school_locs as $value) {

            $tag = $post_type_label."-in-".$value->slug;

            $terms = get_terms( 'post_tag', array(
                                                'slug' => $tag,
                                                'hide_empty' => false,
                                            ) );

            if ( empty( $terms ) || is_wp_error( $terms ) ){ ?>

                <tr>
                    <td><?php echo $post_type_obj->label.' in '.$value->name; ?></td>
                    <td><a href="<?php echo get_term_link($value); ?>"><?php echo get_term_link($value); ?></a></td>
                </tr>

                <?php 
            } 
        }?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php

global $wpdb;

$search_query = "SELECT * FROM `wp_postmeta_university` WHERE `meta_key` = 'gallery'";

$search_results = $wpdb->get_results($search_query);

echo "<pre>";

$count = 0;

$verified = 0;

foreach ($search_results as $value) {

    $pappu = unserialize($value->meta_value);

    $gama = json_encode($pappu);

    $data = array('meta_value' => $gama);

    $where_clause = array(
                'post_id' => $value->post_id,
                'meta_key' => 'gallery'
            );

    $update_meta = $wpdb->update('wp_postmeta_university', $data, $where_clause);

    if( $update_meta == false ) {

        echo $value->post_id." == false"."<br>";

    }else{

        $verified++;

        echo "true"."<br>";
    }

    $count++;
}

echo "</pre>";

echo $count.' --- '.$verified; ?>

--------------------------------------------------------------------------------------------------

<table>

    <tr>
        <th>Title</th>                    
        <th>Emails</th>
    </tr>

    <?php 

    $query = new WP_Query(
                            array(
                                'post_type' => 'school',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                                      array(
                                                          'taxonomy' => 'school_categories',
                                                          'field'    => 'slug',
                                                          'terms'    =>  array("dubai")
                                                      )
                                                  )
                            )
                        );
    $rel_news = $query->posts;

    if( !empty( $rel_news ) ){

        foreach ($rel_news as $news) {

            if( get_listing_meta($news->ID, 'email', 'school') ){

                $pappu = explode(',', get_listing_meta($news->ID, 'email', 'school'));

                for ($i=0; $i < count($pappu); $i++) { ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><?php echo $pappu[$i]; ?></td>
                </tr>

                <?php } ?>
            
            <?php }else if( get_listing_meta($news->ID, 'job_email', 'school') ){

                $pappu = explode(',', get_listing_meta($news->ID, 'job_email', 'school'));

                for ($i=0; $i < count($pappu); $i++) { ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><?php echo $pappu[$i]; ?></td>
                </tr>

                <?php } ?>
            
            <?php }else if( get_listing_meta($news->ID, 'event_email', 'school') ){

                $pappu = explode(',', get_listing_meta($news->ID, 'event_email', 'school'));

                for ($i=0; $i < count($pappu); $i++) { ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><?php echo $pappu[$i]; ?></td>
                </tr>

                <?php } ?>
            
            <?php }else if( get_listing_meta($news->ID, 'contact_person_email_1', 'school') ){

                $pappu = explode(',', get_listing_meta($news->ID, 'contact_person_email_1', 'school'));

                for ($i=0; $i < count($pappu); $i++) { ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><?php echo $pappu[$i]; ?></td>
                </tr>

                <?php } ?>
            
            <?php }else if( get_listing_meta($news->ID, 'contact_person_email_2', 'school') ){

                $pappu = explode(',', get_listing_meta($news->ID, 'contact_person_email_2', 'school'));

                for ($i=0; $i < count($pappu); $i++) { ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><?php echo $pappu[$i]; ?></td>
                </tr>

                <?php } ?>
            
            <?php }
        }
    } ?>

</table>

--------------------------------------------------------------------------------------------------

<table>

    <tr>
        <th>Title</th>
        <th>URL</th>
        <th>City, Country</th>
        <th>Premium</th>
    </tr>

    <?php 

    $query = new WP_Query(
                            array(
                                'post_type' => 'nursery',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                                      array(
                                                          'taxonomy' => 'nursery_categories',
                                                          'field'    => 'slug',
                                                          'terms'    =>  array("abu-dhabi")
                                                      )
                                                  )
                            )
                        );
    $rel_news = $query->posts;

    if( !empty( $rel_news ) ){

        foreach ($rel_news as $news) { ?>

            <tr>
                <td><?php echo $news->post_title; ?></td>
                <td><a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo get_the_permalink($news->ID); ?></a></td>
                <td>Abu Dhabi, UAE</td>
                <td><?php echo get_listing_meta($news->ID, 'member', 'nursery'); ?></td>
            </tr>
            <?php
        }
    }

    ?>

</table>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Country/City</th>
        </tr>

        <?php

        $school_locs = get_terms( 'school_categories', array(
                        'hide_empty' => true,
                    ) );

        foreach ($school_locs as $value) {
        if( $value->count >= 5 ){ ?>
        <tr>
            <td>Schools in <?php echo $value->name; ?></td>
        </tr>

        <?php }} ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
            <th>Category</th>
            <th>Dubai</th>
            <th>Abu Dhabi</th>
            <th>Sharjah</th>
        </tr>

        <?php

        $course_cats = get_terms( 'type', array(
                        'hide_empty' => false,
                    ) );

        foreach ($course_cats as $value) { ?>

        <tr>
            <td><?php echo $value->name; ?></td>
            <td><a href="<?php echo get_site_url().'/courses/for/'.$value->slug.'/at/dubai/'; ?>" target="_blank"><?php echo get_site_url().'/courses/for/'.$value->slug.'/at/dubai/'; ?></a></td>
            <td><a href="<?php echo get_site_url().'/courses/for/'.$value->slug.'/at/abu-dhabi/'; ?>" target="_blank"><?php echo get_site_url().'/courses/for/'.$value->slug.'/at/abu-dhabi/'; ?></a></td>
            <td><a href="<?php echo get_site_url().'/courses/for/'.$value->slug.'/at/sharjah/'; ?>" target="_blank"><?php echo get_site_url().'/courses/for/'.$value->slug.'/at/sharjah/'; ?></a></td>
        </tr>

        <?php } ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
          <th>Title</th>
          <th>URL</th>
          <th>Category</th>
        </tr>

        <?php

        global $wpdb;

        $search_query = 'SELECT ID FROM `wp_posts` WHERE `post_title` LIKE "%adec%" OR `post_content` LIKE "%adec%"';
        
        $search_results = $wpdb->get_results($search_query);

        foreach ($search_results as $value) { ?>

            <tr>
                <td><?php echo get_the_title($value->ID); ?></td>
                <td><?php echo get_the_permalink($value->ID); ?></td>
                <td><?php echo get_post_type($value->ID); ?></td>
            </tr>                    

        <?php } ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<table>

    <tr>
        <th>Title</th>
        <th>URL</th>
        <th>Previous Year Rating</th>

    </tr>

    <?php 

    $query = new WP_Query(
                            array(
                                'post_type' => 'school',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                                      array(
                                                          'taxonomy' => 'school_categories',
                                                          'field'    => 'slug',
                                                          'terms'    =>  array("al-ain","abu-dhabi")
                                                      )
                                                  )
                            )
                        );
    $rel_news = $query->posts;

    if( !empty( $rel_news ) ){

        foreach ($rel_news as $news) {

            $previous_year_ratings = get_listing_meta($news->ID, 'previous_year_rating', 'school');

            if( $previous_year_ratings ){ ?>

                <tr>
                    <td><?php echo $news->post_title; ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo get_the_permalink($news->ID); ?></a></td>
                    
                    <td>
                        <?php
                        $previous_year_ratings = unserialize($previous_year_ratings);
                        foreach($previous_year_ratings as $previous_year_rating){

                            echo "<strong>".$previous_year_rating['year']."</strong>: ".$previous_year_rating['rating']." ";
                            echo $previous_year_rating['rating_file_link'] ? " (Yes)"." | " : " (No)"." | ";

                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
    }

    ?>

</table>

--------------------------------------------------------------------------------------------------

<table>

    <tr>
        <th>Title</th>
        <th>URL</th>
        <th>Content Status</th>
    </tr>

    <?php

    $query = new WP_Query(
                            array(
                                'post_type' => 'fees_links',
                                'posts_per_page' => -1,
                            )
                        );
    $rel_news = $query->posts;


    if( !empty( $rel_news ) ){

        foreach ($rel_news as $news) {
            $check_cont = $news->post_content; ?>
            <tr>
              <td><?php echo get_the_title($news->ID); ?></td>
              <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
              <td><?php if( $check_cont != "" ){ echo "Yes";}else{echo "No";} ?></td>
            </tr>
            <?php
        }
    } ?>

</table>

--------------------------------------------------------------------------------------------------

<table>

    <tr>
        <th>Title</th>
        <th>URL</th>
        <th>Start Date</th>
        <th>End Date</th>
    </tr>

    <?php

    $query = new WP_Query(
                            array(
                                'post_type' => 'event_activity',
                                'posts_per_page' => -1,
                            )
                        );
    $rel_news = $query->posts;


    if( !empty( $rel_news ) ){

        foreach ($rel_news as $news) { 

            $start_date = get_listing_meta($news->ID, 'start_date', 'event_activity');
            $end_date = get_listing_meta($news->ID, 'end_date', 'event_activity'); ?>
            <tr>
                <td><?php echo get_the_title($news->ID); ?></td>
                <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                <td>
                    <?php
                    if( $start_date ){
                        $start_date_obj = new DateTime($start_date);
                        echo $event_start_date = $start_date_obj->format('j M Y');
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if( $end_date ){
                        $end_date_obj = new DateTime($end_date);
                        echo $event_end_date = $end_date_obj->format('j M Y');
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
    } ?>

</table>

--------------------------------------------------------------------------------------------------

<div class="table-responsive">
    <table class="table">

        <tr>
          <th>Title</th>
          <th>Meta Title</th>
          <th>Meta Desc</th>
          <th>URL</th>
          <th>Category</th>
        </tr>

        <?php

        global $wpdb;

        //$search_query = 'SELECT ID FROM `wp_posts` WHERE `post_title` LIKE "%2018%"';

        $search_query = 'SELECT post_id FROM `wp_postmeta` WHERE `meta_key` IN ("_yoast_wpseo_title","_yoast_wpseo_metadesc")';
        
        $search_results = $wpdb->get_results($search_query);

        foreach ($search_results as $value) { ?>

            <tr>
                <td><?php echo get_the_title($value->post_id); ?></td>
                <td><?php echo get_post_meta($value->post_id, '_yoast_wpseo_title', true); ?></td>
                <td><?php echo get_post_meta($value->post_id, '_yoast_wpseo_metadesc', true); ?></td>
                <td><?php echo get_the_permalink($value->post_id); ?></td>
                <td><?php echo get_post_type($value->post_id); ?></td>
            </tr>
        

        <?php } ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php

global $wpdb;

$search_query = "SELECT * FROM `wp_postmeta_course` WHERE `meta_key` = 'company_listing' AND `meta_value` != ''";

$search_results = $wpdb->get_results($search_query);

$count = 0;

foreach ($search_results as $value) {

    $pappu = get_post_type($value->meta_value);
    $data = array(
            'post_id' => $value->post_id,
            'meta_key' => 'course_listing_type',
            'meta_value' => $pappu
        );

    $wpdb->insert('wp_postmeta_course', $data);
    $count++;
}

echo $count++; ?>

--------------------------------------------------------------------------------------------------

<table>

    <tr>
        <th>Title</th>
        <th>URL</th>
        <th>Website</th>
        <th>Embed PDF</th>
        <th>Government Rating</th>
        <th>Report Link</th>
        <th>Report Title</th>
        <th>Previous Year Rating</th>
    </tr>

    <?php 

    $query = new WP_Query(
                            array(
                                'post_type' => 'school',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                                      array(
                                                          'taxonomy' => 'school_categories',
                                                          'field'    => 'slug',
                                                          'terms'    =>  array("dubai")
                                                      )
                                                  )
                            )
                        );
    $rel_news = $query->posts;

    if( !empty( $rel_news ) ){

        foreach ($rel_news as $news) { ?>

            <tr>
                <td><?php echo $news->post_title; ?></td>
                <td><a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo get_the_permalink($news->ID); ?></a></td>
                <td><?php echo get_listing_meta($news->ID, 'website', 'school'); ?></td>
                <td><?php echo get_listing_meta($news->ID, 'embedd_pdf', 'school') ? "Yes" : "No"; ?></td>
                <td><?php echo get_listing_meta($news->ID, 'government_rating', 'school'); ?></td>
                <td><?php echo get_listing_meta($news->ID, 'report_link', 'school'); ?></td>
                <td><?php echo get_listing_meta($news->ID, 'report_title', 'school'); ?></td>
                <td><?php echo get_listing_meta($news->ID, 'previous_year_rating', 'school') ? "Yes" : "No"; ?></td>
            </tr>
            <?php
        }
    }

    ?>

</table>

--------------------------------------------------------------------------------------------------

<?php 

$job_types = get_terms( 'school_curriculum', array(
    'hide_empty' => false,
) );


$job_locs = get_terms( 'school_categories', array(
    'hide_empty' => false,
) ); ?>

<section>

    <div class="row">

      <div class="content-box news-post">

        <table border=1>

          <tr>
            <th>Country City</th>

            <?php foreach ( $job_types as $job_type ) { ?>
            <th><?php echo $job_type->name; ?></th>
            <?php } ?>
          </tr>



          <?php foreach ( $job_locs as $job_loc ) { ?>
          <tr>
            <td><?php echo $job_loc->name; ?></td>

            <?php foreach ( $job_types as $job_type ) {

                $custom_name = str_replace("-", "_", $job_type->slug);

                $term_meta = get_listing_termmeta($job_loc->term_id,$job_loc->taxonomy);
                
                $check_con = $term_meta[$custom_name];  ?>
            <td>
            
              <?php 

              echo $check_con ? "Yes" : "No";

              global $wpdb;

              $get_total_rows = "SELECT COUNT(ID) AS total FROM wp_posts INNER JOIN wp_postmeta_school ON ( wp_posts.ID = wp_postmeta_school.post_id ) INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) INNER JOIN wp_term_relationships AS tt1 ON (wp_posts.ID = tt1.object_id) WHERE wp_posts.post_type = 'school' AND wp_postmeta_school.meta_key = 'member' AND ( wp_term_relationships.term_taxonomy_id IN ($job_type->term_taxonomy_id) AND tt1.term_taxonomy_id IN ($job_loc->term_taxonomy_id) ) AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID";

              $get_total_rows = $wpdb->get_results($get_total_rows);

              echo " (".count($get_total_rows).")";

              ?>
            
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>

      </div>

    </div>

</section>

--------------------------------------------------------------------------------------------------

<?php

$job_locs = get_terms( 'university_subject', array(
    'hide_empty' => false,
) ); ?>

<section>

    <div class="row">

      <div class="content-box news-post">

        <table border=1>

          <tr>
            <th>Universities Subjects</th>
            <th>Universities Count</th>
            <th>Content Status</th>                    
          </tr>
          <?php foreach ( $job_locs as $job_loc ) { ?>
          <tr>
            <td><a href="https://www.edarabia.com/universities/new/<?php echo $job_loc->slug; ?>/" target="_blank"><?php echo $job_loc->name; ?></a></td>
            <td><?php echo $job_loc->count; ?></td>
            <td><?php echo $job_loc->description ? "Yes" : "No"; ?></td>                    
          </tr>
          <?php } ?>
        </table>

      </div>

    </div>

</section>

--------------------------------------------------------------------------------------------------

<table>

    <tr>
      <th>Title</th>
      <th>URL</th>
    </tr>

    <?php

    $query = new WP_Query(
                            array(
                                'post_type' => 'school',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                                      array(
                                                          'taxonomy' => 'school_categories',
                                                          'field'    => 'slug',
                                                          'terms'    =>  array("qatar","bahrain","singapore","malaysia","hong-kong","egypt","kuwait")
                                                      )
                                                  )
                            )
                        );
    $rel_news = $query->posts;

    if( !empty( $rel_news ) ){


        foreach ($rel_news as $news) {

            $status = false;

            $fees_content = get_listing_meta($news->ID, 'fees_content', 'school');

            if( $fees_content ){

                preg_match('/<table [^>]*>(.*?)<\/table>/is', $fees_content, $matches);

                if( !empty($matches) ){
                    $status = true;
                }else{
                    $status = false;
                }
            }

            $admission_content = get_listing_meta($news->ID, 'admission_content', 'school');

            if( $admission_content ){

                preg_match('/<table [^>]*>(.*?)<\/table>/is', $admission_content, $matches);

                if( !empty($matches) ){
                    $status = true;
                }else{
                    $status = false;
                }
            }

            if( $status ){ ?>
                <tr>
                    <td><?php echo get_the_title($news->ID); ?></td>
                    <td><a href="<?php echo get_the_permalink($news->ID); ?>" target="_blank"><?php echo get_the_permalink($news->ID); ?></a></td>
                </tr>

                <?php 
            }
        }

    } ?>

</table>

--------------------------------------------------------------------------------------------------

<?php 

global $wpdb;

$search_query = "SELECT wp_posts.ID FROM wp_posts LEFT JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE ( wp_postmeta.meta_key = 'expiry_date' AND wp_postmeta.meta_value != '' ) AND wp_posts.post_type IN ('university','online-universities','school','nursery','special_needs','training-tutoring','school-activity','art-gallery','education-supplier','language-institute','performing-art','recruite-agency','sports-fitness-club','abroad-study','academic-pathway','employer') AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_postmeta.meta_value+0 DESC";

$search_results = $wpdb->get_results($search_query);

$count = 0;

$job_count = 0;

$course_count = 0;        

foreach ($search_results as $result) {

    $post_ID = $result->ID;

    $post_group = get_post_type($post_ID);

    $member = get_listing_meta($post_ID, "member", $post_group );

    if( $member == "Yes" ){

        $count++;

        $member_value = 'Yes';

        // Updates Jobs & Course Membership
        $get_meta_jobs = "SELECT post_id FROM wp_postmeta_job WHERE meta_key = 'company_listing' AND meta_value = $post_ID";

        $get_meta_jobs =  $wpdb->get_results($get_meta_jobs);

        if( !empty($get_meta_jobs) ){

            foreach ($get_meta_jobs as $job) {

                $job_count++;
                update_listing_meta($job->post_id, "member", $member_value, 'job');
            }
        }

        $get_meta_course = "SELECT post_id FROM wp_postmeta_course WHERE meta_key = 'company_listing' AND meta_value = $post_ID";

        $get_meta_course =  $wpdb->get_results($get_meta_course);

        if( !empty($get_meta_course) ){

            foreach ($get_meta_course as $course) {

                $course_count++;

                update_listing_meta($course->post_id, "member", $member_value, 'course');
            }
        }
    
    }
}

echo $count.'------------------'.$job_count.'------------------'.$course_count; ?>
        
--------------------------------------------------------------------------------------------------

<table>

    <tr>
      <th>Title</th>
      <th>URL</th>
      <th>Content Status</th>
    </tr>

    <?php

    /*$query = new WP_Query(
                            array(
                                'post_type' => 'fees_links',
                                'posts_per_page' => -1,
                                // 'meta_key' => '_wp_page_template',
                                // 'meta_value' => 'templates/template-public-holidays.php'
                            )
                        );
    $rel_news = $query->posts;*/


    $rel_news = get_terms( 'school_categories', array('hide_empty' => false) );

    if( !empty( $rel_news ) ){

      foreach ($rel_news as $news) { 

        //$check_cont = $news->post_content; ?>
        <!-- <tr>
          <td><?php //echo get_the_title($news->ID); ?></td>
          <td><a href="<?php //echo get_the_permalink($news->ID); ?>" target="_blank"><?php //echo get_the_permalink($news->ID); ?></a></td>
          <td>
            
            <?php //if( $check_cont != "" ){ echo "Yes";}else{echo "No";} ?>
            </td>
        </tr> -->

        <tr>
          <td>Schools in <?php echo $news->name; ?></td>
          <td><a href="<?php echo get_term_link($news); ?>" target="_blank"><?php echo get_term_link($news); ?></a></td>
          <td>
            
            <?php if( $news->description != "" ){ echo "Yes";}else{echo "No";} ?>
            </td>
        </tr>

        <?php
        }
    } ?>

</table>

--------------------------------------------------------------------------------------------------
    
<?php

/*---------------------------------------------*/
/*			Jobs Sub Pages Content Query
/*---------------------------------------------*/

$job_types = get_terms( 'job_types', array(
    'hide_empty' => false,
) );


$job_locs = get_terms( 'job_category', array(
    'hide_empty' => false,
) ); ?>

<section>

    <div class="row">

      <div class="content-box news-post">

        <table border=1>

          <tr>
            <th>Country City</th>

            <?php foreach ( $job_types as $job_type ) { ?>
            <th><?php echo $job_type->name; ?></th>
            <?php } ?>
          </tr>



          <?php foreach ( $job_locs as $job_loc ) { ?>
          <tr>
            <td><?php echo $job_loc->name; ?></td>

            <?php foreach ( $job_types as $job_type ) {


                if ($job_type->name == 'IT') {

                    $custom_name = 'information_technology';

                } else {

                    $custom_name = str_replace("-", "_", $job_type->slug);

                }

                $term_meta = get_listing_termmeta($job_loc->term_id,$job_loc->taxonomy);
                
                $check_con = $term_meta[$custom_name];  ?>
            <td>
            
              <?php 

              echo $check_con ? "Yes" : "No";

              global $wpdb;

              $get_total_rows = "SELECT COUNT(ID) AS total FROM wp_posts INNER JOIN wp_postmeta_job ON ( wp_posts.ID = wp_postmeta_job.post_id ) INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) INNER JOIN wp_term_relationships AS tt1 ON (wp_posts.ID = tt1.object_id) WHERE wp_posts.post_type = 'job' AND wp_postmeta_job.meta_key = 'member' AND ( wp_term_relationships.term_taxonomy_id IN ($job_type->term_taxonomy_id) AND tt1.term_taxonomy_id IN ($job_loc->term_taxonomy_id) ) AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID";

              $get_total_rows = $wpdb->get_results($get_total_rows);

              echo " (".count($get_total_rows).")";

              ?>
            
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>

      </div>

    </div>

</section>

--------------------------------------------------------------------------------------------------

<?php

/*---------------------------------------------*/
/*    Listing Dates Update
/*---------------------------------------------*/
      
$datetime = date("Y-m-d H:i:s");

global $wpdb;

global $post_types_arr;

$number = $_GET['number'];

$post_types = "('".implode("','", $post_types_arr)."')";

$rel_news = "SELECT DISTINCT ID FROM wp_posts WHERE wp_posts.post_type IN $post_types AND wp_posts.post_status = 'publish' LIMIT $number, 10000"; //47990

$rel_news = $wpdb->get_results($rel_news);

if( !empty( $rel_news ) ){

    $count = 0;

    foreach ($rel_news as $news) {

        $id = $news->ID;

        $pappu = "UPDATE $wpdb->posts SET post_modified = '$datetime', post_modified_gmt = '$datetime' WHERE ID = $id";

        $wpdb->get_results($pappu);

        $count++;
    }
}

echo $count; ?>

--------------------------------------------------------------------------------------------------

<?php 

/*---------------------------------------------*/
/*		Monthly Inquiries & Comments Stats
/*---------------------------------------------*/

//Leads

DELETE FROM `wp_inquiries` WHERE `inquiry_date` = "0000-00-00 00:00:00"

SELECT * FROM `wp_inquiries` WHERE `inquiry_status` = "1" AND `inquiry_type` = "" | 138742 

SELECT * FROM `wp_inquiries` WHERE `inquiry_status` = "1" AND `inquiry_type` = "" AND `inquiry_date` LIKE "2020-01-%" | 1568

SELECT * FROM `wp_inquiries` WHERE `inquiry_status` = "1" AND `inquiry_type` = "" AND `inquiry_date` LIKE "2019-12-%" | 7551 

SELECT * FROM `wp_inquiries` WHERE `inquiry_status` = "1" AND `inquiry_type` = "secondary" AND `inquiry_date` LIKE "2019-12-%" | 7587

//Comments


SELECT * FROM `wp_comments` WHERE `comment_date` LIKE "2019-12-%" ORDER BY `wp_comments`.`comment_date` ASC | 160

SELECT * FROM `wp_comments` WHERE `comment_date` LIKE "2019-12-%" AND `comment_approved` = 1 ORDER BY `wp_comments`.`comment_date` ASC | 138 ?>

--------------------------------------------------------------------------------------------------

<?php

/*---------------------------------------------*/
/*    Export Emails from Inquiries
/*---------------------------------------------*/ ?>

<div class="table-responsive">

    <table>

        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>URL</th>
            <th>Name</th>
            <th>Email</th>
            <th>City, Country</th>
        </tr>

        <?php 

        $rel_news = 'SELECT * FROM wp_inquiries WHERE inquiry_type = "" GROUP BY email ORDER BY inquiry_date';

        $rel_news = $wpdb->get_results($rel_news);

        if( !empty( $rel_news ) ){

            foreach ($rel_news as $news) {

                $id = $news->post_id;

                if( get_post_type($id) == 'university' ){

                    $terms = wp_get_post_terms($id, 'university_categories');

                    $terms = wp_list_pluck( $terms, 'name' );

                    $pappu = in_array_r('Sharjah', $terms) ? true : false;

                    if( $pappu == 1 ) { ?>

                        <tr>
                            <td><?php echo $news->inquiry_date; ?></td>
                            <td><?php echo get_post_type($id); ?></td>
                            <td><?php echo get_the_permalink($id); ?></td>
                            <td><?php echo $news->name; ?></td>
                            <td><?php echo $news->email; ?></td>
                            <td>
                            <?php foreach ($terms as $value) { echo $value.', ';} ?> </td>  
                        </tr>

                        <?php
                    }
                }
            }
        } ?>

    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php

/*---------------------------------------------*/
/*    Delete Extra Categories post count
/*---------------------------------------------*/

$curr = get_term_by('slug', 'curriculum', 'nursery_categories');

$curr = $curr->term_taxonomy_id;

global $wpdb;

$nursery_list = $wpdb->get_results( "SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN ($curr) ) AND wp_posts.post_type = 'nursery' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC" );

if( !empty($nursery_list) ){

    foreach ($nursery_list as $value) {

        wp_remove_object_terms($value->ID, 'curriculum', 'nursery_categories');
        echo '<a href="'.get_the_permalink($value->ID).'">'.get_the_title($value->ID).'</a>';
        echo "<br><br>";
    }
} ?>

--------------------------------------------------------------------------------------------------

<?php 

/*---------------------------------------------*/
/*    Thin content Queries
/*---------------------------------------------*/

$args = array(

            'post_type' => 'page',
            'posts_per_page' => -1
        );
              
$query = new WP_Query( $args ); ?>

<div class="table-responsive">

    <table border="1">

        <tr>
            <th>Content Count</th>
            <th>Name</th>
            <th>URL</th>
        </tr>

        <?php if ( $query->posts ) {

            $posts = $query->posts;

            foreach ($posts as $post) {

                $post_content_count =  str_word_count($post->post_content);

                if( $post_content_count <= 500 ){ ?>

                    <tr>
                        <td><?php echo $post_content_count;?></td>
                        <td><?php echo $post->post_title; ?></td>
                        <td><a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>"><?php echo get_permalink($post->ID); ?></a></td>
                    </tr>
                    <?php
                }
            }
        } ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php $terms = get_terms('job_category'); ?>

<div class="table-responsive">

    <table border="1">

        <tr>
            <th>Content Count</th>
            <th>Name</th>
            <th>URL</th>
        </tr>

        <?php if ( $terms ) {

            foreach ($terms as $term) {

                $term_content_count =  str_word_count($term->description);

                if( $term_content_count <= 500 ){ ?>

                    <tr>
                        <td><?php echo $term_content_count;?></td>
                        <td><?php echo $term->name; ?></td>
                        <td><a href="<?php echo get_term_link($term); ?>" title="<?php echo $term->name; ?>"><?php echo get_term_link($term); ?></a></td>                                
                    </tr>

                    <?php 
                }
            }

        } ?>
    </table>
</div>

--------------------------------------------------------------------------------------------------

<?php

$job_types = get_terms( 'job_types', array(
    'hide_empty' => false,
) );

$job_locs = get_terms( 'job_category', array(
    'hide_empty' => false,
) ); ?>

<section>

    <div class="row">

        <div class="content-box news-post">

            <table border="1">

                <tr>
                    <th>Country City</th>

                    <?php foreach ( $job_types as $job_type ) { ?>
                    <th><?php echo $job_type->name; ?></th>
                    <?php } ?>
                </tr>

                <?php foreach ( $job_locs as $job_loc ) { ?>
                <tr>
                    <td><?php echo $job_loc->name; ?></td>

                    <?php foreach ( $job_types as $job_type ) {

                        $term_meta = get_listing_termmeta($job_loc->term_id, $job_loc->taxonomy);

                        $check_con = str_word_count($term_meta[$job_type->slug]);

                        if( $check_con <= 500 ){ ?>
                        
                        <td><?php echo $check_con; ?></td>
                        <?php } ?>

                    <?php } ?>
                </tr>
                <?php } ?>
            </table>

        </div>

    </div>

</section>

--------------------------------------------------------------------------------------------------

<?php

/*---------------------------------------------*/
/*    Check Posts Count Details
/*---------------------------------------------*/

$All_countries = get_terms( 'university_categories', array(
                                        'hide_empty' => false,
                                        'parent'   => '11636',
                                        'number' => '10',
                                        //'offset' => 10
                                    ) ); ?>
<table>

    <tr>
        <th>Country City</th>
        <th>Existing Post Count</th>
        <th>New Post Added</th>
        <th>Total Post</th>
        <th>W/o Courses post</th>
        <th>With Courses post</th>
    </tr>

    <?php foreach ( $All_countries as $country ) { ?>
    <tr>
        <td><?php echo $country->name; ?></td>
        <td>

            <?php

            global $wpdb;

            $pappu = $country->term_taxonomy_id;

            $rel_news = $wpdb->get_results("SELECT COUNT(*) AS total FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_posts.post_date < '2017-12-31 23:59:59' ) AND ( wp_term_relationships.term_taxonomy_id IN ($pappu) ) AND wp_posts.post_type = 'university' GROUP BY wp_posts.ID");

            if( !empty( $rel_news ) ){
                echo count($rel_news);
            }else{
                echo "0";
            } ?>
        </td>

        <td>

            <?php

            global $wpdb;

            $pappu = $country->term_taxonomy_id;

            $rel_news = $wpdb->get_results("SELECT COUNT(*) AS total FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_posts.post_date > '2017-12-31 23:59:59' ) AND ( wp_term_relationships.term_taxonomy_id IN ($pappu) ) AND wp_posts.post_type = 'university' GROUP BY wp_posts.ID");

            if( !empty( $rel_news ) ){

                echo count($rel_news);
            }else{

                echo "0";
            } ?>
                
        </td>

        <td>
            <?php

            global $wpdb;

            $pappu = $country->term_taxonomy_id;

            $rel_news = $wpdb->get_results("SELECT COUNT(*) AS total FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN ($pappu) ) AND wp_posts.post_type = 'university' GROUP BY wp_posts.ID");

            if( !empty( $rel_news ) ){

                echo count($rel_news);

            }else{
                echo "0";
            } ?>
        </td>

        <td>
            <?php

            global $wpdb;

            $pappu = $country->term_taxonomy_id;

            $rel_news = $wpdb->get_results("SELECT wp_posts.ID FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN ($pappu) ) AND wp_posts.post_type = 'university' GROUP BY wp_posts.ID");

            if( !empty( $rel_news ) ){

                $total_course_post = 0;

                foreach ($rel_news as $value) {

                    $post_id = $value->ID;

                    $course_posts = "SELECT wp_posts.ID FROM wp_posts INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE wp_posts.post_type = 'course' AND ( wp_postmeta.meta_key = 'course_listing' AND wp_postmeta.meta_value = $post_id ) AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC";
                    $course_posts = $wpdb->get_results($course_posts);
                    $uni_extra_courses = get_field('more_courses', $post_id);

                    if( empty($course_posts) && empty($uni_extra_courses) ){
                        $total_course_post++;
                    }
                }

                echo $total_course_post;

            } ?>
        </td>

        <td>
            <?php

            global $wpdb;

            $pappu = $country->term_taxonomy_id;

            $rel_news = $wpdb->get_results("SELECT wp_posts.ID FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN ($pappu) ) AND wp_posts.post_type = 'university' GROUP BY wp_posts.ID");

            if( !empty( $rel_news ) ){

                $total_course_post = 0;

                foreach ($rel_news as $value) {

                    $post_id = $value->ID;

                    $course_posts = "SELECT wp_posts.ID FROM wp_posts INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE wp_posts.post_type = 'course' AND ( wp_postmeta.meta_key = 'course_listing' AND wp_postmeta.meta_value = $post_id ) AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC";

                    $course_posts = $wpdb->get_results($course_posts);
                    $uni_extra_courses = get_field('more_courses', $post_id);

                    if( !empty($course_posts) || !empty($uni_extra_courses) ){
                        $total_course_post++;
                    }
                }

                echo $total_course_post;
            } ?>
        </td>
    </tr>
    <?php } ?>
</table>

--------------------------------------------------------------------------------------------------
        
<?php

/*---------------------------------------------*/
/*      Jobs Company Data Query
/*---------------------------------------------*/ ?>

<table>
    <thead>
      <tr>
        <th>Name</th>
        <th>URL</th>
        <th>Company</th>
        <th>Job Categories</th>
        <th>Job Country, City</th>
        <th>Company Country, City</th>
        <th>Company Address</th>
        <th>Author</th>
      </tr>
    </thead>
    <tbody>
      <?php

      $args = array(
                  'post_type' => array('job'),
                  'posts_per_page' => -1,
              );

      $query = new WP_Query( $args );

      global $wpdb;

      $rel_news = $query->request;

      $rel_news = $wpdb->get_results($rel_news);

      if( !empty( $rel_news ) ){

        $rel_news = objectToArray($rel_news);

        $count = 0;

        foreach ($rel_news as $news) {

          $id = $news['ID'];

          $author_id = get_post_field ('post_author', $id);
          $display_name = get_the_author_meta( 'display_name' , $author_id );
          $locations = wp_get_post_terms($id, 'job_category');
          $job_types = wp_get_post_terms($id, 'job_types');

          $Company_listing =  get_post_meta($id, "company_listing", true );
          $address = get_post_meta($Company_listing, "address" , true );

          $listing_post_group = get_post_type($Company_listing);
          $taxonomies = get_object_taxonomies($listing_post_group);

          $listing_cats = wp_get_post_terms($Company_listing, $taxonomies[0]); ?>

          <tr>
            <td><?php echo get_the_title($id); ?></td>
            <td><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_permalink($id); ?></a></td>
            <td><a href="<?php echo get_the_permalink($Company_listing); ?>"><?php echo get_the_title($Company_listing); ?></a></td>
            <td>
              <?php
              foreach ($job_types as $value) {
                echo $value->name.',';
              }
              ?>
            </td>
            <td>
              <?php
              foreach ($locations as $value) {
                echo $value->name.',';
              }
              ?>
            </td>
            <td>
              <?php
              foreach ($listing_cats as $value) {
                echo $value->name.',';
              }
              ?>
            </td>
            <td><?php echo $address; ?></td>
            <td><?php echo $display_name; ?></td>
          </tr>
          <?php
        }
      }

      ?>
    </tbody>
</table>

<?php 

$args = array(
            'post_type' => 'university',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'university_categories',
                    'field'    => 'name',
                    'terms'    =>  array("Qatar","Bahrain","Singapore","Malaysia","Hong Kong","Egypt","Kuwait")
                )
            )
        );
              
$query = new WP_Query( $args );

global $wpdb; 

$nursery_list = $query->request;

$nursery_list = $wpdb->get_results( $nursery_list );

if( !empty($nursery_list) ){

    $comment_content_count = 0;

    foreach ($nursery_list as $key => $value) {

        $comments = get_comments('post_id='.$value->ID);

        if( count($comments) == 0 ) {

            $comment_content_count++;
        }

        /*foreach($comments as $comment) :

        print_r($comment);
        //$comment_content_count += strlen($comment->comment_content);
        endforeach;*/

    }
    echo $comment_content_count;
} ?>

--------------------------------------------------------------------------------------------------

<?php 

/*DB BACKUP & IMPORT COMMAND*/

mysqldump -u grafdom_user -p grafdom_2019 > /home/grafdom/dbs-backup/grafdom_2019_03_10_21.sql

mysql -p -u username database_name < file.sql ?>


--------------------------------------------------------------------------------------------------

<?php

/*Remove extra terms from all post types*/

global $wpdb;

$rel_news = "SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts WHERE 1=1 AND wp_posts.post_type IN ('page') AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') ORDER BY wp_posts.post_date ASC";

$rel_news = $wpdb->get_results($rel_news);

if( !empty( $rel_news ) ){

    $count = 0;

    $taxonomies = array_values(get_taxonomies());

    $taxonomies = array_diff($taxonomies,['post_tag']);

    foreach ($rel_news as $news) {

        $id = $news->ID;

        $job_tags = wp_get_post_terms($id, $taxonomies);

        if( !empty($job_tags) ){

            // foreach ($job_tags as $key => $value) {
                
            //     wp_remove_object_terms( $id, $value->term_id, 'category' );
            // }

            print_r($job_tags);

            echo "<br><br>";

            $count++;
        }
    }

    echo $count;
}