//Ver a senha
function seepass(){
    var passInput = document.getElementById('inppassword')
    var eyeimg = document.getElementById('eyeimg')

    if(passInput.type == 'password'){
        passInput.type = 'text'
        eyeimg.src = 'imgs/closedeye.png'
    }else{
        passInput.type = 'password'
        eyeimg.src = 'imgs/openeye.png'
    }
}

//Máscara para senha 
function mascpass(){
        var charCode = window.event.keyCode;
        var keysArr = [109,106,110,111,107,222,189,188,190,191,186,219,220,221,192,187]

        if(keysArr.includes(charCode)){
            alert('Só letras e números!')
            passTyped = formlogin.senha.value;
            ersErr = formlogin.senha.value.length-1
            formlogin.senha.value = passTyped.substring(ersErr,0)
        }else{
            return true;
        }
}


