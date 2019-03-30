/**
 * Hide slider on mobile
 */

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    $('.header-menu').css('display','none');
    $('.slider').css('display','none');
    $('.footer-top-container').css('display','none');

    $('.mobile-bar').css('display', 'block');
    $('body').css('padding-top','150px');

}

/**
 * Dynamic login screen.
 *
 * @type {jQuery|HTMLElement}
 */

var loginBtn    = $('a#login-toggle');
var loginForm   = $('.login-form');
var registrForm = $('.register-form');

var hasAccount = true;

loginBtn.click(() => {

    if (!hasAccount) {
        loginForm.css('display', 'none');
        registrForm.css('display', 'block');
        hasAccount = !hasAccount;
    } else {
        loginForm.css('display', 'block');
        registrForm.css('display', 'none');
        hasAccount = !hasAccount;
    }

});


/**
 * Logout confirm
 */
$('.logout-btn').click(function() {
    var logout = confirm("Are you sure to logout?");

    if(logout){
        location.href = "../multiversum/includes/logout.php";
    }
});

/**
 * Graph render admin page.
 *
 * @type {CanvasRenderingContext2D | WebGLRenderingContext}
 */

var values = [];

$('span.statistics-result').each(function() {
    values.push($(this).text());
});

var ctx = document.getElementById('myChart').getContext('2d');

var chart = new Chart(ctx, {
    type: 'pie',

    data: {
        labels: ['Amount Products', 'Products Sold', 'Average prices'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: [
                '#4c9789',
                '#3b7968',
                '#1c6f78',
            ],
            borderColor: '#fff',
            data: values
        }]
    },

    // Configuration options go here
    options: {}
});
