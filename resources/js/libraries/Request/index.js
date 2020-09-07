import axios from 'axios'

export default {

    send(config){
        const configAxios ={
            url: 'http://gabriel-manara-api.herokuapp.com/api/'+config.endpoint,
            method: config.method,
            data: config.data,
            headers : {
                'Content-Type' : 'application/json; charset=UTF-8',
               
            }
        }
        console.log(configAxios.url)
        if(localStorage.getItem('auth_token')){
            configAxios.headers.Authorization = 'Bearer ' + localStorage.getItem('auth_token')
        }
        return new Promise((resolve, reject) => {
            axios(configAxios).then((response) => {
                console.log(response);
                resolve(response);
            }).catch((error) => {
                console.log(error);
                reject(error);
            })
        })
    }


}