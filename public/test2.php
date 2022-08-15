<?php

$text = "/-1-//-g-//-2-/";

$regex = "|/-([0-9])+?-/|";

preg_match_all($regex,$text,$matches,2);

print_r($matches);