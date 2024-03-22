<?php

namespace Seguranca\Rbac\Http;

class Request
{
    private function __construct(
        private array $get,
        private array $post,
        private array $cookies,
        private array $files,
        private array $server
    ) {}

    public function __get(string $name)
    {
        if(isset($this->{$name})) {
            return $this->{$name};
        }
        return null;
    }

    public static function getRequest()
    {
        $jsonPost = file_get_contents("php://input");
        $jsonPost = json_decode($jsonPost, true);
        $post = array_merge($_POST, $jsonPost ?? []);
        return new self(
            $_GET,
            $post,
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
    }
}