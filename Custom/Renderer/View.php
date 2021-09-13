<?php

namespace Framework\Renderer;

class View {
    private static array $extensions = [
        'html',
        'light.html',
        'php',
        'light.php'
    ];

    public static function template(string $template, array $with = []) {
        foreach (self::$extensions as $extension) {
            if (file_exists(base("Resources/Views/$template.$extension"))) {
                return arrayToObject(["type" => "html", "html" => fileContents(base("Resources/Views/$template.light.php")), "with" => $with]);
            }
        }
    }
}
