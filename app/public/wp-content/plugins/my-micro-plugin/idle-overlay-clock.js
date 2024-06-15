jQuery(document).ready(function($) {
    //In order to test that our wp_enqueue_script is called properly, I trigger a function that after 10seconds will show the overlay.
    let idleTime = 0;
    function timerIncrement() {
        idleTime++;
        if (idleTime > 9) {
            showOverlay();
        }
    }

    function showOverlay() {
        $('#ioc-overlay').fadeIn();
        
        
    }
    setInterval(timerIncrement, 1000);

    //append the html code in body
    $('body').append(`
        <div id="ioc-overlay" style="display:none;">
            <div id="ioc-clock">Clock</div>
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