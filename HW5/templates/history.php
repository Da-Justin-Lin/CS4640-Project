<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Sky Chen; Da Lin">
        <meta name="description" content="Worlde Extreme">  
        <title>History</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
    </head>
    <body>
        <div class="container" style="margin-top: 15px;">
            <div class="row col-xs-8">
                <h3>User:<?=$name?><br> E-mail:<?=$email?></h3>
                <h3>Current Balance: 
                    <?php
                        if (!empty($total_bal[0]["balance"])) {
                            echo $total_bal[0]["balance"];
                        }
                        else{
                            echo "0.00";
                        }
                    ?>
                </h3>
                <form action="?command=history" method="post">
                    <div class="text-center">                
                    <a href="?command=new" class="btn btn-primary">Add a new transaction</a>
                    <a href="?command=logout" class="btn btn-danger">Log out</a>
                    </div>
                </form>
                <h4>Transaction History</h4>
                <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }else{
                        echo "<table border='1'>
                        <tr>
                        <th>Transaction Name</th>
                        <th>Transaction Category</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Transaction Type</th>
                        </tr>";
                        foreach ($list as $item){
                            echo "<tr>";
                            echo "<td>" . $item['trans_name'] . "</td>";
                            echo "<td>" . $item['trans_cat'] . "</td>";
                            echo "<td>" . $item['t_date'] . "</td>";
                            echo "<td>" . $item['amount'] . "</td>";
                            echo "<td>" . $item['trans_type'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                ?>
                <h4>Transaction By Category</h4>
                <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }else{
                        echo "<table border='1'>
                        <tr>
                        <th>Transaction Category</th>
                        <th>Balance</th>
                        </tr>";
                        foreach ($cat_bal as $item){
                            echo "<tr>";
                            echo "<td>" . $item['trans_cat'] . "</td>";
                            echo "<td>" . $item['balance'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                ?>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>