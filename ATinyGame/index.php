<?php
  $pageName = "ATinyGame";
  $image = "https://johanv.xyz/f/galleries/Random/ATinyGame.jpg";
  $description = "A $1 game console that fits in 1 hand, with a program smaller than 1kB.";
  $no_extras = true;
  $viewport = '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />';
  include $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>

<h1 style="text-align: center; ">ATinyGame: A Tiny Inexpensive Nugget for Your Gaming and All Manner of Entertainment</h1>

  <div id="game">
    <img id="on_img" src="/ATinyGame/on.jpg" style="display:none;" />
    <img id="dim_img" src="/ATinyGame/dim.jpg" style="display:none;" />
    <img id="off_img" src="/ATinyGame/off.jpg" style="display:none; position: absolute; z-index: 0; border-radius: 50%; user-select: none;" />
    <img id="off_img_noscript" src="/ATinyGame/off.jpg" style="display: block; margin: auto; width: calc(90% - 35px); z-index: 0; border-radius: 50%; user-select: none;" />
    <canvas id="LED00" style="position: absolute; z-index: 1;"></canvas>
    <canvas id="LED10" style="position: absolute; z-index: 2;"></canvas>
    <canvas id="LED20" style="position: absolute; z-index: 3;"></canvas>
    <canvas id="LED01" style="position: absolute; z-index: 4;"></canvas>
    <canvas id="LED11" style="position: absolute; z-index: 5;"></canvas>
    <canvas id="LED21" style="position: absolute; z-index: 6;"></canvas>
    <canvas id="LED02" style="position: absolute; z-index: 7;"></canvas>
    <canvas id="LED12" style="position: absolute; z-index: 8;"></canvas>
    <canvas id="LED22" style="position: absolute; z-index: 9;"></canvas>
    <canvas id="dim" style="position: absolute; z-index: 10;"></canvas>
    <canvas id="buttonL" style="position: absolute; z-index: 11;"></canvas>
    <canvas id="buttonR" style="position: absolute; z-index: 12;"></canvas>
    <canvas id="buttonS" style="position: absolute; z-index: 13;"></canvas>
    <canvas id="click" style="position: absolute; z-index: 14;"></canvas>
  </div>
  <script>
function fillRectCenterWH(ctx, x, y, w, h) {
  ctx.fillRect(x-w/2, y-h/2, w, h)
}

function clearCanvas(ctx) {
  ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}


function dist(x1, y1, x2, y2) {
  return Math.sqrt((Math.pow(x1-x2,2))+(Math.pow(y1-y2,2)));
}

const buttons = {
  L: {x: .3005, y: .3635, r: .0343},
  R: {x: .6820, y: .3800, r: .0343},
  S: {x: .6915, y: .5785, r: .0343},
}

const vibrateLength = 5;
function vibrate() {
  if (navigator.vibrate) window.navigator.vibrate(vibrateLength);
}

function handle_click(e) {
  console.log(e.type, 'client=('+e.clientX+','+e.clientY+') layer=('+e.layerX+','+e.layerY+') offset=('+e.offsetX+','+e.offsetY+')');
  var x = e.offsetX;
  var y = e.offsetY;
  // ctxClick.fillStyle = 'rgba(255,0,0,1)'
  // fillRectCenterWH(ctxClick, x, y, .01*w, .01*h);
  var radiusFactor = 3;
  if (dist(w*buttons.L.x, h*buttons.L.y, x, y) < w*buttons.L.r*radiusFactor) {
    if (e.type === 'mousedown' || e.type === 'touchstart') {
      vibrate();
      press(buttonL);
      scrollEnabled = false;
    } else {
      release(buttonL);
    }
  }
  if (dist(w*buttons.R.x, h*buttons.R.y, x, y) < w*buttons.R.r*radiusFactor) {
    if (e.type === 'mousedown' || e.type === 'touchstart') {
      vibrate();
      press(buttonR);
      scrollEnabled = false;
    } else {
      release(buttonR);
    }
  }
  if (dist(w*buttons.S.x, h*buttons.S.y, x, y) < w*buttons.S.r*radiusFactor) {
    if (e.type === 'mousedown' || e.type === 'touchstart') {
      vibrate();
      press(buttonS);
      scrollEnabled = false;
    } else {
      release(buttonS);
    }
  }
}

function show(id) {
  document.getElementById(id).style.display = '';
}

function hide(id) {
  document.getElementById(id).style.display = 'none';
}

function sh(id, value) {
  if (value) {
    show(id);
  } else {
    hide(id);
  }
}

function renderButtons() {
  sh('buttonL', buttonL.pressed || buttonL.justPressed || buttonL.justReleased);
  sh('buttonR', buttonR.pressed || buttonR.justPressed || buttonR.justReleased);
  sh('buttonS', buttonS.pressed || buttonS.justPressed || buttonS.justReleased);
}

function drawLEDMask(ctx, x, y) {
//   ctx.fillStyle = 'rgba(255,255,255,1)'
//   ctx.fillRect(.42*w, .33*h, .025*w, .018*h)
//
//   there was a bug with drawing multiple elipses, so this code is broken:
//   a = 0.3
//   for (r=.015; r<.06; r+=.0005) {
//     ctx.fillStyle = 'rgba(255,255,255,' + a + ')'
//     a *= 0.92
//     // ctx.arc(.43*w, .34*h, r*w, 0, 2 * Math.PI, false);
//     ctx.ellipse((.43 + x*0.068)*w, (.339 + y*0.071)*h, r*w*1.2, r*w, 0, 0, Math.PI*2);
//     ctx.fill();
//   }

  var opacity = 0.3
  for (var r=1; r<7; r+=0.5) {
    ctx.fillStyle = 'rgba(255,255,255,' + opacity + ')'
    opacity *= 0.85
    fillRectCenterWH(ctx, (.43+x*0.068)*w, (.339+y*0.071)*h, (.025+.01*r)*w, (.018+.01*r)*h)
  }
}

function render_init() {
  //make everything hidden (since starting board is empty)
  renderLEDs();
  renderButtons();

  // https://stackoverflow.com/questions/18379818/canvas-image-masking-overlapping
  ctxDim.globalCompositeOperation = 'source-over';
  for (x=0; x<3; x++){
    for (y=0; y<3; y++){
      var ctx = ctxs[y][x];
      ctx.filter = "brightness(120%)";
      ctx.globalCompositeOperation = 'source-over';
      drawLEDMask(ctx, x, y);
      ctx.globalCompositeOperation = 'source-in';
      ctx.drawImage(on_img, 0, 0, w, h);

      drawLEDMask(ctxDim, x, y);
    }
  }
  
  ctxDim.globalCompositeOperation = 'source-in';
  ctxDim.filter = "hue-rotate(-20deg)";
  ctxDim.drawImage(dim_img, 0, 0, w, h);

  ctxButtonL.globalCompositeOperation = 'source-over';
  ctxButtonL.fillStyle = 'rgba(240,240,255,0.6)';
  ctxButtonL.beginPath();
  ctxButtonL.arc(buttons.L.x*w, buttons.L.y*h, buttons.L.r*w, 0, 2*Math.PI, false);
  ctxButtonL.closePath();
  ctxButtonL.fill();

  ctxButtonR.globalCompositeOperation = 'source-over';
  ctxButtonR.fillStyle = 'rgba(240,240,255,0.6)';
  ctxButtonR.beginPath();
  ctxButtonR.arc(buttons.R.x*w, buttons.R.y*h, buttons.R.r*w, 0, 2 * Math.PI, false);
  ctxButtonR.closePath();
  ctxButtonR.fill();

  ctxButtonS.globalCompositeOperation = 'source-over';
  ctxButtonS.fillStyle = 'rgba(240,240,255,0.6)';
  ctxButtonS.beginPath();
  ctxButtonS.arc(buttons.S.x*w, buttons.S.y*h, buttons.S.r*w, 0, 2 * Math.PI, false);
  ctxButtonS.closePath();
  ctxButtonS.fill();
}

