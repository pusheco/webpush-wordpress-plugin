(function() {
    window.addEventListener('DOMContentLoaded', (event) => {
        var switches = document.querySelectorAll('.pw-switch');
        if (!!switches && switches.length > 0) {
            switches.forEach((elem) => {

                if (elem.classList.contains('active')) {
                    elem.querySelector('input.checkbox').checked = true;
                }

                elem.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (elem.classList.contains('active')) {
                        elem.classList.remove('active');
                        elem.querySelector('input.checkbox').checked = false;
                    } else {
                        elem.classList.add('active');
                        elem.querySelector('input.checkbox').checked = true;
                    }
                });
            });
        }
    });
})();