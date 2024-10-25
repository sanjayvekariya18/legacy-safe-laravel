import './bootstrap';
import $ from 'jquery';
import 'bootstrap';
import { Select } from './custom/Select.js';

window.$ = window.jQuery = $;


window.windowWidth = $(window).width();
window.windowHeight = $(window).height();

window.isiPhone = navigator.userAgent.toLowerCase().indexOf('iphone');
window.isiPad = navigator.userAgent.toLowerCase().indexOf('ipad');
window.isiPod = navigator.userAgent.toLowerCase().indexOf('ipod');

$(document).ready(function () {
    window.select = new Select();
    window.select.init();
});
