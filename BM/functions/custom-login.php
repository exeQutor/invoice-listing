<?php

class BM_Custom_Login {

	private $logo;
	private $bg;

	function __construct() {
		$this->logo = get_template_directory_uri() . '/assets/images/logo.svg';
		$this->bg = get_template_directory_uri() . '/assets/images/bg.png';

		add_action('login_head', [$this, 'login_head']);
		add_filter('login_headerurl', [$this, 'login_headerurl']);
		add_filter('login_headertitle', [$this, 'login_headertitle']);
	}

	function login_head() {
		echo "
		<style>
			body.login #login h1 a {
				background: url('" . $this->logo . "') no-repeat scroll center #1779ba;
		    width: 100%;
		    background-size: 100% auto;
		    margin-bottom: 0px;
			}
			body {
				background: #1779ba url('". $this->bg ."') no-repeat scroll center top / cover;
			}
			.login #backtoblog a,
			.login #nav a,
			.login h1 a {
				color: #fff;
			}
			.login #backtoblog a:hover,
			.login #nav a:hover,
			.login h1 a:hover {
				color: #fff;
				text-decoration: underline;
			}
		</style>
		";
	}

	function login_headerurl() {
    return home_url();
	}
	function login_headertitle() {
    return get_option( 'blogname' );
	}
}

new BM_Custom_Login;
