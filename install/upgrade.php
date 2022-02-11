<?php
ignore_user_abort(1);

// version 2.0
if($config['version'] < 2.0){
    // update apply now email
    update_option("email_message_contact_seller",'{SENDER_NAME} {LANG_WANT-TO-CONTACT}.\n\n{LANG_YOUR-AD}  : {ADTITLE}\n{LANG_NAME}     : {SENDER_NAME}\n{LANG_EMAIL}    : {SENDER_EMAIL}\n{LANG_RESUME}    : {RESUME_LINK}\n{LANG_MESSAGE}  : {MESSAGE}\n\n------------------------------------------\nThis message has been sent automatically by the {SITE_TITLE} system.\nIf you need to contact us, go to {LINK_CONTACT}');
    update_option("email_sub_contact_seller",'{SITE_TITLE} - {SENDER_NAME} {LANG_WANT-TO-CONTACT}');
}

// version 3.0
if($config['version'] < 3.0){
    // add default values for new options
    update_option("blog_enable",'1');
    update_option("blog_banner",'1');
    update_option("show_blog_home",'1');
    update_option("blog_comment_enable",'1');
    update_option("blog_comment_approval",'2');
    update_option("blog_comment_user",'1');
    update_option("testimonials_enable",'1');
    update_option("show_testimonials_blog",'1');
    update_option("show_testimonials_home",'1');
    update_option("instagram_link",'https://instagram.com');

    // create database tables
    $sql = "CREATE TABLE IF NOT EXISTS `".$config['db']['pre']."blog` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `author` int(10) DEFAULT NULL,
          `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
          `image` varchar(255) DEFAULT NULL,
          `tags` text CHARACTER SET utf32 COLLATE utf32_unicode_ci,
          `status` enum('publish','pending') NOT NULL DEFAULT 'publish',
          `created_at` datetime DEFAULT NULL,
          `updated_at` datetime DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($mysqli,$sql);

    $sql = "CREATE TABLE IF NOT EXISTS `".$config['db']['pre']."blog_categories` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `slug` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `position` int(10) NOT NULL DEFAULT '0',
          `active` enum('0','1') NOT NULL DEFAULT '1',
          PRIMARY KEY (`id`)
        ) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    mysqli_query($mysqli,$sql);

    $sql = "CREATE TABLE IF NOT EXISTS `".$config['db']['pre']."blog_cat_relation` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `blog_id` int(10) DEFAULT NULL,
          `category_id` int(10) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($mysqli,$sql);

    $sql = "CREATE TABLE IF NOT EXISTS `".$config['db']['pre']."blog_comment` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `blog_id` int(10) DEFAULT NULL,
          `user_id` int(10) DEFAULT NULL,
          `is_admin` enum('0','1') NOT NULL DEFAULT '0',
          `name` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
          `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
          `created_at` datetime DEFAULT NULL,
          `active` enum('0','1') NOT NULL DEFAULT '1',
          `parent` int(10) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`)
        ) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($mysqli,$sql);

    $sql = "CREATE TABLE IF NOT EXISTS `".$config['db']['pre']."testimonials` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `designation` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
          `image` varchar(100) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($mysqli,$sql);

    // insert demo data
    $sql = "INSERT INTO `".$config['db']['pre']."blog` (`author`, `title`, `description`, `image`, `tags`, `status`, `created_at`, `updated_at`) VALUES (1, 'First Blog', '<p>Consectetur adipisicing elitsed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commo do consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla paria tur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<blockquote>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla paria tur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</blockquote><p>Elitsed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commo do consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla paria tur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</p><p></p></p>\n', NULL, 'travel fun, love', 'publish', '2020-01-15 23:05:15', '2020-01-17 19:12:18')";
    mysqli_query($mysqli,$sql);

    $sql = "INSERT INTO `".$config['db']['pre']."testimonials` (`name`, `designation`, `content`, `image`) VALUES ('Tony Stark', 'Social Marketing', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla paria tur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL)";
    mysqli_query($mysqli,$sql);

    // create required folders and files
    $srcfile = '../storage/products/default.png';
    $dstfile = '../storage/blog/';
    if(!is_dir($dstfile))
        mkdir ( $dstfile, 0755, true );
    @copy($srcfile, $dstfile.'default.png');

    $srcfile = '../storage/profile/default_user.png';
    $dstfile = '../storage/testimonials/';
    if(!is_dir($dstfile))
        mkdir ( $dstfile, 0755, true );
    @copy($srcfile, $dstfile.'default_user.png');
}

// version 3.1
if($config['version'] < 3.1){
    // add default values for new options
    update_option("job_image_field",'0');
    update_option("resume_enable",'1');
    update_option("company_enable",'1');
    update_option("non_active_allow",'1');
    update_option("non_active_msg",'1');
    update_option("linkedin_link",'https://www.linkedin.com/');
    update_option("pinterest_link",'https://pinterest.com/');
}

// version 4.0
if($config['version'] < 4.0){
    // add default values for new options
    update_option("show_search_home",'1');
    update_option("show_categories_home",'1');
    update_option("show_featured_jobs_home",'1');
    update_option("show_latest_jobs_home",'1');

    // add columns in user table
    $sql = "ALTER TABLE `".$config['db']['pre']."user` ADD `city_code` CHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `city`;";
    mysqli_query($mysqli,$sql);

    $sql = "ALTER TABLE `".$config['db']['pre']."user` ADD `state_code` CHAR(50) NULL DEFAULT NULL AFTER `city_code`, ADD `country_code` CHAR(50) NULL DEFAULT NULL AFTER `state_code`;";
    mysqli_query($mysqli,$sql);

    $sql = "ALTER TABLE `".$config['db']['pre']."user` ADD `category` INT(11) NULL DEFAULT NULL AFTER `description`, ADD `subcategory` INT(11) NULL DEFAULT NULL AFTER `category`;";
    mysqli_query($mysqli,$sql);

    $sql = "ALTER TABLE `".$config['db']['pre']."user` ADD `salary_min` BIGINT(20) NOT NULL DEFAULT '0' AFTER `description`, ADD `salary_max` BIGINT(20) NOT NULL DEFAULT '0' AFTER `salary_min`;";
    mysqli_query($mysqli,$sql);

    $sql = "ALTER TABLE `".$config['db']['pre']."user` ADD `dob` DATE NULL DEFAULT NULL AFTER `description`;";
    mysqli_query($mysqli,$sql);

    // add default value for balance table
    $sql = "SELECT COUNT(*) total FROM `".$config['db']['pre']."balance`";
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row['total'] == 0) {
        $sql = "INSERT INTO `".$config['db']['pre']."balance` (`id`, `current_balance`, `total_earning`, `total_withdrawal`) VALUES
(1, 0.00, 0.00, 0.00);";
        mysqli_query($mysqli,$sql);
    }
}

// version 4.1
if($config['version'] < 4.1){
    // add default values for new options
    update_option("job_seeker_enable",'1');
}

// version 4.2
if($config['version'] < 4.2){
    $sql = "CREATE TABLE IF NOT EXISTS `".$config['db']['pre']."fav_users` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `user_id` int(10) NOT NULL,
          `fav_user_id` int(10) NOT NULL,
          PRIMARY KEY (`id`)
        ) DEFAULT CHARSET=utf8;";
    mysqli_query($mysqli,$sql);

    $sql = "CREATE TABLE IF NOT EXISTS `".$config['db']['pre']."user_applied` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `user_id` int(10) DEFAULT NULL,
          `job_id` int(10) DEFAULT NULL,
          `resume_id` int(10) DEFAULT NULL,
          `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
          `created_at` datetime DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) DEFAULT CHARSET=utf8;";
    mysqli_query($mysqli,$sql);
}

