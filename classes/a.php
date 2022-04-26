<?php
    $db = new Database();
    $id  = $_POST['id'];
    $recipe = $db->query("select * from recipes where id = ?;", "s", $id)[0];
    header("Content-type: application/json");
    $recipe_json = json_encode($recipe);
    echo $recipe;