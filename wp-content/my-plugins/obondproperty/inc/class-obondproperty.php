<?php

class Obondproperty {
	private $post_type;

	public function __construct(CustomPostType $post_type) {
		$this->post_type = $post_type;
	}

	public function register_post_type() {
		$this->post_type->register();
	}

	public static function activate() {
		flush_rewrite_rules();
	}

	public static function deactivate() {
		flush_rewrite_rules();
	}
}