function renderLEDs() {
  var dim = false;
  for (x=0; x<3; x++){
    for (y=0; y<3; y++){
      if (board[y][x] === 1 || (board[y][x] === 4 && (r25 % 8) >= 4)) {
        show('LED'+x+y)
      } else {
        hide('LED'+x+y)
        if (board[y][x] == 2) {
          dim = true;
        }
      }
    }
  }
  sh('dim', dim);
}

function loop() {
  renderButtons();
  var board_before = ''+board
  game_logic()
  buttonL.justPressed = false;
  buttonL.justReleased = false;
  buttonR.justPressed = false;
  buttonR.justReleased = false;
  buttonS.justPressed = false;
  buttonS.justReleased = false;
  //accounting for board changes and blinking LEDs
  if (board_before !== ''+board ||
  (((r25 % 8) === 0 || (r25 % 8) === 4) && board_before.includes('4'))) {
    renderLEDs()
  }
  r25++;
  if (r25 >= 256) r25 = 0;

  //timers from handle_scroll
  if (scrollS > 0) {
    if (scrollS == 9) press(buttonS);
    if (scrollS == 1) release(buttonS);
    scrollS--;
  }
  if (scrollR > 0) {
    if (scrollR == 9) press(buttonR);
    if (scrollR == 1) release(buttonR);
    scrollR--;
  }
}

function random() {
  if (!is_rng_seeded) {
    if (r25 === 255) r25 = 0;
    rng_number = r25;
    is_rng_seeded = true;
  }
  // ;use a linear feedback shift register (LFSR) algorithm to scramble it
  //
  // ;https://aloriumtech.com/project/random-number-generator/
  // ;https://aloriumtech.com/wp-content/uploads/2019/09/lfsr-768x322.jpg
  // ;
  // ; [7]-[6]-[5]-[4]-[3]-[2]-[1]-[0]<--
  // ;  |       |   |   |   ___         |
  // ;  |       |   |   ---)   \        |
  // ;  |       |   -------)XNOR\.______|
  // ;  |       -----------)    /
  // ;  -------------------)___/

  var r30 = rng_number;  // lds r30, RNG ;load the RNG value from memory
  var r31 = r30;         // mov r31, r30 ;r30 and r31 are both RNG
  r30 = r30 << 1;        // lsl r30
  r30 = r30 << 1;        // lsl r30 ;bit 7 of r30 is bit 5 of RNG
  r31 = r31 ^ r30;       // eor r31, r30 ;xor bits 7^5 of RNG into bit 7 of r31
  r30 = r30 << 1;        // lsl r30 ;bit 7 of r30 is bit 4 of RNG
  r31 = r31 ^ r30;       // eor r31, r30 ;xor bits 7^5^4 of RNG into bit 7 of r31
  r30 = r30 << 1;        // lsl r30 ;bit 7 of r30 is bit 3 of RNG
  r31 = r31 ^ r30;       // eor r31, r30 ;xor bits 7^5^4^3 of RNG into bit 7 of r31
  r31 = ~r31;            // com r31 ;invert to get the XNOR instead of XOR effect

  r30 = rng_number;      // lds r30, RNG ;load the RNG value from memory
  C = (r31 & 128) / 128; // rol r31 ;put bit 7 of r30 into the carry flag
  r30 = r30 << 1;        // rol r30 ;put the carry flag into bit 0 of r30 and shift the rest left
  r30 = r30 & 0b1111_1111;
  r30 = r30 | C
  rng_number = r30;      // sts RNG, r30 ;store the new value back to memory
  return rng_number;
}

var rng_number;
var r25 = 0; //used for a timer and for seeding the random number generator
var is_rng_seeded = false;
var currentState = 'gameSelect';
var nextState;
var nextNextState;
var game = 1
var games = ['stackerInit', 'reactionInit', 'memoryInit', 'whackamoleInit', 'diceRoller']
var timer = 0;
var score = 0;
var mole_location = 'L';
var memory_game_seed;
var seq_index;
var stacker_row;
var stacker_direction;
var stacker_delay;

