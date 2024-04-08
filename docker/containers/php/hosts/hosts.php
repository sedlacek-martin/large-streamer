<?php

if (($hosts = @file_get_contents(__DIR__.'/hosts.template')) === false) {
    echo "Failed to read hosts template\n";
    exit;
}

// @container container.localhost       --->        192.168.0.1 container.localhost
$hosts = preg_replace_callback('~^\s*@([\w]+)~m', function (array $matches) {
    return gethostbyname($matches[1]);
}, $hosts);

if (@file_put_contents('/etc/hosts', $hosts, FILE_APPEND) === false) {
    echo "Failed to append /etc/hosts\n";
} else {
    echo "File hosts.template has been processed and entries have been appended to /etc/hosts\n";
}
