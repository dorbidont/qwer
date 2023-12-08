// Функция для проверки кода защиты
let problem;
function generateArithmeticProblem() {
// Выбираем случайные числа от 1 до 10
const number1 = Math.floor(Math.random() * 10) + 1;
const number2 = Math.floor(Math.random() * 10) + 1;

// Выбираем случайную операцию (сложение, вычитание, умножение или деление)
const operators = ['+', '-', '*', '/'];
const operator = operators[Math.floor(Math.random() * operators.length)];
console.log(`${number1}${operator}${number2}=`);
document.getElementById('capch-form').innerHTML =  `${number1}${operator}${number2}=`;

// Генерируем арифметический пример
if (operator === '+') {
problem = number1 + number2;
} else if (operator === '-') {
problem = number1 - number2;
} else if (operator === '*') {
problem = number1 * number2;
} else {
// Убеждаемся, что деление дает целый результат
problem = number1 / number2;
}

return problem;
}
generateArithmeticProblem();
function checkCaptcha() {
const captchaInput = document.getElementById('captcha-code');
const captchaValue = Number(captchaInput.value); // Получаем значение из поля ввода кода защиты
// Здесь должна быть логика проверки кода, например, сравнение с ожидаемым значением


if (captchaValue !== problem) {
generateArithmeticProblem();
document.getElementById('comment-result').innerHTML = 'Неверный код защиты!';
return false; // Остановить отправку формы
}

return true; // Код защиты верен
}

// Функция для удаления ссылок из текста комментария
function removeLinksFromComment() {
const commentText = document.getElementById('comment-text');
const commentValue = commentText.value;
// Используем регулярное выражение для удаления всех ссылок из текста
const commentWithoutLinks = commentValue.replace(/<a\b[^>]*>.*?<\/a>/gi, ''); // Это удалит <a> теги

// Обновляем значение поля ввода комментария
commentText.value = commentWithoutLinks;
}

// Обработка отправки формы
const commentForm = document.getElementById('comment-form');
commentForm.addEventListener('submit', function (e) {
e.preventDefault(); // Предотвращаем отправку формы по умолчанию

// Проверяем код защиты
if (checkCaptcha()) {
// Удаляем ссылки из комментария перед отправкой
removeLinksFromComment();

// Вместо этого места вы можете выполнить AJAX-запрос для отправки комментария на сервер
// и обработать ответ от сервера
generateArithmeticProblem();
document.getElementById('comment-result').innerHTML = 'Комментарий отправлен!';
}
});