function game_logic() {
//   console.log(currentState);
  if (currentState === 'gameSelect') {
    showScore(game);
    if (buttonL.justPressed && game > 1) game--;
    if (buttonR.justPressed && game < 5) game++;
    if (buttonS.justPressed) {
      clearScreen();
      currentState = games[game-1];
    }
  } else if (currentState === 'stackerInit') {
    // ;turn on the bottom 2 rows of LEDs, and the top left LED
    // ldi r20, 0x11
    // ldi r21, 0x10
    // rcall helpFillScreen
    // sbr r24, 0x10 ;avoid messing up the seeding and buttons
    board = [[1,0,0],[1,1,1],[1,1,1]]

    timer = 0;                // clr r25             ;clear the loop counter for consistent movement
    stacker_row = 0b01110000; // ldi r26, 0b01110000 ;the moving top row
    stacker_direction = 1;    // ldi r28, 1          ;the direction of motion (1 = >>, 0 = <<)
    stacker_delay = 13;       // ldi r27, 13         ;the delay between movements (next: 13-2)
    score = 0;                // ldi r17, 0          ;the score (number of times the button was pressed, minus 1)
    // ;score   1  2 3 4 5 6 7 8 9 a b c d e f
    // ;delay 13,11,9,8,7,6,5,4,3,3,3,2,2,2,1,1,1,1,1,1,...
    // ;delta   2  2 1 1 1 1 1 1 0 0 1 0 0 1 0
    // ;x=200 #x starts at 200ms and decreases by 15% every time
    // ;for i in range(25): print(int(x/15.625+0.5)*15.625); x *= .85
    // ;for i in range(25): print(int(x/15.625+0.5)); x *= .85
    //
    // ;       top row
    // ;         |||
    // ; 3  1 01110000
    // ; 3  2 00111000
    // ; 3  3 00011100
    // ; 3  4 00001110
    // ; 3  5 00000111
    // ;         |||
    // ; 2  1 00110000
    // ; 2  2 00011000
    // ; 2  3 00001100
    // ; 2  4 00000110
    // ;         |||
    // ; 1  1 00010000
    // ; 1  2 00001000
    // ; 1  3 00000100
    // ;         |||
    //
    currentState = 'stackerMove'; // ldi r18, 11 ;change state to stackerMove
    //
    // ;fall thru to the next state on purpose
    // ;	rjmp statesEnd
    game_logic() //since we can't fall-thru an if-else, we can call the next state now with recursion
  } else if (currentState === 'reactionInit') {
    timer = random(); // rcall random
                    // mov r25, r31
    currentState = 'reactionWait'; // ldi r18, 19 ;change state to reactionWait
  } else if (currentState === 'memoryInit') {
    memory_game_seed = random() //rcall random ;make sure the RNG is seeded, now we can use r25 after
    //mov r26, r31 ;store the first number in the sequence so it can be recreated

    score = 1; //ldi r17, 1 ;the score (length of the memory sequence)
    //;it is 1 higher than the actual number of presses
    seq_index = 1; //ldi r27, 1 ;the number of items left in the current sequence
    timer = 0; //clr r25 ;reset the timer
    currentState = 'shortDelay'; //ldi r18, 14 ;change state to shortDelay
    nextState = 'memoryShow'; //ldi r16, 7 ;then change state to memoryShow
  } else if (currentState === 'whackamoleInit') {
    timer = 0; //clr r27 ;clear the loop counter, when it reaches 255 (4 sec) the game is over
    score = 0; //ldi r17, 0 ;score (number of moles hit)
    currentState = 'whackamoleMole'; //ldi r18, 9 ;change state to whackamoleMole
  } else if (currentState === 'diceRoller') {
    dice_num = (random() % 6)+1;
    if (buttonR.justPressed) showScore(dice_num);
    if (buttonL.justPressed) currentState = 'transition';
    nextState = 'gameSelect';
    timer = 0;
  } else if (currentState === 'transition') {
    board = [[2,2,2],[2,2,2],[2,2,2]]
    timer++;
    if (timer >= 32) { // it has been 1/2 second
      currentState = nextState;
      game = 1;
      clearScreen();
    }
  } else if (currentState === 'memoryShow') {
    mole_location = randomLED() //rcall randomLED
    timer = 0; //clr r25 ;reset the timer
    currentState = 'shortDelay'; //ldi r18, 14 ;change state to shortDelay
    nextState = 'memoryShowBetween' //ldi r16, 17 ;then change state to memoryShowBetween
  } else if (currentState === 'memoryPress') {
    // subi r19, 0
    if (buttonL.justPressed || buttonR.justPressed || buttonS.justPressed) { // breq memoryPressEnd ;if any button was just pressed:
      //
      mole_location = randomLED(); // rcall randomLED ;puts the button mask into r28
      clearScreen(); // rcall clearScreen
      if (
          // and r28, r19 ;see if the correct button was just pressed
          // breq memoryPressGameOver
          (mole_location === 'L' && buttonL.justPressed) ||
          (mole_location === 'R' && buttonR.justPressed) ||
          (mole_location === 'S' && buttonS.justPressed)
      ) {
        seq_index--; // dec r27 ;decrement sequence index
        if (seq_index <= 0) { // brne memoryPressEnd ;if the sequence is done being entered
          rng_number = memory_game_seed; // sts RNG, r26 ;store the original random value back to the RNG to start over
          timer = 0; // clr r25 ;reset the timer
          currentState = 'shortDelay'; // ldi r18, 14 ;change state to shortDelay
          nextState = 'memoryShow'; // ldi r16, 7 ;then change state to memoryShow
          incScore(); // rcall incScore ;increase the score by 1 (the sequence length will also increase)
          seq_index = score; // mov r27, r17 ;reset the sequence index to the sequence length (score)
        }
      } else { // memoryPressGameOver:
        // ;exhaust the rest of the RNG sequence
        while (seq_index > 0) {
          random(); // rcall random
          seq_index--; // dec r27
          // brne memoryPressGameOver
        }
        // ;dec r17 ;decrease the score by 1 to account for the extra one at the start
        score = score >> 1; // lsr r17 ;divide score by 2
        timer = 0; // clr r27 ;clear the timer for the transition
        currentState = 'transition'; // ldi r18, 6 ;change state to transition
        nextState = 'generalScore'; // ldi r16, 12 ;after that, change state to generalScore
        nextNextState = 'memoryInit' // ldi r26, 3 ;finally, it will be memoryInit
      }
    }
  } else if (currentState === 'whackamoleMole') {
    currentState = 'whackamoleWait'; //ldi r18, 10 ;change state to whackamoleWait
    mole_location = randomLED(); //rcall randomLED
  } else if (currentState === 'whackamoleWait') {
    timer++; //inc r27 ;increment the timer
    if (timer >= 256) { //breq whackamoleTimeUp
        timer = 0; //;timer is already cleared for the transition
        currentState = 'transition'; //ldi r18, 6 ;change state to transition
        nextState = 'generalScore'; //ldi r16, 12 ;after that, change state to generalScore
        nextNextState = 'whackamoleInit'; //ldi r26, 4 ;finally, it will be whackamoleInit
    }
    //whackamoleWaitTimeLeft:
    if (buttonL.justPressed || buttonR.justPressed || buttonS.justPressed) {
      if (
        //mov r30, r28 ;copy the bitmask
        //and r30, r19 ;see if the correct button was just pressed
        (mole_location === 'L' && buttonL.justPressed) ||
        (mole_location === 'R' && buttonR.justPressed) ||
        (mole_location === 'S' && buttonS.justPressed)
      ) { //correct button
        incScore() //rcall incScore ;add 1 to the score
        clearScreen() //rcall clearScreen
        currentState = 'whackamoleWhileAnyPressed'; //ldi r18, 16 ;change state to whackamoleWhileAnyPressed
        nextState = 'whackamoleMole'; //ldi r16, 9 ;after that, change state to whackamoleMole
      } else { //whackamoleWaitWrongButton:
        //subi r17, 0 ;if score is already 0
        //breq whackamoleWaitingStill ;don't decrement
        //dec r17 ;decrease the score because the wrong button was pressed
        if (score > 0) score --;
      }
    }

  } else if (currentState === 'stackerMove') {
    if (buttonS.justPressed) { // sbrc r19, 0 ;if S was just pressed, run the next line
      currentState = 'stackerFall'; // rjmp stackerFall
      game_logic() //more recursion to simulate fall-thru
    }
    timer++; //this was done in the loop since it was r25
    //
    // mov r30, r25
    if (timer >= stacker_delay) {// sub r30, r27 ;check if the delay has elapsed yet
      timer = 0; // clr r25
      if (stacker_direction === 1) { // sbrc r28, 0 ;if r28 = 1 (moving right)
        stacker_row = stacker_row >> 1; // lsr r26
      } else { // sbrs r28, 0 ;if r28 = 0 (moving left)
        stacker_row = stacker_row << 1; // lsl r26
      }
      // ;bits 4, 3, and 2 of r26 are the top row
      board[0] = [0,0,0] // rcall clearTopRow
      //
      if (stacker_row & (1<<4)) { // sbrc r26, 4   ;if bit 4 is set
        board[0][0] = 1; // sbr r20, 0x10 ;light up LED 0,0
      }
      if (stacker_row & (1<<3)) { // sbrc r26, 3   ;if bit 4 is set
        board[0][1] = 1; // sbr r21, 0x01 ;light up LED 1,0
      }
      if (stacker_row & (1<<2)) { // sbrc r26, 2   ;if bit 4 is set
        board[0][2] = 1; // sbr r23, 0x10 ;light up LED 2,0
      }
      // ;reverse direction when it reaches the edge
      if (board[0][1] !== 1) { // sbrc r21, 0 ;if LED 1,0 is on
        // rjmp statesEnd ;jump to end

        // ;if r28 == 1 and !LED(1,0) and LED(2,0): r28 = 0
        // ;if r28 == 0 and !LED(1,0) and LED(0,0): r28 = 1
        // ;since LED(1,0) has already been checked this becomes:
        // ;if r28 == 1 and r23H: r28 = 0
        // ;if r28 == 0 and r20H: r28 = 1
        //
        if (stacker_direction === 1 && board[0][2] === 1) {// sbrs r28, 0 ;if r28 = 0
          // rjmp stackerMover28is0
          //
          // ;r28 == 1
          // sbrc r23, 4 ;if r23H
          stacker_direction = 0; // ldi r28, 0
          //
          // stackerMover28is0:
        } else if (stacker_direction === 0 && board[0][0] === 1) { // sbrc r20, 4 ;if r20H
          stacker_direction = 1; // ldi r28, 1
        }
      }
    }

  } else if (currentState === 'generalScore') {
    //mov r30, r17
    showScore(score) //rcall showScore
    //cbr r19, 0b0000_0001 ;disregard S
    //subi r19, 0 ;if any button was pressed
    if (buttonL.justPressed || buttonR.justPressed) { //;either L or R was pressed
      timer = 0; //clr r27 ;clear the timer for the transition state
      currentState = 'transition'; //ldi r18, 6 ;change state to transition
      nextState = nextNextState; //mov r16, r26 ;after that the state will be whatever was given unless
      if (buttonL.justPressed) { //sbrc r19, 2 ;if L was just pressed
        nextState = 'gameSelect'; //ldi r16, 0 ;after that the state will be gameSelect
      }
    }
  } else if (currentState === 'stackerFall') {
    // ;whichever ones should fall, make them blink
    if (board[1][0] === 0 && board[0][0] === 1) board[0][0] = 4;
    // sbrc r20, 0   ;if LED(0,1)==0
    // rjmp stackerFallCol1Done
    // sbrs r20, 4   ;and LED(0,0)==1
    // rjmp stackerFallCol1Done
    // cbr r20, 0xf0 ;clear LED(0,0)
    // sbr r20, 0x40 ;set LED(0,0) to blink
    // ;ldi r30, 1    ;mark that at least 1 is blinking
    // stackerFallCol1Done:
    //
    if (board[1][1] === 0 && board[0][1] === 1) board[0][1] = 4;
    // sbrc r22, 4   ;if LED(1,1)==0
    // rjmp stackerFallCol2Done
    // sbrs r21, 0   ;and LED(1,0)==1
    // rjmp stackerFallCol2Done
    // cbr r21, 0x0f ;clear LED(1,0)
    // sbr r21, 0x04 ;set LED(1,0) to blink
    // ;ldi r30, 1    ;mark that at least 1 is blinking
    // stackerFallCol2Done:
    //
    if (board[1][2] === 0 && board[0][2] === 1) board[0][2] = 4;
    // sbrc r23, 0   ;if LED(2,1)==0
    // rjmp stackerFallCol3Done
    // sbrs r23, 4   ;and LED(2,0)==1
    // rjmp stackerFallCol3Done
    // cbr r23, 0xf0 ;clear LED(2,0)
    // sbr r23, 0x40 ;set LED(2,0) to blink
    // ;ldi r30, 1    ;mark that at least 1 is blinking
    // stackerFallCol3Done:
    //
    timer = 0; // clr r25 ;clear the counter to start the next state's timer at 0
    currentState = 'shortDelay'; // ldi r18, 14 ;change state to shortDelay
    nextState = 'stackerFall2'; // ldi r16, 15 ;change state to stackerFall2 after that
  } else if (currentState === 'shortDelay') {
    timer++;
    if (timer >= 32) { //sbrc r25, 5 ;if bit 5 in the counter is 1, it has been 1/2 second so:
      currentState = nextState; //mov r18, r16 ;move to whatever next state was specified in r16
    }
  } else if (currentState === 'stackerFall2') {
    // ;make the blinking ones fall from the top row to the middle
    //
    if (board[0][0] === 4) {
      board[0][0] = 0;
      board[1][0] = 4;
    }
    // sbrs r20, 6   ;if LED(0,0)==4 (blinking)
    // rjmp stackerFall2Col1Done
    // cbr r20, 0xff ;turn off LED(0,0) and LED(0,1)
    // sbr r20, 0x04 ;set LED(0,1)=4 (blinking)
    // stackerFall2Col1Done:
    //
    if (board[0][1] === 4) {
      board[0][1] = 0;
      board[1][1] = 4;
    }
    // sbrs r21, 2   ;if LED(1,0)==4 (blinking)
    // rjmp stackerFall2Col2Done
    // cbr r21, 0x0f ;turn off LED(1,0)
    // cbr r22, 0xf0 ;turn off LED(1,1)
    // sbr r22, 0x40 ;set LED(1,1)=4 (blinking)
    // stackerFall2Col2Done:
    //
    if (board[0][2] === 4) {
      board[0][2] = 0;
      board[1][2] = 4;
    }
    // sbrs r23, 6   ;if LED(2,0)==4 (blinking)
    // rjmp stackerFall2Col3Done
    // cbr r23, 0xff ;turn off LED(2,0) and LED(2,1)
    // sbr r23, 0x04 ;set LED(2,1)=4 (blinking)
    // stackerFall2Col3Done:
    //
    timer = 0; // clr r25 ;clear the counter to start the next state's timer at 0
    //
    currentState = 'shortDelay'; // ldi r18, 14 ;change state to shortDelay
    nextState = 'stackerFell'; // ldi r16, 18 ;change state to stackerFell next
  } else if (currentState === 'whackamoleWhileAnyPressed') {
    timer++; //inc r27 ;increment the timer
    if (timer >= 256) {
      timer = 0; //;timer is already cleared for the transition
      currentState = 'transition'; //ldi r18, 6 ;change state to transition
      nextState = 'generalScore'; //ldi r16, 12 ;after that, change state to generalScore
      nextNextState = 'whackamoleInit'; //ldi r26, 4 ;finally, it will be whackamoleInit
    } else {
      if (!(buttonL.pressed || buttonR.pressed || buttonS.pressed)) {
        currentState = nextState //mov r18, r16 ;move to whatever next state was specified in r16
      }
    }
  } else if (currentState === 'memoryShowBetween') {
    timer = 0; //clr r25 ;reset the timer
    currentState = 'shortDelay'; //ldi r18, 14 ;change state to shortDelay
    nextState = 'memoryShow'; //ldi r16, 7 ;then change state to memoryShow

    clearScreen(); //rcall clearScreen

    seq_index--; //dec r27 ;decrement sequence index
    if (seq_index <= 0) { //brne memoryShowBetweenEnd ;if the sequence is done showing
      rng_number = memory_game_seed; //sts RNG, r26 ;store the original random value back to the RNG to start over
      seq_index = score; //mov r27, r17 ;reset the sequence index to the sequence length (score)
      currentState = 'memoryPress'; //ldi r18, 8 ;change state to memoryPress
    }
  } else if (currentState === 'stackerFell') {
    // ;get rid of the blinking on the 2nd row from the falling animation
    if (board[1][0] === 4) board[1][0] = 0; // cbr r20, 0b0000_0100 ;clear LED(0,1)'s "blinking" bit
    if (board[1][1] === 4) board[1][1] = 0; // cbr r22, 0b0100_0000 ;clear LED(1,1)'s "blinking" bit
    if (board[1][2] === 4) board[1][2] = 0; // cbr r23, 0b0000_0100 ;clear LED(2,1)'s "blinking" bit

    stacker_row = 0; // clr r26 ;reset the moving bar
    //
    // ;recalculate the width of the moving bar
    if (board[0][0]) // sbrc r20, 4   ;if LED(0,0)==1
      stacker_row |= 0b100; // sbr r26, 0b100
    //
    if (board[0][1]) // sbrc r21, 0   ;if LED(1,0)==1
      stacker_row |= 0b010; // sbr r26, 0b010
    //
    if (board[0][2]) // sbrc r23, 4   ;if LED(2,0)==1
      stacker_row |= 0b001; // sbr r26, 0b001

    // ;r26 can be 000, 001, 011, 111, 110, 100
    // ;for the last 2, it needs to be shifted over
    if ((stacker_row & 0b001) === 0) // sbrs r26, 0 ;if the final bit is 0
      stacker_row = stacker_row >> 1; // lsr r26     ;shift right
    if ((stacker_row & 0b001) === 0) // sbrs r26, 0 ;if the final bit is 0
      stacker_row = stacker_row >> 1; // lsr r26     ;shift right

    // ;if the game is over
    if (stacker_row === 0) { // subi r26, 0
      // brne stackerFellGameContinue
      timer = 0; // clr r27 ;clear the timer for the transition
      currentState = 'transition'; // ldi r18, 6 ;change state to transition
      nextState = 'generalScore'; // ldi r16, 12 ;after that, change state to generalScore
      nextNextState = 'stackerInit'; // ldi r26, 1 ;finally, it will be stackerInit
    } else {
      // stackerFellGameContinue:
      fallScreen() // rcall fallScreen
      //
      // ;on every other one, go backwards
      if ((score & 1) === 1) { // sbrs r17, 0   ;if bit 0 of the score is 1
        // rjmp stackerFellBackwards
        board[0][0] = 1; // sbr r20, 0x10 ;set the top left LED to be on
        stacker_row = stacker_row << 4 // swap r26      ;move the row to the left side
        stacker_direction = 1; // ldi r28, 1    ;set the motion direction to be >>
        // rjmp stackerFellBackwardsAfter
      } else {
        // stackerFellBackwards:
        stacker_direction = 0; // ldi r28, 0    ;set the motion direction to be <<
        board[0][2] = 1; // sbr r23, 0x10 ;set the top right LED to be on
        // ;shift the 111, 011, or 001 to be 111, 110, or 100
        if ((stacker_row & (1<<2)) === 0) // sbrs r26, 2 ;if the 2nd bit is 0
          stacker_row = stacker_row << 1; // lsl r26     ;shift left
        if ((stacker_row & (1<<2)) === 0) // sbrs r26, 2 ;if the 2nd bit is 0
          stacker_row = stacker_row << 1;// lsl r26     ;shift left
        // stackerFellBackwardsAfter:
      }
      //
      timer = 0; // clr r25 ;clear the loop counter for consistent movement
      incScore(); // rcall incScore ;increment the score

      currentState = 'stackerMove'; // ldi r18, 11 ;change state to stackerMove

      // mov r30, r17
      if (score < 3) { // subi r30, 3 ;if score < 3
        // brsh stackerFellAfterExtraDelay
        stacker_delay--; // dec r27 ;decrease the delay
      }
      // stackerFellAfterExtraDelay:
      // mov r30, r17
      if (score < 9) { // subi r30, 9 ;if score < 9
        // brsh stackerFellAfterExtraDelay2
        stacker_delay--; // dec r27 ;decrease the delay
      }
      // stackerFellAfterExtraDelay2:
      if (score === 11) {// subi r30, 2 ;if score-9 == 2 (aka score == 11)
        // brne stackerFellAfterExtraDelay3
        stacker_delay--; // dec r27 ;decrease the delay
      }
      // stackerFellAfterExtraDelay3:
      if (score === 14) { // subi r30, 3 ;if score-9-2 == 3 (aka score == 14)
        // brne statesEnd
        stacker_delay--; // dec r27 ;decrease the delay
      }
    }
  } else if (currentState === 'reactionWait') {
    timer--; //subi r25, 0 ;if the random timer is up
    if (timer < 0) timer = 255;
    if (timer === 0) { //brne reactionWaitEnd
      board[1][1] = 1; //sbr r22, 0x10 ;turn on LED(1,1)
      score = 65; //ldi r17, 65 ;allow 1 second to press it
      currentState = 'reactionPress'; //ldi r18, 20 ;change state to reactionPress
    }
  } else if (currentState === 'reactionPress') {
    score--; //dec r17 ;decrease the score
    if (score === 0 || buttonS.justPressed) { //breq reactionPressGameOver ;if the score is 0 (4 sec has passed), end the game
      //sbrs r19, 0 ;if S pressed
      score = score >> 1; //lsr r17 ;divide score by 2
      score = score >> 1; //lsr r17 ;divide score by 2
      timer = 0; //clr r27 ;clear the timer for the transition
      currentState = 'transition'; //ldi r18, 6 ;change state to transition
      nextState = 'generalScore'; //ldi r16, 12 ;after that, change state to generalScore
      nextNextState = 'reactionInit'; //ldi r26, 2 ;finally, it will be reactionInit
    }
  } else {
    currentState = 'gameSelect';
  }

//   if (buttonL.pressed) {
//     board[0][0] = 1
//   } else {
//     board[0][0] = 0
//   }
//   for (x=0; x<3; x++){
//     for (y=0; y<3; y++){
//         board[y][x] = 0
//       if (Math.random() >= 0.97) {
//         board[y][x] = 1
//       }
//       if (Math.random() >= 0.99) {
//         board[y][x] = 2
//       }
//     }
//   }
}

