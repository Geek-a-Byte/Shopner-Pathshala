@extends('layouts.app')


<?php
$user = DB::select('select * from admins');

foreach ($user as $row) {
    echo $row->name . '<br>';
}
?>