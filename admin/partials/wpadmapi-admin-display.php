<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://seowp.pl
 * @since      1.0.0
 *
 * @package    Wpadmapi
 * @subpackage Wpadmapi/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
		        <div id="icon-themes" class="icon32"></div>  
                <h2><?php  echo basename( plugin_dir_path(  dirname( __FILE__ , 2 ) ) ); ?> settings</h2>  
                 
                <form action="admin.php?page=<?php  echo basename( plugin_dir_path(  dirname( __FILE__ , 2 ) ) ); ?>" method="GET">
                    <input type="text" name="sq" /> 
                    <input type='hidden' name='page' value='<?php  echo basename( plugin_dir_path(  dirname( __FILE__ , 2 ) ) ); ?>' />
                    <input type="submit" name="search" value="Search" />
                </form>
    <div >
        <br />
    
<?php 
$m_array=[];
if (isset($_GET['sq']) && count($cluesArray)>0)
{
    $gkey = array_search('%'.$_GET['sq'].'%', $cluesArray);
    echo "Searching: <b>".$_GET['sq'].'</b><br />' ;

    $pattern = '*'.$_GET['sq'].'*';
    $m_array = preg_grep($pattern, array_column($cluesArray, 'question' ));
    echo count($m_array). " results found.";
}

if (count($cluesArray)>0)
    foreach ($cluesArray as $key => $value) {
        ?>
        <form method="POST" action="<?php //echo admin_url('admin-ajax.php'); ?>"> 
                    <?php wp_nonce_field('add_new_cpt','security-code-here'); ?>
                    <input name="action" value="add_new_cpt" type="hidden">
                    <?php

        if (isset($_POST['save'])) {
            $q = esc_attr($_POST['q']);
            $a = esc_attr($_POST['a']);
        } else  {
            $q = esc_attr($value["question"]);
            $a = esc_attr($value["answer"]);
        }

        echo "<input type='hidden' name='q' value='".$q."' />";
        echo "<input type='hidden' name='a' value='".$a."' />";
        

        if ( count($m_array)>0 && array_key_exists($key, $m_array)  ) {
            $class="style='color:red'";             
        } else  $class='';
            
        
        echo  " <span ".$class.">". $value["question"] . "? </span><span>" . $value["answer"] . "</span>";
        echo "<span><input name='save' type='submit' value='SAVE & POST'></input></span>";
        
         
        ?>
        </form> 
        <?php
    }
?>


    </div>
    
</div>

<?php 

if (isset($_POST['save']))
{
    $post_title =$q;
    $post_body = $a;
    
    //$post_title    = sanitize_text_field($_POST['q']); 
    //$post_body =  sanitize_text_field($_POST['a']); 
   
    $my_post = array(
        'post_title'  => $post_title,
        'post_status' => 'publish',
        'post_type'   => 'geopardy',
        'post_content' => $post_body
    );
    
    if (post_exists($post_title) == 0 )  {
       wp_insert_post( $my_post ); 
       echo "New";
    }
    
} else {
    $post_title='';
    $post_body='';
}

