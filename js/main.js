/**
 * Hide slider on mobile
 */

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    $('.header-menu').css('display', 'none');
    $('.slider').css('display', 'none');
    $('.footer-top-container').css('display', 'none');

    $('.mobile-bar').css('display', 'block');
    $('body').css('padding-top', '150px');

}

/**
 * Dynamic login screen.
 *
 * @type {jQuery|HTMLElement}
 */

// var loginBtn    = $('a#login-toggle');
// var loginForm   = $('.login-form');
// var registrForm = $('.register-form');
//
// var hasAccount = true;
//
// loginBtn.click(() => {
//
//     if (!hasAccount) {
//         loginForm.css('display', 'none');
//         registrForm.css('display', 'block');
//         hasAccount = !hasAccount;
//     } else {
//         loginForm.css('display', 'block');
//         registrForm.css('display', 'none');
//         hasAccount = !hasAccount;
//     }
//
// });

$('.form-message').css('display', 'none');

/**
 * Logout confirm
 */
$('.logout-btn').click(function () {
    var logout = confirm("Are you sure to logout?");

    if (logout) {
        location.href = "../multiversum/includes/logout.php";
    }
});

/**
 * Mobile toggle
 */

$openBtn = $('.open-toggle');
$closeBtn = $('button.close-toggle');

$openBtn.click(function () {
    $('div.popup-menu').removeClass('close-menu');
});

$closeBtn.click(function () {
    $(this).parent().addClass('close-menu');
});

/**
 * Admin add product form
 */

var visible       = true;
var addPanel      = $('.admin-add');
var tablePanel    = $('.admin-table');
var addBtn        = $('.add-product');
var tableControls = $('.table-controls');

addBtn.click(function () {
    if (visible) {
        addPanel.css('display', 'block');
        tablePanel.css('display', 'none');
        addBtn.html('<i class="fas fa-times-circle" style="padding-right: 10px;"></i>Cancel').addClass('btn-danger');
        tableControls.css('display', 'none');
        visible = !visible;
    } else {
        addPanel.css('display', 'none');
        tablePanel.css('display', 'block');
        addBtn.html('<i class="fas fa-plus" style="padding-right: 10px;"></i>Add product').removeClass('btn-danger');
        tableControls.css('display', 'block');
        visible = !visible;
    }

});

/**
 * Displays err messages
 */

var url_string   = window.location.href; //window.location.href
var url          = new URL(url_string);
var errorMessage = url.searchParams.get("err");

console.log(errorMessage);

if (errorMessage) {
    alert(errorMessage);
}

/**
 * Graph render admin page.
 *
 * @type {CanvasRenderingContext2D | WebGLRenderingContext}
 */

var values = [];

$('span.statistics-result').each(function () {
    values.push($(this).text());
});

var ctx = document.getElementById('myChart').getContext('2d');

var chart = new Chart(ctx, {
    type: 'pie',

    data: {
        labels:   ['Amount Products', 'Products Sold', 'Average prices'],
        datasets: [{
            label:           'My First dataset',
            backgroundColor: [
                '#4c9789',
                '#3b7968',
                '#1c6f78',
            ],
            borderColor:     '#fff',
            data:            values
        }]
    },
    options: {}
});

/**
 * Admin page description toggle
 */

$('.open-description').click(function () {
    $(this).next().css('display', 'block');
});

$('.close-description').click(function () {
    $(this).parent().parent().parent().css('display', 'none');
});


