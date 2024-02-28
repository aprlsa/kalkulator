const display = document.querySelector('.display');
const buttons = document.querySelectorAll('button');
const equals = document.querySelector('.equals');
const clear = document.querySelector('.clear');

buttons.forEach(button => {
 button.addEventListener('click', () => {
    if (button.textContent === 'C') {
      display.value = '';
    } else if (button.textContent === '=') {
      try {
        display.value = eval(display.value);
      } catch (error) {
        display.value = 'Error';
      }
    } else {
      display.value += button.textContent;
    }
 });
});

function appendToDisplay(value) {
  if (value === '%') {
    const currentValue = parseFloat(display.value);
    const newValue = currentValue / 100;
    display.value = newValue;
  } else {
    display.value += value;
    if (isNaN(value)) {
      lastOperation = value;
    }
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



equals.addEventListener('click', () => {
 try {
    display.value = eval(display.value);
 } catch (error) {
    display.value = 'Error';
 }
});

clear.addEventListener('click', () => {
 display.value = '';
});