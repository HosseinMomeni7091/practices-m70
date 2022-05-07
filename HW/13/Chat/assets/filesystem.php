<?php

define("STORAGE_PATH", __DIR__."/../Storage/");


function read_file(string $path) {
    return file_get_contents(STORAGE_PATH . $path);
}

function write_file(string $path, string $content) {
    file_put_contents(STORAGE_PATH . $path, $content);
}

function save_uploaded($file, $path) {
    move_uploaded_file($file["tmp_name"], STORAGE_PATH . $path);
}


function convert_size(int $size) {

    if ($size >= pow (1024, 3)) 
        return [
            round($size / pow(1024, 3), 2),
            'Gb',
        ];
    elseif ($size >= pow(1024, 2))
        return [
            round($size / pow(1024, 2), 2),
            'Mb'
        ];
    elseif ($size >= 1024) 
        return [
            round($size / 1024, 2),
            'Kb'
        ];
    else 
        return [
            $size,
            'bytes',
        ];
}

function calc_dir_size($json) {
    $res = 0;

    foreach ($json as $file) {
        if (isset($file['name'])) {
            $res += $file['size'];
        } else {
            $res += calc_dir_size($file);
        }
    }

    return $res;
}

function make_json_file(string $name) {
    file_put_contents(STORAGE_PATH . $name, '{"root":{}}');
}