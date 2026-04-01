<?php
/**
 * LevelAI Bootstrap
 * Ensures BASE_PATH is always defined regardless of how the file is included.
 */
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}
