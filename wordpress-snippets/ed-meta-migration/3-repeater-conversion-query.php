<?php
/**
 * Template Name: Test Data
 */
get_header(); ?>

<style type="text/css">
    
    #st-2 {
        display: none;
    }
</style>
<section>

  <div class="row">

    <div class="content-box news-post">

        <?php

        /* Gallery Fields Migration */

        global $wpdb;

        $target_key = "listing_gallery";

        $converted_key = "gallery";

        $table_name = "wp_postmeta_school";

        $repeater_meta = 'SELECT * FROM `'.$table_name.'` WHERE meta_key IN ("listing_gallery","listing_gallery_0_add_image","listing_gallery_1_add_image","listing_gallery_10_add_image","listing_gallery_11_add_image","listing_gallery_12_add_image","listing_gallery_13_add_image","listing_gallery_14_add_image","listing_gallery_15_add_image","listing_gallery_16_add_image","listing_gallery_17_add_image","listing_gallery_18_add_image","listing_gallery_19_add_image","listing_gallery_2_add_image","listing_gallery_20_add_image","listing_gallery_21_add_image","listing_gallery_22_add_image","listing_gallery_23_add_image","listing_gallery_24_add_image","listing_gallery_25_add_image","listing_gallery_26_add_image","listing_gallery_27_add_image","listing_gallery_28_add_image","listing_gallery_29_add_image","listing_gallery_3_add_image","listing_gallery_30_add_image","listing_gallery_31_add_image","listing_gallery_32_add_image","listing_gallery_33_add_image","listing_gallery_34_add_image","listing_gallery_35_add_image","listing_gallery_36_add_image","listing_gallery_37_add_image","listing_gallery_38_add_image","listing_gallery_39_add_image","listing_gallery_4_add_image","listing_gallery_40_add_image","listing_gallery_41_add_image","listing_gallery_42_add_image","listing_gallery_43_add_image","listing_gallery_44_add_image","listing_gallery_45_add_image","listing_gallery_46_add_image","listing_gallery_47_add_image","listing_gallery_48_add_image","listing_gallery_49_add_image","listing_gallery_5_add_image","listing_gallery_50_add_image","listing_gallery_51_add_image","listing_gallery_52_add_image","listing_gallery_53_add_image","listing_gallery_54_add_image","listing_gallery_55_add_image","listing_gallery_56_add_image","listing_gallery_57_add_image","listing_gallery_58_add_image","listing_gallery_59_add_image","listing_gallery_6_add_image","listing_gallery_60_add_image","listing_gallery_61_add_image","listing_gallery_62_add_image","listing_gallery_63_add_image","listing_gallery_64_add_image","listing_gallery_65_add_image","listing_gallery_66_add_image","listing_gallery_67_add_image","listing_gallery_68_add_image","listing_gallery_69_add_image","listing_gallery_7_add_image","listing_gallery_70_add_image","listing_gallery_71_add_image","listing_gallery_72_add_image","listing_gallery_73_add_image","listing_gallery_8_add_image","listing_gallery_9_add_image","images_gallery","images_gallery_0_add_gallery_image","images_gallery_1_add_gallery_image","images_gallery_2_add_gallery_image","images_gallery_3_add_gallery_image","images_gallery_4_add_gallery_image","images_gallery_5_add_gallery_image","logos","logos_0_logo_image","logos_0_logo_title","logos_1_logo_image","logos_1_logo_title","logos_10_logo_image","logos_10_logo_title","logos_11_logo_image","logos_11_logo_title","logos_12_logo_image","logos_12_logo_title","logos_13_logo_image","logos_13_logo_title","logos_14_logo_image","logos_14_logo_title","logos_15_logo_image","logos_15_logo_title","logos_16_logo_image","logos_16_logo_title","logos_17_logo_image","logos_17_logo_title","logos_18_logo_image","logos_18_logo_title","logos_19_logo_image","logos_19_logo_title","logos_2_logo_image","logos_2_logo_title","logos_20_logo_image","logos_20_logo_title","logos_21_logo_image","logos_21_logo_title","logos_22_logo_image","logos_22_logo_title","logos_23_logo_image","logos_23_logo_title","logos_24_logo_image","logos_24_logo_title","logos_25_logo_image","logos_25_logo_title","logos_26_logo_image","logos_26_logo_title","logos_27_logo_image","logos_27_logo_title","logos_28_logo_image","logos_28_logo_title","logos_29_logo_image","logos_29_logo_title","logos_3_logo_image","logos_3_logo_title","logos_30_logo_image","logos_30_logo_title","logos_31_logo_image","logos_31_logo_title","logos_32_logo_image","logos_32_logo_title","logos_33_logo_image","logos_33_logo_title","logos_34_logo_image","logos_34_logo_title","logos_35_logo_image","logos_35_logo_title","logos_36_logo_image","logos_36_logo_title","logos_37_logo_image","logos_37_logo_title","logos_38_logo_image","logos_38_logo_title","logos_39_logo_image","logos_39_logo_title","logos_4_logo_image","logos_4_logo_title","logos_5_logo_image","logos_5_logo_title","logos_6_logo_image","logos_6_logo_title","logos_7_logo_image","logos_7_logo_title","logos_8_logo_image","logos_8_logo_title","logos_9_logo_image","logos_9_logo_title")';

        $repeater_meta = $wpdb->get_results($repeater_meta);

        if( !empty($repeater_meta) ){

            $repeater_data = [];

            $delete_count = 0;

            foreach ($repeater_meta as $repeater) {

                if( $repeater->meta_key != $target_key ){

                    $repeater_data[$repeater->post_id][$repeater->meta_key] = $repeater->meta_value;

                    /*$deleting_record = $wpdb->query('DELETE FROM `'.$table_name.'` WHERE post_id = '.$repeater->post_id.' AND meta_key = "'.$repeater->meta_key.'"');

                    if( $deleting_record ){

                        $delete_count++;
                    }*/
                }
            }

            // echo $delete_count;
            // echo "<br><br>";

            print_r($repeater_data);
            if( !empty($repeater_data) ){

                $insert_count = 0;

                foreach ($repeater_data as $post_id => $meta_value) {
                  
                    $meta_val = serialize(array_values($meta_value));

                    $data = array(
                        'post_id' => $post_id,
                        'meta_key' => $converted_key,
                        'meta_value' => $meta_val
                    );

                    $insert_record = $wpdb->insert( $table_name, $data);

                    if( $insert_record ){

                        $insert_count++;
                    
                    }
                }

                echo $insert_count;
            }
        }

        ?>

    </div>

  </div>