// version 5.0
if($config['version'] < 5.0){
    // add default values for new options
    update_option("cookie_link",'');
    update_option("cookie_consent",'1');

    $sql = "CREATE TABLE IF NOT EXISTS `".$config['db']['pre']."experiences` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `user_id` int(10) DEFAULT NULL,
          `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `company` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `description` text,
          `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `start_date` date DEFAULT NULL,
          `end_date` date DEFAULT NULL,
          `currently_working` enum('0','1') NOT NULL DEFAULT '1',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($mysqli,$sql);
}

// version 6.0
if($config['version'] < 6.0){
    // add default values for new options
    update_option("2checkout_sandbox_mode",'production');
    update_option("map_type",'google');
    update_option("quickchat_socket_on_off","off");
    update_option("quickchat_socket_secret_file",'');
    update_option("quickchat_socket_purchase_code",'');
    update_option("quickchat_ajax_on_off","off");
    update_option("quickchat_ajax_secret_file",'');
    update_option("quickchat_ajax_purchase_code",'');
    update_option("location_track_icon", 1);
    update_option("auto_detect_location",'no');
    update_option("live_location_api",'geo_ip_db');
    update_option("resume_files", "pdf,doc,docx,rtf,rtx,ppt,pptx,jpeg,jpg,bmp,png");

    $sql = "INSERT INTO `".$config['db']['pre']."payments` (`payment_id`, `payment_install`, `payment_title`, `payment_folder`, `payment_desc`) VALUES (NULL, '0', 'Payumoney', 'payumoney', 'You will be redirected to Payumoney to complete payment.');";
    mysqli_query($mysqli,$sql);

    $sql = "INSERT INTO `".$config['db']['pre']."payments` (`payment_id`, `payment_install`, `payment_title`, `payment_folder`, `payment_desc`) VALUES (NULL, '0', 'Paytm', 'paytm', NULL);";
    mysqli_query($mysqli,$sql);

    $sql = "INSERT INTO `".$config['db']['pre']."payments` (`payment_id`, `payment_install`, `payment_title`, `payment_folder`, `payment_desc`) VALUES (NULL, '0', 'CCAvenue', 'ccavenue', NULL);";
    mysqli_query($mysqli,$sql);

    $sql = "ALTER TABLE `".$config['db']['pre']."user` CHANGE `user_type` `user_type` ENUM('user','employer') NULL DEFAULT NULL;";
    mysqli_query($mysqli,$sql);

    $sql = "ALTER TABLE `".$config['db']['pre']."messages` ADD `post_id` INT(11) NULL DEFAULT NULL AFTER `message_type`;";
    mysqli_query($mysqli,$sql);
}