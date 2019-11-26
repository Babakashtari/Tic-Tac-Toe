<?php include 'PHP/index.php'?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="CSS/index.css" />
    <title>Tic Tac Toe</title>
  </head>

  <body>

    <form method="post" id="tic_tac_toe">
      <?php cell_creator(); ?>
    </form>

    <div>
      <form method="POST">
        <?php player_creator() ?>
        <input type="submit" name="reset" value="Start/reset the game" >
      </form>
    </div>

    <section id="result">
      <div class="close" onclick="closing()">&times;</div>
      <p id = result2>
        <?php write_winner_name() ?>
      </p>
    </section>

    <script src="JS/index.js"></script>
  </body>
</html>