function dec2bin(dec) {
return (dec >>> 0).toString(2);
}

function fallScreen() {
  board[2] = board[1]
  board[1] = board[0]
  board[0] = [0,0,0]
  // ;shift all pixels on the screen down by 1, replacing the top row with blank
  // ;NOTE: only works for solidly on pixels, not blinking or dim
  //
  // ;copy the middle row to the bottom (preserving the top, but not the middle)
  // ;r21H <- r20L   0,2 <- 0,1
  // ;	cbr r21, 0xf0  ;clear r21H (the destination)
  // ;	mov r30, r20   ;copy r20 so we can modify it
  // ;	andi r30, 0x0f ;get only r20L
  // ;	swap r30       ;move r20L to r30H
  // ;	or r21, r30    ;copy what was r20L to r21H
  // bst r20, 0 ;copy from LED(0,1) into T
  // bld r21, 4 ;copy T into LED(0,2)
  //
  // ;r22L <- r22H   1,2 <- 1,1
  // swap r22       ;just swap the nybbles (messing up the middle, but it's OK)
  //
  // ;r24H <- r23L   2,2 <- 2,1
  // ;	cbr r24, 0xf0  ;clear r24H (the destination)
  // ;	mov r30, r23   ;copy r23 so we can modify it
  // ;	andi r30, 0x0f ;get only r23L
  // ;	swap r30       ;move r23L to r30H
  // ;	or r24, r30    ;copy what was r23L to r24H
  // bst r23, 0 ;copy from LED(2,1) into T
  // bld r24, 4 ;copy T into LED(2,2)
  //
  //
  // ;copy the top row to the middle (preserving the bottom, but not the top)
  // ;r20L <- r20H   0,1 <- 0,0
  // swap r20       ;just swap the nybbles (messing up the top, but it's OK)
  //
  // ;r22H <- r21L   1,1 <- 1,0
  // ;	cbr r22, 0xf0  ;clear r22H (the destination)
  // ;	mov r30, r21   ;copy r21 so we can modify it
  // ;	andi r30, 0x0f ;get only r21L
  // ;	swap r30       ;move r21L to r30H
  // ;	or r22, r30    ;copy what was r21L to r22H
  // bst r21, 0 ;copy from LED(1,0) into T
  // bld r22, 4 ;copy T into LED(1,1)
  //
  // ;r23L <- r23H   2,1 <- 2,0
  // swap r23       ;just swap the nybbles (messing up the top, but it's OK)
  //
  // ;falling thru to the next function is intentional
  // clearTopRow:
  // ;clear the top row
  // cbr r20, 0xf0  ;clear 0,0
  // cbr r21, 0x0f  ;clear 1,0
  // cbr r23, 0xf0  ;clear 2,0
  //
  // ret
}

