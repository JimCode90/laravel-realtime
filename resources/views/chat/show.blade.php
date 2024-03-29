@extends('layouts.app')
@push('styles')
    <style>

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Chat') }}</div>

                    <div class="card-body">
                        <div class="row p-2">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12 border rounded-lg p-3">
                                        <ul id="messages" class="list-unstyled overflow-auto" style="height: 45vh">
                                            <li>Test1: Hello</li>
                                            <li>Test2: Hello</li>
                                        </ul>
                                    </div>
                                </div>
                                <form method="post">
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="message">
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" id="send" class="btn btn-primary btn-block">Send
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-2">
                                <p><strong>Online now</strong></p>
                                <ul id="users" class="list-unstyled overflow-auto text-info" style="height:45vh">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const usersElement = document.getElementById('users');
        const messagesElement = document.getElementById('messages');
        //Código js para un canal de presencia
        Echo.join('chat')
            .here((users) => {          //Recibe la lista de usuarios
                console.log(users)
                users.forEach((user, index) => {
                    let element = document.createElement('li');
                    element.setAttribute('id', user.id)
                    element.innerText = user.name;
                    usersElement.appendChild(element)
                })
            })
            .joining((user) => {        //Reaccionar cuando un usuario nuevo se une a ese canal
                let element = document.createElement('li');
                element.setAttribute('id', user.id)
                element.innerText = user.name;
                usersElement.appendChild(element)
            })
            .leaving((user) => {        //Se ejecuta cuando un usuario abandona ese canal
                let element = document.getElementById(user.id);
                element.parentNode.removeChild(element)
            })
            .listen('MessageSent', (e) => {
                let element = document.createElement('li');
                element.setAttribute('id', e.user.id)
                element.innerText = e.user.name + ': ' + e.message;
                messagesElement.appendChild(element)
            })
    </script>

    <script>
        const sendElement = document.getElementById('send');
        const messageElement = document.getElementById('message');
        sendElement.addEventListener('click', (e) => {
            e.preventDefault();
            window.axios.post('/chat/message', {
                message: messageElement.value
            })
            messageElement.value = ''
        });

    </script>
@endpush
