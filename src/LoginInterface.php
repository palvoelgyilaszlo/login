<?php

declare(strict_types = 1);

namespace Palvoelgyi\Login;

interface LoginInterface
{
    public static function loginProof() : void;
    public static function redirect()   : void;
    public function login()             : void;
    public function logout()            : void;
    public function addNewUser(bool $add = false) : void;
    public function proofUser(string $user, string $pw) : bool;
}