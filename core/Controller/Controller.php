<?php

namespace Core\Controller;

class Controller {

    protected $viewPath;
    protected $template;

    /**
     * Cree la vu et inclue un template
     * @param $view
     * @param $var
     */
    protected function render($view, $var)
    {
        ob_start();
        extract($var);
        require($this->viewPath . $view . '.php');
        $content = ob_get_clean();
        require(ROOT .  '/content/templates/' . $this->template . '.php');
    }


    /**
     * Function qui affiche un message si une page a un access refuse
     */
    protected function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Access denied');
    }

    /**
     *  Function qui affiche un message si une page n'est pas trouver
     */
    protected function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        die('Page not found');
    }

    /**
     * Cree un message flash pour des notif et petit message a affiche a l'utilisatuer (succes, fail ...)
     * @return string
     */
    function flash()
    {
        if(isset($_SESSION['Flash'])) {
            extract($_SESSION['Flash']);
            unset($_SESSION['Flash']);
            return "<div class='alert alert-$type'><i class='fa fa-$icon'></i> $message</div>";
        }
    }

    /**
     * Function a utlisier pour afficher le message, $message = "message-text", $type(la couleur et par defaut la
     * couleur est success(vert)) = "default(blanc), primary(blue), info(cyan), warning(orange), danger(rouge)
     * $icon = "visual icon for message"
     * @param $message
     * @param string $type
     * @param $icon
     */
    function setFlash($message, $type = 'success', $icon = 'check-circle')
    {
        $_SESSION['Flash']['message'] = $message;
        $_SESSION['Flash']['type'] = $type;
        $_SESSION['Flash']['icon'] = $icon;
    }

}