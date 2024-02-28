<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculator</title>


  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url("3.jpg"); 
      background-size: cover;
    }

    .calculator {
      text-align: center;
      border: 2px solid #F5F5DC;
      padding: 10px;
      border-radius: 10px;
      background-color: rgb(192, 192, 192); 
    }

    .display {
      width: 250px;
      height:50px;
      font-size: 30px;
      margin-bottom: 10px;
      border: 2px solid #D3D3D3;
    }

    .buttons {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1px;
    }

    button {
      border-radius: 50%;
      width: 50px;
      height: 50px;
      background-color: #D3D3D3;
      border: 0px solid rgba(222, 121, 247, 0.8);
      color: rgba(222, 121, 247, 0.8);
      font-size: 25px;
      font-family: Arial, Helvetica, sans-serif;
      outline: none;
    }

    button:hover {
      background-color: #DEB887;
      cursor: grab;
    }

    .history {
      margin-top: 50px;
      text-align: center;
      border: 2px solid #D3D3D3;
      padding: 25px;
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.8); 
    }

    #historyList {
      list-style: none;
      padding: 0;
    }

    #historyList li {
      border-bottom: 1px solid #D3D3D3C;
      margin: 5px 0;
      padding: 5px 0;
    }
  </style>
</head>
<body>
  <div class="calculator">
    <input type="text" class="display" readonly>
    <div class="buttons">
    
    <button onclick="appendToDisplay('0')">0</button>
      <button onclick="appendToDisplay('+')">+</button>
     
      <button onclick="appendToDisplay('/')">:</button>

      <button onclick="appendToDisplay('4')">4</button>
      <button onclick="appendToDisplay('5')">5</button>
      <button onclick="appendToDisplay('6')">6</button>
      <button onclick="appendToDisplay('*')">x</button>

      <button onclick="appendToDisplay('1')">1</button>
      <button onclick="appendToDisplay('2')">2</button>
      <button onclick="appendToDisplay('3')">3</button>
      <button onclick="appendToDisplay('-')">-</button>

      <button onclick="appendToDisplay('7')">7</button>
      <button onclick="appendToDisplay('8')">8</button>
      <button onclick="appendToDisplay('9')">9</button>
      <button class="equals" onclick="calculate()">=</button>
      <button class="clear" onclick="clearDisplay()">C</button>

    </div>
  </div>

  <div class="history">
    <h3>History</h3>
    <ul id="historyList"></ul>
  </div>

  <script>

let lastOperation = "";
let currentCalculation = "";

const display = document.querySelector('.display');
const historyList = document.getElementById('historyList');

function appendToDisplay(value) {
  display.value += value;
  if (isNaN(value)) {
    lastOperation = value;
  }
}


function calculatePercentage() {
  try {
    const expression = display.value;
    const operands = expression.split(/[\+\-\*\/]/); 
    const operator = expression.match(/[\+\-\*\/]/); 

    const lastOperand = parseFloat(operands[operands.length - 1]);
    
    const result = lastOperand / 100;

    const calculatedExpression = operands.slice(0, operands.length - 1).join(operator) + operator + result;

    display.value = eval(calculatedExpression);

    currentCalculation = `${calculatedExpression} = ${display.value}`;
    saveToHistory(currentCalculation);
  } catch (error) {
    display.value = 'Error';
  }
}



function calculate() {
  try {
    const result = eval(display.value);
    currentCalculation = `${display.value} = ${result}`;
    display.value = result;
    saveToHistory(currentCalculation);
  } catch (error) {
    display.value = 'Error';
  }
}

function clearDisplay() {
  display.value = '';
}

function deleteLast() {
  display.value = display.value.slice(0, -1);
}


function saveToHistory(operation) {
  const MAX_HISTORY_LENGTH = 5; 
  const historyItem = document.createElement('li');
  historyItem.innerText = operation;
  historyList.appendChild(historyItem);
}

  </script>
  
  <script src="script.js"></script>
</body>
</html>


