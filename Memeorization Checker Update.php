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
            <textarea class="output-text" name="Missed_words"
                 placeholder="Results will be here"></textarea>
            </label>
            <label>
            <textarea class="output-text" name="Added_words"
                      placeholder="Results will be here"></textarea>
            </label>

        </div>
        <p class = 'div' id = "percentage">Percentage of missed words:</p>
        <button class="save-btn" onclick="saveResults()">Save</button>
        <a href="home.php" class="back-btn">Back to Home</a>
    </div>
</div>
<script>
    const recordButton = document.getElementsByClassName('record-btn')[0];
    const saveButton = document.getElementsByClassName('save-btn')[0];
    const missedDiv = document.getElementsByName('Missed_words')[0];
    const addedDiv = document.getElementsByName('Added_words')[0];
    const inputDiv = document.getElementsByClassName('input-text')[0];
    const percentageDiv = document.getElementById('percentage');

    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition || window.mozSpeechRecognition || window.msSpeechRecognition)();
    recognition.lang = 'en-US';
    recognition.continuous = true;
    var finalOutputArray = [];
    var i = 0;
    var percentageCounter = 0;

    function enableButton() {
        recordButton.disabled = false;
    }

    function missed_words(inputArray, outputArray) {
        let missed_position = [];
        let added_position = [];

        // Normalize the case of 'I' to 'i' in the outputArray
        outputArray = outputArray.map(word => word === 'I' ? 'i' : word);

        let count1 = 0;
        let count2 = 0;

        while (count1 < inputArray.length && count2 < outputArray.length) {
            if (inputArray[count1] === outputArray[count2]) {
                count1++;
                count2++;
            } else {
                // Check if the current word in outputArray is an added word
                if (inputArray[count1] === outputArray[count2+1]) {
                    added_position.push(count2);
                    count2++;
                }
                else if (inputArray[count1] === outputArray[count2+2] &&
                    inputArray[count1+1] !== outputArray[count2+1]) {
                    added_position.push(count2);
                    added_position.push(count2+1);
                    count2 = count2+2;
                }
                //If not, place the position of the missed word in missed_position
                else {
                    missed_position.push(count1);
                    count1++;
                }
            }
        }

        // If there are remaining words in inputArray, they are missed words
        while (count1 < inputArray.length) {
            missed_position.push(count1);
            count1++;
        }

        // If there are remaining words in outputArray, they are added words
        while (count2 < outputArray.length) {
            added_position.push(count2);
            count2++;
        }

        return {
            array1: missed_position,
            array2: added_position
        };
    }

    function highlightDifferingWords(inputArray, position) {
        const asterisk = '*';
        if (position.length === 0){
            missedDiv.textContent = "No missed words."
        }
        else {
            for (let i in position) {
                inputArray[position[i]] = asterisk.concat(inputArray[position[i]], asterisk);
            }
            missedDiv.textContent = inputArray.join(" ");
        }

    }

    function highlightAddedWords (position, outputArray) {
        const plus = '+';
        if (position.length === 0){
            addedDiv.textContent = "No added words."
        }
        else{
            for (let i in position) {
                outputArray[position[i]] = plus.concat(outputArray[position[i]], plus);
            }
            addedDiv.textContent = outputArray.join(" ");
        }
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
        highlightDifferingWords(userInputPunctuation, position.array1);

        highlightAddedWords(position.array2, finalOutputArray);

        // Calculate percentage of missed words
        const missedCount = position.array1.length;
        const totalWords = inputArray.length;
        const missedPercentage = (missedCount / totalWords) * 100;
        alert(missedPercentage)

        // Display the percentage of missed words
        percentageDiv.innerText = `Percentage of words missed: ${missedPercentage.toFixed(2)}%`;
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
        if (i === 0) {
            recognition.start();
        }
        else {
            missedDiv.textContent = '';
            addedDiv.textContent = '';
            i = 0;
            finalOutputArray = [];
            recognition.start();
        }
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
