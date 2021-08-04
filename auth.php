<?php

namespace MustUseLocal\Auth;

add_filter( 'auth_cookie_expiration', __NAMESPACE__ . '\filter_auth_cookie_expiration', 99 );

/**
 * Filter the amount of time authentication via cookie is good for.
 *
 * WordPress defaults to 14 days if "remember me" is checked and 2 days if not.
 *
 * @return int Time in seconds the cookie should be good for.
 */
function filter_auth_cookie_expiration() {
	return 365 * DAY_IN_SECONDS;
}
