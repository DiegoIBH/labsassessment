jQuery(document).ready(function($) {
    //In order to test that our wp_enqueue_script is called properly, I trigger a function that after 10seconds will show the overlay.
    let idleTime = 0;
    function timerIncrement() {
        idleTime++;
        if (idleTime > 9) {
            showOverlay();
        }
    }
// Timer is reset after the user moves mouse or presses a key
    function resetTimer() {
        idleTime = 0;
        hideOverlay();
        // if (idleTime < 8) {
        //     hideOverlay();
        // }
    }
    //Triggered by timer Increment function, the overlay will fade in, trigger the updateClock function and the conditional.
    function showOverlay() {
        $('#ioc-overlay').fadeIn();
        updateClock();
        //If the user is logged in, we can show the user name and email
        if (ioc_user_data.is_logged_in) {
            $('#user-name').text(`${ioc_user_data.user_name}`);
            $('#user-email').text(`${ioc_user_data.user_email}`);
        }
    }

    function hideOverlay() {
        $('#ioc-overlay').fadeOut();
    }
    //Current clock time and date
    function updateClock() {
        let now = new Date();
        $('#ioc-clock').text(now.toLocaleTimeString());
        $('#ioc-date').text(now.toDateString());
    }
    //Update methods every second for clock and timer for showing the overlay every second
    setInterval(timerIncrement, 1000);
    setInterval(updateClock, 1000);

    //Reset trigger
    $(this).mousemove(resetTimer);
    $(this).keypress(resetTimer);

    //append the html code in body
    $('body').append(`
        <section id="ioc-overlay" style="display:none;">
            <ul id="ioc-overlay-list">
                <li id="ioc-clock"></li>
                <li id="ioc-date"></li>
                <li id="user-name"></li>
                <li id="user-email"></li>
            </ul>
        </section>
    `);
});