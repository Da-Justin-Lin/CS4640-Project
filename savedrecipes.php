<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>Saved Recipes</title>
        <meta name="author" content="Sky Chen/Da Lin">
        <meta name="description" content="A place to find recipes that work for you.">
        <meta name="keywords" content="food">
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/search.css">
    </head> 
    <body>
        <header>
            <nav>
                <a href="?command=home">Recipick</a>
                <a href="?command=search">Search</a>
                <a href="?command=myrecipes">My Recipes</a>
                <a href="?command=profile">Profile</a>
            </nav>
        </header>
        <br>
        <?php
            if (!empty($error_msg)) {
                echo "<div class='alert alert-danger'>$error_msg</div>";
            }else{
                echo "<table border='1'>
                <tr>
                <th>Recipe Name</th>
                <th>Estimated Time</th>
                <th>Author</th>
                <th>Rating</th>
                <th>Unsave?</th>
                </tr>";
                foreach($data2 as $item){
                    $rate = $this->db->query("select rating from ratings where recipe_id = ?;", "s", $item["id"]);
                    $count = 0;
                    $total = 0;
                    foreach ($rate as $r) {
                        $total += $r["rating"];
                        $count++;
                    }
                    if ($count == 0) {
                        $rate = 0;
                    }else {
                        $rate = $total/$count;
                    }
                    echo "<tr>";
                    echo "<td style='text-align:center;'>" . $item["RecipeName"] . "</td>";
                    echo "<td style='text-align:center;'>" . $item["EstimatedTime"] . "</td>";
                    echo "<td style='text-align:center;'>" . $item["Author"] . "</td>";
                    echo "<td style='text-align:center;'>" . $rate . "</td>";
                    echo "<td style='text-align:center;'>" . "Unsave?" . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
        <hr>
    </body>