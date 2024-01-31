<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/calculator.styles.css">
    <title></title>
</head>
<body>
    <div class="calculator-wrapper">
        <div class="input">
            <input id="input" type="text" value="0" disabled>
        </div>
        <div class="calculator-buttons">
            <button onclick="getTotal('7')">7</button>
            <button onclick="getTotal('8')">8</button>
            <button onclick="getTotal('9')">9</button>
            <button onclick="getTotal('+')">+</button>
            <button onclick="getTotal('4')">4</button>
            <button onclick="getTotal('5')">5</button>
            <button onclick="getTotal('6')">6</button>
            <button onclick="getTotal('-')">-</button>
            <button onclick="getTotal('1')">1</button>
            <button onclick="getTotal('2')">2</button>
            <button onclick="getTotal('3')">3</button>
            <button onclick="getTotal('=')">=</button>
            <button disabled></button>
            <button onclick="getTotal('0')">0</button>
            <button disabled></button>
            <button disabled></button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        // "use strict";
        var values = (function (val) {
            var num = ""
            var currentInput = ""
            var arr = []
            var total = 0;

            return {
                setCurrentInput: function (val) {
                    currentInput += val;
                },
                getCurrentInput: function () {
                    return currentInput;
                },
                setNum: function (val) {
                    if (val){
                        num += val;
                    }
                    else {
                        console.log('check')
                        num = "";
                    }
                    console.log(num)
                },
                getNum: function () {
                    return num;
                },
                setArr: function (val) {
                    arr.push(val);
                },
                getArr: function () {
                    return arr;
                },
                setTotal: function (val) {
                    total = val;
                },
                getTotal: function () {
                    return parseInt(total);
                },
            };

        })();

        function getTotal(input){
            if (input != '='){
                if (input != '+' && input != '-'){
                    values.setNum(input)
                    values.setCurrentInput(input)
                }
                else{
                    values.setArr(values.getNum(input))
                    values.setArr(input)
                    values.setCurrentInput(input)
                    values.setNum('')
                }
                document.getElementById('input').value = values.getCurrentInput('');
            }
            else {
                values.setArr(values.getNum(input))
                expression = values.getArr('')
                let temp = 0;
                let operator = '';
                for (let i=0; i<expression.length; i++){

                    if (i==0){
                        values.setTotal(parseInt(expression[i]));
                    }
                    else {
                        if (expression[i] == '+' || expression[i] == '-'){
                            operator = expression[i];
                        }
                        else{
                            if (operator == '+'){
                                temp = values.getTotal('');
                                values.setTotal(temp + parseInt(expression[i]));
                            }
                            else{
                                temp = values.getTotal('');
                                values.setTotal(temp - parseInt(expression[i]));
                            }
                        }
                    }
                }

                document.getElementById('input').value = values.getTotal();
            }
        }
    </script>
</body>
</html>