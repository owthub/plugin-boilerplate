<h4>This is our custom page template</h4>

<?php
echo "<h4>User details</h4>";
echo "<pre>";

global $user_ID;
$user_details = get_userdata($user_ID);
print_r($user_details);

/*
$user_Details = get_currentuserinfo();
print_r($user_Details);*/

/*global $user_ID;

$user_details = new WP_User($user_ID);
echo $user_ID."<br/>";

print_r($user_details);*/

/*$userid = get_current_user_id();
echo $userid."<br/>";
$user_details = new WP_User($userid);

print_r($user_details);*/

/*$user_details = wp_get_current_user();

print_r($user_details->user_email);

global $wpdb;*/

/* Returns results of whole db table ARRAY_A, ARRAY_N, Object*/
$users_details = $wpdb->get_results(
        $wpdb->prepare(
                "SELECT * from " . $wpdb->prefix . "users ORDER BY id desc"
        ),Object
);
/*
 * It returns the row of db table based on some condition
  $users_details = $wpdb->get_row(
  $wpdb->prepare(
  "SELECT * from " . $wpdb->prefix . "users WHERE id = %d", 2
  )
  ); */

/* Returns a single scalar value based on condition */
/*
  $users_details = $wpdb->get_var(
  $wpdb->prepare(
  "SELECT user_email from " . $wpdb->prefix . "users WHERE id = %d", 2
  )
  ); */

//echo "<pre>";
//print_r($users_details);
?>