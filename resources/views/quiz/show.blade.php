@extends('layout.index')

@section('content')
    <section class="container">
        <h1>{{$quiz->name}}</h1>
        <p>{{ $quiz->description }}</p>
        <br />
        <div>
            <div id="gameHeaderWrapper">
                <div id="gameBarBox" class="@if($quiz->type == "clicking" || $quiz->type == "Clicking") clicking @endif">

                    <div id="playGameBar">
                        <div id="playGameBox">

                            <div id="playPadding">
                                @if($quiz->type == "Typing" || $quiz->type == "typing")
                                    <button id="button-play" class="button-primary " onclick="startQuiz();">
                                        PLAY QUIZ
                                    </button>
                                @endif
                            </div>

                            <div id="answer-wrapper" style="display:none">
                                <button id="previousButton" class="button-secondary" onclick="pickPreviousSlot();">prev</button>
                                <div id="answerBox">
                                    <label id="answerText"><span id="currgamename"></span>:</label>
                                    <input type="text" id="gameinput" class="answerEntry narrow js-bound" oninput="checkGameInput(this);" autocapitalize="off" spellcheck="true" autocomplete="off" autocorrect="off">
                                </div>
                                <button id="nextButton" class="button-secondary" onclick="pickSlot();">next</button>
                            </div>
                        </div>


                        <div id="postGameBox" style="display:none">
                            <div id="gameOverMsg" class="reckon-section">
                                <div class="reckon-title">You got</div>
                                <div class="reckon-score"><span id="userPct"></span>%</div>
                            </div>
                            <div id="snark"></div>
                            <div id="reckonMsg" class="reckon-section">
                                <div class="reckon-title">Avg Score</div>
                                <div class="reckon-score"><span id="avgPct">81</span>%</div>
                            </div>

                            <div id="friendAvg" class="reckon-section">
                                <div class="reckon-title">Avg Friend Score</div>
                                <button class="button-secondary orange-score-promo">Upgrade to see</button>
                            </div>
                        </div>

                    </div>

                    <div id="timerScoreBox">

                        <div id="scoreBox" class="dataBox">
                            <div class="dropdown-menu-container" id="quiz-score-dropdown">
                                <button class="unformatted dropdown-menu-trigger" data-trigger-for="score-box-dropdown-menu" aria-label="Toggle quiz menu">Score</button>
                                <div class="dropdown-menu" id="score-box-dropdown-menu" style="display: none;">
                                    <button class="unformatted dropdown-item score-controls-btn active" data-value="numeric" aria-label="Show numerical score">
                                        <div class="item-icon"></div>
                                        <div class="item-content">Numerical</div>
                                    </button>
                                    <button class="unformatted dropdown-item score-controls-btn" data-value="percentage" aria-label="Show percentage score">
                                        <div class="item-icon"></div>
                                        <div class="item-content">Percentage</div>
                                    </button>
                                </div>
                            </div>

                            <div class="currentScore"></div>
                        </div>


                        <div id="pauseBox" style="visibility:hidden">
                            <button class="unformatted" id="pauseButton" onclick="pauseGame();"></button>
                        </div>

                        <div id="timeBox" class="dataBox">
                            <div class="dropdown-menu-container" id="quiz-time-dropdown">
                                <button class="unformatted dropdown-menu-trigger" data-trigger-for="time-box-dropdown-menu" aria-label="Toggle quiz menu">Timer</button>
                                <div class="dropdown-menu" id="time-box-dropdown-menu" style="display: none;">
                                    <button class="unformatted dropdown-item timer-controls-btn active" data-value="timer" aria-label="Use default timer">
                                        <div class="item-icon"></div>
                                        <div class="item-content">Default Timer</div>
                                    </button>
                                    <button class="unformatted dropdown-item timer-controls-btn" data-value="stopwatch" aria-label="Use stopwatch timer">
                                        <div class="item-icon"></div>
                                        <div class="item-content">Stopwatch</div>
                                    </button>
                                </div>
                            </div>

                            <div id="time"></div>

                            <button id="giveUp" class="unformatted" style="display:none">Give Up</button>

                        </div>

                    </div>

                </div>
                <div id="reckonBox" class="post-game-links" style="display: none;">
                    <div class="reckon-bar-wrapper">
                        <div class="label">Replay</div>
                        <a id="replay-link" class="reckon-bar-action" href="/games/CommodoreAmazing/Hiragana">
                            <div class="icon"></div>
                            <div class="screen-reader-text">Link that replays current quiz</div>
                        </a>
                    </div>


                    <div class="reckon-bar-wrapper">
                        <div class="label">Next Quiz</div>
                        <a id="next-quiz-link" class="reckon-bar-action" title="Play next quiz: Japanese in English" href="/games/Ignis_Umbrae/english_etymology_japanese?playlist=speaking-japanese&amp;creator=SporcleEXP&amp;pid=1f54b49b6j">
                            <div class="icon"></div>
                            <div class="screen-reader-text">Link to next quiz in quiz playlist</div>
                        </a>
                    </div>


                    <div class="reckon-bar-wrapper">
                        <div class="label">Quiz Stats</div>
                        <button id="reckonStats" class="reckon-bar-action">
                            <div class="icon"></div>
                            <div class="screen-reader-text">Open a modal to take you to registration information</div>
                        </button>
                    </div>


                    <div class="reckon-bar-wrapper">
                        <div class="label">Challenge Friends</div>
                        <button id="postgame-challenge-button" class="reckon-bar-action">
                            <div class="icon"></div>
                            <div class="screen-reader-text">Button that open a modal to initiate a challenge</div>
                        </button>
                    </div>


                    <div class="reckon-bar-wrapper">
                        <div class="label">Random Quiz</div>
                        <a id="random-link" class="reckon-bar-action" href="/games/random.php?c=language">
                            <div class="icon"></div>
                            <div class="screen-reader-text">Link to a random quiz page</div>
                        </a>
                    </div>

                    <div class="reckon-bar-wrapper">
                        <div class="label">Save</div>
                        <a id="random-link" class="reckon-bar-action" onclick="submitForm()" href="#">
                            <div class="icon"></div>
                            <div class="screen-reader-text">Save the game</div>
                        </a>
                    </div>

                </div>
                <div id="gameHeaderTransition"></div>
            </div>
        </div>
        @php
            $nameCount = 0;
            $borderCount = 0;
            $slotCount = 0;
        @endphp
        @if($quiz->type == "Typing" || $quiz->tpye == "typing")
            <div class="quiz-list">
                <table id="gameTable">
                    <tbody>
                    <tr>
                        @foreach($questions as $row => $innerArray)
                            @foreach($innerArray as $innerRow => $question)
                                <td class="gametable-col">
                                    <table class="data">
                                        <tbody>
                                        <tr>
                                            <th class="h_name">{{$quiz->h_name}}</th>
                                            <th class="h_value">{{$quiz->h_value}}</th>
                                        </tr>

                                        @foreach($question as $elementRow => $element)
                                            <tr class="question">
                                                <td class="d_name" id="name{{$nameCount++}}" onclick="pickSlot(this)">{{ $element->question }}</td>
                                                <td class="d_value" id="slot{{$slotCount++}}" onclick="pickSlot(this)"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            @endforeach
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>
        @elseif($quiz->type == "Clicking" || $quiz->type == "clicking")
            <div id="game-wrapper" class="clicking">
                <div id="questionbox">
                    <div id="currQuestion" class="question"></div>

                    <div id="skip" style="visibility:hidden">
                        <button id="pickprev" class="button-secondary" onclick="pickPreviousSlot();" alt="Click to skip to previous" name="Skip">Prev</button>
                        <button id="picknext" class="button-secondary" onclick="pickSlot();" alt="Click to skip to next" name="Skip">Next</button>
                    </div>
                    @foreach($questions as $row => $innerArray)
                        @foreach($innerArray as $innerRow => $question)
                            @foreach($question as $elementRow => $element)
                                <div id="name{{$nameCount++}}" style="display:none;" data-url="">{{ $element->question }}<br></div>
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
                <div id="answerbox">
                    <div id="playPadding">
                        <div id="playbuttonbox">

                            <button id="button-play" class="button-primary " onclick="startQuiz();">
                                PLAY QUIZ
                            </button>
                        </div>
                    </div>
                    @foreach($questions as $row => $innerArray)
                        @foreach($innerArray as $innerRow => $question)
                            @foreach($question as $elementRow => $element)
                                <div id="border{{$borderCount}}" class="borderOff">
                                    <div id="slot{{$borderCount++}}" class="answer" onclick="checkGameInput(this)" style="visibility:hidden">
                                        <div class="text"></div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endif
        <form method="post" id="gameStatsForm" action="{{ route("playQuizStore", [$quiz->name, $quiz])  }}" style="display: none">
            @csrf
            <input type="text" id="inputArray" name="array" value="" />
        </form>
    </section>

    <script>
        let gameStarted = false;
        let gameFinished = false;
        let currentScore = 0;
        let intervalTimer;
        let arrayCurrentCount = -1
        let divs;
        let removeClass = false;

        @if($quiz->type == "clicking" || $quiz->type == "Clicking")
            let arrayShuffled = @JSON($array);
        @endif

        // score
        function score()
        {
            let display;
            let questionCount;
            @if($quiz->type == "typing" || $quiz->type == "Typing")
                display = document.querySelector('.currentScore');
                let table = document.getElementById("gameTable");

                //1. get all rows
                let rowsCollection = table.querySelectorAll("tr.question");

                //2. convert to array
                let rows = Array.from(rowsCollection)

                //3. count
                questionCount = rows.length;
                display.textContent = currentScore + "/" + questionCount;

            @elseif($quiz->type == "clicking" || $quiz->type == "Clicking")
                display = document.querySelector('.currentScore');
                let div = document.getElementById("game-wrapper");

                //1. get all rows
                let divCollection = div.querySelectorAll("div.borderOff");

                //2. convert to array
                let divs = Array.from(divCollection)

                //3. count
                questionCount = divs.length;
                display.textContent = currentScore + "/" + questionCount;
            @endif

            if(currentScore === questionCount || gameFinished === true)
            {
                gameFinished = true;
                gameStarted = false;

                clearInterval(intervalTimer);

                startTimer();
                @if($quiz->type == "typing" || $quiz->type == "Typing")
                pickSlot();
                @endif
                gameEnd();
            }
            else
            {
                currentScore++;
            }
        }

        // timer
        function displayTimer(duration, display)
        {
            let timer = duration, minutes, seconds;

            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;
        }

        // countdown timer
        function startTimer()
        {
            timer();

            if(gameStarted === true)
            {
                intervalTimer = setInterval(timer, 1000)
            }
        }

        // count total minutes
        let duration = 60 * {{ $quiz->timer }};
        let timers = duration, minutes1, seconds;

        function timer () {

            let display = document.querySelector('#time');

            // count total minutes
            minutes1 = parseInt(timers / 60, 10);
            seconds = parseInt(timers % 60, 10);

            minutes1 = minutes1 < 10 ? "0" + minutes1 : minutes1;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes1 + ":" + seconds;


            if (--timers < 0) {
                gameFinished = true
                timers = 0;
                clearInterval(intervalTimer);
                gameEnd();
            }
        }

        function pickSlot(element)
        {
            let currentSelectedName = document.getElementsByClassName("nameactive");
            let currentSelectedValue = document.getElementsByClassName("valueactive");
            if(gameStarted === true && gameFinished === false) {

                @if($quiz->type == "typing" || $quiz->type == "Typing")
                // get current selected td
                let input = document.getElementById("gameinput");
                let currGameName;


                if (gameStarted === true)
                {
                    if (currentSelectedName.length !== 0 && currentSelectedValue.length !== 0) {
                        // remove class from current selected td
                        currentSelectedName.item(0).classList.remove("nameactive");
                        currentSelectedValue.item(0).classList.remove("valueactive");
                    } else {
                        // add class to first td when starting the game
                        element.classList.add("nameactive");
                        element.nextElementSibling.classList.add("valueactive");

                        currGameName = element.textContent;
                    }
                    if (element.classList.contains("d_name")) {
                        // add class to element
                        element.classList.add("nameactive");
                        element.nextElementSibling.classList.add("valueactive");

                        currGameName = element.textContent;
                    } else if (element.classList.contains("d_value")) {
                        // add class to element
                        element.classList.add("valueactive");
                        element.previousElementSibling.classList.add("nameactive");

                        currGameName = element.previousElementSibling.textContent;
                    }

                    document.getElementById("currgamename").textContent = currGameName;
                    input.focus();
                } else if (gameFinished === true) {
                    currentSelectedName.item(0).classList.remove("nameactive");
                    currentSelectedValue.item(0).classList.remove("valueactive");
                }
                @elseif($quiz->type == "clicking" || $quiz->type == "Clicking")

                if (arrayShuffled.length >= arrayCurrentCount) {
                    arrayCurrentCount = 0;
                }
                document.getElementById("currQuestion").textContent = arrayShuffled[arrayCurrentCount]["question"];

                @endif
            }
            else
            {
                if(removeClass === false)
                {
                    currentSelectedName.item(0).classList.remove("nameactive");
                    currentSelectedValue.item(0).classList.remove("valueactive");
                    removeClass = true;
                }

            }
        }

        @if($quiz->type == "clicking" || $quiz->type == "Clicking")
        function pickPreviousSlot()
        {
            if(arrayCurrentCount === 0)
            {
                arrayCurrentCount = arrayShuffled.length;
            }
            document.getElementById("currQuestion").textContent = arrayShuffled[arrayCurrentCount]["question"];
            arrayCurrentCount--;
        }
        @endif

        function startQuiz()
        {
            gameStarted = true;
            // count total minutes
            let minutes = 60 * {{ $quiz->timer }} - 1;

            let display = document.querySelector('#time');

            // set styling of element
            document.getElementById("playPadding").style = "display:none";

            startTimer(minutes, display);

            @if($quiz->type == "typing" || $quiz->type == "Typing")
                // set styling of element
                document.getElementById("answer-wrapper").style.display = null;

                // get first tr in table
                let table = document.getElementById("gameTable");

                let rowsCollection = table.querySelectorAll("tr.question");

                let row = rowsCollection[0];

                let nameElement = row.children.item(0);

                pickSlot(nameElement);

                // focus on input field
                document.getElementById("gameinput").focus();
            @elseif($quiz->type == "clicking" || $quiz->type == "Clicking")

                let array = @JSON($array);
                // set styling of element
                document.getElementById("playbuttonbox").style = "display:none";

                let divElement = document.getElementsByClassName("answer");
                let i;


                for(i = 0; i < divElement.length; i++)
                {

                    let divNumber = divs[i].id.match(/\d+/)[0];

                    divElement.item(i).style = "visibility:visible";
                    divElement.item(i).firstElementChild.textContent = array[divNumber]["correct_answer"];
                }

                pickSlot(arrayShuffled);
            @endif
        }

        function checkGameInput(event)
        {
            if(gameStarted === true && gameFinished === false)
            {

                @if($quiz->type == "typing" || $quiz->type == "Typing")
                let input = document.getElementById("gameinput");
                let inputValue = input.value;

                let answer = "" + inputValue;

                let slot = document.querySelector(".valueactive").id;

                // get only the numbers from slot id
                let slotNumber = slot.match(/\d+/)[0];

                let array = @json($array);

                if (array[slotNumber]["correct_answer"].toUpperCase() === answer.toUpperCase()) {
                    // select next td
                    document.getElementById(slot).textContent = answer.toLowerCase();

                    let parentElement = document.getElementById(slot).parentElement;

                    let nextElement = parentElement.nextElementSibling;

                    let nameElement;

                    if (nextElement == null) {
                        let trParent = parentElement.parentElement;
                        let tableParent = trParent.parentElement;
                        let tdNext = tableParent.nextElementSibling;
                        let tdPrevious;

                        let tdChild;
                        if (tdNext == null) {
                            tdPrevious = tableParent.previousElementSibling.previousElementSibling.previousElementSibling;
                            let tableChild = tdPrevious.children;
                            let trChild = tableChild[0].children.item(1);
                            tdChild = trChild.children.item(0);
                        } else {
                            let tableChild = tdNext.children;
                            let trChild = tableChild[0].children.item(1);
                            tdChild = trChild.children.item(0);
                        }
                        nameElement = tdChild;
                    } else {
                        nameElement = nextElement.children.item(0);
                    }

                    // select next td
                    pickSlot(nameElement);

                    input.value = "";
                    input.focus();

                    // update score
                    score();
                }
                @elseif($quiz->type == "clicking" || $quiz->type == "Clicking")

                if (gameStarted === true) {
                    if (event.classList.contains("right")) {

                    } else {
                        if (arrayShuffled[arrayCurrentCount]["correct_answer"] === event.firstElementChild.textContent) {
                            event.classList.add("right");

                            arrayShuffled.splice(arrayCurrentCount, 1);
                            // update score
                            score();
                        } else {
                            arrayShuffled.splice(arrayCurrentCount, 1);
                        }
                    }
                    if (arrayShuffled.length === 0) {
                        gameFinished = true;
                        gameStarted = false;

                        if (gameFinished === true) {
                            clearInterval(intervalTimer);
                            gameEnd();
                        }
                        startTimer();
                    } else {
                        pickSlot();
                    }
                }
                @endif
            }
        }

        function gameEnd()
        {
            let array = @json($array);
            let i;
            let questionArray = @json($array);
            let gameQuizArray = [];
            let correct;
            let type;
            let slot;

            for(i = 0; i < array.length; i++)
            {
                @if($quiz->type == "typing" || $quiz->type == "Typing")
                 slot = document.getElementById("slot"+i);

                // if slot has text do nothing. If slotId doens't have text add answer in red.
                if(slot.innerText == "")
                {
                    slot.classList.add("in_correct");
                    slot.textContent = array[i]["correct_answer"];
                }

                if(slot.classList.contains("in_correct"))
                {
                   correct = "incorrect"
                }
                else
                {
                    correct = "correct"
                }
                @elseif($quiz->type == "clicking" || $quiz->type == "Clicking")
                slot = document.getElementById("slot"+i);
                currentScore--;
                // if slot has right class do nothing. If slotId doens't have correct class add class wrong in red.
                if (slot.classList.contains("right"))
                {

                }
                else
                {
                    slot.classList.add("wrong");
                }

                if (slot.classList.contains("wrong"))
                {
                    correct = "incorrect"
                } else
                {
                    correct = "correct"
                }
                @endif
                @if($quiz->type == "typing" || $quiz->type == "Typing")
                    type = "typing"
                @else
                    type = "clicking"
                @endif
                let obj = {
                    question: array[i], answer: slot.textContent, is_correct: correct, timer: timers,
                    type: type, capacity: 1, score: currentScore,
                };

                gameQuizArray.push(obj);
            }

            document.getElementById("inputArray").setAttribute("value", JSON.stringify(gameQuizArray));


            document.getElementById("playGameBox").style = "display: none";
            document.getElementById("reckonBox").style = "display:"

        }

        function shuffle(array)
        {
            let currentIndex = array.length,  randomIndex;

            // While there remain elements to shuffle.
            while (currentIndex != 0) {

                // Pick a remaining element.
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;

                // And swap it with the current element.
                [array[currentIndex], array[randomIndex]] = [
                    array[randomIndex], array[currentIndex]];
            }

            return array;
        }

        // shuffle table questions when quiz type is typing
        @if($quiz->type == "typing" || $quiz->type == "Typing")
        function shuffleTable()
        {
            //get the parent table for convenience
            let table = document.getElementById("gameTable");

            let innertable = document.getElementsByClassName("data")

            //1. get all rows
            let rowsCollection = table.querySelectorAll("tr.question");

            //2. convert to array
            let rows = Array.from(rowsCollection)

            //3. shuffle
            shuffle(rows);

            //4. count
            let totalCount = rows.length;

            let columnCount = innertable.length;

            let equalCount = Math.ceil(totalCount / columnCount);

            //5. add back to the DOM
            let arrayKey = 0
            for(let i = 0; i < rows.length; i += equalCount)
            {
                const chunk = rows.slice(i, i + equalCount);

                for(const row of chunk)
                innertable[arrayKey].appendChild(row);
                arrayKey++
            }
        }
        @elseif($quiz->type == "clicking" || $quiz->type == "Clicking")

        function shuffleDiv()
        {
            //get the parent div for convenience
            let div = document.getElementById("game-wrapper");

            let innerDiv = document.getElementById("answerbox");

            //1. get all divs
            let divCollection = div.querySelectorAll("div.borderOff");

            //2. convert to array
            divs = Array.from(divCollection)

            //3. shuffle
            shuffle(divs);

            //5. add back to the DOM
            for(let i = 0; i < divs.length; i++)
            {
                innerDiv.appendChild(divs[i]);
            }

            shuffle(arrayShuffled);
        }
        @endif

        @if($quiz->type == "typing" || $quiz->type == "Typing")
            let minutes = 60 * {{ $quiz->timer }};
            let display = document.querySelector('#time');
            window.onload = shuffleTable(), score(), displayTimer(minutes, display);
        @elseif($quiz->type == "clicking" || $quiz->type == "Clicking")
            let minutes = 60 * {{ $quiz->timer }};
            let display = document.querySelector('#time');
            window.onload = shuffleDiv(), score(), displayTimer(minutes, display);
        @endif

        function submitForm()
        {
            document.getElementById("gameStatsForm").submit();
        }
    </script>
@endsection
