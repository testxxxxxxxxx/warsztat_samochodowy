<?php
declare(strict_types=1);

namespace App\Logic;
use \Exception;

class TemplateEngine {
    public function __construct(private string $viewName, private array $args) {
        $this->viewName = $viewName;
        $this->args = $args;

        $this->display();
    }
    
    private function display(): void {
        $dir = __DIR__ . "/../Views/";
        $this->viewName = "{$dir}/{$this->viewName}";
        if(!file_exists($this->viewName))
            throw new Exception("View file not found: {$this->viewName}"); 
        extract($this->args);
        ob_start(); 
        require $this->viewName;
        $template = ob_get_clean();
        echo $template;
    }
}