</section>

<?php get_footer(); ?>





































<?php

/* Gallery Fields Migration */



//array('hospital-clinic','doctor','insurances','pharmacie','gyms_fitness','government-agencies','page','news-posts','event','job');

global $wpdb;

$target_key = "listing_gallery";

$converted_key = "gallery";

$table_name = "wp_postmeta_event";

$repeater_meta = 'SELECT * FROM `'.$table_name.'` WHERE meta_key IN ("pic1","pic11","pic2","pic22","pic3","pic33","pic4","pic44","pic5","pic55","pic6","pic66","image_1","image_2","image_3","image_4","image_5","listing_gallery","listing_gallery_0_add_image","listing_gallery_1_add_image","listing_gallery_10_add_image","listing_gallery_11_add_image","listing_gallery_12_add_image","listing_gallery_13_add_image","listing_gallery_14_add_image","listing_gallery_15_add_image","listing_gallery_16_add_image","listing_gallery_17_add_image","listing_gallery_18_add_image","listing_gallery_19_add_image","listing_gallery_2_add_image","listing_gallery_20_add_image","listing_gallery_21_add_image","listing_gallery_22_add_image","listing_gallery_23_add_image","listing_gallery_24_add_image","listing_gallery_25_add_image","listing_gallery_26_add_image","listing_gallery_27_add_image","listing_gallery_28_add_image","listing_gallery_29_add_image","listing_gallery_3_add_image","listing_gallery_30_add_image","listing_gallery_31_add_image","listing_gallery_32_add_image","listing_gallery_4_add_image","listing_gallery_5_add_image","listing_gallery_6_add_image","listing_gallery_7_add_image","listing_gallery_8_add_image","listing_gallery_9_add_image")';

$repeater_meta = $wpdb->get_results($repeater_meta);

