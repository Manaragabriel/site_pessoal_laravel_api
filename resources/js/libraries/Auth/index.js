export default {
     VerifyLogin : () => {
        
        if(!localStorage.getItem('auth_token')){
          location.href= "login"
        }
     }
 }