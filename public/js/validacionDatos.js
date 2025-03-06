document.addEventListener("DOMContentLoaded", () => {
  let bEnviar = document.getElementById("enviarDatos");
  bEnviar.addEventListener("click", (e) => {
    let nameUsuario = document.getElementById("inputUser").value;
    let passUsuario = document.getElementById("inputPassword").value;

    let vNameUsuario = /^[a-zA-Z0-9_]{4,16}$/; //Mayusculas, minusculas, numero y guiones bajos. Entre 4 y 16 caracteres.
    let vPassUsuario =
      /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/; //Min 1 mayuscula, 1 minuscula, 1 numero, 1 caracter especial. Entre 8 y 20 caracteres.

    let usuarioValido = vNameUsuario.test(nameUsuario);
    let PassValido = vPassUsuario.test(passUsuario);

    if (usuarioValido && PassValido) {
      let form = document.getElementById("formDatosUser");
      form.submit();
    } else {
      if (!usuarioValido) {        
        let avisoAnteriorUsuario = document.getElementById("avisoErrorUsuario");
        if (avisoAnteriorUsuario) {
          avisoAnteriorUsuario.remove();
        }
        let divAvisoUsuario = document.createElement("div");
        divAvisoUsuario.id = 'avisoErrorUsuario';
        divAvisoUsuario.classList.add('avisoError');
        divAvisoUsuario.innerHTML = 'El usuario debe tener entre 4 y 16 caracteres y solo puede estar formado por:<ul><li>Mayusculas</li><li>Minuscualas</li><li>Numeros</li><li>Guiones bajos</li></ul>'
        document.getElementById('usuario').append(divAvisoUsuario);
      }else{
        let avisoAnteriorUsuario = document.getElementById("avisoErrorUsuario");
        if (avisoAnteriorUsuario) {
          avisoAnteriorUsuario.remove();
        }
      }
      if(!PassValido){
        let avisoAnteriorPass = document.getElementById('avisoErrorPass');
        if (avisoAnteriorPass) {
            avisoAnteriorPass.remove();
        }
        let divAvisoPass = document.createElement('div');
        divAvisoPass.id = 'avisoErrorPass';
        divAvisoPass.classList.add('avisoError');
        divAvisoPass.innerHTML = 'La contraseña debe tener entre 8 y 20 caracteres y contener al menos: <ul><li>1 Mayuscula</li><li>1 Minuscula</li><li>1 Numero</li><li>1 Caracter especial</li></ul>'
        document.getElementById('passw').append(divAvisoPass);
      }else{
        let avisoAnteriorPass = document.getElementById('avisoErrorPass');
        if (avisoAnteriorPass) {
            avisoAnteriorPass.remove();
        }
      }
    }
  });
});
