<?php

interface UtilityInterface {
    public function pay (array $params) : array;
    public function withdraw (array $params) : array;
    public function status (array $params) : array;
}