<?php

namespace Simplified\Forms;

class FormElementEditor extends FormElementTextArea {
	private $height = 300;
	private $resize = false;
	private $statusbar = false;
	
	public function setHeight($height) {
		$this->height = intval($height) > 0 ? intval($height) : 200;
	}
	
	public function getHeight() {
		return $this->height;
	}
	
	public function setResize($resize) {
		$this->resize = $resize ? true : false;
	}
	
	public function getResize() {
		return $this->resize ? true : false;
	}
	
	public function render() {
		$content = parent::render();
		
		// add JS to start editor
		$content .= '
		<script type="text/javascript">
			tinymce.init({
			selector: "textarea#'.$this->getAttribute('id').'",
			height: '.$this->height.',
			resize: '.($this->resize ? "true" : "false").',
			statusbar: '.($this->statusbar ? "true" : "false").',
			plugins : "paste",
			paste_as_text: true,
			setup: function (editor) {
				editor.on("change", function () {
					editor.save();
				});
			}
		});
		</script>
		';
		
		return $content;
	}
}

?>