<?php

namespace Framework\Renderer;

class Webpage {
    public static function render(string $html) {
        evaluate($html);
    }
}
