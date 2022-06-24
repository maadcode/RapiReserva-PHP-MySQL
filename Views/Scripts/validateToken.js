import { ajaxPost } from './ajax.js';

document.addEventListener('DOMContentLoaded', (ev) => {
    validateToken();
})

const validateToken = () => {
    const url = 'http://localhost/Projects/RapiReserva/Controllers/loginController.php';
    let token = localStorage.getItem('tokenAuth') || "";
    let values = {
        token: token,
        validate: true
    }
    const form = new FormData();
    for(const property in values) {
        form.append(property, values[property])
    }
    fetch(url, {
        method: 'POST',
        body: form
    })
    .then(res => res.json())
    .then(response => {
        if(response.isValid && !window.location.href.includes('http://localhost/Projects/RapiReserva/Views/Pages/app.php')) {
            window.location.replace("http://localhost/Projects/RapiReserva/Views/Pages/app.php");
        } 
        if(!response.isValid && !window.location.href.includes('http://localhost/Projects/RapiReserva/Views/Pages/login.php')) {
            window.location.replace("http://localhost/Projects/RapiReserva/Views/Pages/login.php");
        }
    })
    .catch(err => console.error(err))
}

export async function saveToken(userId) {
    const url = 'http://localhost/Projects/RapiReserva/Controllers/authController.php';
    const values = {
      userId : userId,
      saveAuth: true 
    };
    const data = await ajaxPost(url, values);
    const validation = () => {
        await data
    }
    validation();
    data.then(res => console.log(res))
        .catch(err => console.log(err));
    // console.log(data);
    // if(data.Valid) {
    //     localStorage.setItem('tokenAuth', data.Token);
    //     return true;
    // }
    // return false;
  }