function incScore() {
  if (score < 128) score++;
}

function randomLED() {
  r = random() % 6;
  if (r === 0 || r === 1) {
    board[0][2] = 1
    return 'R'
  } else if (r === 2 || r === 3) {
    board[2][2] = 1
    return 'S'
  } else {
    board[0][0] = 1
    return 'L'
  }

}

function clearScreen() {
  showScore(0)
}

function showScore(score) {
  if      (score ===  0) board = [[0,0,0],[0,0,0],[0,0,0]]
  else if (score ===  1) board = [[0,0,0],[0,1,0],[0,0,0]]
  else if (score ===  2) board = [[1,0,0],[0,0,0],[0,0,1]]
  else if (score ===  3) board = [[1,0,0],[0,1,0],[0,0,1]]
  else if (score ===  4) board = [[1,0,1],[0,0,0],[1,0,1]]
  else if (score ===  5) board = [[1,0,1],[0,1,0],[1,0,1]]
  else if (score ===  6) board = [[1,0,1],[1,0,1],[1,0,1]]
  else if (score ===  7) board = [[1,0,1],[1,1,1],[1,0,1]]
  else if (score ===  8) board = [[1,1,1],[1,0,1],[1,1,1]]
  else if (score ===  9) board = [[1,1,1],[1,1,1],[1,1,1]]

  else if (score === 10) board = [[0,1,0],[0,0,0],[0,0,0]]
  else if (score === 11) board = [[0,0,0],[1,0,0],[0,0,0]]
  else if (score === 12) board = [[0,1,0],[1,0,0],[0,0,0]]
  else if (score === 13) board = [[0,0,0],[0,0,0],[0,1,0]]
  else if (score === 14) board = [[0,1,0],[0,0,0],[0,1,0]]
  else if (score === 15) board = [[0,0,0],[1,0,0],[0,1,0]]
  else if (score === 16) board = [[0,1,0],[1,0,0],[0,1,0]]
  else if (score === 17) board = [[0,0,0],[0,0,1],[0,0,0]]
  else if (score === 18) board = [[0,1,0],[0,0,1],[0,0,0]]
  else if (score === 19) board = [[0,0,0],[1,0,1],[0,0,0]]
  else if (score === 20) board = [[0,1,0],[1,0,1],[0,0,0]]
  else if (score === 21) board = [[0,0,0],[0,0,1],[0,1,0]]
  else if (score === 22) board = [[0,1,0],[0,0,1],[0,1,0]]
  else if (score === 23) board = [[0,0,0],[1,0,1],[0,1,0]]
  else if (score === 24) board = [[0,1,0],[1,0,1],[0,1,0]]
  else if (score >=  25) board = [[0,1,0],[1,1,1],[0,1,0]]
}

