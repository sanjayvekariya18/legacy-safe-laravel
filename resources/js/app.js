import './bootstrap';
import $ from 'jquery';
import 'bootstrap';
import { Select } from './custom/Select.js';


import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import.meta.glob([ '../images/**', ]);


window.$ = window.jQuery = $;

window.Pusher = Pusher;

window.windowWidth = $(window).width();
window.windowHeight = $(window).height();

window.isiPhone = navigator.userAgent.toLowerCase().indexOf('iphone');
window.isiPad = navigator.userAgent.toLowerCase().indexOf('ipad');
window.isiPod = navigator.userAgent.toLowerCase().indexOf('ipod');

$(document).ready(function () {
    window.select = new Select();
    window.select.init();
});


const echo = new Echo({
    broadcaster: 'pusher',
    key: 'eaa456bf7cb5a74aa2a4',
    cluster: 'ap2',
    forceTLS: true,
});

echo.channel('message.1')
    .listen('message.sent', (event) => {
        console.log('New message:', event.message);
    });















