<?php

require __DIR__ . '/vendor/autoload.php';

// Welcome to
// __________         __    __  .__                               __
// \______   \_____ _/  |__/  |_|  |   ____   ______ ____ _____  |  | __ ____
//  |    |  _/\__  \\   __\   __\  | _/ __ \ /  ___//    \\__  \ |  |/ // __ \
//  |    |   \ / __ \|  |  |  | |  |_\  ___/ \___ \|   |  \/ __ \|    <\  ___/
//  |________/(______/__|  |__| |____/\_____>______>___|__(______/__|__\\_____\
//
// This file can be a nice home for your Battlesnake logic and helper functions.
//
// To get you started we've included code to prevent your Battlesnake from moving backwards.
// For more info see docs.battlesnake.com

// info is called when you create your Battlesnake on play.battlesnake.com
// and controls your Battlesnake's appearance
// TIP: If you open your Battlesnake URL in a browser you should see this data
function info()
{
    error_log("INFO");

    response()->json([
        'apiversion' => '1',
        'author' => '',       // TODO: Your Battlesnake Username
        'color' => '#888888', // TODO: Choose color
        'head' => 'default',  // TODO: Choose head
        'tail' => 'default',  // TODO: Choose tail
    ]);
}

// start is called when your Battlesnake begins a game
function startGame($gameState)
{
    error_log("GAME START");
}

// end is called when your Battlesnake finishes a game
function endGame($gameState)
{
    error_log("GAME OVER");
}

// move is called on every turn and returns your next move
// Valid moves are "up", "down", "left", or "right"
// See https://docs.battlesnake.com/api/example-move for available data
function move($gameState)
{

    // We've included code to prevent your Battlesnake from moving backwards
    $isMoveSafe = [
        'up' => true,
        'down' => true,
        'left' => true,
        'right' => true,
    ];

    // The Battlesnake's head and neck positions
    $myHead = $gameState['you']['body'][0]; // Coordinates of your head
    $myNeck = $gameState['you']['body'][1]; // Coordinates of your neck

    // The order of these checks matter!
    // First, prevent the Battlesnake from moving backwards
    if ($myNeck['x'] < $myHead['x']) {        // Neck is left of head, don't move left
        $isMoveSafe['left'] = false;
    } elseif ($myNeck['x'] > $myHead['x']) { // Neck is right of head, don't move right
        $isMoveSafe['right'] = false;
    } elseif ($myNeck['y'] < $myHead['y']) { // Neck is below head, don't move down
        $isMoveSafe['down'] = false;
    } elseif ($myNeck['y'] > $myHead['y']) { // Neck is above head, don't move up
        $isMoveSafe['up'] = false;
    }

    // TODO: Step 1 - Prevent your Battlesnake from moving out of bounds
    // Use boardWidth and boardHeight to prevent moving beyond the walls
    // $boardWidth = $gameState['board']['width'];
    // $boardHeight = $gameState['board']['height'];

    // TODO: Step 2 - Prevent your Battlesnake from colliding with itself
    // Use myBody to prevent collisions with yourself
    // $myBody = $gameState['you']['body'];

    // TODO: Step 3 - Prevent your Battlesnake from colliding with other Battlesnakes
    // Use opponents to prevent collisions with others
    // $opponents = $gameState['board']['snakes'];

    // Are there any safe moves left?
    $safeMoves = array_keys(array_filter($isMoveSafe));

    if (count($safeMoves) === 0) {
        // No safe moves, default to 'down'
        error_log("MOVE {$gameState['turn']}: No safe moves detected! Moving down");
        response()->json(['move' => 'down']);
        return;
    }

    // Choose a random move from the safe moves
    $nextMove = $safeMoves[array_rand($safeMoves)];

    // TODO: Step 4 - Move towards food instead of random, to regain health and survive longer
    // Use food positions to move towards food
    // $food = $gameState['board']['food'];

    error_log("MOVE {$gameState['turn']}: {$nextMove}");
    response()->json(['move' => $nextMove]);
}

// RunServer function equivalent in PHP using Leaf
// Define routes for your Battlesnake

// Route for GET /
app()->get('/', function () {
    info();
});

// Route for POST /start
app()->post('/start', function () {
    $gameState = request()->body();
    startGame($gameState);
});

// Route for POST /move
app()->post('/move', function () {
    $gameState = request()->body();
    move($gameState);
});

// Route for POST /end
app()->post('/end', function () {
    $gameState = request()->body();
    endGame($gameState);
});

// Start the application
app()->run();