function handle_key(e) {
  //when this function returns false, it disables the default event, such as spacebar scrolling the page
  e = e || window.event;
  if (!e.repeat) {
    console.log(e.type, e.keyCode)
    if (
      e.keyCode === 76 || //L
      e.keyCode === 81 || //Q
      e.keyCode === 49 || //1
      e.keyCode === 37 || //Left Arrow
      e.keyCode === 37 || //Left Arrow
      false
    ) {
      if (e.type === 'keydown') {
        press(buttonL);
        scrollEnabled = false;
      } else {
        release(buttonL);
      }
      vibrate();
      return false;
    }
    if (
      e.keyCode === 82 || //R
      e.keyCode === 87 || //W
      e.keyCode === 50 || //2
      e.keyCode === 39 || //Right Arrow
      e.keyCode === 38 || //Up Arrow
      false
    ) { //W
      if (e.type === 'keydown') {
        press(buttonR);
        scrollEnabled = false;
      } else {
        release(buttonR);
      }
      vibrate();
      return false;
    }
    if (
      e.keyCode === 83 || //S
      e.keyCode === 51 || //3
      e.keyCode === 40 || //Down Arrow
      e.keyCode === 32 || //Space
      e.keyCode === 13 || //Enter
      false
    ) {
      if (e.type === 'keydown') {
        press(buttonS);
        scrollEnabled = false;
      } else {
        release(buttonS);
      }
      vibrate();
      return false;
    }
  }
  return true;
}

