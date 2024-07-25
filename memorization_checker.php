<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorization Checker</title>
    <link rel="stylesheet" href="css/style4.css">
</head>
<body>
<div class="container">
    <div class="box form-box">
        <header>Memorization Checker</header>
        <hr>
        <div class="content">
            <button class="record-btn" disabled>Record</button>
            <label>
            <textarea class="input-text"
                placeholder="Type text here or record your voice"
                oninput="enableButton()"></textarea>
            </label>
        </div>
        <div class="output">
            <label>
            <textarea class="output-text"
                 placeholder="Results will be here"></textarea>
            </label>
        </div>
        <button class="save-btn" onclick="saveResults()">Save</button>
        <a href="home.php" class="back-btn">Back to Home</a>
    </div>
</div>
<script>
    const recordButton = document.getElementsByClassName('record-btn')[0];
    const saveButton = document.getElementsByClassName('save-btn')[0];
    const outputDiv = document.getElementsByClassName('output-text')[0];
    const inputDiv = document.getElementsByClassName('input-text')[0];

    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition || window.mozSpeechRecognition || window.msSpeechRecognition)();
    recognition.lang = 'en-US';
    recognition.continuous = true;
    var finalOutputArray = [];
    var i = 0;

    function enableButton() {
        recordButton.disabled = false;
    }

    function missed_words(inputArray, outputArray) {
        var count1 = 0;
        var count2 = 0;
        let missed_position = [];
        for (let z in outputArray) {
            if (outputArray[z] === 'I') {
                outputArray[z] = 'i';
            }
        }

        //First check if we have reached the end of the input
        while (count1 !== inputArray.length) {

            //If so, check if we reached the end of the output, if so the user missed the rest of the input
            if (count2 === outputArray.length) {
                missed_position.push(count1);
                count1++;
            }

            //If the words match, continue
            else if (inputArray[count1] === outputArray[count2]) {
                count1++;
                count2++;
            }

            //If not, place the position of the missed word in missed_position
            else {
                missed_position.push(count1);
                count1++;
            }
        }
        return missed_position;
    }

    function highlightDifferingWords(inputArray, position) {
        const asterisk = '*';
        for (let i in position) {
            inputArray[position[i]] = asterisk.concat(inputArray[position[i]], asterisk);
        }
        const results = inputArray.join(" ");
        outputDiv.textContent = results;
    }

    function removePunctuation(str) {
        return str.replace(/[!"#$%&()*+,-./:;<=>?@[\]^_`{|}~]/g, '');
    }

    //Once the speech recognizer starts, changes the button to "Stop Recording"
    recognition.onstart = () => {
        recordButton.textContent = 'Stop Recording';

    };

    //When the speech recognizer finishes
    recognition.onresult = (event) => {
        //Store the resulting transcript in outputArray
        var transcript = event.results[i][0].transcript;
        var outputArray = transcript.split(" ");
        if (i === 0) {
            for (let x in outputArray) {
                finalOutputArray.push(outputArray[x]);
            }
        }
        else {
            for (let y = 1; y <= outputArray.length-1; y++){
                finalOutputArray.push(outputArray[y]);
            }
        }
        i++;
    };

    //Once the speech recognizer stops registering words, change the button back to "Record"
    recognition.onend = () => {
        //And the user input as inputArray
        let userInputPunctuation = inputDiv.value.split(" ")
        let userInputNoPunctuation = removePunctuation(inputDiv.value.toLowerCase());
        const inputArray = userInputNoPunctuation.split(" ");

        //Then call the function to get the position of missed words
        const position = missed_words(inputArray, finalOutputArray);

        //And finally highlight them and display them in the output text box
        highlightDifferingWords(userInputPunctuation, position);

        // Calculate percentage of missed words
        const missedCount = position.length;
        const totalWords = inputArray.length;
        const missedPercentage = (missedCount / totalWords) * 100;

        // Display the percentage of missed words
        const percentageDiv = document.createElement('div');
        percentageDiv.textContent = `Percentage of words missed: ${missedPercentage.toFixed(2)}%`;
        document.querySelector('.output').appendChild(percentageDiv);

        // Store results for saving
        saveButton.dataset.inputText = inputDiv.value;
        saveButton.dataset.missedPercentage = missedPercentage.toFixed(2);
    };

    recognition.nomatch = () => {
        outputDiv.textContent = "Please repeat the recitation."
    };

    //Event to begin the speech recognizer

    recordButton.addEventListener('click', () => {
        if (recordButton.textContent !== 'Record') {
            recordButton.textContent = 'Record';
            recognition.stop();
        }
        recognition.start();
    });

    function saveResults() {
        const inputText = saveButton.dataset.inputText;
        const missedPercentage = saveButton.dataset.missedPercentage;

        if (inputText && missedPercentage !== undefined) {
            // Send data to save_results.php via POST
            fetch('save_results.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    inputText: inputText,
                    missedPercentage: missedPercentage
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Results saved successfully!');
                } else {
                    alert('Error saving results.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }
</script>
</body>
</html>
