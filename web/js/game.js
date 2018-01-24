var present = '';
var money_count = parseInt(document.getElementById('money-count').innerText);
var bonus_count = parseInt(document.getElementById('bonus-count').innerText);
function startGame() {
    var main_range = getRandomInteger(1,10000);
    var message = '<div class="win-message">';
    if(main_range % 2 == 0){
        present = getPresentFromList();
        message += '<div class="success-win">Congratulations! <br /> You are win ' + present + '</div>';
        message += '<div class="win-btn">';
        message +=  '<input type="button" class="get-present" onclick="sendPresent()" value="Get Present" />';
        message +=  '<input type="button" class="dismiss-present" onclick="dismissPresent()" value="Dismiss" />';
        message += '</div>';
    }else{
        if(main_range % 3 == 0){
            var bonus_random = getRandomInteger(10,100);
            bonus_count = bonus_count + bonus_random;
            message += '<div class="success-win">Congratulations! <br /> You are win ' + bonus_random + ' bonus money!</div>';
            message += '<div class="win-btn">';
            message +=  '<input type="button" class="get-present" onclick="getBonus()" value="Get Present" />';
            message +=  '<input type="button" class="dismiss-present" onclick="dismissPresent()" value="Dismiss" />';
            message += '</div>';
        }else{
            if(main_range % 5 == 0){
                var money_random = getRandomInteger(50,1000);
                money_count = money_count + money_random;
                message += '<div class="success-win">Congratulations! <br /> You are win $' + money_random + '!</div>';
                message += '<div class="win-btn">';
                message +=  '<input type="button" class="get-present" onclick="getMoney()" value="Get Present" />';
                message +=  '<input type="button" class="dismiss-present" onclick="dismissPresent()" value="Dismiss" />';
                message += '</div>';
            }else{
                message += '<div class="not-win">Sorry! <br /> Please try again!</div>';
            }
        }
    }

    message += '</div>';

    document.getElementById('game-result').innerHTML = message;
}

function getRandomInteger(min, max){
    var rand = min - 0.5 + Math.random() * (max - min + 1);
    rand = Math.round(rand);
    return rand;
}

function getPresentFromList(){
    var presents_list = [
        "Candy",
        "Cup",
        "Laptop",
        "Pensil",
        "Phone",
        "Book",
        "Head phones",
        "Bike",
        "Toy",
        "Flash card"
    ];

    return presents_list[Math.floor(Math.random()*presents_list.length)];
}

function sendPresent() {
    var message = 'Your gift is accepted for processing. Our manager will contact you!';
    sendAjax('save-present', {present_name: present, present_status: 'in_progress'}, message);
}

function dismissPresent() {
    startGame();
}

function getBonus() {
    var message = 'Your bonus is added!';
    sendAjax('save-bonus', {bonus_count: bonus_count}, message);
    document.getElementById('bonus-count').innerText = bonus_count;
}

function getMoney() {
    if(money_count > 3000){
        alert('Sorry, you can get more than $3000');
        document.getElementById('game-result').innerHTML = '<div class="win-message"><div class="success-win">Please press button to continue game!</div></div>';
    }else{
        var message = 'Your money is added!';
        sendAjax('save-money', {money_count: money_count}, message);
        document.getElementById('money-count').innerText = money_count;
    }
}

function sendMoney() {
    alert('send money into cart action!');
}

function convertMoney() {
    alert('convert money to bonus action!');
}

function sendAjax(action, params, message){
    var url = 'index.php?r=game/' + action;
    $.post(url, params, function () {
        alert(message);
        document.getElementById('game-result').innerHTML = '<div class="win-message"><div class="success-win">Please press button to continue game!</div></div>';
    }).fail(function () {
        alert('Sorry something is wrong. Please contact administrator!');
    });
}