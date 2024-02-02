<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Calculator</title>
</head>
<body class="w-full h-full">
    <div class="grid grid-rows-12 w-11/12 h-full">
        <div class="grid row-span-10 grid-cols-4 grid-rows-7 gap-1 mt-5 bg-cyan-400 shadow-xl shadow-cyan-800">
            <input class="bg-white appearance-none border-2 border-cyan-400 rounded row-span-2 col-span-4 py-2 px-4 mx-2 mt-1 text-cyan-900 shadow-sm shadow-cyan-900 leading-tight focus:outline-none focus:border-cyan-400" name="input" id="input" type="text" value="0" disabled>
            <button class="col-span-2 bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('AC')">AC</button>
            <button class="col-span-2 bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('DEL')">DEL</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('7')">7</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('8')">8</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('9')">9</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('+')">+</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('4')">4</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('5')">5</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('6')">6</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('-')">-</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('1')">1</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('2')">2</button>
            <button class="bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('3')">3</button>
            <button class="row-span-2 bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('=')">=</button>
            <button class="col-span-3 bg-cyan-400 shadow-sm shadow-cyan-900 hover:text-red-600 hover:font-bold" onclick="getTotal('0')">0</button>
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
                removeLastChar: function (val) {
                    if (val == 'num') {
                        num = num.slice(0, -1);
                    }
                    else if (val == 'currentInput') {
                        currentInput = currentInput.slice(0, -1);
                    }
                    else if (val == 'arr') {
                        arr.splice(0, -1);
                    }
                },
                resetCurrentInput: function (val) {
                    currentInput = "";
                },
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
                        num = "";
                    }
                },
                getNum: function () {
                    return num;
                },
                addArrItem: function (val) {
                    arr.push(val);
                },
                resetArr: function () {
                    arr.splice(0, arr.length);
                },
                getArr: function () {
                    return arr;
                },
                setTotal: function (val) {
                    total = val;
                },
                getTotal: function () {
                    return parseInt(total);
                }
            };

        })();

        function getTotal(input){
            if (input == 'AC') {
                values.setNum('');
                values.resetArr();
                values.resetCurrentInput('');
                values.setTotal(0);
                document.getElementById('input').value = '0';
            }
            else if (input == 'DEL') {
                if (values.getArr().length == 0) {
                    values.setTotal(0);
                    document.getElementById('input').value = '0';
                }
                else {
                    values.removeLastChar('num');
                    values.removeLastChar('currentInput');
                    values.removeLastChar('arr');
                    document.getElementById('input').value = values.getCurrentInput('');
                }
            }
            else if (input != '=') {
                if (input != '+' && input != '-'){
                    values.setNum(input)
                    values.setCurrentInput(input)
                }
                else {
                    if (values.getTotal() != 0) {
                        values.setNum(values.getTotal());
                        values.setCurrentInput(values.getTotal());
                        values.addArrItem(values.getNum(input));
                        values.addArrItem(input);
                        values.setCurrentInput(input);
                        values.setNum('');
                        values.setTotal(0);
                    }
                    else {
                        values.addArrItem(values.getNum(input));
                        values.addArrItem(input);
                        values.setCurrentInput(input);
                        values.setNum('');
                    }
                }
                document.getElementById('input').value = values.getCurrentInput('');
            }
            else {
                values.addArrItem(values.getNum(input))
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
                values.setNum('');
                values.resetArr();
                values.resetCurrentInput('');
            }
        }
    </script>
</body>
</html>