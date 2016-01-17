<?php

namespace Simplified\Forms;

use Simplified\Core\Collection;

class FormElementTagInput extends FormElementInterface {
	private static $count = 0;
	public function __construct(array $options = array()) {
		if (isset($options['value'])) {
			if (!is_array($options['value']) && !$options['value'] instanceof Collection)
				throw new \InvalidArgumentException('Value must be type array or Simplified\\Core\\Collection');
			$this->setValue($options['value']);
			unset($options['value']);
		}
		$id = 'taginput_'.self::$count;
		$this->setAttribute('id', $id);
		self::$count++;
	}

	public function render() {
		$tags = '';
		if (!empty($this->value()) && count($this->value()) > 0) {
			foreach ($this->value() as $tag) {
				$tags .= '<li>' . htmlentities($tag, ENT_QUOTES, 'UTF-8', false) . '</li>';
			}
		}

		$content = '
		<ul id="'.$this->getAttribute('id').'">'.$tags.'</ul>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#'.$this->getAttribute('id').'").tagit({
					placeholderText: "Enter Tag(s)",
					singleField: true,
					afterTagAdded: function(event, tag) {
						el = $($(tag)[0].tag[0]);
						$(el).find(".text-icon").remove();
						$(el).find(".ui-icon").addClass("fa fa-times-circle");
					}
				});
			});
		</script>
		';

		return $content;
	}
}
