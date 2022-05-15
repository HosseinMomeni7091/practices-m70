<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Users list is as below:</p>


    <ul>
        <?php foreach ($data as $key => $value) { ?>
            <li> <a href="/user?id=<?php echo $value["ID"] ?>">
                <?php echo $key . ":".$value["name"];  ?>
                </a>
            </li>

        <?php } ?>
    </ul>
</body>

</html>