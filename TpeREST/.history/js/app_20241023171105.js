"use strict"

const BASE_URL = "api/"; // url relativa a donde estoy parado (http://localhost/web2/2024/todo-list-rest/api)

// arreglo de tareas
let proveedores = [];

// event listener para insertar tarea
let form = document.querySelector("#proveedores-form");
form.addEventListener('submit', agregar);


async function obtenerTodos() {
    try {
        const respuesta = await fetch(BASE_URL + "proveedores");
        if (!respuesta.ok) {
            throw new Error('Error al llamar los proveedores');
        }

        proveedores = await respuesta.json();
        mostrarProveedores();
    } catch(error) {
        console.log(error)
    }
}

async function agregar(e) {
    e.preventDefault();

    let data = new FormData(form);
    let proveedor = {
        nombre: data.get('nombre'),
        contacto: data.get('contacto'),
        cuit: data.get('cuit'),
        direccion: data.get('direccion'),
        informacion_pago: data.get('informacion_pago'),
    };

    try {
        let respuesta = await fetch(BASE_URL + "proveedores", {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(proveedor)
        });
        if (!respuesta.ok) {
            throw new Error('Error del servidor');
        }

        let nuevoProveedor = await respuesta.json();

        // inserto la tarea nueva
        proveedores.push(nuevoProveedor);
        mostrarProveedores();

        form.reset();
    } catch(e) {
        console.log(e);
    }
}

obtenerTodos();