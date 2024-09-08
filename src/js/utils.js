window.onload = function () {
     this.FechaActual();
}

function FechaActual() {
     var fecha = new Date(); //Fecha actual
     var mes = fecha.getMonth() + 1; //obteniendo mes
     var dia = fecha.getDate(); //obteniendo dia
     var anho = fecha.getFullYear(); //obteniendo año
     if (dia < 10)
          dia = '0' + dia; //agrega cero si el menor de 10
     if (mes < 10)
          mes = '0' + mes //agrega cero si el menor de 10
     $('#Fecha').val(anho + "-" + mes + "-" + dia);
}

function mensaje(position, timer, icon, title) {
     const Toast = Swal.mixin({
          toast: true,
          position: position,
          showConfirmButton: false,
          timer: timer,
     })

     Toast.fire({
          icon: icon,
          title: title
     });
}

function validaInputs(datos) {
     var cont = 0;
     var vacio = false;
     for (let i = 0; i < datos.length; i++) {
          if (datos[i] === "" || datos[i] === 0) {
               cont++;
          }
     }

     if (cont > 0) {
          vacio = true
     }
     return vacio;
}

function validaArrayAsociativo(datos) {
     var cont = 0;
     var vacio = false;
     datos.forEach(element => {
          if (element.codRepuesto == "" || element.Descripcion == "" || element == "0") {
               cont++
          }
     });

     if (cont > 0) {
          vacio = true
     }
     return vacio;
}

function iniciarArray(array) {
     array.splice(0, array.length);
}

function msgError(title, text) {
     Swal.fire({
          // icon: 'error',
          title: title,
          text: text,
     });
}

function msgErrorConexion() {
     const Toast = Swal.mixin({
          toast: true,
          position: 'top',
          showConfirmButton: false,
          timer: 1500,
     })

     Toast.fire({
          icon: 'error',
          title: 'Error de Conexión con la BD'
     });
}

function pfrm(frm) {
     new Response(frm).text().then(console.log);
}