<?php

namespace MustUseLocal\Mail;

add_action( 'phpmailer_init', __NAMESPACE__ . '\phpmailer_init_mailhog' );

/**
 * Force the PHPMailer instance to use the local configuration of Mailhog
 * for all email.
 *
 * @param \PHPMailer\PHPMailer\PHPMailer $phpmailer The PHPMailer instance.
 */
function mu_local_phpmailer_init( $phpmailer ) {
	$phpmailer->IsSMTP();
	$phpmailer->Host = '127.0.0.1';
	$phpmailer->Port = 1025;
	$phpmailer->Username = '';
	$phpmailer->Password = '';
	$phpmailer->SMTPAuth = true;
}
