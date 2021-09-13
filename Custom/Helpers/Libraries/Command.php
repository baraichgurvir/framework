<?php

namespace Framework\Helpers\Libraries;

use Framework\Renderer\Webpage;
use stdClass;

class Command {
    public static function execute(stdClass $command) {
        $function = "render_" . $command->type;
        self::$function($command->html, $command->with);
    }

    private static function render_html(string $html, array $with = []) {
        Webpage::render($html);
    }
}
