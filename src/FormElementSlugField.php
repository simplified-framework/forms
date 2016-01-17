<?php

namespace Simplified\Forms;

use Cocur\Slugify\Slugify;

class FormElementSlugField extends FormElementInterface {
	private static $count = 0;
	private $source;

	public function __construct(array $options = array()) {
		if (isset($options['value'])) {
			$slugify = new Slugify();
			$value = $slugify->slugify($options['value']);
			$this->setValue($value);
			unset($options['value']);
		}

		if (isset($options['source'])) {
			$this->source = $options['source'];
			unset($options['source']);
		}

		$this->setAttributes(array_merge($this->attributes(), $options));
		$id = 'updatefield_' . self::$count;
		$this->setAttribute('id', $id);
		self::$count++;
	}

	public function render() {
		$attrs = array();
		foreach ($this->attributes() as $key => $val ) {
			$attrs[] = $key . '="' . $val . '"';
		}
		$attrs[] = 'value="'.$this->value() . '"';

		$hide_edit_button = "inline-block";
		if(empty($this->value())) {
			$hide_edit_button = "none";
		}

		$id = $this->getAttribute('id');
		$content  = '<div class="textfield" style="float: left;border: 0;padding-left: 0;">';
		$content .= '<span id="'.$id.'_editablestring">'.htmlspecialchars($this->value(),ENT_QUOTES, 'UTF-8').'</span>';
		$content .= '<input type="text" class="textfield short" id="'.$id.'_editableinput" value="'.htmlspecialchars($this->value(),ENT_QUOTES, 'UTF-8').'" style="display:none;"/>';
		$content .= '<a class="btn btn-info" id="'.$id.'_button" style="margin-left: 8px;display: '.$hide_edit_button.'"><i class="glyphicon glyphicon-pencil"></i><span>Edit</span></a>';
		$content .= '<input type="hidden" ' . implode(' ', $attrs) . '/>';
		$content .= '</div>';

		$content .= '<script type="text/javascript">
		$("#'.$this->source.'").keyup(function() {
			var val = $(this).val();
			val = val.toLowerCase(val);
			val = s.trim(val);
			val = s.slugify(val);
			$("#'.$id.'").val(val);
			$("#'.$id.'_editablestring'.'").html(val);

			$("#'.$id.'_button").show();
		});

		$("#'.$id.'_editableinput").keyup(function() {
			var val = $(this).val();
			val = val.toLowerCase(val);
			val = s.trim(val);
			val = s.slugify(val);
			$("#'.$id.'").val(val);
			$("#'.$id.'_editablestring'.'").html(val);
		});

		$("#'.$id.'_button").click(function(){
			if (!$("#'.$id.'_editableinput").is(":visible")) {
				$("#'.$id.'_editablestring").hide();
				$("#'.$id.'_editableinput").show();
				$("#'.$id.'_editableinput").val( $("#'.$id.'").val() );
				$("#'.$this->source.'").attr("disabled", "true");

				// disable page bottom save button
				$("#save-btn").attr("disabled", "disabled");

				// change button
				$("#'.$id.'_button").removeClass("btn-info");
				$("#'.$id.'_button").addClass("btn-success");
				$("#'.$id.'_button").find("i").removeClass("glyphicon-pencil");
				$("#'.$id.'_button").find("i").addClass("glyphicon-ok");
				$("#'.$id.'_button").find("span").html("OK");
			} else {
				$("#'.$id.'").val( $("#'.$id.'_editableinput").val() );
				$("#'.$id.'_editablestring").html($("#'.$id.'_editableinput").val());
				$("#'.$id.'_editablestring").show();
				$("#'.$id.'_editableinput").hide();
				$("#'.$this->source.'").removeAttr("disabled");

				// enable page bottom save button
				$("#save-btn").removeAttr("disabled");

				// change button
				$("#'.$id.'_button").addClass("btn-info");
				$("#'.$id.'_button").removeClass("btn-success");
				$("#'.$id.'_button").find("i").removeClass("glyphicon-ok");
				$("#'.$id.'_button").find("i").addClass("glyphicon-pencil");
				$("#'.$id.'_button").find("span").html("Edit");
			}
		});
		</script>';

		return $content;
	}
}

?>