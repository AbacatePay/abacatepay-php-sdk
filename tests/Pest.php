<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

\AbacatePay\Clients\Client::setToken($_ENV["ABACATEPAY_TOKEN"]);