<?php 

namespace App\Extensions;

class BladeExtensions {

    public static function register() {
		/**
		 * <code>
		 * {? $old_section = "whatever" ?}
		 * </code>
		 */
		\Blade::extend(function($value) {
		    return preg_replace('/\{\?(.+)\?\}/', '<?php ${1} ?>', $value);
		});

    }

}