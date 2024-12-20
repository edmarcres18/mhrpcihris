<!-- Add in the head section after SweetAlert2 CSS -->
<style>
    /* Base Toast Styles */
    .custom-toast {
        padding: 12px 16px !important;
        margin-top: 16px !important;
        margin-right: 16px !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        font-size: 14px !important;
        max-width: 356px !important;
        width: auto !important;
    }

    /* Light Mode Styles */
    @media (prefers-color-scheme: light) {
        .custom-toast {
            background: #ffffff !important;
            color: #333333 !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            border-left: 4px solid #28a745 !important;
        }

        .custom-toast .custom-toast-title {
            color: #333333 !important;
            font-weight: 500 !important;
        }

        .custom-toast-progress {
            background: rgba(40, 167, 69, 0.2) !important;
        }

        .custom-toast-progress:before {
            background-color: #28a745 !important;
        }

        /* Success Icon in Light Mode */
        .custom-toast .swal2-success-ring {
            border-color: #28a745 !important;
        }

        .custom-toast .swal2-success-line-tip,
        .custom-toast .swal2-success-line-long {
            background-color: #28a745 !important;
        }
    }

    /* Dark Mode Styles */
    @media (prefers-color-scheme: dark) {
        .custom-toast {
            background: #2d3748 !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-left: 4px solid #2ecc71 !important;
        }

        .custom-toast .custom-toast-title {
            color: #ffffff !important;
            font-weight: 500 !important;
        }

        .custom-toast-progress {
            background: rgba(46, 204, 113, 0.2) !important;
        }

        .custom-toast-progress:before {
            background-color: #2ecc71 !important;
        }

        /* Success Icon in Dark Mode */
        .custom-toast .swal2-success-ring {
            border-color: #2ecc71 !important;
        }

        .custom-toast .swal2-success-line-tip,
        .custom-toast .swal2-success-line-long {
            background-color: #2ecc71 !important;
        }
    }

    /* Hover Effects */
    .custom-toast:hover {
        transform: translateY(-2px) !important;
        transition: transform 0.2s ease-in-out !important;
    }

    /* Animation */
    .custom-toast.swal2-show {
        animation: slide-in 0.3s ease-out !important;
    }

    @keyframes slide-in {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .custom-toast {
            max-width: calc(100vw - 32px) !important;
            margin: 8px !important;
            font-size: 13px !important;
        }
    }

    /* High Contrast Support */
    @media (forced-colors: active) {
        .custom-toast {
            border: 2px solid CanvasText !important;
        }
    }

    /* Ensure Icon Visibility */
    .custom-toast .swal2-icon {
        margin: 0 8px 0 0 !important;
        transform: scale(0.8) !important;
    }

    /* Toast Content Layout */
    .custom-toast .swal2-content {
        padding: 0 !important;
        margin: 0 !important;
    }

    .custom-toast .swal2-html-container {
        margin: 0 !important;
        padding: 0 !important;
    }
</style>

<!-- Add these in the head section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/css/shepherd.css"/>
<script src="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/js/shepherd.min.js"></script>

<!-- Add this before closing body tag -->
<script>
    function initTour() {
        const tour = new Shepherd.Tour({
            defaultStepOptions: {
                cancelIcon: {
                    enabled: true
                },
                classes: 'shepherd-theme-custom',
                scrollTo: true
            }
        });

        // Add steps based on data attributes in your blade files
        document.querySelectorAll('[data-tour]').forEach(element => {
            const tourData = JSON.parse(element.dataset.tour);
            tour.addStep({
                text: tourData.text,
                attachTo: {
                    element: element,
                    on: tourData.position || 'bottom'
                },
                buttons: [
                    {
                        text: 'Next',
                        action: tour.next
                    }
                ]
            });
        });

        // Start the tour
        tour.start();
    }

    // You can trigger the tour with a button or automatically
    // document.addEventListener('DOMContentLoaded', initTour);
</script>

    .shepherd-element {
        background: var(--background-color, #ffffff) !important;
        color: var(--text-color, #333333) !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    }

    @media (prefers-color-scheme: dark) {
        .shepherd-element {
            --background-color: #2d3748;
            --text-color: #ffffff;
        }
    }

    .shepherd-button {
        background: #4299e1 !important;
        color: white !important;
        border-radius: 4px !important;
        padding: 8px 12px !important;
    }

    .shepherd-button:hover {
        background: #3182ce !important;
    }
</style>

<!-- Add this before closing body tag -->
<script>
    function initTour() {
        const tour = new Shepherd.Tour({
            defaultStepOptions: {
                cancelIcon: {
                    enabled: true
                },
                classes: 'shepherd-theme-custom',
                scrollTo: true
            }
        });

        // Add steps based on data attributes in your blade files
        document.querySelectorAll('[data-tour]').forEach(element => {
            const tourData = JSON.parse(element.dataset.tour);
            tour.addStep({
                text: tourData.text,
                attachTo: {
                    element: element,
                    on: tourData.position || 'bottom'
                },
                buttons: [
                    {
                        text: 'Next',
                        action: tour.next
                    }
                ]
            });
        });

        // Start the tour
        tour.start();
    }

    // You can trigger the tour with a button or automatically
    // document.addEventListener('DOMContentLoaded', initTour);
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let lastTimestamp = Date.now() / 1000;

    // Initialize Pusher
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        encrypted: true
    });

    // Subscribe to notifications channel
    const channel = pusher.subscribe('notifications');

    // Listen for new notifications
    channel.bind('App\\Events\\NewNotification', function(data) {
        updateNotificationsUI(data);
        playNotificationSound();
        showToast('You have new notifications');
    });

    // Poll for updates every 30 seconds
    setInterval(checkForUpdates, 30000);

    function checkForUpdates() {
        fetch('/notifications/check-updates', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ lastTimestamp: lastTimestamp })
        })
        .then(response => response.json())
        .then(data => {
            if (data.hasUpdates) {
                updateNotificationsUI(data.notifications);
                lastTimestamp = data.notifications.timestamp;
                playNotificationSound();
                showToast('You have new notifications');
            }
        })
        .catch(error => console.error('Error checking for updates:', error));
    }

    function updateNotificationsUI(notifications) {
        // Update notification count
        const countElement = document.querySelector('#notification-count');
        if (countElement) {
            countElement.textContent = notifications.label;
        }

        // Update dropdown content
        const dropdownElement = document.querySelector('#notification-dropdown');
        if (dropdownElement) {
            dropdownElement.innerHTML = notifications.dropdown;
        }
    }

    function playNotificationSound() {
        const audio = new Audio('/path/to/notification.mp3');
        audio.play().catch(e => console.log('Sound play failed:', e));
    }

    function showToast(message) {
        // If you're using toastr
        if (typeof toastr !== 'undefined') {
            toastr.info(message);
        } else {
            // Fallback to alert
            console.log(message);
        }
    }
});
</script>