if( !empty($repeater_meta) ){

    $repeater_data = [];

    $delete_count = 0;

    $pappu = 0;

    foreach ($repeater_meta as $repeater) {

        if( $repeater->meta_key != $target_key ){

            $gama = is_numeric($repeater->meta_value);

            if( $gama ) {

                $repeater_data[$repeater->post_id][$repeater->meta_key] = $repeater->meta_value;

            }else{

                $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $repeater->meta_value ));

                $repeater_data[$repeater->post_id][$repeater->meta_key] = $attachment[0];
            }

            

            $deleting_record = $wpdb->query('DELETE FROM `'.$table_name.'` WHERE post_id = '.$repeater->post_id.' AND meta_key = "'.$repeater->meta_key.'"');

            if( $deleting_record ){

                $delete_count++;
            }
        }
    }

    echo $delete_count;
    // echo "<br><br>";

    echo "<pre>";

    //print_r($repeater_data);

    /*if( !empty($repeater_data) ){

        $insert_count = 0;

        foreach ($repeater_data as $post_id => $meta_value) {

            $meta_value = array_values($meta_value);

            $newArr = array();

            for ($i=0; $i < count($meta_value); $i++) { 
                
                $pappu = [];

                $pappu['gallery_image'] = $meta_value[$i];

                array_push($newArr, $pappu);
            }

            $meta_val = json_encode(array_values($newArr), JSON_UNESCAPED_SLASHES);

            //print_r($meta_val);

            $data = array(
                'post_id' => $post_id,
                'meta_key' => $converted_key,
                'meta_value' => $meta_val
            );

            // $insert_record = $wpdb->insert( $table_name, $data);

            // if( $insert_record ){

            //     $insert_count++;
            
            // }
        }

        echo $insert_count;
    }*/

    echo "</pre>";
}

?>




<?php

/* Gallery Fields Migration */

global $wpdb;

$target_key = "listing_gallery";

$converted_key = "gallery";

$table_name = "wp_postmeta_hospital-clinic";

$repeater_meta = 'SELECT * FROM `'.$table_name.'` WHERE meta_key IN ("pic1","pic11","pic2","pic22","pic3","pic33","pic4","pic44","pic5","pic55","pic6","pic66")';

$repeater_meta = $wpdb->get_results($repeater_meta);

if( !empty($repeater_meta) ){

    $repeater_data = [];

    $delete_count = 0;

    $pappu = 0;

    foreach ($repeater_meta as $repeater) {

        if( $repeater->meta_key != $target_key ){

            $gama = is_numeric($repeater->meta_value);

            if( $gama ) {

                $repeater_data[$repeater->post_id][$repeater->meta_key] = $repeater->meta_value;

            }else{

                $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $repeater->meta_value )); 

                var_dump($attachment);

                $repeater_data[$repeater->post_id][$repeater->meta_key] = $attachment[0];
            }

            

            /*$deleting_record = $wpdb->query('DELETE FROM `'.$table_name.'` WHERE post_id = '.$repeater->post_id.' AND meta_key = "'.$repeater->meta_key.'"');

            if( $deleting_record ){

                $delete_count++;
            }*/
        }
    }

    //echo $delete_count;
    // echo "<br><br>";

    echo "<pre>";

    //print_r($repeater_data);

    if( !empty($repeater_data) ){

        $insert_count = 0;

        foreach ($repeater_data as $post_id => $meta_value) {

            $newArr = array();

            for ($i=0; $i < (count($meta_value)/2); $i++) { 
                
                $pappu = [];

                $pappu['video_name'] = $meta_value['videos_'.$i.'_video_name'];
                $pappu['video_url'] = $meta_value['videos_'.$i.'_video_url'];

                array_push($newArr, $pappu);
            }

            $meta_val = json_encode(array_values($newArr), JSON_UNESCAPED_SLASHES);

            print_r($meta_val);

            // $data = array(
            //     'post_id' => $post_id,
            //     'meta_key' => $converted_key,
            //     'meta_value' => $meta_val
            // );

            // $insert_record = $wpdb->insert( $table_name, $data);

            // if( $insert_record ){

            //     $insert_count++;
            
            // }
        }

        echo $insert_count;
    }

    echo "</pre>";
}

?>