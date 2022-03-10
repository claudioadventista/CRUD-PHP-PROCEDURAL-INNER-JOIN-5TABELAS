<?php
function maiusculo($term) {
$palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿbcdefghijklmnopqrstuvwxyz","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞßBCDEFGHIJKLMNOPQRSTUVWXYZ");
return $palavra;
}