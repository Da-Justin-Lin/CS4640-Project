<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Sky Chen; Da Lin">
        <meta name="description" content="Finance Tracker New Transaction">  
        <title>Finance Tracker New Transaction</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
    </head>
    <body>
        <div class="container" style="margin-top: 15px;">
            <div class="row col-xs-8">
                <h1>Finance Tracker - New Transacation</h1>
                <p> Add a New Transaction Here</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-4">
                <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }
                ?>
                <form action="?command=new" method="post">
                    <div class="mb-3">
                        <label for="trans_name" class="form-label">Transaction Name</label>
                        <input type="text" class="form-control" id="trans_name" name="trans_name"/>
                    </div>
                    <div class="mb-3">
                        <label for="trans_cat" class="form-label">Transaction Category</label>
                        <input type="text" class="form-control" id="trans_cat" name="trans_cat"/>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Transaction Date</label>
                        <input type="date" class="form-control" id="date" name="date"/>
                    </div>
                    <div class="mb-3">
                        <label for="amount">Transaction Amount</label>
                        <input type="number" id="amount" name="amount">
                    </div>
                    <div class="mb-3">
                        <label for="trans_type" class="form-label">Transaction Type</label>
                        <input type="radio" id="credit" name="trans_type" value="Credit">
                        <label for="credit">Credit</label><br>
                        <input type="radio" id="debit" name="trans_type" value="Debit">
                        <label for="debit">Debit</label><br>
                    </div>
                    <div class="text-center">                
                    <button type="submit" class="btn btn-primary">Submit Transaction</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>