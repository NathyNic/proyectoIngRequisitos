const compra = new Carrito();
const listaCompra = document.querySelector("#lista-compra tbody");
const carrito = document.getElementById('carrito');
const procesarCompraBtn = document.getElementById('procesar-compra');
const cliente = document.getElementById('cliente');
const correo = document.getElementById('correo');

cargarEventos();

function cargarEventos() {
    document.addEventListener('DOMContentLoaded', compra.leerLocalStorageCompra());

    //Eliminar productos del carrito
    carrito.addEventListener('click', (e) => { compra.eliminarProducto(e) });

    compra.calcularTotal();

    //cuando se selecciona procesar Compra
    procesarCompraBtn.addEventListener('click', procesarCompra);

    carrito.addEventListener('change', (e) => { compra.obtenerEvento(e) });
    carrito.addEventListener('keyup', (e) => { compra.obtenerEvento(e) });

}

function procesarCompra() {
    // e.preventDefault();
    if (compra.obtenerProductosLocalStorage().length === 0) {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'No hay productos, selecciona alguno',
            showConfirmButton: false,
            timer: 2000
        }).then(function () {
            window.location = "index.php";
        })
    }
    else if (cliente.value === '' || correo.value === '') {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Ingrese todos los campos requeridos',
            showConfirmButton: false,
            timer: 2000
        })
    }
    else {

        productosLS = compra.obtenerProductosLocalStorage();

        const mercadopago = require ('mercadopago');
        // Agrega credenciales
        mercadopago.configure({
        access_token: 'PROD_ACCESS_TOKEN'
        });


        let preference = {
            items: [
              {
                title: productosLS.titulo,
                unit_price: productosLS.precio,
                quantity: productosLS.cantidad,
              }
            ]
          };
          
          mercadopago.preferences.create(preference)
          .then(function(response){
          // Este valor reemplazará el string "<%= global.id %>" en tu HTML
            global.id = response.body.id;
          }).catch(function(error){
            console.log(error);
          });


        //aqui se coloca el user id generado en el emailJS
        (function(){
            emailjs.init('user_1vELAcSZVQReePNxseDpF');
        })();

        const btn = document.getElementById('procesar-compra');

        document.getElementById('procesar-pago')
        .addEventListener('submit', function(event) {
        event.preventDefault();

        btn.value = 'Sending...';

        const serviceID = 'gmail';
        const templateID = 'template_b7xnouq';

        emailjs.sendForm(serviceID, templateID, this)
            .then(() => {
            btn.value = 'Finalizar Compra';
            alert('Se confirmó tu compra! Gracias por confiar en HADTECSOFT, acabamos de enviarte un correo.');
            }, (err) => {
            btn.value = 'Finalizar Compra';
            alert(JSON.stringify(err));
            });
        });

        /* AGREGAR DATOS DETALLE DEL PEDIDO A UN TEXT AREA */
        const textArea = document.createElement('textarea');
        textArea.id = "detalleCompra";
        textArea.name = "detalleCompra";
        textArea.cols = 60;
        textArea.rows = 10;
        textArea.hidden = true;
        productosLS.forEach(function (producto) {
            textArea.innerHTML += `
                 Producto : ${producto.titulo} <br>
                 Precio : ${producto.precio} <br>
                 Cantidad: ${producto.cantidad} <br>
                --------------------------------------------- <br>
                `;
        });

        carrito.appendChild(textArea);

        /* ------------------------- */

        // document.getElementById('procesar-pago')
        //     .addEventListener('submit', function (event) {
        //         event.preventDefault();

        //         const cargandoGif = document.querySelector('#cargando');
        //         cargandoGif.style.display = 'block';

        //         const enviado = document.createElement('img');
        //         enviado.src = 'img/mail.gif';
        //         enviado.style.display = 'block';
        //         enviado.width = '150';

        //         const serviceID = 'gmail';
        //         const templateID = 'template_b7xnouq';

        //         emailjs.sendForm(serviceID, templateID, this)
        //             .then(() => {
        //                 cargandoGif.style.display = 'none';
        //                 document.querySelector('#loaders').appendChild(enviado);

        //                 setTimeout(() => {
        //                     compra.vaciarLocalStorage();
        //                     enviado.remove();
        //                     window.location = "index.html";
        //                 }, 2000);
        //             }, (err) => {
        //                 cargandoGif.style.display = 'none';
        //                 alert("Error al enviar el email\r\n Response:\n " + JSON.stringify(err));
        //             });
        //     });


    }
}