var scrollEnabled = true;
var lastScroll = window.scrollY;
var scrollS = 0;
var scrollR = 0;
function handle_scroll(e) {
  // console.log(window.scrollY, e)
  if (scrollEnabled) {
    if (window.scrollY - lastScroll > 25){
      scrollS = 20; //after this many frames (64 frames = 1 sec) it will have pressed and released
      lastScroll = window.scrollY;
    }
    if (window.scrollY - lastScroll < -25){
      scrollR = 20;
      lastScroll = window.scrollY;
    }
  }
}

function init_ctx(id, w, h) {
  var ctx = document.getElementById(id).getContext('2d');
  ctx.canvas.width = w;
  ctx.canvas.height = h;

  return ctx
}

function scale(id) {
  //scale the canvas to fit the screen
  var elem = document.getElementById(id)
  // https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial/Optimizing_canvas#scaling_canvas_using_css_transforms
  var scaleX = (window.innerWidth*.9-35) / elem.width;
  var scaleY = window.innerHeight / elem.height;

  var scaleToFit = Math.min(scaleX, scaleY);
  var scaleToCover = Math.max(scaleX, scaleY);

  elem.style.transformOrigin = '0 0'; //scale from top left
  elem.style.transform = 'scale(' + scaleToFit + ')';
  elem.style.left = (window.innerWidth - elem.width*scaleToFit)/2+'px';
  return scaleToFit
}

var ctx0 = null;
var ctx1 = null;
var ctx2 = null;
var w;
var h;
//0=off, 1=on, 2=dim
var board = [
  [0,0,0],
  [0,0,0],
  [0,0,0]
]

var ctxs;
var ctxButtonL;
var ctxButtonR;
var ctxButtonS;

key_events = [];
var buttonL = {pressed: false, prev: false, justPressed: false, justReleased: false}
var buttonR = {pressed: false, prev: false, justPressed: false, justReleased: false}
var buttonS = {pressed: false, prev: false, justPressed: false, justReleased: false}

function press(button) {
  if (!button.pressed) button.justPressed = true;
  button.pressed = true;
}

function release(button) {
  if (button.pressed) button.justReleased = true;
  button.pressed = false;
}

function play() {
  document.onkeydown = handle_key;
  document.onkeyup = handle_key;
  window.onscroll = handle_scroll;

  w = Math.round(2777/2)
  h = Math.round(2694/2)

  scale('off_img')
  var ctxLED00 = init_ctx('LED00', w, h); scale('LED00');
  var ctxLED10 = init_ctx('LED10', w, h); scale('LED10');
  var ctxLED20 = init_ctx('LED20', w, h); scale('LED20');
  var ctxLED01 = init_ctx('LED01', w, h); scale('LED01');
  var ctxLED11 = init_ctx('LED11', w, h); scale('LED11');
  var ctxLED21 = init_ctx('LED21', w, h); scale('LED21');
  var ctxLED02 = init_ctx('LED02', w, h); scale('LED02');
  var ctxLED12 = init_ctx('LED12', w, h); scale('LED12');
  var ctxLED22 = init_ctx('LED22', w, h); scale('LED22');

  ctxs = [
    [ctxLED00,ctxLED10,ctxLED20],
    [ctxLED01,ctxLED11,ctxLED21],
    [ctxLED02,ctxLED12,ctxLED22]
  ]

  ctxDim = init_ctx('dim', w, h); scale('dim');

  ctxButtonL = init_ctx('buttonL', w, h); scale('buttonL');
  ctxButtonR = init_ctx('buttonR', w, h); scale('buttonR');
  ctxButtonS = init_ctx('buttonS', w, h); scale('buttonS');

  ctxClick = init_ctx('click', w, h);
  var factor = scale('click');

  //scale the game canvas container div's height so the stuff below will not be underneath
  canvas_height_on_page = document.getElementById('dim').height*factor+'px';
  document.getElementById('game').style.height = canvas_height_on_page;


//   document.getElementById('click').addEventListener('click', handle_click);
  document.getElementById('click').addEventListener('mousedown', handle_click);
  document.getElementById('click').addEventListener('mouseup', handle_click);
  // document.getElementById('click').addEventListener('touchstart', handle_click);
  // document.getElementById('click').addEventListener('touchend', handle_click);

  on_img = document.getElementById('on_img');
  dim_img = document.getElementById('dim_img');

  document.getElementById('off_img').style.display = 'initial';
  document.getElementById('off_img_noscript').style.display = 'none';

//   document.getElementById('off_img').style.display = 'none';

  render_init();

  FPS = 64
  setInterval(loop, 1000/FPS);
}
window.onload = play;
  </script>

<p>ATinyGame is a $1 game console that fits in 1 hand, with a program smaller than 1kB. Download the <a target="_blank" href="ATinyGame.pdf">instruction PDF</a> to learn how to use it. Read the harrowing tale of its development: <a target="_blank" href="https://blog.johanv.xyz/the-assembly-instruction-that-saved-christmas">The Assembly Instruction that Saved Christmas</a>.
You can see the <a target="_blank" href="https://easyeda.com/jjvan/aTinyGame-5a98fb4c47414c39bf407d7c0f4ad94f">board design on EasyEDA</a> (<a target="_blank" href="https://easyeda.com/jjvan/GamesAttiny-0c60b91066fd4798b2eaa3da66746e06">old version here</a>).
Note that there are some changes and caveats to this design. The PCB design was incorrect, which required some adjustments and extra components after the fact. More details will be added soon.</p>

<img style="width:60%; display:block; margin-left:auto; margin-right:auto" src="/f/galleries/Random/ATinyGame.jpg" alt="">

<p>I might put un-assembled kits up for sale (since it takes me 45 min to solder each one), or at the very least I will post instructions for creating it from scratch. Either way expect tutorials and videos soon! Follow me on <a target="_blank" href="https://fosstodon.org/@johanv">mastodon</a> for updates.</p>
<p>If you have a question or comment, or if you would like to purchase one, send me and email. <a id="9dda4e98_2" href="#9dda4e98_2" onclick="this.innerHTML='&#x202e;'+'moc'+'&#x2e;'+'liamydnav'+'&#x40;'+'nahoj'+'&#x202d;'">[click to show email address]</a></p>

<p>"1kB you say?", you say. Well here's the code below as loaded onto the ATTiny9. This contains 4 games, a random number generator, a state machine, etc.
The assembly code is on <a target="_blank" href="https://codeberg.org/johanvandegriff/ATinyGame">Codeberg</a>, <a target="_blank" href="https://git.sr.ht/~johanvandegriff/ATinyGame">Sourcehut</a>, and <a target="_blank" href="https://github.com/johanvandegriff/ATinyGame">Github</a>
</p>
<pre>
      +0 +1 +2 +3 +4 +5 +6 +7 +8 +9 +A +B +C +D +E +F
