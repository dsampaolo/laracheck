<?php
/**
 * LaraCheck - checks whether your server is Laravel-compatible
 *
 * @package LaraCheck
 * @author Didier Sampaolo <didier@didcode.com>
 */


require_once('./LaraCheck.class.php');

$laracheck = new Laracheck();

/**
 * This view helper turns a boolean into a green checkmark (true) / red cross (false).
 *
 * @param $bool
 * @return string HTML to display
 */
function show_checkmark($bool)
{
    if ($bool) {
        return '<i class="green fa fa-check-circle" aria-hidden="true"></i>';
    }
    return '<i class="red fa fa-times" aria-hidden="true"></i>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LaraCheck</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .green {
            color: #23792f;
        }

        .red {
            color: #9f372a;
        }

        p {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            LaraCheck
        </div>

        <hr />

        <table>
            <tr>
                <th>Requirement</th>
                <th>Pass ?</th>
                <th></th>
            </tr>
            <tr>
                <td>PHP Version 5.6.4 or superior</td>
                <td><?= show_checkmark($laracheck->is_version_ok) ?></td>
                <td><?= $laracheck->version ?></td>
            </tr>

            <?php foreach ($laracheck->extensions as $extension_name => $extension_is_installed) : ?>
                <tr>
                    <td>Extension : <?= $extension_name ?></td>
                    <td><?= show_checkmark($extension_is_installed) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <hr/>

        <?php if ($laracheck->is_version_ok && $laracheck->is_extensions_ok) { ?>
            <p class="green">Congratulations, you are good to go!</p>
        <?php } else { ?>
            <p class="red">You need to review your configuration.</p>
        <?php } ?>

        <hr />
        <?= __FILE__ ?>
    </div>
</div>
</body>
</html>
