<?php

function init_session(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}


function set_session(string $key, mixed $value): void {
    $_SESSION[$key] = $value;
}

function get_session(string $key, mixed $default = null): mixed {
    return $_SESSION[$key] ?? $default;
}

function unset_session(string $key): void {
    unset($_SESSION[$key]);
}

function destroy_session(): void {
    session_unset();
    session_destroy();
}