<style>
    .preloader_container{
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-content: center;
        height: 100%;
    }

    .preloader {
        margin: 0 auto 0;
        transform: translateZ(0);
    }

    .preloader:before,
    .preloader:after {
        content: '';
        position: absolute;
        top: 0;
        z-index: 999;
    }

    .preloader:before,
    .preloader:after,
    .preloader {
        border-radius: 50%;
        width: 1.5em;
        height: 1.5em;
        animation: animation 1.2s infinite ease-in-out;
    }

    .preloader {
        animation-delay: -0.16s;
    }

    .preloader:before {
        left: -2.5em;
        animation-delay: -0.32s;
    }

    .preloader:after {
        left: 2.5em;
    }

    @keyframes animation {

        0%,
        80%,
        100% {
            box-shadow: 0 2em 0 -1em var(--secondary_background);
        }

        40% {
            box-shadow: 0 2em 0 0 var(--secondary_background);
        }
    }
</style>

<div class="container preloader_container d-none">
    <div class="preloader"></div>
</div>
