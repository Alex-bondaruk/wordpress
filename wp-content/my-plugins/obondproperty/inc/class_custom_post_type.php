<?php

class CustomPostType {
	private string $name = '';
	private array $args = array();

	public function __construct($name, $args) {
		$this->name = $name;
		$this->args = $args;
	}

	public function register() {
		add_action( 'init', function () {
			register_post_type( $this->name, $this->args );
		});
	}
}