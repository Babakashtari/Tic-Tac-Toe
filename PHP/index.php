<?php
session_start();

function choose_player()
{
    if ($_SESSION['Player_turn'] ==='X') {
        $_SESSION['Player_turn'] = 'O';
    } else {
        $_SESSION['Player_turn'] = 'X';
    }
}
function player_creator()
{
    if ($_SESSION['players'][0] === "" || $_SESSION['players'][1] === "") {
        echo "<p>Please insert your names here:</p>";
        foreach ($_SESSION['players'] as $key => $value) {
            if ($key===0) {
                $number = "one";
            } else {
                $number = "two";
            }
            echo "<input type='text' placeholder='player_" ."$number'". " name='player_" . "$number'". "class='players'>";
        }
    } else {
        return;
    }
}
function reset_start()
{
    $_SESSION['players'] = ["",""];
    $_SESSION['cells'] = ["","","","","","","","",""];
    $_SESSION['Player_turn'] = "X"; // by default
    $_SESSION['winner'] = "";
    if (isset($_POST['player_one']) && isset($_POST['player_two'])) {
        $_SESSION['players'] = [$_POST['player_one'], $_POST['player_two']];
    }
}

function show_winner()
{
    if (
        ($_SESSION['cells'][0] !== "" && $_SESSION['cells'][0] === $_SESSION['cells'][1] && $_SESSION['cells'][1] === $_SESSION['cells'][2]) || //first row
        ($_SESSION['cells'][3] !== "" && $_SESSION['cells'][3] === $_SESSION['cells'][4] && $_SESSION['cells'][4] === $_SESSION['cells'][5]) || //second row
        ($_SESSION['cells'][6] !== "" && $_SESSION['cells'][6] === $_SESSION['cells'][7] && $_SESSION['cells'][7] === $_SESSION['cells'][8]) || //third row
        ($_SESSION['cells'][0] !== "" && $_SESSION['cells'][0] === $_SESSION['cells'][3] && $_SESSION['cells'][3] === $_SESSION['cells'][6]) || //first column
        ($_SESSION['cells'][1] !== "" && $_SESSION['cells'][1] === $_SESSION['cells'][4] && $_SESSION['cells'][4] === $_SESSION['cells'][7]) || //second column
        ($_SESSION['cells'][2] !== "" && $_SESSION['cells'][2] === $_SESSION['cells'][5] && $_SESSION['cells'][5] === $_SESSION['cells'][8]) || // third column
        ($_SESSION['cells'][0] !== "" && $_SESSION['cells'][0] === $_SESSION['cells'][4] && $_SESSION['cells'][4] === $_SESSION['cells'][8]) || // oblique 1
        ($_SESSION['cells'][2] !== "" && $_SESSION['cells'][2] === $_SESSION['cells'][4] && $_SESSION['cells'][4] === $_SESSION['cells'][6]) // oblique 2

    ) {
        if ($_SESSION['players'][1] !=='' && $_SESSION['Player_turn'] === 'X') {
            $_SESSION['winner'] = $_SESSION['players'][1];
        } elseif ($_SESSION['players'][0] !=='' && $_SESSION['Player_turn'] === 'O') {
            $_SESSION['winner'] = $_SESSION['players'][0];
        } elseif ($_SESSION['Player_turn'] === 'O') {
            $_SESSION['winner'] = 'X';
        } elseif ($_SESSION['Player_turn'] === 'X') {
            $_SESSION['winner'] = 'O';
        }
    }
}

function write_winner_name()
{
    if ($_SESSION['winner'] !== "") {
        echo "Congradulations, <br>" . $_SESSION['winner'] . " is the winner.";
    } else {
        return;
    }
}

if (isset($_POST['reset'])) {
    reset_start();
}

function cell_creator()
{
    foreach ($_SESSION['cells'] as $key => $value) {
        echo "<input type='submit' name='cell$key' value='$value' class='cells' />";
    }
}

foreach ($_SESSION['cells'] as $key => $value) {
    if (isset($_POST["cell$key"]) && $_SESSION['cells'][$key] ==="") {
        $_SESSION['cells'][$key] = $_SESSION['Player_turn'];
        choose_player();
        show_winner();
    }
}
