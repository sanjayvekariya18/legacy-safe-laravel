import $ from 'jquery';
// Import Bootstrap's JS (this provides the modal functionality)
import * as bootstrap from 'bootstrap';
// Optionally, if you need Popper.js for tooltips, popovers, etc.
import { createPopper } from '@popperjs/core';
import { Select } from './custom/Select.js';
import { Document } from './custom/Document.js';

window.$ = window.jQuery = $;
// Expose bootstrap globally on the window object
window.bootstrap = bootstrap;


window.windowWidth = $(window).width();
window.windowHeight = $(window).height();

window.isiPhone = navigator.userAgent.toLowerCase().indexOf('iphone');
window.isiPad = navigator.userAgent.toLowerCase().indexOf('ipad');
window.isiPod = navigator.userAgent.toLowerCase().indexOf('ipod');

$(document).ready(function () {
    window.select = new Select();
    window.select.init();

    window.documentView = new Document();
    window.documentView.init();
});
