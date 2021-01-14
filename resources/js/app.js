require('./bootstrap');
require('alpinejs');
let Turbolinks = require("turbolinks");
require('bootstrap');
require('chosen-js');

// Add Event to Turbo Links
document.addEventListener("livewire:load", function(event) {
    Turbolinks.start();

    setTimeout(() => {
        let flashMessage = document.querySelector('.alert');
        if (flashMessage != null) {
            if (flashMessage.classList.contains('flash-message')) {
                flashMessage.classList.remove('show');
                
                setTimeout(() => {
                    flashMessage.remove();
                }, 300);
            }
        }
    }, 2000);
});

document.addEventListener("DOMContentLoaded", function () {
    window.livewire.start();
});

let firstTime = true;
document.addEventListener("turbolinks:load", function() {
    /* We only want this handler to run AFTER the first load. */
    if  (firstTime) {
        firstTime = false;
        return;
    }

    window.livewire.restart();
});

document.addEventListener("turbolinks:before-cache", function() {
    document.querySelectorAll('[wire\\:id]').forEach(function(el) {
        const component = el.__livewire;

        const dataObject = {
            data: component.data,
            events: component.events,
            children: component.children,
            checksum: component.checksum,
            name: component.name,
            errorBag: component.errorBag,
            redirectTo: component.redirectTo,
        };

        el.setAttribute('wire:initial-data', JSON.stringify(dataObject));
    });
});