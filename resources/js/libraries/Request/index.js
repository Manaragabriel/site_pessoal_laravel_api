import axios from 'axios'

export default {

    send(config){
        const configAxios ={
            url: 'http://localhost/projeto-crud-contatos/'+config.endpoint,
            method: config.method,
            data: config.data,
            headers : {
                'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8',
               
            }
        }
        return new Promise((resolve, reject) => {
            axios(configAxios).then((response) => {
                resolve(response)
            }).catch((error) => {
                reject(error)
            })
        })
    }


}