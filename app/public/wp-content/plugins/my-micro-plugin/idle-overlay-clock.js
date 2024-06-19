jQuery(document).ready(function($) {
    // Added specific classes to the nav menu items in order to show only specific ones once the user is logged out.
    // Also redirected the user to the login url to force login and registration. 
    loginMenu();
    function loginMenu() {
        if (ioc_user_data.is_logged_in) {
            $('.logged-in-only').css('display', 'block');
            $('.logged-out-only').css('display', 'block');
        }else{
            $('.logged-in-only').css('display', 'none');
            $('.logged-out-only').css('display', 'block');
        }
    }

    let overlayTimeout;
    //In order to test that our wp_enqueue_script is called properly, I trigger a function that after 10seconds will show the overlay.
    function timerIncrement() {
        showOverlay();
        storeUserActivity(); //Update the user activity in the database.
    }
    // Calls the custom_ajax object
    function storeUserActivity() {
        $.ajax({
            url: custom_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'store_user_activity'
            },
            success: function(response) {
                if(response.success) {
                    console.log('User activity recorded');
                } else {
                    console.log('Failed to record user activity: ' + response.data);
                }
            },
            error: function(error) {
                console.log('AJAX error: ' + error);
            }
        });
    }


// Timer is reset after the user moves mouse or presses a key
    function resetTimer() {
        hideOverlay();
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

    async function hideOverlay() {
        $('#ioc-overlay').fadeOut();
        if (overlayTimeout) {
            clearTimeout(overlayTimeout);
        }
        overlayTimeout = setTimeout(timerIncrement, 10000);
    }
    //Current clock time and date
    function updateClock() {
        let now = new Date();
        $('#ioc-clock').text(now.toLocaleTimeString());
        $('#ioc-date').text(now.toDateString());
    }
    //Update methods every second for clock and timer for showing the overlay every second
    //resetTimer()
    setInterval(updateClock, 1000);
    overlayTimeout = setTimeout(timerIncrement, 10000);

    //Reset trigger
    $(this).mousemove(resetTimer);
    $(this).keypress(resetTimer);

    //append the html code in body
    $('body').append(`
        <section id="ioc-overlay" style="display:none;">
            <ul id="ioc-overlay-list">
                <li id="ioc-clock"></li>
                <li id="ioc-date"></li>
                <hr>
                <li id="user-name"></li>
                <li id="user-email"></li>
            </ul>
        </section>
    `);
});