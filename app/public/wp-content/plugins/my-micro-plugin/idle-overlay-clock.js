jQuery(document).ready(function($) {
    //In order to test that our wp_enqueue_script is called properly, I trigger a function that after 10seconds will show the overlay.
    let idleTime = 0;
    function timerIncrement() {
        idleTime++;
        if (idleTime > 9) {
            showOverlay();
        }
    }

    function resetTimer() {
        idleTime = 0;
        if (idleTime < 8) {
            hideOverlay();
        }
    }

    function showOverlay() {
        $('#ioc-overlay').fadeIn();
        updateClock();
        
    }

    function hideOverlay() {
        $('#ioc-overlay').fadeOut();
    }

    function updateClock() {
        let now = new Date();
        $('#ioc-clock').text(now.toLocaleTimeString());
        $('#ioc-date').text(now.toDateString());
    }

    setInterval(timerIncrement, 1000);
    setInterval(updateClock, 1000);

    //Reset trigger
    $(this).mousemove(resetTimer);
    $(this).keypress(resetTimer);

    //append the html code in body
    $('body').append(`
        <div id="ioc-overlay" style="display:none;">
            <div id="ioc-clock"></div>
            <div id="ioc-date"></div>
            <div id="ioc-user-info">
                <ul>
                    <li id="user-name"></li>
                    <li id="user-email"></li>
                </ul>
            </div>
        </div>
    `);
});