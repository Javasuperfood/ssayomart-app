<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .main-logo {
            width: 40%;
        }

        @media (min-width: 768px) {
            .main-logo {
                width: 20%;
            }
        }
    </style>
    <link rel="shortcut icon" href="https://apps.ssayomart.com/assets/img/logo.png" type="image/x-icon">
</head>

<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <img class="main-logo" src="https://apps.ssayomart.com/assets/img/logopanjang.png" alt="" srcset="">
                </div>
                <div class="col-12 text-center">
                    <picture>
                        <source srcset="https://www.freepik.com/free-vector/connecting-teams-concept-landing-page_5757111.htm#page=3&query=puzzle&position=24&from_view=search&track=sph&uuid=004d251b-0364-401e-8dbf-470cbbc1f981" type="image/svg+xml">
                    </picture>
                    <img src="/maintenance/m.png" class="img-fluid" alt="...">
                </div>
                <div class="col-12">
                    <h1 class="display-1 fw-bold">Sorry, we are under maintenance</h1>
                </div>
                <div class="col-12">
                    <p class="lead">Please check back later <span id="countdown"></span></p>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        function startCountdown(startTime, endTime) {
            const countdownElement = document.getElementById('countdown');

            function updateCountdown() {
                const now = new Date().toLocaleString('en-US', {
                    timeZone: 'Asia/Jakarta'
                });
                const currentTime = new Date(now).getTime();
                const timeDifference = endTime - currentTime;

                if (timeDifference <= 0) {
                    countdownElement.innerHTML = `<span class="badge text-bg-danger">00:00:00</span>`;
                } else {
                    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                    const hoursDifference = Math.floor((timeDifference / (1000 * 60 * 60) * 24) / 60);

                    countdownElement.innerHTML = `in <span class="badge text-bg-danger">${padZero(hoursDifference)}:${padZero(minutes)}:${padZero(seconds)}</span>`;

                    setTimeout(updateCountdown, 1000);
                }
            }

            function padZero(value) {
                return value < 10 ? `0${value}` : value;
            }

            updateCountdown();
        }

        const startTime = new Date().toLocaleString('en-US', {
            timeZone: 'Asia/Jakarta'
        });
        const endTime = new Date('<?= $endTime; ?>').toLocaleString('en-US', {
            timeZone: 'Asia/Jakarta'
        });

        startCountdown(new Date(startTime).getTime(), new Date(endTime).getTime());
    </script>


</body>

</html>