require('./bootstrap');

//canal publico
// Echo.channel('notificaciones')
//     .listen('UserSessionChanged', (e) => {
//         const notificacionElement = document.getElementById('notificacion')
//         notificacionElement.innerText = e.mensaje;
//         notificacionElement.classList.remove('invisible')
//         notificacionElement.classList.remove('alert-success')
//         notificacionElement.classList.remove('alert-danger')
//         notificacionElement.classList.add(`alert-${e.tipo_mensaje}`)
//     })

//canal privado
Echo.private('notificaciones')
    .listen('UserSessionChanged', (e) => {
        const notificacionElement = document.getElementById('notificacion')
        notificacionElement.innerText = e.mensaje;
        notificacionElement.classList.remove('invisible')
        notificacionElement.classList.remove('alert-success')
        notificacionElement.classList.remove('alert-danger')
        notificacionElement.classList.add(`alert-${e.tipo_mensaje}`)
    })
