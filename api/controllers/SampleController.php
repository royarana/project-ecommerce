<?php

	require './Controller.php';

	class Sample extends Controller {
		function __construct($request) {
			parent::__construct($request);
		}

		function printData() {
			$this->response(
				$_GET,
				"Successfully Retrieved Data...!"
			);
		}
	}

	$class = new Sample($_GET);
	$class->printData();
?>