4000: E0 E0 EE BF EF E5 ED BF E0 E0 F8 ED FC BF E6 BF 
4010: 00 00 87 E0 33 27 8F D1 99 27 26 E0 00 E0 E3 E1 
4020: E2 0F F0 E0 09 94 14 C0 9C C0 2C C0 40 C0 6E C0 
4030: 8F C0 1E C0 44 C0 52 C0 6D C0 6E C0 9C C0 14 C1 
4040: B4 C0 CA C0 CC C0 7C C0 3F C0 DA C0 1F C0 24 C0 
4050: E0 2F 81 D1 BB 27 32 FD 0A 95 00 50 09 F0 31 FD 
4060: 03 95 E0 2F E6 50 09 F4 0A 95 30 FD 26 E0 06 C1 
4070: 42 E2 5B D1 80 62 B3 95 B5 FF 00 C1 20 2F 01 E0 
4080: 5A D1 FC C0 96 D1 9F 2F 23 E1 F8 C0 90 50 19 F4 
4090: 60 61 11 E4 24 E1 F2 C0 1A 95 11 F0 30 FF EE C0 
40A0: 16 95 16 95 BB 27 26 E0 0C E0 A2 E0 E7 C0 81 D1 
40B0: AF 2F 11 E0 B1 E0 99 27 2E E0 07 E0 DF C0 8E D1 
40C0: 99 27 2E E0 01 E1 DA C0 99 27 2E E0 07 E0 33 D1 
40D0: BA 95 19 F4 A0 A9 B1 2F 28 E0 D0 C0 30 50 61 F0 
40E0: 7D D1 29 D1 C3 23 49 F0 BA 95 31 F4 A0 A9 99 27 
40F0: 2E E0 07 E0 55 D1 B1 2F C1 C0 5B D1 BA 95 E9 F7 
4100: 16 95 BB 27 26 E0 0C E0 A3 E0 B8 C0 BB 27 10 E0 
4110: 29 E0 B4 C0 2A E0 62 D1 B3 95 71 F0 30 50 59 F0 
4120: EC 2F E3 23 29 F0 3C D1 06 D1 20 E1 09 E0 A6 C0 
4130: 10 50 09 F0 1A 95 A2 C0 26 E0 0C E0 A4 E0 9E C0 
4140: B3 95 D1 F3 E8 2F E7 70 E0 50 71 F5 20 2F 96 C0 
4150: 32 FD 26 E0 00 E0 BB 27 2C D1 E3 95 31 FD FB D0 
4160: 8D C0 41 E1 50 E1 E2 D0 80 61 99 27 A0 E7 C1 E0 
4170: BD E0 10 E0 2B E0 30 FD 18 C0 E9 2F EB 1B A1 F4 
4180: 99 27 C0 FD A6 95 C0 FF AA 0F E1 D0 A4 FD 40 61 
4190: A3 FD 51 60 A2 FD 70 61 50 FD 70 C0 C0 FF 02 C0 
41A0: 74 FD C0 E0 44 FD C1 E0 69 C0 2D E0 40 FD 04 C0 
41B0: 44 FF 02 C0 4F 70 40 64 64 FD 04 C0 50 FF 02 C0 
41C0: 50 7F 54 60 70 FD 04 C0 74 FF 02 C0 7F 70 70 64 
41D0: 99 27 2E E0 0F E0 52 C0 95 FD 20 2F 4F C0 46 FF 
41E0: 02 C0 40 70 44 60 52 FF 03 C0 50 7F 6F 70 60 64 
41F0: 76 FF 02 C0 70 70 74 60 99 27 2E E0 02 E1 3E C0 
4200: 4B 7F 6F 7B 7B 7F AA 27 44 FD A4 60 50 FD A2 60 
4210: 74 FD A1 60 A0 FF A6 95 A0 FF A6 95 A0 50 29 F4 
4220: BB 27 26 E0 0C E0 A1 E0 29 C0 88 D0 10 FF 04 C0 
4230: 40 61 A2 95 C1 E0 06 C0 C0 E0 70 61 A2 FF AA 0F 
4240: A2 FF AA 0F 99 27 AC D0 2B E0 E1 2F E3 50 08 F4 
4250: BA 95 E1 2F E9 50 08 F4 BA 95 E2 50 09 F4 BA 95 
4260: E3 50 61 F4 BA 95 0A C0 E1 2F 75 D0 3E 7F 30 50 
4270: 29 F0 BB 27 26 E0 0A 2F 32 FD 00 E0 38 2F 88 7F 
4280: D4 E0 D1 B9 E0 E0 E2 B9 48 D0 03 9B 8D 2B D6 95 
4290: D0 50 B9 F7 30 95 38 23 37 70 E4 2F E2 95 FC E0 
42A0: D4 E0 28 D0 E4 2F FA E0 D2 E0 24 D0 E5 2F E2 95 
42B0: F9 E0 D1 E0 1F D0 E5 2F F6 E0 D2 E0 1B D0 E6 2F 
42C0: E2 95 F6 E0 D4 E0 16 D0 E6 2F F5 E0 D4 E0 12 D0 
42D0: E7 2F E2 95 F5 E0 D1 E0 0D D0 E7 2F F3 E0 D1 E0 
42E0: 09 D0 E8 2F E2 95 F3 E0 D2 E0 04 D0 E0 E0 E1 B9 
42F0: 93 95 95 CE F1 B9 F0 E0 F2 B9 E0 FD 05 C0 E1 FD 
4300: 06 C0 E2 FD 92 FD 01 C0 D2 B9 09 D0 08 95 07 D0 
4310: D2 B9 E0 E4 F0 E0 05 D0 08 95 FB E0 01 C0 F8 E0 
4320: EF EF E1 50 F0 40 E9 F7 08 95 54 2F 64 2F 75 2F 
4330: 72 95 8F 70 08 95 44 27 F8 DF 08 95 40 FB 54 F9 
4340: 62 95 70 FB 84 F9 42 95 50 FB 64 F9 72 95 4F 70 
4350: 50 7F 7F 70 08 95 EF DF EA 50 A0 F4 E6 5F E0 FD 
4360: 60 61 E2 50 E0 F0 40 61 80 61 E2 50 C0 F0 50 61 
4370: 70 61 E2 50 A0 F0 41 60 71 60 E2 50 80 F0 51 60 
4380: 61 60 0D C0 EF 50 10 F0 60 61 EF EF E0 5F E0 FD 
4390: 51 60 E1 FD 41 60 E2 FD 61 60 E3 FD 71 60 08 95 
43A0: 17 FF 13 95 08 95 88 60 93 95 09 F4 93 95 9A 95 
43B0: 90 A9 83 FF F8 CF E0 A1 FE 2F EE 0F EE 0F FE 27 
43C0: EE 0F FE 27 EE 0F FE 27 F0 95 E0 A1 FF 1F EE 1F 
43D0: E0 A9 FE 2F E6 50 F0 F7 EA 5F 08 95 AC DF E9 DF 
43E0: E2 50 28 F0 E2 50 30 F0 40 61 C4 E0 08 95 70 61 
43F0: C2 E0 08 95 80 61 C1 E0 08 95 FF FF FF FF FF FF 
</pre>
<?php $GLOBALS['email_counter']++; ?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
