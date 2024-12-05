let mass = ['Логин', 'Имя', 'Фамилия', 'Отчество', 'Номер',  'Пароль', 'Потверждение пароля'];
let array = ['user', 'name', 'lastname', 'fathername', 'number', 'password', 'password_d'];
let pattern = [/^[a-zA-Z0-9А-Яа-я]{3,50}[^!@#$%\^&*()_+=-?:;№\|\/\\>]$/m,
        /^[А-Яа-яa-zA-Z]{2,50}[^0-9!@#$%\^&*()_+=-?:;.,№\|\/\\><{}'"`~&]$/mu,
        /^[А-Яа-яa-zA-Z]{2,50}[^0-9!@#$%\^&*()_+=-?:;.,№\|\/\\><{}'"`~&]$/mu,
        /^[А-Яа-яa-zA-Z]{2,50}[^0-9!@#$%\^&*()_+=-?:;.,№\|\/\\><{}'"`~&]$/mu,
        /^[ ]{0,1}[+]{0,1}[ ]{0,1}[0-9]{0,1}[ ]{0,1}[(]{0,1}[ ]{0,1}[0-9]{0,3}[ ]{0,1}[)]{0,1}[ ]{0,1}[0-9]{3}[ ]{0,1}[-]{0,1}[ ]{0,1}[0-9]{2}[ ]{0,1}[-]{0,1}[ ]{0,1}[0-9]{2}[^!@#$%^&*_=a-z<{}\'\"\`~&][ ]{0,1}$/m,
        /^[a-zA-Z0-9]{2,50}[^!@#$%\^&*()_+=-?:.,;№\|\/\\><{}\'\"\`~&]$/m,
        /^[a-zA-Z0-9]{2,50}[^!@#$%\^&*()_+=-?:.,;№\|\/\\><{}\'\"\`~&]$/m];

form.addEventListener('submit',function(event){
    let flag = true;
    if(document.querySelector('.blurSErr')){
        document.querySelector('.blurSErr').classList.add('blurS')
        document.querySelector('.blurSErr').classList.remove('blurSErr')
    }
    let indexCount = 0;
    array.forEach(element => {
        if (!flag)
            return;
        console.log(`${pattern[indexCount]}` + ' ' + `${document.getElementById(element).value}` + ' = ')
        console.log(pattern[indexCount].test(`${document.getElementById(element).value}`));
        if(!pattern[indexCount].test(`${document.getElementById(element).value}`)){
            // console.log(element)
            flag = false;
            let massage = '';
            if(array[indexCount] == 'name' || array[indexCount] == 'lastname' || array[indexCount] == 'fathername' || array[indexCount] == 'password' || array[indexCount] == 'password_d'){
                if(document.getElementById(element).value.length <= 2){
                    massage = 'не может содержать менее 3 или более 50 символов!';
                }
                else{
                    massage = 'не может содержать спецсимволов, точек и т.д.!';
                }
            }
            if(array[indexCount] == 'login'){
                if(document.getElementById(element).value.length <= 5){
                    massage = 'не может содержать менее 6 или более 50 символов!';
                }
                else{
                    massage = 'не может содержать спецсимволов, точек и т.д.!';
                }
            }
            if(array[indexCount] == 'number'){
                if(document.getElementById(element).value.length <= 6){
                    massage = 'не может содержать менее 7 или более 11 символов!';
                }
                else{
                    massage = 'не может содержать спецсимволов, точек и т.д.!';
                }
            }
            document.getElementById(element).parentElement.querySelector('.blurS').classList.add('blurSErr')
            document.getElementById(element).parentElement.querySelector('.blurS').classList.remove('blurS')
            document.getElementById('err').innerHTML = `<div class="contBlur"><h3 class="err">Ошибка: Поле ${mass[indexCount]} ${massage}</h3><div class="blurSErr"></div></div>`;
            indexCount++;
            return false;
        }
        indexCount++;
    });
    if (flag == false)
        event.preventDefault();
});
